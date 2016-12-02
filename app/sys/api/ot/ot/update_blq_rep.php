<?php
/**
 * file: update_blq_rep.php
 * User: rabii
 */

extract($_POST);

$err = 0;
$message = array();

$stm = $db->prepare("update blq_pbc set reponse_ajustement=:reponse_ajustement where id_blq_pbc=:id_blq_pbc");

if(isset($idblq) && !empty($idblq)){
    $stm->bindParam(':id_blq_pbc',$idblq);
} else {
    $err++;
    $message[] = "Identifiant question invalid !";
}

if(isset($reponse_ajustement) && !empty($reponse_ajustement)){
    $stm->bindParam(':reponse_ajustement',$reponse_ajustement);
} else {
    $err++;
    $message[] = "Le champs réponse est obligatoire !";
}

if($err == 0){
    if($stm->execute()){
        $message [] = "Réponse enregistrée avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));