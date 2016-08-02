<?php
/**
 * file: ddesign_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_distribution_design (id_sous_projet,intervenant_be,intervenant_bex,date_debut,date_fin,duree,lineaire_distribution,etat,date_envoi,ok) values (:id_sous_projet,:intervenant_be,:intervenant_bex,:date_debut,:date_fin,:duree,:lineaire_distribution,:etat,:date_envoi,:ok)");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($dd_intervenant_be) && !empty($dd_intervenant_be)){
    $stm->bindParam(':intervenant_be',$dd_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

if(isset($dd_intervenant_bex) && !empty($dd_intervenant_bex)){
    $stm->bindParam(':intervenant_bex',$dd_intervenant_bex);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BEX est obligatoire !";
}

/*if(isset($dd_date_debut) && !empty($dd_date_debut)){
    $stm->bindParam(':date_debut',$dd_date_debut);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date début est obligatoire !";
}

if(isset($dd_date_fin) && !empty($dd_date_fin)){
    $stm->bindParam(':date_fin',$dd_date_fin);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date fin est obligatoire !";
}*/

/*
 * dates debut
 */

$dd = DateTime::createFromFormat('Y-m-d', $dd_date_debut);
$df = DateTime::createFromFormat('Y-m-d', $dd_date_fin);


if($dd && $df && $df < $dd) {
    $err++;
    $message[] = "la date de fin doit étre superieure à la date de début !";
} else  {

    if(isset($dd_date_debut)){
        $stm->bindParam(':date_debut',$dd_date_debut);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date début est obligatoire !";
    }

    if(isset($dd_date_fin)){
        $stm->bindParam(':date_fin',$dd_date_fin);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date fin est obligatoire !";
    }
}

/*
 * dates fin
 */

if(isset($dd_duree) && !empty($dd_duree)){
    $stm->bindParam(':duree',$dd_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
}

if(isset($dd_lineaire_distribution) && !empty($dd_lineaire_distribution)){
    $stm->bindParam(':lineaire_distribution',$dd_lineaire_distribution);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Linéaire distribution est obligatoire !";
}

if(isset($dd_etat) && !empty($dd_etat)){
    $stm->bindParam(':etat',$dd_etat);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Nombre Etat est obligatoire !";
}

if(isset($dd_date_envoi) && !empty($dd_date_envoi)){
    $stm->bindParam(':date_envoi',$dd_date_envoi);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date envoi est obligatoire !";
}

if(isset($dd_ok)){
    $stm->bindParam(':ok',$dd_ok);
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