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
    array( "db" => "t1.id_nro", "dt" => 'id_nro' ),
    array( "db" => "t1.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t1.zone", "dt" => 'zone' ),
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.type_manquant", "dt" => 'type_manquant' ),
    array( "db" => "t1.type_etape", "dt" => 'type_etape' ),
    array( "db" => "t7.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t7.prenom_utilisateur", "dt" => 'prenom_utilisateur' )
);


$condition = "";

$left = " LEFT JOIN `nro_utilisateur` as t6 on t6.id_nro =  t1.id_nro ";
$left .= " LEFT JOIN utilisateur as t7 on t7.id_utilisateur = t6.id_utilisateur ";
$left .= " LEFT JOIN profil_utilisateur as t8 on  t8.id_profil_utilisateur=t7.id_profil_utilisateur and t8.id_profil_utilisateur=4 ";

echo json_encode(@SSP::simpleJoin($_POST,$db,$table,"id_sous_projet",$columns,$condition,$left));
?>