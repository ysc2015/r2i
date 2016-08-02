<?php
/**
 * file: tdesign_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_transport_design (id_sous_projet,intervenant_be,date_debut,date_ret_prevue,duree,lineaire_transport,nb_zones,ok) values (:id_sous_projet,:intervenant_be,:date_debut,:date_ret_prevue,:duree,:lineaire_transport,:nb_zones,:ok)");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($td_intervenant_be) && !empty($td_intervenant_be)){
    $stm->bindParam(':intervenant_be',$td_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

/*if(isset($td_date_debut) && !empty($td_date_debut)){
    $stm->bindParam(':date_debut',$td_date_debut);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date début est obligatoire !";
}

if(isset($td_date_ret_prevue) && !empty($td_date_ret_prevue)){
    $stm->bindParam(':date_ret_prevue',$td_date_ret_prevue);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour prévue est obligatoire !";
}*/

/*
 * dates debut
 */

$dd = DateTime::createFromFormat('Y-m-d', $td_date_debut);
$df = DateTime::createFromFormat('Y-m-d', $td_date_ret_prevue);


if($dd && $df && $df < $dd) {
    $err++;
    $message[] = "la date de retour prévue doit étre superieure à la date de début !";
} else  {

    if(isset($td_date_debut)){
        $stm->bindParam(':date_debut',$td_date_debut);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date de début est obligatoire !";
    }

    if(isset($td_date_ret_prevue)){
        $stm->bindParam(':date_ret_prevue',$td_date_ret_prevue);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date retour prévue est obligatoire !";
    }
}

/*
 * dates fin
 */

if(isset($td_duree) && !empty($td_duree)){
    $stm->bindParam(':duree',$td_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
}

if(isset($td_lineaire_transport) && !empty($td_lineaire_transport)){
    $stm->bindParam(':lineaire_transport',$td_lineaire_transport);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Linéaire transport est obligatoire !";
}

if(isset($td_nb_zones) && !empty($td_nb_zones)){
    $stm->bindParam(':nb_zones',$td_nb_zones);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Nombre de zones est obligatoire !";
}

if(isset($td_ok)){
    $stm->bindParam(':ok',$td_ok);
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