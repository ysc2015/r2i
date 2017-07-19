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

if($connectedProfil->profil->profil->shortlib == "pci") {

    $table[] = "sous_projet as t3";
    $table[] = "projet as t4";
    $table[] = "nro as t5";
    $table[] = "nro_utilisateur as t6";

    $condition .= " AND t1.id_sous_projet = t3.id_sous_projet AND t3.id_projet = t4.id_projet AND t4.id_nro = t5.id_nro";
    $condition .=" AND t4.id_nro = t6.id_nro AND t6.id_utilisateur = ".$connectedProfil->profil->id_utilisateur;
    $condition .=" AND t1.backlog <> 1 ";
    $condition .=" AND t1.id_etat_ot IN(2,3,4,5,6,8) ";
} else {
    if(isset($tentree) && !empty($tentree)) {

        if($tentree == "transportraccordement") $tentree = "transporttirage";
        if($tentree == "distributionraccordement") $tentree = "distributiontirage";
        $condition .=" AND t1.type_entree='$tentree'";
    }

    if(isset($idsp)) {
        $condition .=" AND t1.id_sous_projet=$idsp";
    }
}

$left = "LEFT join etat_ot as etat ON t1.id_etat_ot = etat.id_etat_ot";

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_ordre_de_travail",$columns,$condition,$left));
?>