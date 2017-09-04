<?php
/**
 * Created by PhpStorm.
 * User: fadil
 * Date: 12/01/17
 * Time: 02:38 م
 */

extract($_POST);
$sql = "";
$sql2 = "";
$message =[];
$err = 0;
if ($tablename=="TravauxRaccordementOptiqueMesure"){
    if($iddevis!=""){
        if($ligne < 10){
            $sql  = "update detaildevis set RFO_01_0".$ligne."_".$champ." = '".$val."'  where iddevis=$iddevis";
            $stm = $db->prepare($sql);
        }else{
            $sql  = "update detaildevis set RFO_01_".$ligne."_".$champ." = '".$val."'  where iddevis=$iddevis";
            $stm = $db->prepare($sql);
        }
        if($stm->execute()){
            $message [] = "Enregistrement fait avec succès";
        } else {
            $message [] = $stm->errorInfo();
        }

    }
}elseif ($tablename=="travauxReseauEntere"){
    $namecolone = "";
    if($iddevis!=""){

        if($titrecolumn!=""){
            $sql  = "update detaildevis set ".$titrecolumn."_qt = '".$val."'  where iddevis=$iddevis";
            $stm = $db->prepare($sql);
        }
        if($stm->execute()){
            $message [] = "Enregistrement fait avec succès";
        } else {
            $message [] = $stm->errorInfo();
        }



    }
}elseif ($tablename=="etude"){

    if($iddevis!=""){

        if($titrecolumn!=""){
            $sql  = "update detaildevis set ".$titrecolumn."_qt = '".$val."'  where iddevis=$iddevis";
            $stm = $db->prepare($sql);
        }

        if($stm->execute()){
            $message [] = "Enregistrement fait avec succès : ".$sql;
        } else {
            $message [] = $stm->errorInfo();
        }



    }
}elseif($tablename=="travauxsitetechnique"){
    if($iddevis!=""){

        if($titrecolumn!=""){
            $sql  = "update detaildevis set ".$titrecolumn."_qt = '".$val."'  where iddevis=$iddevis";
            $stm = $db->prepare($sql);
        }

        if($stm->execute()){
            $message [] = "Enregistrement fait avec succès";
        } else {
            $message [] = $stm->errorInfo();
        }



    }
}elseif($tablename=="tranche"){
    if($iddevis!=""){

        if($titrecolumn!=""){
            $sql  = "update detaildevis set ".$titrecolumn."_qt = '".$val."'  where iddevis=$iddevis";
            $stm = $db->prepare($sql);
        }

        if($stm->execute()){
            $message [] = "Enregistrement fait avec succès";
        } else {
            $message [] = $stm->errorInfo();
        }



    }
}elseif($tablename=="chambre"){
    if($iddevis!=""){

        if($titrecolumn!=""){
            $sql  = "update detaildevis set ".$titrecolumn."_qt = '".$val."'  where iddevis=$iddevis";
            $stm = $db->prepare($sql);
        }

        if($stm->execute()){
            $message [] = "Enregistrement fait avec succès";
        } else {
            $message [] = $stm->errorInfo();
        }



    }
}elseif($tablename=="travauxdiversgc"){
    if($iddevis!=""){

        if($titrecolumn!=""){
            $sql  = "update detaildevis set ".$titrecolumn."_qt = '".$val."'  where iddevis=$iddevis";
            $stm = $db->prepare($sql);
        }

        if($stm->execute()){
            $message [] = "Enregistrement fait avec succès";
        } else {
            $message [] = $stm->errorInfo();
        }



    }
}elseif($tablename=="detail_info"){
    if($iddevis!=""){


        $sql  = "update detaildevis set ref_devis = :ref_devis, etat_devis =:etat_devis, date_devis=:date_devis, date_livraison=:date_livraison  where iddevis=:iddevis";
        $stm = $db->prepare($sql);

        $stm->bindParam(':iddevis',$iddevis);
        $stm->bindParam(':ref_devis',$ref_devis);
        $stm->bindParam(':date_devis',$date_devis);
        $stm->bindParam(':date_livraison',$date_livraison);
        $stm->bindParam(':etat_devis',$etat_devis);

        if($stm->execute()){
            $message [] = "Enregistrement fait avec succès";
        } else {
            $message [] = $stm->errorInfo();
        }


    }
}elseif($tablename=="restaure_devis"){
    if($iddevis!=""){


        $sql  = "update detaildevis set  etat_devis =:etat_devis  where iddevis=:iddevis";
        $stm = $db->prepare($sql);

        $stm->bindParam(':iddevis',$iddevis);
        $stm->bindValue(':etat_devis','1');

        if($stm->execute()){
            $message [] = "Enregistrement fait avec succès";
        } else {
            $message [] = $stm->errorInfo();
        }


    }
}

echo json_encode(array("error" => $err , "message" => $message));
//return $message;