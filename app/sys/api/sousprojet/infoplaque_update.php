<?php
/**
 * file: infoplaque_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update sous_projet_plaque set phase=:phase,type=:type where id_sous_projet=:id_sous_projet");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($phase) && !empty($phase)){
    $stm->bindParam(':phase',$phase);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs phase est obligatoire !";
}

if(isset($type) && !empty($type)){
    $stm->bindParam(':type',$type);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs type est obligatoire !";
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