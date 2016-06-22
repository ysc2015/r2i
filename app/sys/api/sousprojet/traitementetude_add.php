<?php
/**
 * file: traitementetude_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_plaque_traitement_etude (id_sous_projet,site,charge_etude) values (:id_sous_projet,:site,:charge_etude)");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($tsite) && !empty($tsite)){
    $stm->bindParam(':site',$tsite);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Site est obligatoire !";
}

if(isset($charge_etude) && !empty($charge_etude)){
    $stm->bindParam(':charge_etude',$charge_etude);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Chargé étude est obligatoire !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>