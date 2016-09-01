<?php
/**
 * file: projet_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

ini_set("display_errors",'1');

//sleep(3);

$output_dir = __DIR__."/uploads/projets/";
set_time_limit(60);

extract($_POST);

$insert = false;
$err = 0;
$insertedId = 0;
$message = array();
$stm = $db->prepare("insert into projet (ville_nom,ville,trigramme_dept,code_site_origine,type_site_origine,taille,etat_site_origine,date_mad_site_origine,date_creation) values (:ville_nom,:ville,:trigramme_dept,:code_site_origine,:type_site_origine,:taille,:etat_site_origine,:date_mad_site_origine,:date_creation)");

$project_name = "";

if(isset($ville_nom) && !empty($ville_nom)){
    $stm->bindParam(':ville_nom',$ville_nom);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs ville est obligatoire !";
}

if(isset($ville) && !empty($ville)){
    $stm->bindParam(':ville',$ville);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs département est obligatoire !";
}

if(isset($trigramme_dept) && !empty($trigramme_dept)){
    if(strlen($trigramme_dept) == 9) {
        $stm->bindParam(':trigramme_dept',$trigramme_dept);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Trigramme de la plaque doit comporter 9 caractéres Ex:PLAXX_XXX";
    }
} else {
    $err++;
    $message[] = "Le champs Trigramme de la plaque est obligatoire !";
}

if(isset($code_site_origine) && !empty($code_site_origine)){
    $stm->bindParam(':code_site_origine',$code_site_origine);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Code site d’origine est obligatoire !";
}

if(isset($type_site_origine) && !empty($type_site_origine)){
    $stm->bindParam(':type_site_origine',$type_site_origine);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Type de Site est obligatoire !";
}

if(isset($taille) && !empty($taille)){
    $stm->bindParam(':taille',$taille);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs taille est obligatoire !";
}

if(isset($etat_site_origine) && !empty($etat_site_origine)){
    $stm->bindParam(':etat_site_origine',$etat_site_origine);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Etat Site Origine est obligatoire !";
}

if(isset($date_mad_site_origine) && !empty($date_mad_site_origine)){
    $stm->bindParam(':date_mad_site_origine',$date_mad_site_origine);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date Mise à disposition est obligatoire !";
}

$stm->bindParam(':date_creation',date('Y-m-d'));

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
        $insertedId = $db->lastInsertId();
        $project_name = "Lancement Projet d’étude Plaque PON FTTH ".$code_site_origine." ".$ville_nom;
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message , "id" => $insertedId, "pname" => $project_name));

?>