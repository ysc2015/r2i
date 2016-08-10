<?php
/**
 * file: get_equipe_by_id.php
 * User: rabii
 */

extract($_POST);

$equipe = EquipeSTT::first(array('conditions' => array("id_equipe_stt = ?", $idp)));

echo json_encode(array("equipe" => $equipe->to_array()));