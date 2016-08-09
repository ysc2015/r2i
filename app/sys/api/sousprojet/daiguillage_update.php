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
$stm = $db->prepare("update sous_projet_distribution_aiguillage set intervenant_be=:intervenant_be,plans=:plans,lineaire1=:lineaire1,lineaire2=:lineaire2,lineaire3=:lineaire3,lineaire4=:lineaire4,lineaire5=:lineaire5,lineaire6=:lineaire6,lineaire7=:lineaire7,lineaire8=:lineaire8,controle_plans=:controle_plans,date_transmission_plans=:date_transmission_plans,id_entreprise=:id_entreprise,date_aiguillage=:date_aiguillage,duree=:duree,controle_demarrage_effectif=:controle_demarrage_effectif,date_retour=:date_retour,etat_retour=:etat_retour,ok=:ok where id_sous_projet=:id_sous_projet");

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

/*if(isset($da_lineaire_reseau) && !empty($da_lineaire_reseau)){
    $stm->bindParam(':lineaire_reseau',$da_lineaire_reseau);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Linéaire réseau est obligatoire !";
}*/

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

if(isset($da_ok)){
    $stm->bindParam(':ok',$da_ok);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs OK est obligatoire !";
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