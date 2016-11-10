<?php
/**
 * file: typeot_liste.php
 * User: rabii
 */

$table = array("select_type_ordre_travail as t1");
$columns = array(
    array( "db" => "t1.id_type_ordre_travail", "dt" => 'id_type_ordre_travail' ),
    array( "db" => "t1.lib_type_ordre_travail", "dt" => 'lib_type_ordre_travail' ),
    array( "db" => "t1.type_entree", "dt" => 'type_entree' ),
    array( "db" => "t1.system", "dt" => 'system' )
);

$condition = "t1.system != 1 or t1.system is NULL";

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_type_ordre_travail",$columns,$condition,""));
?>