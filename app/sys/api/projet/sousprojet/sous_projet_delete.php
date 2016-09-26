<?php
/**
 * file: sous_projet_delete.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from sous_projet where id_sous_projet=:id_sous_projet");

if(isset($idsp) && !empty($idsp)){
    $stm->bindParam(':id_sous_projet',$idsp);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "Sous projet supprimé avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>