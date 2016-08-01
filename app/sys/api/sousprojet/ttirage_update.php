<?php
/**
 * file: ttirage_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update sous_projet_transport_tirage set intervenant_be=:intervenant_be,date_previsionnelle=:date_previsionnelle,prep_plans=:prep_plans,controle_plans=:controle_plans,date_transmission_plans=:date_transmission_plans,id_entreprise=:id_entreprise,date_tirage=:date_tirage,date_ret_prevue=:date_ret_prevue,duree=:duree,controle_demarrage_effectif=:controle_demarrage_effectif,date_retour=:date_retour,etat_retour=:etat_retour where id_sous_projet=:id_sous_projet");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($tt_intervenant_be) && !empty($tt_intervenant_be)){
    $stm->bindParam(':intervenant_be',$tt_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

if(isset($tt_date_previsionnelle) && !empty($tt_date_previsionnelle)){
    $stm->bindParam(':date_previsionnelle',$tt_date_previsionnelle);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date prévisionnelle est obligatoire !";
}

if(isset($tt_prep_plans) && !empty($tt_prep_plans)){
    $stm->bindParam(':prep_plans',$tt_prep_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Préparation plans est obligatoire !";
}

if(isset($tt_controle_plans) && !empty($tt_controle_plans)){
    $stm->bindParam(':controle_plans',$tt_controle_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Controle plans est obligatoire !";
}

if(isset($tt_date_transmission_plans) && !empty($tt_date_transmission_plans)){
    $stm->bindParam(':date_transmission_plans',$tt_date_transmission_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date transmission plans est obligatoire !";
}

if(isset($tt_entreprise) && !empty($tt_entreprise)){
    $stm->bindParam(':id_entreprise',$tt_entreprise);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Entreprise est obligatoire !";
}

/*if(isset($tt_date_tirage) && !empty($tt_date_tirage)){
    $stm->bindParam(':date_tirage',$tt_date_tirage);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date tirage est obligatoire !";
}

if(isset($tt_date_ret_prevue) && !empty($tt_date_ret_prevue)){
    $stm->bindParam(':date_ret_prevue',$tt_date_ret_prevue);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour prévue est obligatoire !";
}*/

/*
 * dates debut
 */

$dd = DateTime::createFromFormat('Y-m-d', $tt_date_tirage);
$df = DateTime::createFromFormat('Y-m-d', $tt_date_ret_prevue);


if($dd && $df && $df < $dd) {
    $err++;
    $message[] = "la date de retour prévue doit étre superieure à la date de tirage !";
} else  {

    if(isset($tt_date_tirage)){
        $stm->bindParam(':date_tirage',$tt_date_tirage);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date tirage est obligatoire !";
    }

    if(isset($tt_date_ret_prevue)){
        $stm->bindParam(':date_ret_prevue',$tt_date_ret_prevue);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date retour prévue est obligatoire !";
    }
}

/*
 * dates fin
 */

if(isset($tt_duree) && !empty($tt_duree)){
    $stm->bindParam(':duree',$tt_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
}

if(isset($tt_controle_demarrage_effectif) && !empty($tt_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$tt_controle_demarrage_effectif);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Controle démarrage effectif est obligatoire !";
}

if(isset($tt_date_retour) && !empty($tt_date_retour)){
    $stm->bindParam(':date_retour',$tt_date_retour);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour est obligatoire !";
}

if(isset($tt_etat_retour) && !empty($tt_etat_retour)){
    $stm->bindParam(':etat_retour',$tt_etat_retour);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Etat retour est obligatoire !";
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