<?php
/**
 * file: raccord_save.php
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

$suffix = "dr";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->distributionraccordement !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_distribution_raccordements set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_distribution_raccordements ($fieldslist) values ($valueslist)");
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

if(isset($dr_intervenant_be)){
    $stm->bindParam(':intervenant_be',$dr_intervenant_be);
    $insert = true;
}

if(isset($dr_preparation_pds)){
    $stm->bindParam(':preparation_pds',$dr_preparation_pds);
    $insert = true;
}

if(isset($dr_controle_plans)){
    $stm->bindParam(':controle_plans',$dr_controle_plans);
    $insert = true;
}

if(isset($dr_date_transmission_pds)){
    $stm->bindParam(':date_transmission_pds',$dr_date_transmission_pds);
    $insert = true;
}

if(isset($dr_id_entreprise)){
    $stm->bindParam(':id_entreprise',$dr_id_entreprise);
    $insert = true;
}

if(isset($dr_date_racco)){
    $stm->bindParam(':date_racco',$dr_date_racco);
    $insert = true;
}

if(isset($dr_duree)){
    $stm->bindParam(':duree',$dr_duree);
    $insert = true;
}

if(isset($dr_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$dr_controle_demarrage_effectif);
    $insert = true;
}

if(isset($dr_date_retour)){
    $stm->bindParam(':date_retour',$dr_date_retour);
    $insert = true;
}

if(isset($dr_etat_retour)){
    $stm->bindParam(':etat_retour',$dr_etat_retour);
    $insert = true;
}

if(isset($dr_ok)){
    $stm->bindParam(':ok',$dr_ok);
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