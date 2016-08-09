<?php
/**
 * file: equipe_add.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into equipe_stt (id_entreprise_stt,imei,nom,prenom,tel,mail) values (:id_entreprise_stt,:imei,:nom,:prenom,:tel,:mail)");

if(isset($idp) && !empty($idp)){
    $stm->bindParam(':id_entreprise_stt',$idp);
    $insert = true;
} else {
    $err++;
    $message[] = "Identifiant entreprise invalid !";
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
    $stm->bindParam(':mail',$mail);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs émail est obligatoire !";
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