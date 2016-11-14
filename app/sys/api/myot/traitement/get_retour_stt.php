<?php
/**
 * file: get_retour_stt.php
 * User: rabii
 */

extract($_POST);

$sousProjet = NULL;

$err = 0;
$message = array();

$retour = "";

if(isset($idsp) && !empty($idsp)){
    $sousProjet = SousProjet::find($idsp);
}

$tentree = "";

if($sousProjet !== NULL) {
    switch($idtot) {
        case "1" :
            $tentree = "transportaiguillage";
            break;
        case "2" :
            $tentree = "transporttirage";
            break;
        case "3" :
            $tentree = "transportraccordement";
            break;
        case "4" :
            $tentree = "transporttirage";
            break;
        case "5" :
            $tentree = "distributionaiguillage";
            break;
        case "6" :
            $tentree = "distributiontirage";
            break;
        case "7" :
            $tentree = "distributionraccordement";
            break;
        case "8" :
            $tentree = "distributiontirage";
            break;
        default :
            $err++;
            $message[] = "cet OT n'est pas natif ou erreur traitement !";
            break;
    }
} else {
    $err++;
    $message[] = "Erreur reférence sous projet";
}

if($err == 0) {
     $retour = $sousProjet->{$tentree}->retour_presta;
}

echo json_encode(array("error" => $err, "retour" => $retour));

