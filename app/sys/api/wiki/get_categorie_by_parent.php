<?php
/**
 * file: get_type_ot.php
 * User: rabii
 */
/*require_once '../../../sys/libs/vendor/autoload.php';
require_once '../../../sys/inc/config.php';
require_once '../../../sys/language/fr/default.php';
require_once "../../../sys/inc/ssp.class.php";
require_once "../../../sys/libs/vendor/EditableGrid/EditableGrid.php";*/

extract($_POST);

extract($_GET);

$categories = Categorie::all(
    array('conditions' => array("id_categorie_parent=?",$id))
    
);
echo '[';
$i=1;
foreach($categories as $categorie){
echo json_encode(array("id" => $categorie->id."","nom" => $categorie->nom,"description" => $categorie->description));
if($i++<count($categories)) echo ',';
}
echo ']';
?>
