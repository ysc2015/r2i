<?php
/**
 * file: user_update.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update utilisateur set nom_utilisateur=:nom,prenom_utilisateur=:prenom,email_utilisateur=:email,telephone_utilisateur=:tel,pass_utilisateur=:pwd,id_profil_utilisateur=:profil where id_utilisateur=:idu");

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

if(isset($tel)){
    $stm->bindParam(':tel',$tel);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs tel est obligatoire !";
}

if(isset($pwd) && !empty($pwd)){
    $stm->bindParam(':pwd',$pwd);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs mot de passe est obligatoire !";
}

if(isset($profil) && !empty($profil)){
    $stm->bindParam(':profil',$profil);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs profil est obligatoire !";
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