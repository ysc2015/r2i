<?php
/**
 * file: sujet_liste.php
 * User: rabii
 */
/*require_once '../../../sys/libs/vendor/autoload.php';
require_once '../../../sys/inc/config.php';
require_once '../../../sys/language/fr/default.php';
require_once "../../../sys/inc/ssp.class.php";
require_once "../../../sys/libs/vendor/EditableGrid/EditableGrid.php";*/

extract($_GET);

$table = "wiki_categorie";
$columns = array(
    array( "db" => "id", "dt" => 'id' ),
    array( "db" => "nom", "dt" => 'nom' )
);
$condition = "";

echo json_encode(SSP::simple($_GET,$db,$table,"id",$columns));
?>
