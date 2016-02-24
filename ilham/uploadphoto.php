<?php
include_once 'config.php';
$response = array();

if(isset($_GET['photo'])){
	$photo=$_GET['photo'];
	$result = mysqli_query($db,"INSERT INTO `Photo`(`photo`) VALUES ('$photo')");
	$row_count= mysqli_affected_rows($db);
	if($row_count>0){
		$response["success"]=1;
		$response["message"]="la mise à jour est faite";
	} else {
		$response["success"]=0;
		$response["messae"]="échec de mise à jour "."INSERT INTO `Photo`(`photo`) VALUES ('$photo')".mysql_error();
	}
	mysqli_close($db);
	echo json_encode($response); 
}

?>
