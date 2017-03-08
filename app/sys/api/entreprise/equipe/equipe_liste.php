<?php
/**
 * file: equipe_liste.php
 * User: rabii
 */

extract($_GET);

$table = array("equipe_stt as t1");
$columns = array(
    array( "db" => "t1.id_equipe_stt", "dt" => 'id_equipe_stt' ),
    array( "db" => "t1.id_entreprise", "dt" => 'id_entreprise' ),
    array( "db" => "t1.imei", "dt" => 'imei' ),
    array( "db" => "t1.nom", "dt" => 'nom' ),
    array( "db" => "t1.prenom", "dt" => 'prenom' ),
    array( "db" => "t1.tel", "dt" => 'tel' ),
    array( "db" => "t1.mail", "dt" => 'mail' ),
    array( "db" => "t1.id_equipe_types", "dt" => 'id_equipe_types' ),
    array( "db" => "t2.lib_type", "dt" => 'lib_type' )
);

$condition = "";

if(isset($ide) && $ide > 0) {
    $condition .="t1.id_entreprise=$ide";
} else {
    $condition .= "0=1";
}

$left = "left join equipe_types t2 on t1.id_equipe_types = t2.id_equipe_types";

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_equipe_stt",$columns,$condition,$left));
?>