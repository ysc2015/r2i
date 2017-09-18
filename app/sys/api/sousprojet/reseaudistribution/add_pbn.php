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
}elseif (!isset($drec_pbn_avance_netgeo) || $drec_pbn_avance_netgeo == 0 || $drec_pbn_avance_netgeo ==""){
    $err++;
    $message[] = "avancement Netgeo vide !";

} else {
    $sql = "INSERT INTO `pbn` ( `text_pbn`, `id_sous_projet`, `id_createur`, `date_creation`, `id_avancement_netgeo`) VALUES(:text_pbn, :id_sous_projet, :id_createur, :date_creation, :id_avancement_netgeo)";
    $stm = $db->prepare($sql);

    $stm->bindParam(":text_pbn",$pbn_information);
    $stm->bindParam(":id_sous_projet",$id_sous_projet);
    $stm->bindParam(':id_createur',$connectedProfil->profil->id_utilisateur);
    $stm->bindParam(':id_avancement_netgeo',$drec_pbn_avance_netgeo);
    $stm->bindValue(':date_creation',date('Y-m-d H:i:s'));
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));