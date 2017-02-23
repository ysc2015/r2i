<?php
/**
 * file: devis_delete.php
 * User: fadil
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();


$stm = $db->prepare("update detaildevis set etat_devis = 10 where iddevis = :iddevis");

if(isset($iddevis) && !empty($iddevis)){
    $stm->bindParam(':iddevis',$iddevis);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence Devis invalide !";
}

if($delete == true && $err == 0){
     if($stm->execute()){
        $message [] = "Devis supprimé avec succès";



    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>