<?php
/**
 * file: phase_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_plaque_phase (id_sous_projet,instigateur,vague,date_lancement) values (:id_sous_projet,:instigateur,:vague,:date_lancement)");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($instigateur) && !empty($instigateur)){
    $stm->bindParam(':instigateur',$instigateur);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Instigateur est obligatoire !";
}

if(isset($vague) && !empty($vague)){
    $stm->bindParam(':vague',$vague);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Vague est obligatoire !";
}

if(isset($date_lancement) && !empty($date_lancement)){
    $stm->bindParam(':date_lancement',$date_lancement);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date lancement est obligatoire !";
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