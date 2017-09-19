<?php
/**
 * file: delete_blq.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("update pbn set statut = :statut where id_pbn=:id_pbn");

if(isset($statut) ){
    $stm->bindParam(':statut',$statut);
    $delete = true;
} else {
    $err++;
    $message[] = "Statut non renseigner !";
}

if(isset($idpbn) && !empty($idpbn)){
    $stm->bindParam(':id_pbn',$idpbn);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence PBN invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "Element modifié avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>