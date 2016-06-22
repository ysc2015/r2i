<?php
/**
 * file: tcmdctr_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_transport_commande_ctr (id_sous_projet,intervenant_be,date_butoir,traitement_retour_terrain,modification_carto,commandes_acces,date_transmission_ca,ref_commande_acces,go_ft) values (:id_sous_projet,:intervenant_be,:date_butoir,:traitement_retour_terrain,:modification_carto,:commandes_acces,:date_transmission_ca,:ref_commande_acces,:go_ft)");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($cctr_intervenant_be) && !empty($cctr_intervenant_be)){
    $stm->bindParam(':intervenant_be',$cctr_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

if(isset($cctr_date_butoir) && !empty($cctr_date_butoir)){
    $stm->bindParam(':date_butoir',$cctr_date_butoir);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date butoir est obligatoire !";
}

if(isset($cctr_traitement_retour_terrain) && !empty($cctr_traitement_retour_terrain)){
    $stm->bindParam(':traitement_retour_terrain',$cctr_traitement_retour_terrain);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Traitement retour terrain est obligatoire !";
}

if(isset($cctr_modification_carto) && !empty($cctr_modification_carto)){
    $stm->bindParam(':modification_carto',$cctr_modification_carto);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Modification carto est obligatoire !";
}

if(isset($cctr_commandes_acces) && !empty($cctr_commandes_acces)){
    $stm->bindParam(':commandes_acces',$cctr_commandes_acces);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Commandes accés est obligatoire !";
}

if(isset($cctr_date_transmission_ca) && !empty($cctr_date_transmission_ca)){
    $stm->bindParam(':date_transmission_ca',$cctr_date_transmission_ca);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date transmission CA est obligatoire !";
}

if(isset($cctr_ref_commande_acces) && !empty($cctr_ref_commande_acces)){
    $stm->bindParam(':ref_commande_acces',$cctr_ref_commande_acces);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Réf commande accés est obligatoire !";
}

if(isset($cctr_go_ft) && !empty($cctr_go_ft)){
    $stm->bindParam(':go_ft',$cctr_go_ft);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Go FT est obligatoire !";
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