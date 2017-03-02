<?php
/**
 * file: devis_delete.php
 * User: fadil
 */

extract($_POST);

$err = 0;
$message = array();
$supprime = 0;

$stm = $db->prepare("select * from detaildevis where detaildevis.iddevis =:iddevis LIMIT 1");


if(isset($iddevis) && !empty($iddevis)){
    $stm->bindParam(':iddevis',$iddevis);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence Devis invalide !";
}

if($delete == true && $err == 0){
     if($stm->execute()){
        $detail_devis =  $stm->fetch(PDO::FETCH_ASSOC);
         if($detail_devis['etat_devis'] == '1') {
             $message [] = "Devis able to delete";
             $supprime = 1;
         }else{
             $message [] = "Devis NOT able to delete";

         }



    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message,"supprime" => $supprime,"etat_devis"=> $detail_devis['etat_devis']));
?>