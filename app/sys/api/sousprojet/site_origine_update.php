<?php
/**
 * file: site_origine_update.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$suffix = "so";
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

$stm = $db->prepare("update sous_projet_site_origine set $fieldslist where id_sous_projet=:id_sous_projet");

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

if(isset($so_auto_adduction)){
    if(!empty($so_auto_adduction)){
        $stm->bindParam(':auto_adduction',$so_auto_adduction);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Auto adduction est obligatoire !";
    }
}

if(isset($so_travaux_adduction)){
    if(!empty($so_travaux_adduction)){
        $stm->bindParam(':travaux_adduction',$so_travaux_adduction);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Travaux adduction est obligatoire !";
    }
}

if(isset($so_recette_adduction)){
    if(!empty($so_recette_adduction)){
        $stm->bindParam(':recette_adduction',$so_recette_adduction);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Recette adduction est obligatoire !";
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