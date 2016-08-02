<?php
/**
 * file: get_entries_by_id.php
 * User: rabii
 */

extract($_POST);

$taiguillage = SousProjetTransportAiguillage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
$id_ta = ($taiguillage!==NULL ? $taiguillage->id_sous_projet_transport_aiguillage : 0);

$ttirage = SousProjetTransportTirage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
$id_tt = ($ttirage!==NULL ? $ttirage->id_sous_projet_transport_tirage : 0);

$traccord = SousProjetTransportRaccordement::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
$id_tr = ($traccord!==NULL ? $traccord->id_sous_projet_transport_raccordements : 0);

$daiguillage = SousProjetDistributionAiguillage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
$id_da = ($daiguillage!==NULL ? $daiguillage->id_sous_projet_distribution_aiguillage : 0);

$dtirage = SousProjetDistributionTirage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
$id_dt = ($dtirage!==NULL ? $dtirage->id_sous_projet_distribution_tirage : 0);

$draccord = SousProjetDistributionRaccordement::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
$id_dr = ($draccord!==NULL ? $draccord->id_sous_projet_distribution_raccordements : 0);






echo json_encode(array("id_ta" => $id_ta, "id_tt" => $id_tt, "id_da" => $id_da, "id_dt" => $id_dt, "id_tr" => $id_tr, "id_dr" => $id_dr));