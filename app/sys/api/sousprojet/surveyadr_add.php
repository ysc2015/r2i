<?php
/**
 * file: surveyadr_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_plaque_survey_adresse (id_sous_projet,volume_adresse,date_debut,date_ret_prevue,intervenant,duree,ok) values (:id_sous_projet,:volume_adresse,:date_debut,:date_ret_prevue,:intervenant,:duree,:ok)");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($sa_volume_adresse) && !empty($sa_volume_adresse)){
    $stm->bindParam(':volume_adresse',$sa_volume_adresse);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Volume adresses est obligatoire !";
}

/*if(isset($sa_date_debut) && !empty($sa_date_debut)){
    $stm->bindParam(':date_debut',$sa_date_debut);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date début est obligatoire !";
}

if(isset($sa_date_ret_prevue) && !empty($sa_date_ret_prevue)){
    $stm->bindParam(':date_ret_prevue',$sa_date_ret_prevue);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour prévue est obligatoire !";
}*/

/*
 * dates debut
 */

$dd = DateTime::createFromFormat('Y-m-d', $sa_date_debut);
$df = DateTime::createFromFormat('Y-m-d', $sa_date_ret_prevue);


if($dd && $df && $df < $dd) {
    $err++;
    $message[] = "la date de retour prévue doit étre superieure à la date de début !";
} else  {

    if(isset($sa_date_debut)){
        $stm->bindParam(':date_debut',$sa_date_debut);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date de début est obligatoire !";
    }

    if(isset($sa_date_ret_prevue)){
        $stm->bindParam(':date_ret_prevue',$sa_date_ret_prevue);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date retour prévue est obligatoire !";
    }
}

/*
 * dates fin
 */

if(isset($sa_intervenant) && !empty($sa_intervenant)){
    $stm->bindParam(':intervenant',$sa_intervenant);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant est obligatoire !";
}

if(isset($sa_duree) && !empty($sa_duree)){
    $stm->bindParam(':duree',$sa_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
}

if(isset($sa_ok) && !empty($sa_ok)){
    $stm->bindParam(':ok',$sa_ok);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs OK est obligatoire !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>