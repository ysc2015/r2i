<?php
/**
 * file: update_blq_rep.php
 * User: rabii
 */

extract($_POST);

$err = 0;
$message = array();

$stm = $db->prepare("update blq_pbc set reponse_ajustement=:reponse_ajustement, flag = :flag, date_action =:date_action where id_blq_pbc=:id_blq_pbc");

if(isset($idblq) && !empty($idblq)){
    $stm->bindParam(':id_blq_pbc',$idblq);
    $stm->bindValue(':flag',0);
    $stm->bindValue(':date_action',date('Y-m-d H:i:s'));
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