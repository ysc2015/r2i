<?php
/**
 * file: equipes_liste.php
 * User: rabii
 */


extract($_POST);
extract($_GET);

/*$stm = $db->prepare("SELECT et.id_equipe_stt,et.id_entreprise,et.id_equipe_types,et.imei,et.nom,et.prenom,et.tel,et.mail FROM equipe_stt et WHERE et.id_entreprise = $ide AND et.id_equipe_types IN (SELECT id_equipe_types FROM equipe_types WHERE a2t = 1 AND id_equipe_types IS NOT NULL)");

$stm->execute();

echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));*/


$table = array("equipe_stt as t1");
$columns = array(
    array( "db" => "t1.id_equipe_stt", "dt" => 'id_entreprise' ),
    array( "db" => "t1.id_entreprise", "dt" => 'id_entreprise' ),
    array( "db" => "t1.id_equipe_types", "dt" => 'id_equipe_types' ),
    array( "db" => "t1.imei", "dt" => 'imei' ),
    array( "db" => "t1.nom", "dt" => 'nom' ),
    array( "db" => "t1.prenom", "dt" => 'prenom' ),
    array( "db" => "t1.tel", "dt" => 'tel' ),
    array( "db" => "t1.mail", "dt" => 'mail' )
);

$condition = "t1.id_entreprise = $ide AND t1.id_equipe_types IN (SELECT id_equipe_types FROM equipe_types WHERE a2t = 1 AND id_equipe_types IS NOT NULL)";

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_equipe_stt",$columns,$condition,""));