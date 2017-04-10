<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 10/04/2017
 * Time: 17:02
 */

extract($_POST);

$err = 0;
$message = array();

$stm = $db->prepare("insert into wiki_categorie (nom,description,id_categorie_parent,date_creation,date_dernier_mod) values (:nom,:description,$idcat,'".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."')");

if(isset($nom) && !empty($nom)){
    $stm->bindParam(':nom',$nom);
} else {
    $err++;
    $message[] = "Le champs Nom est obligatoire !";
}

if(isset($desc) && !empty($desc)){
    $stm->bindParam(':description',$desc);
} else {
    $err++;
    $message[] = "Le champs Déscription est obligatoire !";
}


if($err == 0) {
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";

    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}



echo json_encode(array("error" => $err , "message" => $message ));
?>