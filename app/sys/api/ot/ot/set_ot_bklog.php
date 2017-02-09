<?php
/**
 * file: set_ot_bklog.php
 * User: rabii
 */

extract($_POST);

$err=0;
$message = array();
$stm = NULL;

if(isset($bklog) && isset($idot) && !empty($idot)) {
    $bklog = $bklog==0?1:0;
    $stm = $db->prepare("update ordre_de_travail set backlog = $bklog where id_ordre_de_travail=$idot");
} else {
    $err++;
    $message[] = "Paramétres de MAJ statut OT incorrects !";
}

if($err==0) {
    if($stm->execute()) {
        $message[] = "MAJ réussite !";
    } else {
        $err++;
        $message[] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message ));