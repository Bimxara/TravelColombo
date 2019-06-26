
/*
$jsonData2 = json_encode(array('data' => $LocationDetailsToFront), JSON_PRETTY_PRINT);

$fp = fopen('LocationDetailsToFront.json', 'a');//opens file in append mode  
fwrite($fp, $jsonData2);  
fclose($fp);  
  
echo "File appended successfully"; 
*/



/*

$inp = file_get_contents('mlOutput.json');
$tempArray = json_decode($inp, true);
array_push($tempArray, $sexArray);
$jsonData = json_encode($tempArray, JSON_PRETTY_PRINT);
file_put_contents('mlOutput.json', $jsonData);
echo $jsonData;
*/


/*$json3 = file_get_contents('./mlOutput.json');
$someArray = json_decode($json3, true);

//print_r($someArray);        // Dump all data of the Array

 include('db.php');
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }


$LocationDetailsToFront =array();


$count = sizeof($someArray);
for ($x = 0; $x < $count; $x++) {
    //echo $someArray[$x]["location"]; // Access Array data
    echo "<br>";
   // echo $_REQUEST['id'];
    echo "<br>";
    $tag = $someArray[$x]["location"];
    //Get image data from database
    $result = $db->query("SELECT * FROM locationdetails WHERE Name = '$tag'");
    
    if($result->num_rows > 0){
        $imgData = $result->fetch_assoc();
        array_push($LocationDetailsToFront,$imgData);
        //print_r($LocationDetailsToFront);

        $Name = $imgData['Name']; 
        $imgName = $imgData['ImageName']; 
        $imgAddress = $imgData['Address'];
        $imgRating = $imgData['Rating'];  
        echo "-------------------------------------------------------------------------";
        echo $Name;
        echo "<br>";
        echo $imgName;
        echo "<br>";
        echo $imgAddress;
        echo "<br>";
        echo $imgRating;
        echo "<br>";
        
    }else{
        echo 'Image not found...';
    }
} 

$json2 = json_encode(array('data' => $LocationDetailsToFront));

if (file_put_contents("LocationDetailsToFront.json", $json2))
    echo "Output ready to send to react Succsfully.";
else 
    echo "Weda naaaaa....";


///////////////Getting Guides////////////////////////////////
$GuideDetailsToFront =array();
$guideResult = $db->query("SELECT * FROM guide_details ORDER BY Guide_Name");

if($guideResult->num_rows > 0){
    while ($row = $guideResult->fetch_assoc()) {
     array_push($GuideDetailsToFront, $row);

       $guideImgName = $row['Guide_Image']; 
        $guideName = $row['Guide_Name']; 
        $guideDescription = $row['Description'];
        $guideLocation = $row['Location'];  
        echo "-------------------------------------------------------------------------";
        echo $guideName;
        echo "<br>";
        echo $guideImgName;
        echo "<br>";
        echo $guideDescription;
        echo "<br>";
        echo $guideLocation;
        echo "<br>";
        
    }
    }
   // print_r($GuideDetailsToFront);

    $json4 = json_encode(array('data' => $GuideDetailsToFront));

if (file_put_contents("GuideDetailsToFront.json", $json4))
    echo "Output of guides ready to send to react Succsfully.";
else 
    echo "Weda naaaaa....";
*/
