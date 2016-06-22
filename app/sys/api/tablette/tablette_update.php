<?php
/**
 * file: tablette_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update tablette set imei=:imei,id_entreprise=:id_entreprise where id_tablette=:idt");

if(isset($idt) && !empty($idt)){
    $stm->bindParam(':idt',$idt);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence tablette invalide !";
}

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
        $message [] = "Modification faite avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>