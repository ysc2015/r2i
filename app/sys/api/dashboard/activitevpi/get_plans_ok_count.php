<?php
/**
 * file: get_plans_ok_count.php
 * User: rabii
 */

sleep(1);

$rows = array();

$temp = "";

$tbl_options_arr = array(
    //Sans OT
    "transportaiguillage1" => array(
        "table" => "sous_projet_transport_aiguillage",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail=1"
    ),
    "transporttirage1" => array(
        "table" => "sous_projet_transport_tirage",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail IN (2,4)"
    ),
    "transportraccordement1" => array(
        "table" => "sous_projet_transport_raccordements",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail IN (3,4)"
    ),
    "transportrecette1" => array(
        "table" => "sous_projet_transport_recette",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail=9"
    ),
    "distributionaiguillage1" => array(
        "table" => "sous_projet_distribution_aiguillage",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail=5"
    ),
    "distributiontirage1" => array(
        "table" => "sous_projet_distribution_tirage",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail IN (6,8)"
    ),
    "distributionraccordement1" => array(
        "table" => "sous_projet_distribution_raccordements",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail IN (7,8)"
    ),
    "distributionrecette1" => array(
        "table" => "sous_projet_distribution_recette",
        "in" => "NOT IN",
        "where" => "id_type_ordre_travail=10"
    ),
    //Avec OT sans affectation
    "transportaiguillage2" => array(
        "table" => "sous_projet_transport_aiguillage",
        "in" => "IN",
        "where" => "id_type_ordre_travail=1 AND id_entreprise IS NULL"
    ),
    "transporttirage2" => array(
        "table" => "sous_projet_transport_tirage",
        "in" => "IN",
        "where" => "id_type_ordre_travail IN (2,4) AND id_entreprise IS NULL"
    ),
    "transportraccordement2" => array(
        "table" => "sous_projet_transport_raccordements",
        "in" => "IN",
        "where" => "id_type_ordre_travail IN (3,4) AND id_entreprise IS NULL"
    ),
    "transportrecette2" => array(
        "table" => "sous_projet_transport_recette",
        "in" => "IN",
        "where" => "id_type_ordre_travail=9 AND id_entreprise IS NULL"
    ),
    "distributionaiguillage2" => array(
        "table" => "sous_projet_distribution_aiguillage",
        "in" => "IN",
        "where" => "id_type_ordre_travail=5 AND id_entreprise IS NULL"
    ),
    "distributiontirage2" => array(
        "table" => "sous_projet_distribution_tirage",
        "in" => "IN",
        "where" => "id_type_ordre_travail IN (6,8) AND id_entreprise IS NULL"
    ),
    "distributionraccordement2" => array(
        "table" => "sous_projet_distribution_raccordements",
        "in" => "IN",
        "where" => "id_type_ordre_travail IN (7,8) AND id_entreprise IS NULL"
    ),
    "distributionrecette2" => array(
        "table" => "sous_projet_distribution_recette",
        "in" => "IN",
        "where" => "id_type_ordre_travail=10 AND id_entreprise IS NULL"
    )
);

$search = array("{table}","{in}","{where}");

foreach($tbl_options_arr as $k => $v) {
    $sql = "SELECT count(*) FROM sous_projet sp,{table} et,projet pj,nro nr WHERE sp.id_sous_projet = et.id_sous_projet AND sp.id_projet = pj.id_projet AND pj.id_nro = nr.id_nro AND et.controle_plans = 2 AND et.lien_plans <> '' AND sp.id_sous_projet {in} (SELECT id_sous_projet FROM ordre_de_travail WHERE {where} AND id_sous_projet IS NOT NULL)";
    $sql = str_replace($search,$v,$sql);

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

            $sql .=" AND pj.id_nro IN ( ".implode(",",$arr).")";
            break;

        case "vpi" :
            $arr = array(-1);
            $stm_vpi = $db->prepare("select id_nro from nro where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
            $stm_vpi->execute();
            $nros = $stm_vpi->fetchAll();
            foreach($nros as $nro) {
                $arr[] = $nro['id_nro'];
            }

            $sql .=" AND pj.id_nro IN ( ".implode(",",$arr).")";
            break;

        default : break;
    }

    if($k == "transportaiguillage1") $temp = $sql;

    $stm = $db->prepare($sql);
    $stm->execute();

    $result = $stm->fetchAll(PDO::FETCH_NUM);

    $rows[$k] = $result[0][0];
}

echo json_encode(array("rows" => $rows,  "debug" => $temp));