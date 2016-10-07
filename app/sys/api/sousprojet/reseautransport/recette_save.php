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

$suffix = "trec";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->transportrecette !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_transport_recette set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_transport_recette ($fieldslist) values ($valueslist)");
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

if(isset($trec_intervenant_be)){
    $stm->bindParam(':intervenant_be',$trec_intervenant_be);
    $insert = true;
}

if(isset($trec_doe)){
    $stm->bindParam(':doe',$trec_doe);
    $insert = true;
}

if(isset($trec_netgeo)){
    $stm->bindParam(':netgeo',$trec_netgeo);
    $insert = true;
}

if(isset($trec_intervenant_free)){
    $stm->bindParam(':intervenant_free',$trec_intervenant_free);
    $insert = true;
}

if(isset($trec_id_entreprise)){
    $stm->bindParam(':id_entreprise',$trec_id_entreprise);
    $insert = true;
}

if(isset($trec_date_recette)){
    $stm->bindParam(':date_recette',$trec_date_recette);
    $insert = true;
}

if(isset($trec_etat_recette)){
    $stm->bindParam(':etat_recette',$trec_etat_recette);
    $insert = true;
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