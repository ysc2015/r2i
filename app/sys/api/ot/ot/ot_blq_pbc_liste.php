<?php
/**
 * file: ot_blq_pbc_liste.php
 * User: rabii
 */

extract($_GET);

$table = array("blq_pbc as t1","ordre_de_travail as t2");
$columns = array(
    array( "db" => "t1.id_blq_pbc", "dt" => 'id_blq_pbc' ),
    array( "db" => "t1.id_ordre_de_travail", "dt" => 'id_ordre_de_travail' ),
    array( "db" => "t1.type", "dt" => 'type' ),
    array( "db" => "t1.snake", "dt" => 'snake' ),
    array( "db" => "t1.planche_a3", "dt" => 'planche_a3' ),
    array( "db" => "t1.chambre_amont", "dt" => 'chambre_amont' ),
    array( "db" => "t1.chambre_aval", "dt" => 'chambre_aval' ),
    array( "db" => "t1.question_information", "dt" => 'question_information' ),
    array( "db" => "t1.reponse_ajustement", "dt" => 'reponse_ajustement' )
);

$condition = "t1.id_ordre_de_travail=t2.id_ordre_de_travail";

if(isset($idot)) {
    $condition .=" AND t1.id_ordre_de_travail=$idot";
}

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_ordre_de_travail",$columns,$condition));
?>