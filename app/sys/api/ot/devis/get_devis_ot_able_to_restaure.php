<?php
/**
 * file: devis_delete.php
 * User: fadil
 */

extract($_POST);

$err = 0;
$message = array();
$restaure = 0;

$stm = $db->prepare("select count(*) as nbre_devis_to_restaure from detaildevis dd 
where dd.etat_devis =10 and dd.id_ordre_de_travail= :id_ordre_de_travail 
and (select count(`iddevis`) from detaildevis as dd where dd.id_ordre_de_travail = :id_ordre_de_travail and etat_devis IN (3,4) ) < 1   ");


if(isset($id_ordre_de_travail) && !empty($id_ordre_de_travail)){
    $stm->bindParam(':id_ordre_de_travail',$id_ordre_de_travail);

}

     if($stm->execute()){
        $detail_ot =  $stm->fetch(PDO::FETCH_ASSOC);
         if($detail_ot['nbre_devis_to_restaure'] > 0) {
             $message [] = "Devis able to restaure";
             $restaure = 1;
         }else{
             $message [] = "Devis NOT able to restaure";

         }



    } else {
        $message [] = $stm->errorInfo();
    }


echo json_encode(array("error" => $err , "message" => $message,"restaure" => $restaure));
?>