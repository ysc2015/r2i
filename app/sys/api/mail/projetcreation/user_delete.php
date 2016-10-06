<?php
/**
 * file: user_delete.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from projet_mail_creation where id_projet_mail_creation=:id_projet_mail_creation");

if(isset($idp) && !empty($idp)){
    $stm->bindParam(':id_projet_mail_creation',$idp);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence utilisateur invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "Utilisateur supprimé de la liste avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>