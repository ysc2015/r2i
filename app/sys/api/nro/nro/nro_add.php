<?php
/**
 * file: nro_add.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into nro (lib_nro,id_utilisateur) values (:lib_nro,:id_utilisateur)");


if(isset($idu) && !empty($idu)){
    $stm->bindParam(':id_utilisateur',$idu);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs utilisateur est obligatoire !";
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
        $message [] = "Nro ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>