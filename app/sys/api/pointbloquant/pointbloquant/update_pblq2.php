<?php
/**
 * file: update_pblq2.php
 * User: rabii
 */

extract($_POST);

$pointBloquant = NULL;
$stm = NULL;

if(isset($idp) && !empty($idp)){
    $pointBloquant = PointBloquant::find($idp);
}

$err = 0;
$message = array();

$fieldslist = "";
$valueslist = ":id_point_bloquant,";
$paramcount = 0;

if(true) {
    foreach( $_POST as $key => $value ) {

        if(strpos($key,$suffix) !== false) {
            $paramcount++;
            $arr = explode("_",$key);
            array_shift($arr);
            $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
        }
    }

    $fieldslist = rtrim($fieldslist,",");
    $fieldslist .=",id_modificateur = :id_modificateur";

    $stm = $db->prepare("update point_bloquant_type_de_blocage set $fieldslist where id_point_bloquant=:id_point_bloquant");
    $id_modificateur = intval($connectedProfil->profil->id_utilisateur);
    $stm->bindParam(':id_modificateur',$id_modificateur);
    foreach( $_POST as $key => $value ) {

        if(strpos($key,$suffix) !== false) {
            $arr = explode("_",$key);
            array_shift($arr);
            $stm->bindParam(":".implode("_",$arr),$_POST[$key]);
        }
    }
} else {
    $err++;
    $message[] = "reférence point bloquant invalide ou suppprimée!";
}

if($paramcount < 1) {
    $err++;
    $message[] = "Vous n'avez pas le droit d'effectuer cette action !";
}

if(isset($idp) && !empty($idp)){
    $stm->bindParam(':id_point_bloquant',$idp);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence point bloquant invalide !";
}


if($err == 0){
    if($stm->execute()){
        $message [] = "Type point bloquant enregistré avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));

?>