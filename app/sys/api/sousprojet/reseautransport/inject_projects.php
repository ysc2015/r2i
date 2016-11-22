<?php
/**
 * file: inject_projects.php
 * User: rabii
 */

$str = "";

$list_plq_statment = $db->prepare("SELECT DISTINCT  Emprise FROM  abkp WHERE 1");
$list_plq_statment->execute();
$plaques = $list_plq_statment->fetchAll(PDO::FETCH_OBJ);

foreach($plaques as $plaque) {
    $str .= $plaque->Emprise;
}

echo $str;

//echo json_encode(array("projets" => $projets));