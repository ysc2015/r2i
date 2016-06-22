<?php
/**
 * file: daiguillage_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update sous_projet_distribution_aiguillage set intervenant_be=:intervenant_be,plans=:plans,lineaire_reseau=:lineaire_reseau,controle_plans=:controle_plans,date_transmission_plans=:date_transmission_plans,id_entreprise=:id_entreprise,date_aiguillage=:date_aiguillage,duree=:duree,controle_demarrage_effectif=:controle_demarrage_effectif,date_retour=:date_retour,etat_retour=:etat_retour where id_sous_projet=:id_sous_projet");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($da_intervenant_be) && !empty($da_intervenant_be)){
    $stm->bindParam(':intervenant_be',$da_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

if(isset($da_plans) && !empty($da_plans)){
    $stm->bindParam(':plans',$da_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Plans est obligatoire !";
}

if(isset($da_lineaire_reseau) && !empty($da_lineaire_reseau)){
    $stm->bindParam(':lineaire_reseau',$da_lineaire_reseau);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Linéaire réseau est obligatoire !";
}

if(isset($da_controle_plans) && !empty($da_controle_plans)){
    $stm->bindParam(':controle_plans',$da_controle_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Controle plans est obligatoire !";
}

if(isset($da_date_transmission_plans) && !empty($da_date_transmission_plans)){
    $stm->bindParam(':date_transmission_plans',$da_date_transmission_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date transmission plans est obligatoire !";
}

if(isset($da_entreprise) && !empty($da_entreprise)){
    $stm->bindParam(':id_entreprise',$da_entreprise);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Entreprise est obligatoire !";
}

if(isset($da_date_aiguillage) && !empty($da_date_aiguillage)){
    $stm->bindParam(':date_aiguillage',$da_date_aiguillage);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date aiguillage est obligatoire !";
}

if(isset($da_duree) && !empty($da_duree)){
    $stm->bindParam(':duree',$da_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
}

if(isset($da_controle_demarrage_effectif) && !empty($da_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$da_controle_demarrage_effectif);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Controle démarrage éffectif est obligatoire !";
}

if(isset($da_date_retour) && !empty($da_date_retour)){
    $stm->bindParam(':date_retour',$da_date_retour);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour est obligatoire !";
}

if(isset($da_etat_retour) && !empty($da_etat_retour)){
    $stm->bindParam(':etat_retour',$da_etat_retour);
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