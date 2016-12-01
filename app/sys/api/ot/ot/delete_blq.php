<?php
/**
 * file: delete_blq.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from blq_pbc where id_blq_pbc=:id_blq_pbc");

if(isset($idblq) && !empty($idblq)){
    $stm->bindParam(':id_blq_pbc',$idblq);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence BLQ/PBC invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "Element supprimé avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>