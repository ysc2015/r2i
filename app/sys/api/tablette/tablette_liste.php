<?php
/**
 * file: tablette_liste.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";
include_once __DIR__."/../../inc/ssp.class.php";

$table = array("tablette as t1","select_entreprise as t2");
$columns = array(
    array( "db" => "t1.id_tablette", "dt" => 'id_tablette' ),
    array( "db" => "t1.imei", "dt" => 'imei' ),
    array( "db" => "t1.id_entreprise", "dt" => 'id_entreprise' ),
    array( "db" => "t2.lib_entreprise", "dt" => 'lib_entreprise' )
);

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_tablette",$columns,"t1.id_entreprise = t2.id_entreprise"));
