<?php
/**
 * file: equipe_update.php
 * User: rabii
 */

ini_set("display_errors",'1');

extract($_POST);

//$id = 0;

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update equipe_stt set imei=:imei,nom=:nom,prenom=:prenom,tel=:tel,mail=:mail where id_equipe_stt=:id_equipe_stt");

if(isset($idp) && !empty($idp)){
    $stm->bindParam(':id_equipe_stt',$idp);
    $insert = true;
} else {
    $err++;
    $message[] = "Identifiant équipe invalid !";
}

if(isset($imei) && !empty($imei)){
    $stm->bindParam(':imei',$imei);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs imei est obligatoire !";
}

if(isset($nom) && !empty($nom)){
    $stm->bindParam(':nom',$nom);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs nom est obligatoire !";
}

if(isset($prenom) && !empty($prenom)){
    $stm->bindParam(':prenom',$prenom);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs prénom est obligatoire !";
}

if(isset($tel) && !empty($tel)){
    $stm->bindParam(':tel',$tel);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs tél est obligatoire !";
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
echo json_encode(array("error" => $err , "message" => $message/*, "ide" => $id*/));

?>