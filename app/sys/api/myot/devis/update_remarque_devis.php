<?php
/**
 * file: update_remarque_devis.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update ordre_de_travail set commentaire2=:commentaire2 where id_ordre_de_travail=:id_ordre_de_travail");

if(isset($idot) && !empty($idot)){
    $stm->bindParam(':id_ordre_de_travail',$idot);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence ordre de travail introuvable !";
}

if(isset($rem)){
    $stm->bindParam(':commentaire2',$rem);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Remarque enreqistrée !";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message, "rem" =>  $rem));
?>