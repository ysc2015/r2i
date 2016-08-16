<?php
/**
 * file: get_survey_files.php
 * User: rabii
 */

set_time_limit(60);

$files = array();

$message = array();

$err = 0;

extract($_POST);

$stm = $db->prepare("select * from ressource where type_objet=:type_objet and id_objet=:id_objet");

if(isset($idsp) && !empty($idsp)){
    $stm->execute(array(':id_objet' => $idsp,':type_objet' => $type_objet));
    $files = $stm->fetchAll();
} else {
    $err++;
    $message[] = "Identifiant projet invalid !";
}

echo json_encode(array("error" => $err , "message" => $message, "files" => $files));