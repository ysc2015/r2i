<?php
/**
 * file: projet_set_osa_id.php
 * User: rabii
 */

ini_set("display_errors",'1');

extract($_POST);

$insert = false;
$err = 0;
$insertedId = 0;
$message = array();
$stm = $db->prepare("update projet set id_projet_osa=:id_projet_osa where id_projet=:id_projet");

if(isset($idp) && !empty($idp)){
    $stm->bindParam(':id_projet',$idp);
    $insert = true;
} else {
    $err++;
    $message[] = "Identifiant projet invalid !";
}

if(isset($idosa) && !empty($idosa)){
    $stm->bindParam(':id_projet_osa',$idosa);
    $insert = true;
} else {
    $err++;
    $message[] = "Identifiant projet osa invalid !";
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