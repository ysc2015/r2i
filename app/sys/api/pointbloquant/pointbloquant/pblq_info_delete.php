<?php
/**
 * file: pblq_info_delete.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from traitement_pbt where id_traitement_pbt=:id_traitement_pbt");

if(isset($idpi) && !empty($idpi)){
    $stm->bindParam(':id_traitement_pbt',$idpi);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence info point bloquant invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "Info point bloquant supprimée avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>