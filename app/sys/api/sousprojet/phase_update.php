<?php
/**
 * file: phase_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update sous_projet_plaque_phase set instigateur=:instigateur,vague=:vague,date_lancement=:date_lancement where id_sous_projet=:id_sous_projet");

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
        $message [] = "Modification faite avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>