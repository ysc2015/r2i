<?php
/**
 * file: user_add.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into projet_mail_creation (id_utilisateur) values (:id_utilisateur)");


if(isset($idu) && !empty($idu)){
    $stm->bindParam(':id_utilisateur',$idu);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs utilisateur est obligatoire !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Utilisateur ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>