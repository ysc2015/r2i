<?php
/**
 * file: user_profil_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update utilisateur set id_profil_utilisateur=:id_profil_utilisateur where id_utilisateur=:id_utilisateur");

if(isset($idu) && !empty($idu)){
    $stm->bindParam(':id_utilisateur',$idu);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence utilisateur invalide !";
}

if(isset($idp) && !empty($idp)){
    $stm->bindParam(':id_profil_utilisateur',$idp);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs profil est obligatoire !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Modification faite avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>