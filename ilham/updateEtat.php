<?php
include_once 'config.php';
$response = array();

if(isset($_GET['id_OT'])){
	$id_OT=$_GET['id_OT'];
	$result = mysqli_query($db,"UPDATE `OT` SET `si_valide`='valide' WHERE id_OT='$id_OT'");
	$row_count= mysqli_affected_rows($db);
	if($row_count>0){
		$response["success"]=1;
		$response["message"]="la mise à jour est faite";
	} else {
		$response["success"]=0;
		$response["messae"]="échec de mise à jour "."UPDATE `OT` SET `si_valide`='validé' WHERE id_OT='$id_OT'".mysql_error();
	}
	mysqli_close($db);
	echo json_encode($response); 
}

?>
