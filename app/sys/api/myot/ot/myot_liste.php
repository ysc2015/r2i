<?php
/**
 * file: ot_liste.php
 * User: rabii
 */

extract($_GET);

$table = array("ordre_de_travail as t1","select_type_ordre_travail as t2","sous_projet as t3","projet as t4","nro as t5");
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
    array( "db" => "t1.commentaire2", "dt" => 'commentaire2' ),
    array( "db" => "t4.ville_nom", "dt" => 'ville_nom' ),
    array( "db" => "t5.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t3.plaque", "dt" => 'plaque' ),
    array( "db" => "t3.zone", "dt" => 'zone' ),
    array( "db" => "t1.id_etat_ot", "dt" => 'id_etat_ot' ),
    array( "db" => "etat.lib_etat_ot", "dt" => 'lib_etat_ot' )
);

$condition = "t1.id_type_ordre_travail=t2.id_type_ordre_travail AND t1.id_sous_projet = t3.id_sous_projet AND t3.id_projet = t4.id_projet AND t4.id_nro = t5.id_nro AND t1.id_etat_ot IN(3,4,5,6,8)";

if(isset($idsp)) {
    $condition .=" AND t1.id_sous_projet=$idsp";
}

if(isset($tentree)) {
    $condition .=" AND t1.type_entree='$tentree'";
}

switch($connectedProfil->profil->profil->shortlib) {
    case "stt" :
        $condition .=" AND t1.id_entreprise = ".$connectedProfil->profil->id_entreprise;
        break;
    case "pci" :
        $table[] = "nro_utilisateur as t6";
        $condition .=" AND t4.id_nro = t6.id_nro AND t6.id_utilisateur = ".$connectedProfil->profil->id_utilisateur;
        break;

    default : break;
}

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_sous_projet",$columns,$condition,"left join etat_ot as etat on t1.id_etat_ot=etat.id_etat_ot"));
?>