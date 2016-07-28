<?php
/**
 * file: taguillage_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update sous_projet_transport_aiguillage set intervenant_be=:intervenant_be,plans=:plans,lineaire1=:lineaire1,lineaire2=:lineaire2,lineaire3=:lineaire3,lineaire4=:lineaire4,controle_plans=:controle_plans,date_transmission_plans=:date_transmission_plans,id_entreprise=:id_entreprise,date_aiguillage=:date_aiguillage,date_ret_prevue=:date_ret_prevue,duree=:duree,controle_demarrage_effectif=:controle_demarrage_effectif,date_retour=:date_retour,etat_retour=:etat_retour,lien_plans=:lien_plans,retour_presta=:retour_presta where id_sous_projet=:id_sous_projet");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($ta_intervenant_be) && !empty($ta_intervenant_be)){
    $stm->bindParam(':intervenant_be',$ta_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

if(isset($ta_plans) && !empty($ta_plans)){
    $stm->bindParam(':plans',$ta_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Plans est obligatoire !";
}

/*
 * lineaire debut
 */

if(isset($lineaire1) && !empty($lineaire1)){
    $stm->bindParam(':lineaire1',$lineaire1);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs 720FO est obligatoire !";
}

if(isset($lineaire2) && !empty($lineaire2)){
    $stm->bindParam(':lineaire2',$lineaire2);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs 432FO est obligatoire !";
}

if(isset($lineaire3) && !empty($lineaire3)){
    $stm->bindParam(':lineaire3',$lineaire3);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs 288FO est obligatoire !";
}

if(isset($lineaire4) && !empty($lineaire4)){
    $stm->bindParam(':lineaire4',$lineaire4);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs 144FO est obligatoire !";
}

/*
 * lineaire fin
 */

if(isset($ta_controle_plans) && !empty($ta_controle_plans)){
    $stm->bindParam(':controle_plans',$ta_controle_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Controle plans est obligatoire !";
}

if(isset($ta_date_transmission_plans) && !empty($ta_date_transmission_plans)){
    $stm->bindParam(':date_transmission_plans',$ta_date_transmission_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date transmission plans est obligatoire !";
}

/*if(isset($) && !empty($)){
    $stm->bindParam(':entreprise',$);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Entreprise est obligatoire !";
}*/

if(isset($ta_entreprise) && !empty($ta_entreprise)){
    $stm->bindParam(':id_entreprise',$ta_entreprise);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Entreprise est obligatoire !";
}

if(isset($ta_date_aiguillage) && !empty($ta_date_aiguillage)){
    $stm->bindParam(':date_aiguillage',$ta_date_aiguillage);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date aiguillage est obligatoire !";
}

if(isset($ta_date_ret_prevue) && !empty($ta_date_ret_prevue)){
    $stm->bindParam(':date_ret_prevue',$ta_date_ret_prevue);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour prévue est obligatoire !";
}

if(isset($ta_duree) && !empty($ta_duree)){
    $stm->bindParam(':duree',$ta_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
}

if(isset($ta_controle_demarrage_effectif) && !empty($ta_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$ta_controle_demarrage_effectif);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Controle démarrage effectif est obligatoire !";
}

if(isset($ta_date_retour) && !empty($ta_date_retour)){
    $stm->bindParam(':date_retour',$ta_date_retour);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour est obligatoire !";
}

if(isset($ta_etat_retour) && !empty($ta_etat_retour)){
    $stm->bindParam(':etat_retour',$ta_etat_retour);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Etat retour est obligatoire !";
}

if(isset($ta_lien_plans) && !empty($ta_lien_plans)){
    $stm->bindParam(':lien_plans',$ta_lien_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Lien vers les plans est obligatoire !";
}

if(isset($ta_retour_presta) && !empty($ta_retour_presta)){
    $stm->bindParam(':retour_presta',$ta_retour_presta);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Retour presta est obligatoire !";
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