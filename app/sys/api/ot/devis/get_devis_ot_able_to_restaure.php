<?php
/**
 * file: devis_delete.php
 * User: fadil
 */

extract($_POST);

$err = 0;
$message = array();
$restaure = 0;
$add_new_devis= 0;

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

    $stm_valide_new_devis = $db->prepare("select count(`iddevis`) as count_devis from detaildevis as dd where dd.id_ordre_de_travail = :id_ordre_de_travail 
    and etat_devis IN (3,4)  ");

    if(isset($id_ordre_de_travail) && !empty($id_ordre_de_travail)){
        $stm_valide_new_devis->bindParam(':id_ordre_de_travail',$id_ordre_de_travail);

    }
    if($stm_valide_new_devis->execute()){
    $detail_ot_devis =  $stm_valide_new_devis->fetch(PDO::FETCH_ASSOC);
    if($detail_ot_devis['count_devis'] > 0) {
        $message [] = "Devis NOT able to add new devis";
    }else{
        $message [] = "Devis able to add new devis";
        $add_new_devis = 1;


    }



} else {
    $message [] = $stm_valide_new_devis->errorInfo();
}


echo json_encode(array("error" => $err , "message" => $message,"restaure" => $restaure,"add_new_devis" => $add_new_devis));
?>