<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 10/04/2017
 * Time: 16:38
 */

extract($_POST);

$err = 0;
$message = array();

$stm = $db->prepare("update wiki_categorie set nom = :nom, description = :description where id = $idcat");

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


if($err == 0){
    if($stm->execute()){
        $message [] = "Modification faite avec succès !";
    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message ));