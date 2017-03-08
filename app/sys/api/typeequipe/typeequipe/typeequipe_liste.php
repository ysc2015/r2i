<?php
/**
 * file: typeequipe_liste.php
 * User: rabii
 */

$table = array("equipe_types as t1");
$columns = array(
    array( "db" => "t1.id_equipe_types", "dt" => 'id_equipe_types' ),
    array( "db" => "t1.lib_type", "dt" => 'lib_type' ),
    array( "db" => "t1.a2t", "dt" => 'a2t' )
);

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_equipe_types",$columns,"",""));
?>