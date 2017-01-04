<?php
/**
 * file: get_details_devis.php
 * User: rabii
 */

extract($_GET);
$detailsDevis = array();

$stm = $db->prepare("select * from detaildevis where detaildevis.iddevis =$iddevis LIMIT 1");
if($stm->execute()) {
    if($stm->rowCount() > 0) {
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $detailsDevis['RFO_01_01'] = $row['RFO_01_01'];
        $detailsDevis['RFO_01_03'] = $row['RFO_01_03'];
        $detailsDevis['RFO_01_05'] = $row['RFO_01_05'];
        $detailsDevis['RFO_01_07'] = $row['RFO_01_07'];
        $detailsDevis['RFO_01_09'] = $row['RFO_01_09'];
        $detailsDevis['RFO_01_11'] = $row['RFO_01_11'];
        $detailsDevis['RFO_01_13'] = $row['RFO_01_13'];
        $detailsDevis['RFO_01_15'] = $row['RFO_01_15'];
        $detailsDevis['RFO_01_16'] = $row['RFO_01_16'];
        $detailsDevis['RFO_01_17'] = $row['RFO_01_17'];
        $detailsDevis['RFO_01_18'] = $row['RFO_01_18'];
        $detailsDevis['RFO_01_19'] = $row['RFO_01_19'];
        $detailsDevis['RFO_01_20'] = $row['RFO_01_20'];
        $detailsDevis['RFO_01_21'] = $row['RFO_01_21'];
        $detailsDevis['RFO_01_23'] = $row['RFO_01_23'];
    }
}

echo json_encode($detailsDevis);
