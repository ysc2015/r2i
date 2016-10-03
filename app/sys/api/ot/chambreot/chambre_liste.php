<?php
/**
 * file: chambre_liste.php
 * User: rabii
 */

ini_set("display_errors","1");

extract($_POST);

$table = array("chambre as t1","ressource as t2");
$columns = array(
    array( "db" => "t1.id_chambre", "dt" => 'id_chambre' ),
    array( "db" => "t1.id_ressource", "dt" => 'id_ressource' ),
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.type_entree", "dt" => 'type_entree' ),
    array( "db" => "t1.ref_chambre", "dt" => 'ref_chambre' ),
    array( "db" => "t1.villet", "dt" => 'villet' ),
    array( "db" => "t1.sous_projet", "dt" => 'sous_projet' ),
    array( "db" => "t1.ref_note", "dt" => 'ref_note' ),
    array( "db" => "t1.code_ch1", "dt" => 'code_ch1' ),
    array( "db" => "t1.code_ch2", "dt" => 'code_ch2' ),
    array( "db" => "t1.gps", "dt" => 'gps' )
);

$condition = "t1.id_ressource=t2.id_ressource";

if(isset($idres) && !empty($idres)) {
    $condition .= " AND t1.id_ressource=$idres";
}

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_chambre",$columns,$condition));
?>