<?php
/**
 * file: inject_projects.php
 * User: rabii
 */

$list_plq_statment = $db->prepare("SELECT DISTINCT  Emprise FROM  abkp ");
$list_plq_statment->execute();
$projets = $list_plq_statment->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(array("projets" => $projets));