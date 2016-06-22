<?php
/**
 * file: mailcreation_liste.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";
include_once __DIR__."/../../inc/ssp.class.php";

$table = array("projet_mail_creation as t1");
$columns = array(
    array( "db" => "t1.id_projet_mail_creation", "dt" => 'id_projet_mail_creation' ),
    array( "db" => "t1.mail", "dt" => 'mail' )
);

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_projet_mail_creation",$columns,""));
