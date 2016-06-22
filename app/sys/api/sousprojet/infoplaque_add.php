<?php
/**
 * file: infoplaque_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_plaque (id_sous_projet,phase,type) values (:id_sous_projet,:phase,:type)");

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
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>