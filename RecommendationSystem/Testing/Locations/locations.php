<?php

 
 include('db.php');
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }


$LocationDetailsToFront =array();

    //Get image data from database
    $result = $db->query("SELECT * FROM locationdetails");
    
    if($result->num_rows > 0){
    
    	while ($imgData = $result->fetch_assoc()) {
    		array_push($LocationDetailsToFront,$imgData);
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
    	}

        
   		//print_r($LocationDetailsToFront);
    }else{
        echo 'Image not found...';
    }

$json2 = json_encode(array('data' => $LocationDetailsToFront));

if (file_put_contents("LocationDetailsToFront.json", $json2))
    echo "Output ready to send to react Succsfully.";
else 
    echo "Weda naaaaa....";



?>