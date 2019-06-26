import pandas as pd
import json
from pprint import pprint
import urllib.parse
import requests
import numpy as np

with open('selectionData.json') as json_data:
    data = json.load(json_data)
tag = data["data"][0]["tag"]


# Get the data
places = pd.read_excel(r'..\Datasets\ColomboPlace1.xlsx')
ratings = pd.read_excel(r'..\Datasets\ColomboPlaceReview.xlsx')

# creating and passsing series to new column
places["Indexes"] = places["Tags"].str.find(tag)

data = pd.merge(places, ratings, on='Location')

df_filtered = data.query('Indexes != -1')
max_rating = df_filtered.loc[df_filtered['Overall_Rating'].idxmax()]
location = max_rating['Location']


# Calculate mean rating of all places
df_filtered.groupby('Location')['Rating'].mean().sort_values(ascending=False)

# Calculate count rating of all places
df_filtered.groupby('Location')['Rating'].count().sort_values(ascending=False)

# creating dataframe with 'rating' count values
mean_ratings = pd.DataFrame(df_filtered.groupby('Location')['Rating'].mean())

mean_ratings['num of ratings'] = pd.DataFrame(df_filtered.groupby('Location')['Rating'].count())

moviemat = df_filtered.pivot_table(index='Reviewer_Name', columns='Location', values='Rating')

mean_ratings.sort_values('num of ratings', ascending=False)

user_ratings = moviemat.get(location).notnull()

similar = moviemat.corrwith(user_ratings)

corr = pd.DataFrame(similar, columns=['Correlation'])

# Similar places
corr.sort_values('Correlation', ascending=False)

corr = corr.join(mean_ratings['num of ratings'])


results = (corr[corr['num of ratings'] > 100]).sort_values('Correlation', ascending=False)
results1 = (results[results['Correlation'] > 0])
results2 = results1.index.get_values().tolist()
d = []

for i in range(len(results2)):
    to_json = results2[i]
    places1 = {
        'index' : i,
        'location': to_json
    }
    d.append(places1)
json = json.dumps(d)
print(json)

