<?php
/**
 * file: add_pbn.php
 * User: fadil
 */

extract($_POST);

$err = 0;
$message = array();

$sql = "";
$stm = NULL;

$questionFieldName = "";

if(!isset($pbn_information) ||  $pbn_information =="") {
    $err++;
    $message[] = "texte vide !";
} else {
    $sql = "INSERT INTO `pbn` ( `text_pbn`, `id_sous_projet`, `id_createur`) VALUES(:text_pbn, :id_sous_projet, :id_createur)";
    $stm = $db->prepare($sql);

    $stm->bindParam(":text_pbn",$pbn_information);
    $stm->bindParam(":id_sous_projet",$id_sous_projet);
    $stm->bindValue(':id_createur',$connectedProfil->profil->id_utilisateur);
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));