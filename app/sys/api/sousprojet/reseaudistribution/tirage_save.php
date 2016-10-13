<?php
/**
 * file: tirage_save.php
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

$suffix = "dt";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->distributiontirage !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_distribution_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_distribution_tirage ($fieldslist) values ($valueslist)");
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

if(isset($dt_intervenant_be)){
    $stm->bindParam(':intervenant_be',$dt_intervenant_be);
    $insert = true;
}

if(isset($dt_date_previsionnelle)){
    $stm->bindParam(':date_previsionnelle',$dt_date_previsionnelle);
    $insert = true;
}

if(isset($dt_prep_plans)){
    $stm->bindParam(':prep_plans',$dt_prep_plans);
    $insert = true;
}

/*
 * lineaire debut
 */

if(isset($dt_lineaire1)){
    $stm->bindParam(':lineaire1',$dt_lineaire1);
    $insert = true;
}

if(isset($dt_lineaire2)){
    $stm->bindParam(':lineaire2',$dt_lineaire2);
    $insert = true;
}

if(isset($dt_lineaire3)){
    $stm->bindParam(':lineaire3',$dt_lineaire3);
    $insert = true;
}

if(isset($dt_lineaire4)){
    $stm->bindParam(':lineaire4',$dt_lineaire4);
    $insert = true;
}

if(isset($dt_lineaire5)){
    $stm->bindParam(':lineaire5',$dt_lineaire5);
    $insert = true;
}

if(isset($dt_lineaire6)){
    $stm->bindParam(':lineaire6',$dt_lineaire6);
    $insert = true;
}

if(isset($dt_lineaire7)){
    $stm->bindParam(':lineaire7',$dt_lineaire7);
    $insert = true;
}

if(isset($dt_lineaire8)){
    $stm->bindParam(':lineaire8',$dt_lineaire8);
    $insert = true;
}

if(isset($dt_lineaire9)){
    $stm->bindParam(':lineaire9',$dt_lineaire9);
    $insert = true;
}

if(isset($dt_lineaire10)){
    $stm->bindParam(':lineaire10',$dt_lineaire10);
    $insert = true;
}

if(isset($dt_lineaire11)){
    $stm->bindParam(':lineaire11',$dt_lineaire11);
    $insert = true;
}

if(isset($dt_lineaire12)){
    $stm->bindParam(':lineaire12',$dt_lineaire12);
    $insert = true;
}

/*
 * lineaire fin
 */

if(isset($dt_controle_plans)){
    $stm->bindParam(':controle_plans',$dt_controle_plans);
    $insert = true;
}

if(isset($dt_date_transmission_plans)){
    $stm->bindParam(':date_transmission_plans',$dt_date_transmission_plans);
    $insert = true;
}

if(isset($dt_id_entreprise)){
    $stm->bindParam(':id_entreprise',$dt_id_entreprise);
    $insert = true;
}

if(isset($dt_date_tirage)){
    $stm->bindParam(':date_tirage',$dt_date_tirage);
    $insert = true;
}

if(isset($dt_duree)){
    $stm->bindParam(':duree',$dt_duree);
    $insert = true;
}

if(isset($dt_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$dt_controle_demarrage_effectif);
    $insert = true;
}

if(isset($dt_date_retour)){
    $stm->bindParam(':date_retour',$dt_date_retour);
    $insert = true;
}

if(isset($dt_etat_retour)){
    $stm->bindParam(':etat_retour',$dt_etat_retour);
    $insert = true;
}

if(isset($dt_ok)){
    $stm->bindParam(':ok',$dt_ok);
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