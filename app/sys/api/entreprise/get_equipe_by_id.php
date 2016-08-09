<?php
/**
 * file: get_equipe_by_id.php
 * User: rabii
 */

extract($_POST);

$stmt = $db->query("SELECT * FROM equipe_stt WHERE id_equipe_stt=:id_equipe_stt");
$stmt->bindParam(':id_equipe_stt',$idp);
$rows =$stmt->fetchAll();

echo json_encode(array("equipe" => $rows));