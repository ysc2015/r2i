<?php
/**
 * file: dtirage_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insertedId = 0;
$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_distribution_tirage (id_sous_projet,intervenant_be,date_previsionnelle,prep_plans,lineaire1,lineaire2,lineaire3,lineaire4,lineaire5,lineaire6,lineaire7,lineaire8,controle_plans,date_transmission_plans,id_entreprise,date_tirage,duree,controle_demarrage_effectif,date_retour,etat_retour,ok) values (:id_sous_projet,:intervenant_be,:date_previsionnelle,:prep_plans,lineaire1,lineaire2,lineaire3,lineaire4,lineaire5,lineaire6,lineaire7,lineaire8,:controle_plans,:date_transmission_plans,:id_entreprise,:date_tirage,:duree,:controle_demarrage_effectif,:date_retour,:etat_retour,:ok)");

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

/*
 * lineaire debut
 */

if(isset($lineaire1) && !empty($lineaire1)){
    $stm->bindParam(':lineaire1',$lineaire1);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs 288FO est obligatoire !";
}

if(isset($lineaire2) && !empty($lineaire2)){
    $stm->bindParam(':lineaire2',$lineaire2);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs 144FO est obligatoire !";
}

if(isset($lineaire3) && !empty($lineaire3)){
    $stm->bindParam(':lineaire3',$lineaire3);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs 72FO est obligatoire !";
}

if(isset($lineaire4) && !empty($lineaire4)){
    $stm->bindParam(':lineaire4',$lineaire4);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs 48FO est obligatoire !";
}

if(isset($lineaire5) && !empty($lineaire5)){
    $stm->bindParam(':lineaire5',$lineaire5);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs BPE 288FO est obligatoire !";
}

if(isset($lineaire6) && !empty($lineaire6)){
    $stm->bindParam(':lineaire6',$lineaire6);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs BPE 144FO est obligatoire !";
}

if(isset($lineaire7) && !empty($lineaire7)){
    $stm->bindParam(':lineaire7',$lineaire7);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs BPE 72FO est obligatoire !";
}

if(isset($lineaire8) && !empty($lineaire8)){
    $stm->bindParam(':lineaire8',$lineaire8);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs BPE 48FO est obligatoire !";
}

/*
 * lineaire fin
 */

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

if(isset($dt_ok)){
    $stm->bindParam(':ok',$dt_ok);
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