<?php
/**
 * file: draccord_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_distribution_raccordements (id_sous_projet,intervenant_be,preparation_pds,controle_plans,date_transmission_pds,id_entreprise,date_racco,duree,controle_demarrage_effectif,date_retour,etat_retour) values (:id_sous_projet,:intervenant_be,:preparation_pds,:controle_plans,:date_transmission_pds,:id_entreprise,:date_racco,:duree,:controle_demarrage_effectif,:date_retour,:etat_retour)");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($dr_intervenant_be) && !empty($dr_intervenant_be)){
    $stm->bindParam(':intervenant_be',$dr_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

if(isset($dr_preparation_pds) && !empty($dr_preparation_pds)){
    $stm->bindParam(':preparation_pds',$dr_preparation_pds);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Préparation pds est obligatoire !";
}

if(isset($dr_controle_plans) && !empty($dr_controle_plans)){
    $stm->bindParam(':controle_plans',$dr_controle_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Controle plans est obligatoire !";
}

if(isset($dr_date_transmission_pds) && !empty($dr_date_transmission_pds)){
    $stm->bindParam(':date_transmission_pds',$dr_date_transmission_pds);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date transmission plans est obligatoire !";
}

if(isset($dr_entreprise) && !empty($dr_entreprise)){
    $stm->bindParam(':id_entreprise',$dr_entreprise);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Entreprise est obligatoire !";
}

if(isset($dr_date_racco) && !empty($dr_date_racco)){
    $stm->bindParam(':date_racco',$dr_date_racco);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date raccordement est obligatoire !";
}

if(isset($dr_duree) && !empty($dr_duree)){
    $stm->bindParam(':duree',$dr_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
}

if(isset($dr_controle_demarrage_effectif) && !empty($dr_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$dr_controle_demarrage_effectif);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Controle démarrage effectif est obligatoire !";
}

if(isset($dr_date_retour) && !empty($dr_date_retour)){
    $stm->bindParam(':date_retour',$dr_date_retour);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour est obligatoire !";
}

if(isset($dr_etat_retour) && !empty($dr_etat_retour)){
    $stm->bindParam(':etat_retour',$dr_etat_retour);
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