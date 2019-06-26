<?php

$tagPost = $_GET["tag"];



 include('db.php');
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }


$array = Array (
    "0" => Array (
       "tag" => $tagPost
    )
    );

print_r($array);

$count = sizeof($array);
for ($x = 0; $x < $count; $x++) {
    //echo $someArray[$x]["location"]; // Access Array data
    echo "<br>";
   // echo $_REQUEST['id'];
    echo "<br>";
    $tag = $array[$x]["tag"];
    //Get image data from database
    $result = $db->query("SELECT * FROM restaurants");
    
    if($result->num_rows > 0){
    	 while(($restaurants = $result->fetch_assoc()) {}
      //  $Name = $restaurants["Name"];
      //  echo $Name;

    }else{
        echo 'restaurants not found...';
    }
} 
 $jsonData = json_encode($restaurants, JSON_PRETTY_PRINT);
file_put_contents('restaurantDetails.json', $jsonData);


// WHERE Tags LIKE '%$tag%' = '$tag'