<?php
/**
 * file: sousprojet_liste.php
 * User: rabii
 */

ini_set("display_errors","1");

extract($_POST);

$table = array("sous_projet as t1","projet as t2");
$columns = array(
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.id_projet", "dt" => 'id_projet' ),
    array( "db" => "t2.projet_nom", "dt" => 'projet_nom' ),
    array( "db" => "t1.dep", "dt" => 'dep' ),
    array( "db" => "t1.ville", "dt" => 'ville' ),
    array( "db" => "t1.plaque", "dt" => 'plaque' ),
    array( "db" => "t1.zone", "dt" => 'zone' )
);

$condition = "t1.id_projet=t2.id_projet";

if($idp > 0) {
    $condition .= " AND t1.id_projet=$idp";
}

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_sous_projet",$columns,$condition));
?>