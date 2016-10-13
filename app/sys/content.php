<?php
/**
 * file: content.php
 * User: rabii
 */
include_once "inc/config.php";
include_once "language/fr/default.php";

extract($_GET);

$sousProjet = NULL;


switch ($page) {

    case "dashboard":
        $connectedProfil->dashboard();
        echo "<br><br>";
        break;
    case "projet":
        $connectedProfil->projet();
        echo "<br><br>";
        break;
    case "sousprojet":
        $sousProjet = SousProjet::find($idsousprojet);//TODO check if sp available or has been deleted / replace find/first condition to avoid AR Exception
        switch($connectedProfil->profil->profil->shortlib) {
            case "bei":
                if(in_array($connectedProfil->profil->id_utilisateur,explode("|",trim($sousProjet->users_in,"|")))) {
                    $connectedProfil->sousprojet();
                } else {
                    $connectedProfil->ressourceAccessDenied();
                }
                break;
            case "cdp":
                if($sousProjet->projet->id_chef_projet === $connectedProfil->profil->id_utilisateur ) {
                    $connectedProfil->sousprojet();
                } else {
                    $connectedProfil->ressourceAccessDenied();
                }
                break;
            case "vpi":
                $arr = array();
                $stm = $db->prepare("select id_nro from nro where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
                $stm->execute();
                $nros = $stm->fetchAll();
                foreach($nros as $nro) {
                    $arr[] = $nro['id_nro'];
                }
                if(in_array($sousProjet->projet->code_site_origine,$arr)) {
                    $connectedProfil->sousprojet();
                } else {
                    $connectedProfil->ressourceAccessDenied();
                }
                break;
            default:
                $connectedProfil->sousprojet();
                break;
        }
        echo "<br><br>";
        break;
    case "utilisateur":
        $connectedProfil->utilisateur();
        echo "<br><br>";
        break;
    case "ot":
        $connectedProfil->ot();
        echo "<br><br>";
        break;
    case "pointbloquant":
        $connectedProfil->pointbloquant();
        echo "<br><br>";
        break;
    case "entreprise":
        $connectedProfil->entreprise();
        echo "<br><br>";
        break;
    case "mailcreation":
        $connectedProfil->mail();
        echo "<br><br>";
        break;
    case "nro":
        $connectedProfil->nro();
        echo "<br><br>";
        break;
}

?>