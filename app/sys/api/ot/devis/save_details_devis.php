<?php
/**
 * file: get_details_devis.php
 * User: rabii
 */

extract($_POST);



$fieldslist = "";
foreach( $_POST as $key => $value ) {
        if($key !=="iddevis")
        $fieldslist .= $key."=:".$key.",";

}

$fieldslist = rtrim($fieldslist,",");

$stm = $db->prepare("update detaildevis set $fieldslist where iddevis=:iddevis");

$new = true;
$mailaction_new = true;

if(isset($iddevis)){
    $stm->bindParam(':iddevis',$iddevis);
}

if(isset($RFO_01_01)){
    $stm->bindParam(':RFO_01_01',$RFO_01_01);
}

if(isset($RFO_01_03)){
    $stm->bindParam(':RFO_01_03',$RFO_01_03);
}

if(isset($RFO_01_05)){
    $stm->bindParam(':RFO_01_05',$RFO_01_05);
}

if(isset($RFO_01_07)){
    $stm->bindParam(':RFO_01_07',$RFO_01_07);
}

if(isset($RFO_01_09)){
    $stm->bindParam(':RFO_01_09',$RFO_01_09);
}

if(isset($RFO_01_11)){
    $stm->bindParam(':RFO_01_11',$RFO_01_11);
}

if(isset($RFO_01_13)){
    $stm->bindParam(':RFO_01_13',$RFO_01_13);
}

if(isset($RFO_01_15)){
    $stm->bindParam(':RFO_01_15',$RFO_01_15);
}

if(isset($RFO_01_16)){
    $stm->bindParam(':RFO_01_16',$RFO_01_16);
}

if(isset($RFO_01_17)){
    $stm->bindParam(':RFO_01_17',$RFO_01_17);
}

if(isset($RFO_01_18)){
    $stm->bindParam(':RFO_01_18',$RFO_01_18);
}

if(isset($RFO_01_19)){
    $stm->bindParam(':RFO_01_19',$RFO_01_19);
}

if(isset($RFO_01_20)){
    $stm->bindParam(':RFO_01_20',$RFO_01_20);
}

if(isset($RFO_01_21)){
    $stm->bindParam(':RFO_01_21',$RFO_01_21);
}

if(isset($RFO_01_23)){
    $stm->bindParam(':RFO_01_23',$RFO_01_23);
}

if($stm->execute()){
    $message [] = "Enregistrement fait avec succès";
} else {
    $message [] = $stm->errorInfo();
}