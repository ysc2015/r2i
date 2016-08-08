<?php
/**
 * file: phase_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$suffix = "gp";
$sousprojet_infoplaque = SousProjetInfoPlaque::first(array('conditions' => array("id_sous_projet = ?", $ids)));

$fieldslist = "";

if($sousprojet_infoplaque !== NULL) {
    $fieldslist .= "vague=:vague,";
}

foreach( $_POST as $key => $value ) {

    if(strpos($key,$suffix) !== false) {
        $arr = explode("_",$key);
        array_shift($arr);
        $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
    }
}

$fieldslist = rtrim($fieldslist,",");

$stm = $db->prepare("update sous_projet_plaque_phase set $fieldslist where id_sous_projet=:id_sous_projet");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($gp_instigateur)){
    if(!empty($gp_instigateur)) {
        $stm->bindParam(':instigateur',$gp_instigateur);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Instigateur est obligatoire !";
    }
}

if(isset($gp_date_lancement)){
    if(!empty($gp_date_lancement)) {
        $stm->bindParam(':date_lancement',$gp_date_lancement);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date lancement est obligatoire !";
    }
}

if($sousprojet_infoplaque !== NULL) {
    $stm->bindParam(':vague',$sousprojet_infoplaque->phase);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Modification faite avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>