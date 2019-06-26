<?php

$myFile = "LocationDetailsToFront.json";
unlink($myFile) or die("Couldn't delete file");





 include('db.php');
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }

$sql2 = "DELETE FROM temptable";
if(mysqli_query($db, $sql2)){
    echo "Records deleted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql2. " . mysqli_error($db);
}





/*
$myFile2 = "LocationDetailsToFront.json";
unlink($myFile2) or die("Couldn't delete file");

if (file_put_contents("LocationDetailsToFront.json", null))
    echo "Empty json created";
else 
    echo "Weda naaaaa....";

*/



/*
$my_file = 'mlOutput.json';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);*/

?>