<?php
/**
 * file: mailcreation_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into projet_mail_creation (mail) values (:mail)");


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
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>