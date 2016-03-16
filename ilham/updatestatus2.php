<?php
include_once 'config.php';
$response = array();

if(isset($_GET['id_OT'])){
	$id_OT=$_GET['id_OT'];
	$result = mysqli_query($db,"UPDATE `OT` SET `status`='yes' WHERE id_OT='$id_OT'");
	$row_count= mysqli_affected_rows($db);
	if($row_count>0){
		$response["success"]=1;
		$response["message"]="la mise à jour est faite";
	} else {
		$response["success"]=0;
		$response["messae"]="échec de mise à jour "."UPDATE `OT` SET `status`='yes' WHERE id_OT='$id_OT'".mysql_error();
	}
	mysqli_close($db);
	echo json_encode($response); 
} else if(isset($_GET['ids_OT'])) {
	$id_OT = json_decode($_GET['ids_OT']);
	$updatecond = "";
	foreach($id_OT as $k => $v) {
		$updatecond .= $v . ',';	
	}
	$updatecond = substr($updatecond,0,-1);
	$data .= "UPDATE `OT` SET `status`='yes' WHERE id_OT IN ($updatecond)";
	$result = mysqli_query($db,"UPDATE `OT` SET `status`='yes' WHERE id_OT IN ($updatecond)");
	$row_count= mysqli_affected_rows($db);
	if($row_count>=0){
		$response["success"]=1;
		$response["message"]="la mise à jour est faite";
		$response["count"]=$row_count;
		$data .= " - TRUE";
	} else {
		$data .= " - FALSE ".mysqli_error($db);
		$response["success"]=0;
		$response["message"]="échec de mise à jour "."UPDATE `OT` SET `status`='yes' WHERE id_OT='$id_OT'".$_GET['ids_OT']."' - ".mysqli_error($db);
	}
	mysqli_close($db);
	echo json_encode($response); 

}
?>
