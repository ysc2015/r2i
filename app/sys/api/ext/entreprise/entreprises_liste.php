<?php
/**
 * file: entreprises_liste.php
 * User: rabii
 */

$stm = $db->prepare("SELECT es.id_entreprise,es.nom,es.code_entreprise,es.adresse_siege,es.adresse_livraison,es.gerant_entreprise,es.contact_nom,es.contact_prenom,es.contact_tel_mobile,es.contact_tel_fixe,es.contact_email FROM entreprises_stt es
WHERE es.id_entreprise IN (SELECT DISTINCT id_entreprise FROM equipe_stt et WHERE et.id_equipe_types IN (SELECT id_equipe_types FROM equipe_types WHERE a2t = 1 AND id_equipe_types IS NOT NULL) AND et.id_entreprise IS NOT NULL)");


$stm->execute();

echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));