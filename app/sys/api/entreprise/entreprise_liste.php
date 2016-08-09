<?php
/**
 * file: entreprise_liste.php
 * User: rabii
 */

ini_set("display_errors","1");

include_once __DIR__."/../../inc/config.php";
include_once __DIR__."/../../inc/ssp.class.php";

$table = array("entreprises_stt as t1");
$columns = array(
    array( "db" => "t1.id_entreprises_stt", "dt" => 'id_entreprises_stt' ),
    array( "db" => "t1.nom", "dt" => 'nom' ),
    array( "db" => "t1.adresse_siege", "dt" => 'adresse_siege' ),
    array( "db" => "t1.adresse_livraison", "dt" => 'adresse_livraison' ),
    array( "db" => "t1.gerant_entreprise", "dt" => 'gerant_entreprise' ),
    array( "db" => "t1.contact_nom", "dt" => 'contact_nom' ),
    array( "db" => "t1.contact_prenom", "dt" => 'contact_prenom' ),
    array( "db" => "t1.contact_tel_mobile", "dt" => 'contact_tel_mobile' ),
    array( "db" => "t1.contact_tel_fixe", "dt" => 'contact_tel_fixe' ),
    array( "db" => "t1.contact_email", "dt" => 'contact_email' )
);

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_entreprises_stt",$columns,""));
?>