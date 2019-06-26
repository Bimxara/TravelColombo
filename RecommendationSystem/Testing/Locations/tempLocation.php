<?php



 include('db.php');
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }



$Sights =array();

$sql = "SELECT * FROM restaurants";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
     array_push($Sights,$row);  

    }
} else {
    echo "0 results";
}
$jsonData3 = json_encode($Sights, JSON_PRETTY_PRINT);
file_put_contents('allRestaurants.json', $jsonData3);
$db->close();
?>