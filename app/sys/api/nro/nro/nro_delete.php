<?php
/**
 * file: nro_delete.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from nro where id_nro=:id_nro");

if(isset($idn) && !empty($idn)){
    $stm->bindParam(':id_nro',$idn);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence nro invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "Nro supprimé de la liste avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>