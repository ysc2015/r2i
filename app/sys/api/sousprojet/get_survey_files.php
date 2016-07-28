<?php
/**
 * file: get_survey_files.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

set_time_limit(60);

$files = array();

$message = array();

$err = 0;

extract($_POST);

$stm = $db->prepare("select * from ressource where type_objet=:type_objet and id_objet=:id_objet");

if(isset($idsp) && !empty($idsp)){
    $sousprojet_suradresse = SousProjetPlaqueSurveyAdresse::first(array('conditions' => array("id_sous_projet = ?", $idsp)));
    if($sousprojet_suradresse !== NULL) {
        $stm->execute(array(':id_objet' => $sousprojet_suradresse->id_sous_projet_plaque_survey_adresse,':type_objet' => $type_objet));
        $files = $stm->fetchAll();
    } else {
        $err++;
        $message[] = "référence survey adresse introuvable !";
    }
} else {
    $err++;
    $message[] = "Identifiant projet invalid !";
}

echo json_encode(array("error" => $err , "message" => $message, "files" => $files));