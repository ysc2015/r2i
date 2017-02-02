<?php
/**
 * file: sousprojet_liste.php
 * User: rabii
 */

extract($_GET);

$tbl_options_arr = array(
    //Sans OT
    "transportaiguillage1" => array(
        "table" => "sous_projet_transport_aiguillage",
        "ctr_cnd" => "AND ((select count(*) from sous_projet where sous_projet.is_master = 1 AND sous_projet.id_projet = t1.id_projet) = 0 OR (t1.is_master = 1))",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail=1"
    ),
    "transporttirage1" => array(
        "table" => "sous_projet_transport_tirage",
        "ctr_cnd" => "AND ((select count(*) from sous_projet where sous_projet.is_master = 1 AND sous_projet.id_projet = t1.id_projet) = 0 OR (t1.is_master = 1))",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail IN (2,4)"
    ),
    "transportraccordement1" => array(
        "table" => "sous_projet_transport_raccordements",
        "ctr_cnd" => "AND ((select count(*) from sous_projet where sous_projet.is_master = 1 AND sous_projet.id_projet = t1.id_projet) = 0 OR (t1.is_master = 1))",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail IN (3,4)"
    ),
    "transportrecette1" => array(
        "table" => "sous_projet_transport_recette",
        "ctr_cnd" => "AND ((select count(*) from sous_projet where sous_projet.is_master = 1 AND sous_projet.id_projet = t1.id_projet) = 0 OR (t1.is_master = 1))",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail=9"
    ),
    "distributionaiguillage1" => array(
        "table" => "sous_projet_distribution_aiguillage",
        "ctr_cnd" => "AND ((select count(*) from sous_projet where sous_projet.is_master = 1 AND sous_projet.id_projet = t1.id_projet) = 0 OR (t1.is_master = 1))",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail=5"
    ),
    "distributiontirage1" => array(
        "table" => "sous_projet_distribution_tirage",
        "ctr_cnd" => "AND ((select count(*) from sous_projet where sous_projet.is_master = 1 AND sous_projet.id_projet = t1.id_projet) = 0 OR (t1.is_master = 1))",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail IN (6,8)"
    ),
    "distributionraccordement1" => array(
        "table" => "sous_projet_distribution_raccordements",
        "ctr_cnd" => "AND ((select count(*) from sous_projet where sous_projet.is_master = 1 AND sous_projet.id_projet = t1.id_projet) = 0 OR (t1.is_master = 1))",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail IN (7,8)"
    ),
    "distributionrecette1" => array(
        "table" => "sous_projet_distribution_recette",
        "ctr_cnd" => "AND ((select count(*) from sous_projet where sous_projet.is_master = 1 AND sous_projet.id_projet = t1.id_projet) = 0 OR (t1.is_master = 1))",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail=10"
    ),
    //Avec OT sans affectation
    "transportaiguillage2" => array(
        "table" => "sous_projet_transport_aiguillage",
        "ctr_cnd" => "",
        "in" => "IN",
        "where" => "id_type_ordre_travail=1 AND id_entreprise IS NULL"
    ),
    "transporttirage2" => array(
        "table" => "sous_projet_transport_tirage",
        "ctr_cnd" => "",
        "in" => "IN",
        "where" => "id_type_ordre_travail IN (2,4) AND id_entreprise IS NULL"
    ),
    "transportraccordement2" => array(
        "table" => "sous_projet_transport_raccordements",
        "ctr_cnd" => "",
        "in" => "IN",
        "where" => "id_type_ordre_travail IN (3,4) AND id_entreprise IS NULL"
    ),
    "transportrecette2" => array(
        "table" => "sous_projet_transport_recette",
        "ctr_cnd" => "",
        "in" => "IN",
        "where" => "id_type_ordre_travail=9 AND id_entreprise IS NULL"
    ),
    "distributionaiguillage2" => array(
        "table" => "sous_projet_distribution_aiguillage",
        "ctr_cnd" => "",
        "in" => "IN",
        "where" => "id_type_ordre_travail=5 AND id_entreprise IS NULL"
    ),
    "distributiontirage2" => array(
        "table" => "sous_projet_distribution_tirage",
        "ctr_cnd" => "",
        "in" => "IN",
        "where" => "id_type_ordre_travail IN (6,8) AND id_entreprise IS NULL"
    ),
    "distributionraccordement2" => array(
        "table" => "sous_projet_distribution_raccordements",
        "ctr_cnd" => "",
        "in" => "IN",
        "where" => "id_type_ordre_travail IN (7,8) AND id_entreprise IS NULL"
    ),
    "distributionrecette2" => array(
        "table" => "sous_projet_distribution_recette",
        "ctr_cnd" => "",
        "in" => "IN",
        "where" => "id_type_ordre_travail=10 AND id_entreprise IS NULL"
    )
);

$table = array("sous_projet as t1","projet as t2","nro as t3");
if(isset($ide) && !empty($ide)) $table[] = $tbl_options_arr[explode("_",$ide)[0]]["table"]." as t4";
$columns = array(
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.id_projet", "dt" => 'id_projet' ),
    array( "db" => "t2.projet_nom", "dt" => 'projet_nom' ),
    array( "db" => "t1.dep", "dt" => 'dep' ),
    array( "db" => "t1.ville", "dt" => 'ville' ),
    array( "db" => "t1.plaque", "dt" => 'plaque' ),
    array( "db" => "t1.zone", "dt" => 'zone' ),
    array( "db" => "t3.lib_nro", "dt" => 'lib_nro' )
);

if(isset($ide) && !empty($ide)) {
    $search = array("{table}","{ctr_cnd}","{in}","{where}");

    $condition = "t1.id_sous_projet = t4.id_sous_projet AND t1.id_projet = t2.id_projet AND t2.id_nro = t3.id_nro AND t4.controle_plans = 2 AND t4.lien_plans <> '' {ctr_cnd} AND t1.id_sous_projet {in} (SELECT id_sous_projet FROM ordre_de_travail WHERE {where} AND id_sous_projet IS NOT NULL)";

    $condition = str_replace($search,$tbl_options_arr[explode("_",$ide)[0]],$condition);

    switch($connectedProfil->profil->profil->shortlib) {

        /*case "cdp" :
            $condition .=" AND t2.id_chef_projet = ".$connectedProfil->profil->id_utilisateur;
            break;*/

        case "pci" :
        case "bei" :
            $arr = array(-1);
            $stm_bei_pci = $db->prepare("select id_nro from nro_utilisateur where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
            $stm_bei_pci->execute();
            $nros = $stm_bei_pci->fetchAll();
            foreach($nros as $nro) {
                $arr[] = $nro['id_nro'];
            }

            $condition .=" AND t2.id_nro IN ( ".implode(",",$arr).")";
            break;

        case "vpi" :
            $arr = array(-1);
            $stm = $db->prepare("select id_nro from nro where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
            $stm->execute();
            $nros = $stm->fetchAll();
            foreach($nros as $nro) {
                $arr[] = $nro['id_nro'];
            }

            $condition .=" AND t2.id_nro IN ( ".implode(",",$arr).")";
            break;

        default : break;
    }
} else {
    $condition = "t1.id_projet=-1";
}

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_sous_projet",$columns,$condition));

?>