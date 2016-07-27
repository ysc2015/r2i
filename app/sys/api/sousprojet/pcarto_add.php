<?php
/**
 * file: pcarto_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_plaque_carto (id_sous_projet,intervenant_be,date_debut,date_ret_prevue,duree) values (:id_sous_projet,:intervenant_be,:date_debut,:date_ret_prevue,:duree)");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($pc_intervenant_be) && !empty($pc_intervenant_be)){
    $stm->bindParam(':intervenant_be',$pc_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

/*
 * dates debut
 */

$dd = DateTime::createFromFormat('Y-m-d', $pc_date_debut);
$df = DateTime::createFromFormat('Y-m-d', $pc_date_ret_prevue);


if($dd && $df && $df < $dd) {
    $err++;
    $message[] = "la date de retour prévue doit étre superieure à la date de début !";
} else  {

    if(isset($pc_date_debut) && !empty($pc_date_debut)){
        $stm->bindParam(':date_debut',$pc_date_debut);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date de début est obligatoire !";
    }

    if(isset($pc_date_ret_prevue) && !empty($pc_date_ret_prevue)){
        $stm->bindParam(':date_ret_prevue',$pc_date_ret_prevue);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date retour prévue est obligatoire !";
    }
}

/*
 * dates fin
 */

if(isset($pc_duree) && !empty($pc_duree)){
    $stm->bindParam(':duree',$pc_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
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