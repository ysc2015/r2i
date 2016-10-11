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
        $sousProjet = SousProjet::find($idsousprojet);
        //TODO here restriction
        $connectedProfil->sousprojet();
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