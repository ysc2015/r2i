<?php
/**
 * file: nro_liste.php
 * User: rabii
 */

$table = array("utilisateur as u");
$columns = array(
    array( "db" => "n.id_nro", "dt" => 'id_nro' ),
    array( "db" => "n.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "u.id_utilisateur", "dt" => 'id_utilisateur' ),
    array( "db" => "u.prenom_utilisateur", "dt" => 'prenom_utilisateur' ),
    array( "db" => "u.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "u.email_utilisateur", "dt" => 'email_utilisateur' ),
    array( "db" => "pu.lib_profil_utilisateur", "dt" => 'lib_profil_utilisateur' )
);

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_nro",$columns,"","right join nro as n on u.id_utilisateur = n.id_utilisateur2 left join profil_utilisateur as pu on u.id_profil_utilisateur = pu.id_profil_utilisateur"));