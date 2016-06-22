<?php
/**
 * file: stt_liste.php
 * User: rabii
 */

ini_set("display_errors","1");

include_once __DIR__."/../../inc/config.php";
include_once __DIR__."/../../inc/ssp.class.php";

$table = array("utilisateur as t1","profil_utilisateur as t2","select_entreprise as t3");
$columns = array(
    array( "db" => "t1.id_utilisateur", "dt" => 'id_utilisateur' ),
    array( "db" => "t1.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t1.prenom_utilisateur", "dt" => 'prenom_utilisateur' ),
    array( "db" => "t1.email_utilisateur", "dt" => 'email_utilisateur' ),
    array( "db" => "t1.id_profil_utilisateur", "dt" => 'id_profil_utilisateur' ),
    array( "db" => "t1.pass_utilisateur", "dt" => 'pass_utilisateur' ),
    array( "db" => "t1.id_entreprise", "dt" => 'id_entreprise' ),
    array( "db" => "t1.nom_entreprise", "dt" => 'nom_entreprise' ),
    array( "db" => "t3.lib_entreprise", "dt" => 'lib_entreprise' ),
    array( "db" => "t2.lib_profil_utilisateur", "dt" => 'lib_profil_utilisateur' )
);

echo json_encode(utf8_encode_all(SSP::simpleJoin($_GET,$db,$table,"id_utilisateur",$columns,"t1.id_profil_utilisateur = t2.id_profil_utilisateur AND t1.id_entreprise = t3.id_entreprise AND t2.id_profil_utilisateur=2")));
?>