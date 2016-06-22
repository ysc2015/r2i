<?php
/**
 * file: tablette_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into tablette (imei,id_entreprise) values (:imei,:id_entreprise)");

if(isset($imei) && !empty($imei)){
    $stm->bindParam(':imei',$imei);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs code imei est obligatoire !";
}

if(isset($company) && !empty($company)){
    $stm->bindParam(':id_entreprise',$company);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Entreprise est obligatoire !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>