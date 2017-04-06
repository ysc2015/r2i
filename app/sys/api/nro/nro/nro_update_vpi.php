<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 06/04/2017
 * Time: 10:36
 */

extract($_POST);

$null = NULL;

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update nro set id_utilisateur=:id_utilisateur where id_nro=:id_nro");


if(isset($idu)){
    if(empty($idu)) {
        $stm->bindParam(':id_utilisateur',$null);
        $insert = true;
    } else {
        $stm->bindParam(':id_utilisateur',$idu);
        $insert = true;
    }
}

if(isset($idnro) && !empty($idnro)){
    $stm->bindParam(':id_nro',$idnro);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence nro introuvable !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Nro Modifié avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>