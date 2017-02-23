<?php
/**
 * file: ot_add.php
 * User: rabii
 */

require_once '../../../sys/libs/vendor/autoload.php';
require_once '../../../sys/inc/config.php';
require_once '../../../sys/language/fr/default.php';
require_once "../../../sys/inc/ssp.class.php";
require_once "../../../sys/libs/vendor/EditableGrid/EditableGrid.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("insert into wiki_categorie (nom,description,id_categorie_parent,date_creation,date_dernier_mod) values (:nom,:description,:id_categorie_parent,'".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."')");

if(isset($nom) && !empty($nom)){
    $stm->bindParam(':nom',$nom);
    $insert = true;
} else {
    $err++;
    $message[] = "Nom de la Catégorie invalide !";
}

if(isset($description) && !empty($description)){
    $stm->bindParam(':description',$description);
    $insert = true;
} else {
    $err++;
    $message[] = "Description de la Catégorie invalide !";
}
if(isset($categorie)){
	if(!empty($categorie) && $categorie!='0')
    	$stm->bindParam(':id_categorie_parent',$categorie);
    $insert = true;
} else {
    $err++;
    $message[] = "Catégorie parente est invalide !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
        $cate = Categorie::last();

                      }

                                else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}



echo json_encode(array("error" => $err , "message" => $message, "id" => $cate->id ));
?>
