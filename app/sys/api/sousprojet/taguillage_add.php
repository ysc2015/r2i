<?php
/**
 * file: taguillage_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insertedId = 0;
$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_transport_aiguillage (id_sous_projet,intervenant_be,plans,lineaire1,lineaire2,lineaire3,lineaire4,lineaire5,lineaire6,lineaire7,lineaire8,controle_plans,date_transmission_plans,id_entreprise,date_aiguillage,date_ret_prevue,duree,controle_demarrage_effectif,date_retour,etat_retour,lien_plans,retour_presta,ok) values (:id_sous_projet,:intervenant_be,:plans,:lineaire1,:lineaire2,:lineaire3,:lineaire4,:lineaire5,:lineaire6,:lineaire7,:lineaire8,:controle_plans,:date_transmission_plans,:id_entreprise,:date_aiguillage,:date_ret_prevue,:duree,:controle_demarrage_effectif,:date_retour,:etat_retour,:lien_plans,:retour_presta,:ok)");

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

if(isset($lineaire5) && !empty($lineaire5)){
    $stm->bindParam(':lineaire5',$lineaire5);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs BPE 720FO est obligatoire !";
}

if(isset($lineaire6) && !empty($lineaire6)){
    $stm->bindParam(':lineaire6',$lineaire6);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs BPE 432FO est obligatoire !";
}

if(isset($lineaire7) && !empty($lineaire7)){
    $stm->bindParam(':lineaire7',$lineaire7);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs BPE 288FO est obligatoire !";
}

if(isset($lineaire8) && !empty($lineaire8)){
    $stm->bindParam(':lineaire8',$lineaire8);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs BPE 144FO est obligatoire !";
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

/*if(isset($ta_date_aiguillage) && !empty($ta_date_aiguillage)){
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
}*/

/*
 * dates debut
 */

$dd = DateTime::createFromFormat('Y-m-d', $ta_date_aiguillage);
$df = DateTime::createFromFormat('Y-m-d', $ta_date_ret_prevue);


if($dd && $df && $df < $dd) {
    $err++;
    $message[] = "la Date prévisionnelle de fin d’aiguillage doit étre superieure à la date de début !";
} else  {

    if(isset($ta_date_aiguillage)){
        $stm->bindParam(':date_aiguillage',$ta_date_aiguillage);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date de début aiguillage est obligatoire !";
    }

    if(isset($ta_date_ret_prevue)){
        $stm->bindParam(':date_ret_prevue',$ta_date_ret_prevue);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date retour prévue est obligatoire !";
    }
}

/*
 * dates fin
 */

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

if(isset($ta_lien_plans)){
    $stm->bindParam(':lien_plans',$ta_lien_plans);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Lien vers les plans est obligatoire !";
}

if(isset($ta_retour_presta)){
    $stm->bindParam(':retour_presta',$ta_retour_presta);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Retour presta est obligatoire !";
}

if(isset($ta_ok)){
    $stm->bindParam(':ok',$ta_ok);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs OK est obligatoire !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $insertedId = $db->lastInsertId();
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message , "id" => $insertedId));
?>