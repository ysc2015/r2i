<?php
/**
 * file: projet_liste.php
 * User: rabii
 */

ini_set("display_errors","1");

include_once __DIR__."/../inc/config.php";
include_once __DIR__."/../inc/ssp.class.php";

$table = array("projet as t1");
$columns = array(
    array( "db" => "t1.id_projet", "dt" => 'id_projet' ),
    array( "db" => "t1.ville", "dt" => 'ville' ),
    array( "db" => "t1.trigramme_dept", "dt" => 'trigramme_dept' ),
    array( "db" => "t1.code_site_origine", "dt" => 'code_site_origine' ),
    array( "db" => "t1.taille", "dt" => 'taille' ),
    array( "db" => "t1.etat_site_origine", "dt" => 'etat_site_origine' ),
    array( "db" => "t1.date_mad_site_origine", "dt" => 'date_mad_site_origine' ),
    array( "db" => "t1.date_creation", "dt" => 'date_creation' ),
    array( "db" => "t1.date_attribution", "dt" => 'date_attribution' )
);

echo json_encode(utf8_encode_all(SSP::simpleJoin($_GET,$db,$table,"id_projet",$columns,"")));
?>