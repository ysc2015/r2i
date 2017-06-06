<?php
/**
 * Created by PhpStorm.
 * User: fadil
 * Date: 10/05/17
 * Time: 04:41 م
 */
extract($_POST);



$table = array("donnee_reseau_non_rempli as t1");
$columns = array(
    array( "db" => "t1.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t1.zone", "dt" => 'zone' ),
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.type_manquant", "dt" => 'type_manquant' ),
    array( "db" => "t1.type_etape", "dt" => 'type_etape' ),
    array( "db" => "t1.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t1.prenom_utilisateur", "dt" => 'prenom_utilisateur' )
);


$condition = "";
$left = "";


echo json_encode(@SSP::simpleJoin($_POST,$db,$table,"idsp",$columns,$condition,$left));
?>