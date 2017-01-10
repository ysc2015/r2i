<?php
/**
 * file: update_etat_retour.php
 * User: rabii
 */

extract($_POST);

$sousProjet = NULL;

$err = 0;
$message = array();

if(isset($idsp) && !empty($idsp)){
    $sousProjet = SousProjet::find($idsp);
}

$tentree = array();

if($sousProjet !== NULL) {
    switch($idtot) {
        case "1" :
            $tentree[] = "transportaiguillage";
            break;
        case "2" :
            $tentree[] = "transporttirage";
            break;
        case "3" :
            $tentree[] = "transportraccordement";
            break;
        case "4" :
            $tentree[] = "transporttirage";
            $tentree[] = "transportraccordement";
            break;
        case "5" :
            $tentree[] = "distributionaiguillage";
            break;
        case "6" :
            $tentree[] = "distributiontirage";
            break;
        case "7" :
            $tentree[] = "distributionraccordement";
            break;
        case "8" :
            $tentree[] = "distributiontirage";
            $tentree[] = "distributionraccordement";
            break;
        case "9" :
            $tentree[] = "transportrecette";
            break;
        case "10" :
            $tentree[] = "distributionrecette";
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
    foreach($tentree as $key => $value) {
        if($sousProjet->{$value} !== NULL) {
            if($idtot == 9 || $idtot == 10)
                $sousProjet->{$value}->etat_recette = $val;//$val posted
            else
                $sousProjet->{$value}->etat_retour = $val;

            $sousProjet->{$value}->save();
        }
    }

    $message[] = "MAJ Réussite !";
}

echo json_encode(array("error" => $err, "message" => $message, "val" => $val));