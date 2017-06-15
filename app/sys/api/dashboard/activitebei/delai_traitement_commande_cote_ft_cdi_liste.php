<?php
/**
 * Created by PhpStorm.
 * User: fadil
 * Date: 23/05/17
 * Time: 09:41 م
 */
extract($_POST);


$table = array("delai_traitement_commande_cote_ft as t1");
$columns = array(
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.zone", "dt" => 'zone' ),
    array( "db" => "t1.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t1.id_nro", "dt" => 'id_nro' ),
    array( "db" => "t1.date_diference", "dt" => 'date_diference' ),
    array( "db" => "t1.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t1.prenom_utilisateur", "dt" => 'prenom_utilisateur' )
);
$condition  = " t1.type_etape = 'CDI'";


$left = "  ";


echo json_encode(@SSP::simpleJoin($_POST,$db,$table,"id_sous_projet",$columns,$condition,$left));
?>