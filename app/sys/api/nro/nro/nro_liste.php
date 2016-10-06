<?php
/**
 * file: nro_liste.php
 * User: rabii
 */

$table = array("nro as t1", "utilisateur as t2","profil_utilisateur as t3");
$columns = array(
    array( "db" => "t1.id_nro", "dt" => 'id_nro' ),
    array( "db" => "t1.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t2.id_utilisateur", "dt" => 'id_utilisateur' ),
    array( "db" => "t2.prenom_utilisateur", "dt" => 'prenom_utilisateur' ),
    array( "db" => "t2.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t2.email_utilisateur", "dt" => 'email_utilisateur' ),
    array( "db" => "t3.lib_profil_utilisateur", "dt" => 'lib_profil_utilisateur' )
);

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_nro",$columns,"t1.id_utilisateur = t2.id_utilisateur AND t2.id_profil_utilisateur = t3.id_profil_utilisateur"));