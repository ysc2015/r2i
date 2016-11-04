<?php
/**
 * file: commandefintravaux_save.php
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

$suffix = "dcftrvx";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->distributioncmdfintravaux !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_distribution_commande_fin_travaux set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_distribution_commande_fin_travaux ($fieldslist) values ($valueslist)");
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

if(isset($cftrvx_intervenant_be)){
    $stm->bindParam(':intervenant_be',$cftrvx_intervenant_be);
    $insert = true;
}

if(isset($cftrvx_date_butoir)){
    $stm->bindParam(':date_butoir',$cftrvx_date_butoir);
    $insert = true;
}

if(isset($cftrvx_traitement_retour_terrain)){
    $stm->bindParam(':traitement_retour_terrain',$cftrvx_traitement_retour_terrain);
    $insert = true;
}

if(isset($cftrvx_modification_carto)){
    $stm->bindParam(':modification_carto',$cftrvx_modification_carto);
    $insert = true;
}

if(isset($cftrvx_commandes_fin_travaux)){
    $stm->bindParam(':commandes_fin_travaux',$cftrvx_commandes_fin_travaux);
    $insert = true;
}

if(isset($cftrvx_date_transmission_tfx)){
    $stm->bindParam(':date_transmission_tfx',$cftrvx_date_transmission_tfx);
    $insert = true;
}

if(isset($cftrvx_ref_commande_fin_travaux)){
    $stm->bindParam(':ref_commande_fin_travaux',$cftrvx_ref_commande_fin_travaux);
    $insert = true;
}

if(isset($cftrvx_ok_ft)){
    $stm->bindParam(':ok_ft',$cftrvx_ok_ft);
    $insert = true;
}

if(isset($cftrvx_ok)){
    $stm->bindParam(':ok',$cftrvx_ok);
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