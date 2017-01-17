<?php
/**
 * file: free_users_liste.php
 * User: rabii
 */

$table = array("utilisateur as t1","profil_utilisateur as t2");
$columns = array(
    array( "db" => "t1.id_utilisateur", "dt" => 'id_utilisateur' ),
    array( "db" => "t1.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t1.prenom_utilisateur", "dt" => 'prenom_utilisateur' ),
    array( "db" => "t1.telephone_utilisateur", "dt" => 'telephone_utilisateur' ),
    array( "db" => "t1.email_utilisateur", "dt" => 'email_utilisateur' ),
    array( "db" => "t1.id_profil_utilisateur", "dt" => 'id_profil_utilisateur' ),
    array( "db" => "t1.pass_utilisateur", "dt" => 'pass_utilisateur' ),
    array( "db" => "t2.lib_profil_utilisateur", "dt" => 'lib_profil_utilisateur' ),
    array( "db" => "t2.shortlib", "dt" => 'shortlib' )
);

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_utilisateur",$columns,"t1.id_profil_utilisateur = t2.id_profil_utilisateur AND t2.id_profil_utilisateur!=9"));
?>