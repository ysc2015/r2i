<?php
/**
 * file: dtirage_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update sous_projet_distribution_tirage set intervenant_be=:intervenant_be,date_previsionnelle=:date_previsionnelle,prep_plans=:prep_plans,controle_plans=:controle_plans,date_transmission_plans=:date_transmission_plans,id_entreprise=:id_entreprise,date_tirage=:date_tirage,duree=:duree,controle_demarrage_effectif=:controle_demarrage_effectif,date_retour=:date_retour,etat_retour=:etat_retour where id_sous_projet=:id_sous_projet");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($dt_intervenant_be) && !empty($dt_intervenant_be)){
    $stm->bindParam(':intervenant_be',$dt_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

if(isset($dt_date_previsionnelle) && !empty($dt_date_previsionnelle)){
    $stm->bindParam(':date_previsionnelle',$dt_date_previsionnelle);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date prévisionnelle est obligatoire !";
}

if(isset($dt_prep_plans) && !empty($dt_prep_plans)){
    $stm->bindParam(':prep_plans',$dt_prep_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Prép. plans est obligatoire !";
}

if(isset($dt_controle_plans) && !empty($dt_controle_plans)){
    $stm->bindParam(':controle_plans',$dt_controle_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Controle plans est obligatoire !";
}

if(isset($dt_date_transmission_plans) && !empty($dt_date_transmission_plans)){
    $stm->bindParam(':date_transmission_plans',$dt_date_transmission_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date transmission plans est obligatoire !";
}

if(isset($dt_entreprise) && !empty($dt_entreprise)){
    $stm->bindParam(':id_entreprise',$dt_entreprise);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Entreprise est obligatoire !";
}

if(isset($dt_date_tirage) && !empty($dt_date_tirage)){
    $stm->bindParam(':date_tirage',$dt_date_tirage);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date de tirage est obligatoire !";
}

if(isset($dt_duree) && !empty($dt_duree)){
    $stm->bindParam(':duree',$dt_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
}

if(isset($dt_controle_demarrage_effectif) && !empty($dt_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$dt_controle_demarrage_effectif);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Controle démarrage effectif est obligatoire !";
}

if(isset($dt_date_retour) && !empty($dt_date_retour)){
    $stm->bindParam(':date_retour',$dt_date_retour);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date de retour est obligatoire !";
}

if(isset($dt_etat_retour) && !empty($dt_etat_retour)){
    $stm->bindParam(':etat_retour',$dt_etat_retour);
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