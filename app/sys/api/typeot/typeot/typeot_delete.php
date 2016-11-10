<?php
/**
 * file: typeot_delete.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from select_type_ordre_travail where id_type_ordre_travail=:id_type_ordre_travail");

if(isset($idt) && !empty($idt)){
    $stm->bindParam(':id_type_ordre_travail',$idt);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence Type OT invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "Type OT supprimé avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>