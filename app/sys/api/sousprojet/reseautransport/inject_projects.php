<?php
/**
 * file: inject_projects.php
 * User: rabii
 */

$list_plq_statment = $db->prepare("SELECT DISTINCT  Emprise FROM  abkp ");
$projets = $stm->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($projets);