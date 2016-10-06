<?php
/**
 * file: pblq_liste.php
 * User: rabii
 */

extract($_GET);

$table = array("point_bloquant as t1");
$columns = array(
    array( "db" => "t1.id_point_bloquant", "dt" => 'id_point_bloquant' ),
    array( "db" => "t1.id_chambre", "dt" => 'id_chambre' ),
    array( "db" => "t1.date_controle", "dt" => 'date_controle' ),
    array( "db" => "t1.utilisateur", "dt" => 'utilisateur' ),
    array( "db" => "t1.entreprise", "dt" => 'entreprise' ),
    array( "db" => "t1.responsable", "dt" => 'responsable' ),
    array( "db" => "t1.adresse", "dt" => 'adresse' ),
    array( "db" => "t1.ref_chantier", "dt" => 'ref_chantier' ),
    array( "db" => "t1.nature_travaux", "dt" => 'nature_travaux' ),
    array( "db" => "t1.environement", "dt" => 'environement' ),
    array( "db" => "t1.synthese", "dt" => 'synthese' )
);

$condition = "";

if(isset($idch) && !empty($idch)) {
    $condition .="t1.id_chambre=$idch";
}

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_point_bloquant",$columns,$condition));
?>