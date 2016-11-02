<?php
/**
 * file: insert_tache_osa.php
 * User: rabii
 */

ini_set("display_errors",'1');

//set_time_limit(60);

extract($_POST);

$insert = false;
$err = 0;
$insertedId = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_taches_osa (id_osa,id_etape,type_etape) values (:id_osa,:id_etape,:type_etape)");

if(isset($idosa) && !empty($idosa)){
    $stm->bindParam(':id_osa',$idosa);
    $insert = true;
} else {
    $err++;
    $message[] = "Identifiant osa invalid !";
}

if(isset($idetape) && !empty($idetape)){
    $stm->bindParam(':id_etape',$idetape);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs ref etape est obligatoire !";
}

if(isset($typeetape) && !empty($typeetape)){
    $stm->bindParam(':type_etape',$typeetape);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs type étape est obligatoire !";
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