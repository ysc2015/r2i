<?php
/**
 * file: recette_save.php
 * User: rabii
 */

extract($_POST);

$sousProjet = NULL;
$stm = NULL;

if(isset($ids) && !empty($ids)){
    $sousProjet = SousProjet::find($ids);
}

$insert = false;
$err = 0;
$message = array();

$suffix = "drec";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->distributionrecette !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_distribution_recette set $fieldslist where id_sous_projet=:id_sous_projet");
    } else {
        $fieldslist = "id_sous_projet,";
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

        $stm = $db->prepare("insert into sous_projet_distribution_recette ($fieldslist) values ($valueslist)");
    }
} else {
    $err++;
    $message[] = "Erreur reférence sous projet";
}

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

if(isset($drec_intervenant_be)){
    if(!empty($drec_intervenant_be)){
        $stm->bindParam(':intervenant_be',$drec_intervenant_be);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Intervenant BE est obligatoire !";
    }
}

if(isset($drec_doe)){
    if(!empty($drec_doe)){
        $stm->bindParam(':doe',$drec_doe);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs DOE est obligatoire !";
    }
}

if(isset($drec_netgeo)){
    if(!empty($drec_netgeo)){
        $stm->bindParam(':netgeo',$drec_netgeo);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs netgeo est obligatoire !";
    }
}

if(isset($drec_intervenant_free)){
    if(!empty($drec_intervenant_free)){
        $stm->bindParam(':intervenant_free',$drec_intervenant_free);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Intervenant free est obligatoire !";
    }
}

if(isset($drec_id_entreprise)){
    if(!empty($drec_id_entreprise)){
        $stm->bindParam(':id_entreprise',$drec_id_entreprise);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Entreprise est obligatoire !";
    }
}

if(isset($drec_date_recette)){
    if(!empty($drec_date_recette)){
        $stm->bindParam(':date_recette',$drec_date_recette);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date de recette est obligatoire !";
    }
}

if(isset($drec_etat_recette)){
    if(!empty($drec_etat_recette)){
        $stm->bindParam(':etat_recette',$drec_etat_recette);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Etat recette est obligatoire !";
    }
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>