<?php
/**
 * file: stt_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update utilisateur set nom_utilisateur=:nom,prenom_utilisateur=:prenom,email_utilisateur=:email,pass_utilisateur=:pwd,id_entreprise=:id_entreprise where id_utilisateur=:idu");

if(isset($idu) && !empty($idu)){
    $stm->bindParam(':idu',$idu);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence utilisateur invalide !";
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

if(isset($email) && !empty($email)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {//is valid
        $stm->bindParam(':email',$email);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs email n'est pas valid !";
    }
} else {
    $err++;
    $message[] = "Le champs email est obligatoire !";
}

if(isset($pwd) && !empty($pwd)){
    $stm->bindParam(':pwd',$pwd);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs mot de passe est obligatoire !";
}

if(isset($company) && !empty($company)){
    $stm->bindParam(':id_entreprise',$company);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs entreprise est obligatoire !";
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