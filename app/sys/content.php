<?php
/**
 * file: content.php
 * User: rabii
 */
ini_set("display_errors", "1");
include_once "inc/config.php";
include_once "language/fr/default.php";


switch ($page) {

    case "dashboard":
        include_once "dashboard.php";
        break;

    case "projet":
        $connectedProfil->projet();
        echo "<br><br>";//TODO style row with bottom border color -> footer
        break;
    case "sousprojet":
        $connectedProfil->sousprojet();
        break;
    case "user":
        $connectedProfil->utilisateur();
        echo "<br><br>";//TODO style row with bottom border color -> footer
        break;
}

?>
