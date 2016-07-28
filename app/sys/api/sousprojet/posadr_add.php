<?php
/**
 * file: posadr_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_plaque_pos_adresse (id_sous_projet,intervenant_be,date_debut,date_ret_prevue,duree,intervenant,ok) values (:id_sous_projet,:intervenant_be,:date_debut,:date_ret_prevue,:duree,:intervenant,:ok)");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($pa_intervenant_be) && !empty($pa_intervenant_be)){
    $stm->bindParam(':intervenant_be',$pa_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

/*if(isset($pa_date_debut) && !empty($pa_date_debut)){
    $stm->bindParam(':date_debut',$pa_date_debut);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date début est obligatoire !";
}

if(isset($pa_date_ret_prevue) && !empty($pa_date_ret_prevue)){
    $stm->bindParam(':date_ret_prevue',$pa_date_ret_prevue);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour prévue est obligatoire !";
}*/

/*
 * dates debut
 */

$dd = DateTime::createFromFormat('Y-m-d', $pa_date_debut);
$df = DateTime::createFromFormat('Y-m-d', $pa_date_ret_prevue);


if($dd && $df && $df < $dd) {
    $err++;
    $message[] = "la date de retour prévue doit étre superieure à la date de début !";
} else  {

    if(isset($pa_date_debut)){
        $stm->bindParam(':date_debut',$pa_date_debut);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date de début est obligatoire !";
    }

    if(isset($pa_date_ret_prevue)){
        $stm->bindParam(':date_ret_prevue',$pa_date_ret_prevue);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date retour prévue est obligatoire !";
    }
}

/*
 * dates fin
 */

if(isset($pa_duree) && !empty($pa_duree)){
    $stm->bindParam(':duree',$pa_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
}

if(isset($pa_intervenant) && !empty($pa_intervenant)){
    $stm->bindParam(':intervenant',$pa_intervenant);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant est obligatoire !";
}

if(isset($pa_ok) && !empty($pa_ok)){
    $stm->bindParam(':ok',$pa_ok);
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