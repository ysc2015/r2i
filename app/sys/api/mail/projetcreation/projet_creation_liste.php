<?php
/**
 * file: projet_creation_liste.php
 * User: rabii
 */

$table = array("projet_mail_creation as t1", "utilisateur as t2","profil_utilisateur as t3","type_notification as t4");
$columns = array(
    array( "db" => "t1.id_projet_mail_creation", "dt" => 'id_projet_mail_creation' ),
    array( "db" => "t2.id_utilisateur", "dt" => 'id_utilisateur' ),
    array( "db" => "t2.prenom_utilisateur", "dt" => 'prenom_utilisateur' ),
    array( "db" => "t2.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t2.email_utilisateur", "dt" => 'email_utilisateur' ),
    array( "db" => "t3.lib_profil_utilisateur", "dt" => 'lib_profil_utilisateur' ),
    array( "db" => "t4.id_type_notification", "dt" => 'id_type_notification' ),
    array( "db" => "t4.lib_type_notification", "dt" => 'lib_type_notification' )
);

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_projet_mail_creation",$columns,"t1.id_type_notification = t4.id_type_notification AND t1.id_utilisateur = t2.id_utilisateur AND t2.id_profil_utilisateur = t3.id_profil_utilisateur AND t3.id_profil_utilisateur!=9"));