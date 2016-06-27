<?php
/**
 * file: mailcreation_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update projet_mail_creation set mail=:mail where id_projet_mail_creation=:idm");

if(isset($idm) && !empty($idm)){
    $stm->bindParam(':idm',$idm);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence mail invalide !";
}

if(isset($mail) && !empty($mail)){
    if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {//is valid
        $stm->bindParam(':mail',$mail);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs email n'est pas valid !";
    }
} else {
    $err++;
    $message[] = "Le champs email est obligatoire !";
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