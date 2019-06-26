<?php

$tagPost = $_GET["tag"];

$array = Array (
    "0" => Array (
        "tag" => $tagPost
    )
);

$json = json_encode(array('data' => $array));

if (file_put_contents("selectionData.json", $json))
    echo "Succesfully sent data to ML File....Your OutPUt is: ";
else 
    echo "Weda naaaaa....";
echo "<br>";

$command = escapeshellcmd('test.py');
    $output = shell_exec($command);
   echo $output;
    file_put_contents('ml2Output.json', $output);


echo "<br>";
echo "<br>";
echo "<br>";

$json3 = file_get_contents('ml2Output.json');
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
        //array_push($LocationDetailsToFront,$imgData);
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
        $sql2 = "INSERT INTO tempTable (Name, ImageName, Address, Rating ) VALUES ('$Name', '$imgName', '$imgAddress', '$imgRating')";
        if(mysqli_query($db, $sql2)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql2. " . mysqli_error($db);
}
    }else{
        echo 'Image not found...';
    }
} 


$result2 = $db->query("SELECT * FROM tempTable");
 if($result2->num_rows > 0){
    while($row = $result2->fetch_assoc()) {
        array_push($LocationDetailsToFront,$row);
        //print_r($LocationDetailsToFront);
    }
}else{
    echo "error in finding";
}

$jsonData3 = json_encode($LocationDetailsToFront, JSON_PRETTY_PRINT);
file_put_contents('LocationDetailsToFront.json', $jsonData3);





?>

