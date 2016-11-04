<?php
/**
 * file: check_ot.php
 * User: rabii
 */

extract($_POST);

$sousProjet = NULL;

if(isset($ids) && !empty($ids)){
    $sousProjet = SousProjet::find($ids);
}

$err = 0;
$message = array();
$id = 0;

if($sousProjet !== NULL) {
    if(isset($tentree) && !empty($tentree)) {
        if($sousProjet->{$tentree} !== NULL) {
            $message[] = "ok";
        } else {
            $err++;
            $message[] = "Etape ".$lang[$tentree]." non enregistrée, veuillez l'enregistrer svp!";
        }
    } else {
        $err++;
        $message[] = "Erreur reférence entrée";
    }
} else {
    $err++;
    $message[] = "Erreur reférence sous projet";
}

echo json_encode(array("error" => $err , "message" => $message));