<?php
 include('db.php');
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }


    ///////////////Getting Guides////////////////////////////////
$GuideDetailsToFront =array();
$guideResult = $db->query("SELECT * FROM guide_details ORDER BY Guide_Name");

if($guideResult->num_rows > 0){
	while ($row = $guideResult->fetch_assoc()) {
     array_push($GuideDetailsToFront, $row);

       /* $guideImgName = $row['Guide_Image']; 
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
        */
    }
    }
   // print_r($GuideDetailsToFront);

    $json4 = json_encode(array('data' => $GuideDetailsToFront));

if (file_put_contents("GuideDetailsToFront.json", $json4))
    echo "Output of guides ready to send to react Succsfully.";
else 
    echo "Weda naaaaa....";

echo(GuideDetailsToFront.json)


?>