<?php
/**
 * file: pcarto_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update sous_projet_plaque_carto set intervenant_be=:intervenant_be,date_debut=:date_debut,date_ret_prevue=:date_ret_prevue,duree=:duree where id_sous_projet=:id_sous_projet");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($pc_intervenant_be) && !empty($pc_intervenant_be)){
    $stm->bindParam(':intervenant_be',$pc_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

if(isset($pc_date_debut) && !empty($pc_date_debut)){
    $stm->bindParam(':date_debut',$pc_date_debut);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date de début est obligatoire !";
}

if(isset($pc_date_ret_prevue) && !empty($pc_date_ret_prevue)){
    $stm->bindParam(':date_ret_prevue',$pc_date_ret_prevue);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour prévue est obligatoire !";
}

if(isset($pc_duree) && !empty($pc_duree)){
    $stm->bindParam(':duree',$pc_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
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