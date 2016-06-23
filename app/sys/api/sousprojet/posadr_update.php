<?php
/**
 * file: posadr_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update sous_projet_plaque_pos_adresse set intervenant_be=:intervenant_be,date_debut=:date_debut,date_ret_prevue=:date_ret_prevue,duree=:duree,intervenant=:intervenant,bpe_sur_site=:bpe_sur_site where id_sous_projet=:id_sous_projet");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($pa_intervenant_be) && !empty($pa_intervenant_be)){
    $stm->bindParam(':intervenant_be',$pa_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

if(isset($pa_date_debut) && !empty($pa_date_debut)){
    $stm->bindParam(':date_debut',$pa_date_debut);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date début est obligatoire !";
}

if(isset($pa_date_ret_prevue) && !empty($pa_date_ret_prevue)){
    $stm->bindParam(':date_ret_prevue',$pa_date_ret_prevue);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour prévue est obligatoire !";
}

if(isset($pa_duree) && !empty($pa_duree)){
    $stm->bindParam(':duree',$pa_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
}

if(isset($pa_intervenant) && !empty($pa_intervenant)){
    $stm->bindParam(':intervenant',$pa_intervenant);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant est obligatoire !";
}

if(isset($pa_bpe_sur_site) && !empty($pa_bpe_sur_site)){
    $stm->bindParam(':bpe_sur_site',$pa_bpe_sur_site);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Bpe sur site est obligatoire !";
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