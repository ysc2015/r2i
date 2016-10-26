<?php
/**
 * file: affect_liste.php
 * User: rabii
 */

$table = array("ordre_de_travail as t1","select_type_ordre_travail as t2","entreprises_stt as t3","equipe_stt as t4");
$columns = array(
    array( "db" => "t1.id_ordre_de_travail", "dt" => 'id_ordre_de_travail' ),
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.type_entree", "dt" => 'type_entree' ),
    array( "db" => "t1.type_ot", "dt" => 'type_ot' ),
    array( "db" => "t1.id_type_ordre_travail", "dt" => 'id_type_ordre_travail' ),
    array( "db" => "t2.lib_type_ordre_travail", "dt" => 'lib_type_ordre_travail' ),
    array( "db" => "t1.commentaire", "dt" => 'commentaire' )
);

$condition = "t1.id_type_ordre_travail=t2.id_type_ordre_travail AND t1.id_entreprise = t3.id_entreprise AND t3.id_entreprise = t4.id_entreprise";

if(isset($idsp)) {
    $condition .=" AND t1.id_sous_projet=$idsp";
}

if(isset($tentree)) {
    $condition .=" AND t1.type_entree='$tentree'";
}

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_sous_projet",$columns,$condition));
?>