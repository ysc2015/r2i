<?php
/**
 * file: entreprise_update.php
 * User: rabii
 */

ini_set("display_errors",'1');

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update entreprises_stt set nom=:nom,adresse_siege=:adresse_siege,adresse_livraison=:adresse_livraison,gerant_entreprise=:gerant_entreprise,contact_nom=:contact_nom,contact_prenom=:contact_prenom,contact_tel_mobile=:contact_tel_mobile,contact_tel_fixe=:contact_tel_fixe,contact_email=:contact_email where id_entreprises_stt=:id_entreprises_stt");

if(isset($idp) && !empty($idp)){
    $stm->bindParam(':id_entreprises_stt',$idp);
    $insert = true;
} else {
    $err++;
    $message[] = "Identifiant entreprise invalid !";
}

if(isset($nom) && !empty($nom)){
    $stm->bindParam(':nom',$nom);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs nom est obligatoire !";
}

if(isset($adresse_siege) && !empty($adresse_siege)){
    $stm->bindParam(':adresse_siege',$adresse_siege);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs adresse siége est obligatoire !";
}

if(isset($adresse_livraison) && !empty($adresse_livraison)){
    $stm->bindParam(':adresse_livraison',$adresse_livraison);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs adresse siége est obligatoire !";
}

if(isset($gerant_entreprise) && !empty($gerant_entreprise)){
    $stm->bindParam(':gerant_entreprise',$gerant_entreprise);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs gérant entreprise est obligatoire !";
}

if(isset($contact_nom) && !empty($contact_nom)){
    $stm->bindParam(':contact_nom',$contact_nom);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs contact nom est obligatoire !";
}

if(isset($contact_prenom) && !empty($contact_prenom)){
    $stm->bindParam(':contact_prenom',$contact_prenom);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs contact prénom est obligatoire !";
}

if(isset($contact_tel_mobile) && !empty($contact_tel_mobile)){
    $stm->bindParam(':contact_tel_mobile',$contact_tel_mobile);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs contact tél mobile est obligatoire !";
}

if(isset($contact_tel_fixe) && !empty($contact_tel_fixe)){
    $stm->bindParam(':contact_tel_fixe',$contact_tel_fixe);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs contact tél fixe est obligatoire !";
}

if(isset($contact_email) && !empty($contact_email)){
    $stm->bindParam(':contact_email',$contact_email);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs contact émail est obligatoire !";
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