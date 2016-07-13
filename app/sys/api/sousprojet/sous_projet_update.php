<?php
/**
 * file: sous_projet_update.php
 * User: rabii
 */

global $connectedProfil;

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update sous_projet set zone=:zone where id_sous_projet=:id_sous_projet");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($zone) && !empty($zone)){
    $stm->bindParam(':zone',$zone);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs zone est obligatoire !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Modification faite avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message, "pss" => $connectedProfil->nom_utilisateur));
?>