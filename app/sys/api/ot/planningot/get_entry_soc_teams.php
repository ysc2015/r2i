<?php
/**
 * file: get_entry_soc_teams.php
 * User: rabii
 */

$teams = array();

$message = array();

extract($_POST);

$ret= array();

$stm = $db->prepare("select * from equipe_stt");

$stm->execute();
$teams = $stm->fetchAll();

foreach($teams as $team)
{

}

echo json_encode($ret);