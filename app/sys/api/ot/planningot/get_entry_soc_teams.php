<?php
/**
 * file: get_entry_soc_teams.php
 * User: rabii
 */

$message = array();

extract($_POST);

$stm = $db->prepare("select * from equipe_stt where id_entreprise=$ide");

$stm->execute();

$teams = array();

// Fetch results
while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

    $t = array();
    $t['id'] = $row['id_equipe_stt'];
    $t['nom'] = $row['prenom']." ".$row['nom'];

    array_push($teams, $t);

}

echo json_encode($teams);