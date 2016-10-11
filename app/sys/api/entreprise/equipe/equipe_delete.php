<?php
/**
 * file: equipe_delete.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from equipe_stt where id_equipe_stt=:id_equipe_stt");

if(isset($ide) && !empty($ide)){
    $stm->bindParam(':id_equipe_stt',$ide);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence equipe invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "Equipe supprimée avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>