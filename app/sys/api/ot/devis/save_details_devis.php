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
            $message [] = "Enregistrement fait avec succès";
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
}


echo $sql;

return $message;