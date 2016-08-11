<?php
/**
 * file: infoplaque_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$suffix = "ip";
$fieldslist = "";
$paramcount = 0;

foreach( $_POST as $key => $value ) {

    if(strpos($key,$suffix) !== false) {
        $paramcount++;
        $arr = explode("_",$key);
        array_shift($arr);
        $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
    }
}

$fieldslist = rtrim($fieldslist,",");

$stm = $db->prepare("update sous_projet_plaque set $fieldslist where id_sous_projet=:id_sous_projet");

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

if(isset($ip_phase)){
    if(!empty($ip_phase)){
        $stm->bindParam(':phase',$ip_phase);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs phase est obligatoire !";
    }
}

if(isset($ip_type)){
    if(!empty($ip_type)){
        $stm->bindParam(':type',$ip_type);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs type est obligatoire !";
    }
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