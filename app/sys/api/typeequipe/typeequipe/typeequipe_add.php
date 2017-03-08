<?php
/**
 * file: typeequipe_add.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("insert into equipe_types (lib_type,a2t) values (:lib_type,:a2t)");

if(isset($lib) && !empty($lib)){
    $stm->bindParam(':lib_type',$lib);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Lib type équipe est obligatoire !";
}

if(isset($visa2t)){

    if(empty($visa2t)) $visa2t = NULL;

    $stm->bindParam(':a2t',$visa2t);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>