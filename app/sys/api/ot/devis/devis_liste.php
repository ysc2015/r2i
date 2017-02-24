<?php
/**
 * file: ot_liste.php
 * User: rabii
 */

extract($_GET);

$table = array("detaildevis as dd","ordre_de_travail as t1","etat_devis as ed");

$columns = array(

    array( "db" => "dd.iddevis", "dt" => 'iddevis' ),
    array( "db" => "dd.id_ressource", "dt" => 'id_ressource' ),
    array( "db" => "t1.id_ordre_de_travail", "dt" => 'id_ordre_de_travail' ),
    array( "db" => "dd.ref_devis", "dt" => 'ref_devis' ),
    array( "db" => "ed.lib_etat_devis", "dt" => 'lib_etat_devis' )

);


$condition = "dd.id_ordre_de_travail=t1.id_ordre_de_travail";
$condition .=" AND ed.id_etat_devis=dd.etat_devis ";

if(isset($supprime) && $supprime == 1 ){
    $condition .=" AND dd.etat_devis=10 ";
}else{
    $condition .=" AND dd.etat_devis!=10 ";
}


$left = " ";

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_ordre_de_travail",$columns,$condition,$left));
?>