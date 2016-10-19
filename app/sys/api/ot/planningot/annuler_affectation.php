<?php
/**
 * file: annuler_affectation.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$ot = OrdreDeTravail::first(
    array('conditions' =>
        array("id_ordre_de_travail = ?", $idot)
    )
);

if($ot !== NULL) {
    $stm = $db->prepare("update ordre_de_travail set id_entreprise=NULL,id_equipe_stt=NULL,date_debut=NULL,date_fin=NULL where id_ordre_de_travail=:id_ordre_de_travail");

    if(isset($idot) && !empty($idot)){
        $stm->bindParam(':id_ordre_de_travail',$idot);
        $insert = true;
    } else {
        $err++;
        $message[] = "Référence OT invalide !";
    }

} else {
    $err++;
    $message[] = "OT non défini ou a été supprimé !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Affectation annulée avec succès";
    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));