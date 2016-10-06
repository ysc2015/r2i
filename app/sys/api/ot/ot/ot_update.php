<?php
/**
 * file: ot_update.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update ordre_de_travail set id_type_ordre_travail=:id_type_ordre_travail,commentaire=:commentaire where id_ordre_de_travail=:id_ordre_de_travail");

if(isset($idot) && !empty($idot)){
    $stm->bindParam(':id_ordre_de_travail',$idot);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence OT invalide !";
}

if(isset($type_ot) && !empty($type_ot)){
    $stm->bindParam(':id_type_ordre_travail',$type_ot);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs type ot est obligatoire !";
}

if(isset($commentaire)){
    $stm->bindParam(':commentaire',$commentaire);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Modification faite avec succès";
    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>