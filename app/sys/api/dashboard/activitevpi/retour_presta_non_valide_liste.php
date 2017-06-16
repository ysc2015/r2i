<?php
/**
 * Created by PhpStorm.
 * User: fadil
 * Date: 16/06/17
 * Time: 10:41 م
 */
extract($_POST);



$table = array("retour_presta_non_valide as t1");
$columns = array(
    array( "db" => "t1.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t1.zone", "dt" => 'zone' ),
    array( "db" => "t1.idsp", "dt" => 'idsp' ),
    array( "db" => "t1.etape", "dt" => 'etape' ),
    array( "db" => "t1.type", "dt" => 'type' ),
    array( "db" => "t1.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t1.prenom_utilisateur", "dt" => 'prenom_utilisateur' )
);


$condition = "";
$left = "";


echo json_encode(@SSP::simpleJoin($_POST,$db,$table,"idsp",$columns,$condition,$left));

?>