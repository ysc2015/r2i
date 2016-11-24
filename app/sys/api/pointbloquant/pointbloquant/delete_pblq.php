<?php
/**
 * file: delete_pblq.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from point_bloquant where id_point_bloquant=:id_point_bloquant");

if(isset($idp) && !empty($idp)){
    $stm->bindParam(':id_point_bloquant',$idp);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence point bloquant invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "Point bloquant supprimé avec succès !";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>