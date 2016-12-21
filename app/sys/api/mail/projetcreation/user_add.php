<?php
/**
 * file: user_add.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into projet_mail_creation (id_utilisateur,id_type_notification) values (:id_utilisateur,:id_type_notification)");


if(isset($idu) && !empty($idu)){
    $stm->bindParam(':id_utilisateur',$idu);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs utilisateur est obligatoire !";
}

if(isset($type_notif) && !empty($type_notif)){
    $stm->bindParam(':id_type_notification',$type_notif);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs type notification est obligatoire !";
}

if($insert == true && $err == 0){
    if(@$stm->execute()){
        $message [] = "Utilisateur ajouté à liste avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>