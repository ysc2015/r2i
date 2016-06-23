<?php
/**
 * file: chambre_liste.php
 * User: rabii
 */

ini_set("display_errors","1");

include_once __DIR__."/../../inc/config.php";
include_once __DIR__."/../../inc/ssp.class.php";

extract($_GET);

$table = array("chambre as t1");
$columns = array(
    array( "db" => "t1.id_chambre", "dt" => 'id_chambre' ),
    array( "db" => "t1.ref_chambre", "dt" => 'ref_chambre' ),
    array( "db" => "t1.villet", "dt" => 'villet' ),
    array( "db" => "t1.sous_projet", "dt" => 'sous_projet' ),
    array( "db" => "t1.ref_note", "dt" => 'ref_note' ),
    array( "db" => "t1.code_ch1", "dt" => 'code_ch1' ),
    array( "db" => "t1.code_ch2", "dt" => 'code_ch2' ),
    array( "db" => "t1.gps", "dt" => 'gps' )
);

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_chambre",$columns,"id_ordre_de_travail = $idot"));
?>