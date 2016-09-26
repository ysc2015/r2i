<?php
/**
 * file: get_project_files.php
 * User: rabii
 */

set_time_limit(60);

$files = array();

$message = array();

$err = 0;

extract($_POST);

$stm = $db->prepare("select * from ressource where type_objet='projet' and id_objet=:id_objet");

if(isset($idp) && !empty($idp)){
    $stm->execute(array(':id_objet' => $idp));
    $files = $stm->fetchAll();
} else {
    $err++;
    $message[] = "Identifiant projet invalid !";
}

echo json_encode(array("error" => $err , "message" => $message, "files" => $files));

