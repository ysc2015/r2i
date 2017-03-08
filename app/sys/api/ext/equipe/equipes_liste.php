<?php
/**
 * file: equipes_liste.php
 * User: rabii
 */


extract($_POST);
extract($_GET);

$stm = $db->prepare("SELECT et.id_equipe_stt,et.id_entreprise,et.id_equipe_types,et.imei,et.nom,et.prenom,et.tel,et.mail FROM equipe_stt et WHERE et.id_entreprise = $ide AND et.id_equipe_types IN (SELECT id_equipe_types FROM equipe_types WHERE a2t = 1 AND id_equipe_types IS NOT NULL)");

$stm->execute();

echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));