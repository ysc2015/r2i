<?php
include_once 'config.php';
$response = array();

if(isset($_GET['room_id'])){
	$room_id=$_GET['room_id'];
	$result = mysqli_query($db,"UPDATE `rooms_list` SET `flag`='yes' WHERE room_id='$room_id'");
	$row_count= mysqli_affected_rows($db);
	if($row_count>0){
		$response["success"]=1;
		$response["message"]="la mise à jour est faite";
	} else {
		$response["success"]=0;
		$response["messae"]="échec de mise à jour "."UPDATE `rooms_list` SET `flag`='yes' WHERE room_id='$room_id'".mysql_error();
	}
	mysqli_close($db);
	echo json_encode($response); 
} else if(isset($_GET['room_ids'])) {
	$room_id = json_decode($_GET['room_ids']);
	$updatecond = "";
	foreach($room_id as $k => $v) {
		$updatecond .= $v . ',';	
	}
	$updatecond = substr($updatecond,0,-1);
	$data .= "UPDATE `rooms_list` SET `flag`='yes' WHERE room_id IN ($updatecond)";
	$result = mysqli_query($db,"UPDATE `rooms_list` SET `flag`='yes' WHERE room_id IN ($updatecond)");
	$row_count= mysqli_affected_rows($db);
	if($row_count>=0){
		$response["success"]=1;
		$response["message"]="la mise à jour est faite";
		$response["count"]=$row_count;
		$data .= " - TRUE";
	} else {
		$data .= " - FALSE ".mysqli_error($db);
		$response["success"]=0;
		$response["message"]="échec de mise à jour "."UPDATE `rooms_list` SET `flag`='yes' WHERE room_id='$room_id'".$_GET['room_ids']."' - ".mysqli_error($db);
	}
	mysqli_close($db);
$response['debug'] = "UPDATE `rooms_list` SET `flag`='yes' WHERE room_id IN ($updatecond)";
	echo json_encode($response); 

}
?>
