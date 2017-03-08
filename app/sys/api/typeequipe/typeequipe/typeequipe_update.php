<?php
/**
 * file: typeequipe_update.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("update equipe_types set lib_type=:lib_type where id_equipe_types=:id_equipe_types");

if(isset($idt) && !empty($idt)){
    $stm->bindParam(':id_equipe_types',$idt);
    $insert = true;
} else {
    $err++;
    $message[] = "Réf type équipe est obligatoire !";
}

if(isset($lib) && !empty($lib)){
    $stm->bindParam(':lib_type',$lib);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Lib type équipe est obligatoire !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Modification faite avec succès";
    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>