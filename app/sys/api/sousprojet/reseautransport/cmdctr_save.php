<?php
/**
 * file: cmdctr_save.php
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

$suffix = "cctr";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->transportcmcctr !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_transport_commande_ctr set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_transport_commande_ctr ($fieldslist) values ($valueslist)");
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

if(isset($cctr_intervenant_be)){
    $stm->bindParam(':intervenant_be',$cctr_intervenant_be);
    $insert = true;
}

if(isset($cctr_date_butoir)){
    $stm->bindParam(':date_butoir',$cctr_date_butoir);
    $insert = true;
}

if(isset($cctr_traitement_retour_terrain)){
    $stm->bindParam(':traitement_retour_terrain',$cctr_traitement_retour_terrain);
    $insert = true;
}

if(isset($cctr_modification_carto)){
    $stm->bindParam(':modification_carto',$cctr_modification_carto);
    $insert = true;
}

if(isset($cctr_commandes_acces)){
    $stm->bindParam(':commandes_acces',$cctr_commandes_acces);
    $insert = true;
}

if(isset($cctr_date_transmission_ca)){
    $stm->bindParam(':date_transmission_ca',$cctr_date_transmission_ca);
    $insert = true;
}

if(isset($cctr_ref_commande_acces)){
    $stm->bindParam(':ref_commande_acces',$cctr_ref_commande_acces);
    $insert = true;
}

if(isset($cctr_go_ft)){
    $stm->bindParam(':go_ft',$cctr_go_ft);
    $insert = true;
}

if(isset($cctr_ok)){
    $stm->bindParam(':ok',$cctr_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        setSousProjetUsers(SousProjet::find($ids));
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>