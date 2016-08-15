<?php
/**
 * file: draccord_add.php
 * User: rabii
 */

extract($_POST);

$insertedId = 0;
$insert = false;
$err = 0;
$message = array();

$suffix = "dr";
$fieldslist = "id_sous_projet,";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

foreach( $_POST as $key => $value ) {

    if(strpos($key,$suffix) !== false) {
        $paramcount++;
        $arr = explode("_",$key);
        array_shift($arr);
        $fieldslist .= implode("_",$arr).",";
        $valueslist .= ":".implode("_",$arr).",";
    }
}

$fieldslist = rtrim($fieldslist,",");
$valueslist = rtrim($valueslist,",");

$stm = $db->prepare("insert into sous_projet_distribution_raccordements ($fieldslist) values ($valueslist)");

if($paramcount < 1) {
    $err++;
    $message[] = "Vous n'avez pas le droit d'effectuer cette action !";
}

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($dr_intervenant_be)){
    if(!empty($dr_intervenant_be)){
        $stm->bindParam(':intervenant_be',$dr_intervenant_be);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Intervenant BE est obligatoire !";
    }
}

if(isset($dr_preparation_pds)){
    if(!empty($dr_preparation_pds)){
        $stm->bindParam(':preparation_pds',$dr_preparation_pds);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Préparation pds est obligatoire !";
    }
}

if(isset($dr_controle_plans)){
    if(!empty($dr_controle_plans)){
        $stm->bindParam(':controle_plans',$dr_controle_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Controle plans est obligatoire !";
    }
}

if(isset($dr_date_transmission_pds)){
    if(!empty($dr_date_transmission_pds)){
        $stm->bindParam(':date_transmission_pds',$dr_date_transmission_pds);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date transmission plans est obligatoire !";
    }
}

if(isset($dr_id_entreprise)){
    if(!empty($dr_id_entreprise)){
        $stm->bindParam(':id_entreprise',$dr_id_entreprise);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Entreprise est obligatoire !";
    }
}

if(isset($dr_date_racco)){
    if(!empty($dr_date_racco)){
        $stm->bindParam(':date_racco',$dr_date_racco);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date raccordement est obligatoire !";
    }
}

if(isset($dr_duree)){
    if(!empty($dr_duree)){
        $stm->bindParam(':duree',$dr_duree);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Durée est obligatoire !";
    }
}

if(isset($dr_controle_demarrage_effectif)){
    if(!empty($dr_controle_demarrage_effectif)){
        $stm->bindParam(':controle_demarrage_effectif',$dr_controle_demarrage_effectif);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Controle démarrage effectif est obligatoire !";
    }
}

if(isset($dr_date_retour)){
    if(!empty($dr_date_retour)){
        $stm->bindParam(':date_retour',$dr_date_retour);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date retour est obligatoire !";
    }
}

if(isset($dr_etat_retour)){
    if(!empty($dr_etat_retour)){
        $stm->bindParam(':etat_retour',$dr_etat_retour);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Etat retour est obligatoire !";
    }
}

if(isset($dr_ok)){
    $stm->bindParam(':ok',$dr_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $insertedId = $db->lastInsertId();
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message, "id" => $insertedId));
?>