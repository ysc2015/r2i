<?php
include_once(__DIR__."/src/CassetteExcelParser/Controller.php");
include_once(__DIR__."/src/CassetteExcelParser/Parser.php");
include_once(__DIR__."/src/CassetteExcelParser/Reader.php");
use \CassetteExcelParser\Controller;

extract($_POST);

if(isset($id)) {
    $stm = $db->prepare("SELECT * FROM ressource WHERE id_ressource=:id");
    $stm->bindParam(':id',$id);
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_OBJ);


    $controller = new Controller();
    $controller->get(__DIR__."/../../uploads/". $row->dossier . "/" .$row->nom_fichier_disque);
} else {
    echo json_encode(array());
}
