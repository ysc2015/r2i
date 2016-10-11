<?php
/**
 * file: entreprise_delete.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from entreprises_stt where id_entreprise=:id_entreprise");

if(isset($ide) && !empty($ide)){
    $stm->bindParam(':id_entreprise',$ide);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence entreprise invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "Entreprise supprimée avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>