<?php
/**
 * file: ot_delete.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from ordre_de_travail where id_ordre_de_travail=:id_ordre_de_travail");

if(isset($idot) && !empty($idot)){
    $stm->bindParam(':id_ordre_de_travail',$idot);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence OT invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "OT supprimé avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>