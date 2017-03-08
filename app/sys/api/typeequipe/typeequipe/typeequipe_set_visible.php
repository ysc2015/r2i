<?php
/**
 * file: typeequipe_set_visible.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("update equipe_types set a2t=:a2t where id_equipe_types=:id_equipe_types");

if(isset($idt) && !empty($idt)){
    $stm->bindParam(':id_equipe_types',$idt);
    $insert = true;
} else {
    $err++;
    $message[] = "Réf type équipe est obligatoire !";
}

if(isset($visa2t) && !empty($visa2t)){
    $stm->bindParam(':a2t',$visa2t);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Visible A2T est obligatoire !";
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