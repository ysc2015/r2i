<?php
/**
 * file: update_info.php
 * User: rabii
 */

extract($_POST);

$stm = NULL;

$err = 0;
$message = array();

$fieldslist = "";
$valueslist = ":id_traitement_pbt,";
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

$stm = $db->prepare("update traitement_pbt set $fieldslist where id_traitement_pbt=:id_traitement_pbt");

foreach( $_POST as $key => $value ) {

    if(strpos($key,$suffix) !== false) {
        $arr = explode("_",$key);
        array_shift($arr);
        $stm->bindParam(":".implode("_",$arr),$_POST[$key]);
    }
}

if($paramcount < 1) {
    $err++;
    $message[] = "Vous n'avez pas le droit d'effectuer cette action !";
}

if(isset($idpi) && !empty($idpi)){
    $stm->bindParam(':id_traitement_pbt',$idpi);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence info point bloquant invalide !";
}


if($err == 0){
    if($stm->execute()){
        $message [] = "Info point bloquant enregistrée avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));

?>