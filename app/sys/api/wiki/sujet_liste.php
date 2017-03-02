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

$table = array("wiki_sujet","wiki_categorie");
$columns = array(
    array( "db" => "wiki_sujet.id", "dt" => 'id' ),
    array( "db" => "wiki_sujet.titre", "dt" => 'titre' ),
    array( "db" => "wiki_sujet.contenu", "dt" => 'contenu' ),
    array( "db" => "wiki_categorie.nom", "dt" => 'nom' ),
    array( "db" => "wiki_sujet.date_creation", "dt" => 'date_creation' )
);

$condition = "wiki_categorie.id=wiki_sujet.id_categorie";
if(isset($id_cat) && !empty($id_cat) && $id_cat!='0')
	$condition .= " AND wiki_sujet.id_categorie=".$id_cat;

/*$menu='';
if(isset($menu_categorie) && !empty($menu_categorie))
	$menu = $menu_categorie;*/
echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id",$columns,$condition));
?>
