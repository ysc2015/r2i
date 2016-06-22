<?php
/**
 * file: traccord_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_transport_raccordements (id_sous_projet,intervenant_be,preparation_pds,controle_plans,date_transmission_pds,id_entreprise,date_racco,duree,controle_demarrage_effectif,date_retour,etat_retour) values (:id_sous_projet,:intervenant_be,:preparation_pds,:controle_plans,:date_transmission_pds,:id_entreprise,:date_racco,:duree,:controle_demarrage_effectif,:date_retour,:etat_retour)");


if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($tr_intervenant_be) && !empty($tr_intervenant_be)){
    $stm->bindParam(':intervenant_be',$tr_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant est obligatoire !";
}

if(isset($tr_preparation_pds) && !empty($tr_preparation_pds)){
    $stm->bindParam(':preparation_pds',$tr_preparation_pds);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Préparation pds est obligatoire !";
}

if(isset($tr_controle_plans) && !empty($tr_controle_plans)){
    $stm->bindParam(':controle_plans',$tr_controle_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Controle plans est obligatoire !";
}

if(isset($tr_date_transmission_pds) && !empty($tr_date_transmission_pds)){
    $stm->bindParam(':date_transmission_pds',$tr_date_transmission_pds);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date transmission pds est obligatoire !";
}

if(isset($tr_entreprise) && !empty($tr_entreprise)){
    $stm->bindParam(':id_entreprise',$tr_entreprise);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Entreprise est obligatoire !";
}

if(isset($tr_date_racco) && !empty($tr_date_racco)){
    $stm->bindParam(':date_racco',$tr_date_racco);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date raccordement est obligatoire !";
}

if(isset($tr_duree) && !empty($tr_duree)){
    $stm->bindParam(':duree',$tr_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
}

if(isset($tr_controle_demarrage_effectif) && !empty($tr_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$tr_controle_demarrage_effectif);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Controle démarrage éffectif est obligatoire !";
}

if(isset($tr_date_retour) && !empty($tr_date_retour)){
    $stm->bindParam(':date_retour',$tr_date_retour);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour est obligatoire !";
}

if(isset($tr_etat_retour) && !empty($tr_etat_retour)){
    $stm->bindParam(':etat_retour',$tr_etat_retour);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Etat retour est obligatoire !";
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