<?php
/**
 * file: projet_delete.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from projet where id_projet=:id_projet");

if(isset($idp) && !empty($idp)){
    $stm->bindParam(':id_projet',$idp);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence projet invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "Projet supprimé avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>