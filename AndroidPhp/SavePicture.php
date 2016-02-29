<?php
/* ilham Amara* 2016*/
include_once 'config.php';
//header('Content-type : bitmap; charset=utf-8');
echo 'FIRST';
 if(isset($_POST["encoded_string"])){
 	echo 'Test';
	$encoded_string = $_POST["encoded_string"];
	$image_name = $_POST["image_name"];

	$decoded_string = base64_decode($encoded_string);
	
	$path = 'Photo/'.$image_name;
	
	echo file_put_contents($path,$decoded_string);
 }


?>
