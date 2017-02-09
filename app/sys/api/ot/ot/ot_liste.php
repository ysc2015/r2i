<?php
/**
 * file: ot_liste.php
 * User: rabii
 */

extract($_GET);

$table = array("ordre_de_travail as t1","select_type_ordre_travail as t2");
$columns = array(
    array( "db" => "t1.id_ordre_de_travail", "dt" => 'id_ordre_de_travail' ),
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.type_entree", "dt" => 'type_entree' ),
    array( "db" => "t1.id_entreprise", "dt" => 'id_entreprise' ),
    array( "db" => "t1.id_equipe_stt", "dt" => 'id_equipe_stt' ),
    array( "db" => "t1.type_ot", "dt" => 'type_ot' ),
    array( "db" => "t1.date_debut", "dt" => 'date_debut' ),
    array( "db" => "t1.date_fin", "dt" => 'date_fin' ),
    array( "db" => "t1.id_type_ordre_travail", "dt" => 'id_type_ordre_travail' ),
    array( "db" => "t2.lib_type_ordre_travail", "dt" => 'lib_type_ordre_travail' ),
    array( "db" => "t1.commentaire", "dt" => 'commentaire' ),
    array( "db" => "etat.lib_etat_ot", "dt" => 'lib_etat_ot' )
);

$condition = "t1.id_type_ordre_travail=t2.id_type_ordre_travail";

if(isset($tentree) && !empty($tentree)) {

    /*$tbl = getTableNameForEntry($tentree,true);
    $table[] = "$tbl as e";

    $te = "";

    if($tentree == "transportraccordement") $te = "transporttirage";
    if($tentree == "distributionraccordement") $te = "distributiontirage";
    $condition .=" AND t1.type_entree='".($te==""?$tentree:$te)."'";

    $condition .=" AND t1.id_sous_projet = e.id_sous_projet AND (t1.id_type_ordre_travail > 10 OR (t1.id_type_ordre_travail <=10 AND e.ok <> 1))";*/

    if($tentree == "transportraccordement") $te = "transporttirage";
    if($tentree == "distributionraccordement") $te = "distributiontirage";
    $condition .=" AND t1.type_entree='$tentree'";
}

if(isset($idsp)) {
    $condition .=" AND t1.id_sous_projet=$idsp";
}

/*if(!isset($tab_imei)) {
    switch($connectedProfil->profil->profil->shortlib) {
        case "stt" :
            $condition .=" AND t1.id_entreprise = ".$connectedProfil->profil->id_entreprise;
            break;

        default : break;
    }
}*/


$left = "LEFT join etat_ot as etat ON t1.id_etat_ot = etat.id_etat_ot";

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_ordre_de_travail",$columns,$condition,$left));
?>