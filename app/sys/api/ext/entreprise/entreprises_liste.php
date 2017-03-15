<?php
/**
 * file: entreprises_liste.php
 * User: rabii
 */

/*$stm = $db->prepare("SELECT es.id_entreprise,es.nom,es.code_entreprise,es.adresse_siege,es.adresse_livraison,es.gerant_entreprise,es.contact_nom,es.contact_prenom,es.contact_tel_mobile,es.contact_tel_fixe,es.contact_email FROM entreprises_stt es
WHERE es.id_entreprise IN (SELECT DISTINCT id_entreprise FROM equipe_stt et WHERE et.id_equipe_types IN (SELECT id_equipe_types FROM equipe_types WHERE a2t = 1 AND id_equipe_types IS NOT NULL) AND et.id_entreprise IS NOT NULL)");


$stm->execute();

echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));*/

echo "fdfd";


$table = array("entreprises_stt as t1");
$columns = array(
    array( "db" => "t1.id_entreprise", "dt" => 'id_entreprise' ),
    array( "db" => "t1.nom", "dt" => 'nom' ),
    array( "db" => "t1.code_entreprise", "dt" => 'code_entreprise' ),
    array( "db" => "t1.adresse_siege", "dt" => 'adresse_siege' ),
    array( "db" => "t1.adresse_livraison", "dt" => 'adresse_livraison' ),
    array( "db" => "t1.gerant_entreprise", "dt" => 'gerant_entreprise' ),
    array( "db" => "t1.contact_nom", "dt" => 'contact_nom' ),
    array( "db" => "t1.contact_prenom", "dt" => 'contact_prenom' ),
    array( "db" => "t1.contact_tel_mobile", "dt" => 'contact_tel_mobile' ),
    array( "db" => "t1.contact_tel_fixe", "dt" => 'contact_tel_fixe' ),
    array( "db" => "t1.contact_email", "dt" => 'contact_email' ),
);

$condition = "t1.id_entreprise IN (SELECT DISTINCT id_entreprise FROM equipe_stt et WHERE et.id_equipe_types IN (SELECT id_equipe_types FROM equipe_types WHERE a2t = 1 AND id_equipe_types IS NOT NULL) AND t1.id_entreprise IS NOT NULL)";

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_entreprise",$columns,$condition,""));