<?php
/**
 * file: trecette_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_transport_recette (id_sous_projet,intervenant_be,doe,netgeo,intervenant_free,id_entreprise,date_recette,etat_recette) values (:id_sous_projet,:intervenant_be,:doe,:netgeo,:intervenant_free,:id_entreprise,:date_recette,:etat_recette)");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($trec_intervenant_be) && !empty($trec_intervenant_be)){
    $stm->bindParam(':intervenant_be',$trec_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

if(isset($trec_doe) && !empty($trec_doe)){
    $stm->bindParam(':doe',$trec_doe);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs DOE est obligatoire !";
}

if(isset($trec_netgeo) && !empty($trec_netgeo)){
    $stm->bindParam(':netgeo',$trec_netgeo);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs NETGEO est obligatoire !";
}

if(isset($trec_intervenant_free) && !empty($trec_intervenant_free)){
    $stm->bindParam(':intervenant_free',$trec_intervenant_free);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant free est obligatoire !";
}

if(isset($trec_entreprise) && !empty($trec_entreprise)){
    $stm->bindParam(':id_entreprise',$trec_entreprise);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Entreprise est obligatoire !";
}

if(isset($trec_date_recette) && !empty($trec_date_recette)){
    $stm->bindParam(':date_recette',$trec_date_recette);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date recette est obligatoire !";
}

if(isset($trec_etat_recette) && !empty($trec_etat_recette)){
    $stm->bindParam(':etat_recette',$trec_etat_recette);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Etat recette est obligatoire !";
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