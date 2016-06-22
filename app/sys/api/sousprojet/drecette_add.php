<?php
/**
 * file: drecette_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_distribution_recette (id_sous_projet,intervenant_be,doe,netgeo,intervenant_free,id_entreprise,date_recette,etat_recette) values (:id_sous_projet,:intervenant_be,:doe,:netgeo,:intervenant_free,:id_entreprise,:date_recette,:etat_recette)");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($drec_intervenant_be) && !empty($drec_intervenant_be)){
    $stm->bindParam(':intervenant_be',$drec_intervenant_be);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

if(isset($drec_doe) && !empty($drec_doe)){
    $stm->bindParam(':doe',$drec_doe);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs DOE est obligatoire !";
}

if(isset($drec_netgeo) && !empty($drec_netgeo)){
    $stm->bindParam(':netgeo',$drec_netgeo);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs netgeo est obligatoire !";
}

if(isset($drec_intervenant_free) && !empty($drec_intervenant_free)){
    $stm->bindParam(':intervenant_free',$drec_intervenant_free);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Intervenant free est obligatoire !";
}

if(isset($drec_entreprise) && !empty($drec_entreprise)){
    $stm->bindParam(':id_entreprise',$drec_entreprise);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Entreprise est obligatoire !";
}

if(isset($drec_date_recette) && !empty($drec_date_recette)){
    $stm->bindParam(':date_recette',$drec_date_recette);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date de recette est obligatoire !";
}

if(isset($drec_etat_recette) && !empty($drec_etat_recette)){
    $stm->bindParam(':etat_recette',$drec_etat_recette);
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