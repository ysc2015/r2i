<?php
/**
 * file: nro_update.php
 * User: rabii
 */

extract($_POST);

$null = NULL;

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update nro set lib_nro=:lib_nro,id_utilisateur=:id_utilisateur where id_nro=:id_nro");


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

if(isset($idn) && !empty($idn)){
    $stm->bindParam(':lib_nro',strtoupper($idn));
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs nro est obligatoire !";
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