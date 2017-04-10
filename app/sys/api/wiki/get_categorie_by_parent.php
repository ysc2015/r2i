<?php
/**
 * file: get_categorie_by_parent.php
 * User: rabii
 */

extract($_POST);

extract($_GET);

$categories = WikiCategorie::all(
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
