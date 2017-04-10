<?php
/**
 * file: get_parent_categorie.php
 * User: rabii
 */

extract($_POST);

extract($_GET);

$categories = WikiCategorie::all(
    array('conditions' => "id_categorie_parent IS NULL")
    
);
echo '[';
$i=1;
foreach($categories as $categorie){
echo json_encode(array("id" => $categorie->id."","nom" => $categorie->nom,"description" => $categorie->description));
if($i++<count($categories)) echo ',';
}
echo ']';
?>
