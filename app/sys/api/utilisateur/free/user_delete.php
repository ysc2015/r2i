<?php
/**
 * file: user_delete.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from utilisateur where id_utilisateur=:id_utilisateur");

if(isset($idu) && !empty($idu)){
    $stm->bindParam(':id_utilisateur',$idu);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence utilisateur invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "Utilisateur supprimé avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>