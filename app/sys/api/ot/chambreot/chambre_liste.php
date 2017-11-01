<?php
/**
 * file: chambre_liste.php
 * User: rabii
 */

ini_set("display_errors","1");

extract($_GET);

$table = array("chambre as t1","ressource as t2");
$columns = array(
    array( "db" => "t1.id_chambre", "dt" => 'id_chambre' ),
    array( "db" => "t1.id_ressource", "dt" => 'id_ressource' ),
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.type_entree", "dt" => 'type_entree' ),
    array( "db" => "t1.ref_chambre", "dt" => 'ref_chambre' ),
    array( "db" => "t1.villet", "dt" => 'villet' ),
    array( "db" => "t1.sous_projet", "dt" => 'sous_projet' ),
    array( "db" => "t1.ref_note", "dt" => 'ref_note' ),
    array( "db" => "t1.code_ch1", "dt" => 'code_ch1' ),
    array( "db" => "t1.code_ch2", "dt" => 'code_ch2' ),
    array( "db" => "t1.gps", "dt" => 'gps' ),
    array( "db" => "t1.type_chambre", "dt" => 'type_chambre' ),
    array( "db" => "t1.traite", "dt" => 'traite' ),
    array( "db" => "t1.type_chambre", "dt" => 'type_chambre' )
);

$condition = "t1.id_ressource=t2.id_ressource";

if(isset($idot) && !empty($idot)) {
    $condition .= "  AND t2.id_ordre_de_travail=$idot";
}

if(isset($id_chambre))
{
	$condition .= "  AND t1.id_chambre=$id_chambre";
}

if(isset($type_objet))
{
	$condition .= "  AND t2.type_objet='$type_objet'";
}

$rows = SSP::simpleJoin($_GET,$db,$table,"id_chambre",$columns,$condition);

$imei = isset($tab_imei) ? '&tab_imei=' . $tab_imei : '';

foreach($rows['data'] as $key => $value)
{
	$rows['data'][$key]['link'] = 'api/file/download.php?id=' . $value['id_ressource'] . $imei;
}

echo json_encode($rows);
?>
