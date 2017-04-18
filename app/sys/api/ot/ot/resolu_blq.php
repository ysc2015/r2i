<?php
/**
 * file: delete_blq.php
 * User: rabii
 */

extract($_POST);

$resolu = false;
$err = 0;
$message = array();

$stm = $db->prepare("update blq_pbc set statut = 1 where id_blq_pbc=:id_blq_pbc");

if(isset($idblq) && !empty($idblq)){
    $stm->bindParam(':id_blq_pbc',$idblq);
    $resolu = true;
} else {
    $err++;
    $message[] = "Référence BLQ/PBC invalide !";
}

if($resolu == true && $err == 0){
    if($stm->execute()){
        $message [] = "Element résolu avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>