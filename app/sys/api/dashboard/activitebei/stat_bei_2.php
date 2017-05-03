<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 20/04/2017
 * Time: 11:20
 */

extract($_POST);

$tpl_extra_ssp_array = array(
    //CTR
    1 => array(//Design CTR
        "tables" => array("sous_projet_transport_design as t4"),
        "condition" => " AND t1.id_sous_projet = t4.id_sous_projet AND t4.ok = 1 AND ( ns.intervenant_be < 1 OR ns.intervenant_be IS NULL OR ns.intervenant_be = '' ) ",
        "left" => " left join sous_projet_transport_aiguillage as ns on t1.id_sous_projet = ns.id_sous_projet",
        "extra_pluck" => "t1.date_insertion AS date_fin_prev_step,'Design CTR' AS etape"
    ),
    2 => array(//Aiguillage CTR
        "tables" => array("sous_projet_transport_aiguillage as t5"),
        "condition" => " AND t1.id_sous_projet = t5.id_sous_projet AND t5.ok = 1 AND ( ns.intervenant_be < 1 OR ns.intervenant_be IS NULL OR ns.intervenant_be = '' ) ",
        "left" => " left join sous_projet_transport_commande_ctr as ns on t1.id_sous_projet = ns.id_sous_projet left join sous_projet_transport_design as ps on t1.id_sous_projet = ps.id_sous_projet",
        "extra_pluck" => "ps.date_ret_prevue AS date_fin_prev_step,'Aiguillage CTR' AS etape"
    ),
    3 => array(//CMD Structurante CTR
        "tables" => array("sous_projet_transport_commande_ctr as t6"),
        "condition" => " AND t1.id_sous_projet = t6.id_sous_projet AND t6.ok = 1 AND ( ns.intervenant_be < 1 OR ns.intervenant_be IS NULL OR ns.intervenant_be = '' ) ",
        "left" => " left join sous_projet_transport_tirage as ns on t1.id_sous_projet = ns.id_sous_projet left join sous_projet_transport_aiguillage as ps on t1.id_sous_projet = ps.id_sous_projet",
        "extra_pluck" => "ps.date_ret_prevue AS date_fin_prev_step,'CMD Structurante CTR' AS etape"
    ),
    4 => array(//Tirage CTR
        "tables" => array("sous_projet_transport_tirage as t7"),
        "condition" => " AND t1.id_sous_projet = t7.id_sous_projet AND t7.ok = 1 AND ( ns.intervenant_be < 1 OR ns.intervenant_be IS NULL OR ns.intervenant_be = '' ) ",
        "left" => " left join sous_projet_transport_raccordements as ns on t1.id_sous_projet = ns.id_sous_projet left join sous_projet_transport_commande_ctr as ps on t1.id_sous_projet = ps.id_sous_projet",
        "extra_pluck" => "ps.date_fin_travaux_ft AS date_fin_prev_step,'Tirage CTR' AS etape"
    ),
    5 => array(//Raccordement CTR
        "tables" => array("sous_projet_transport_raccordements as t8"),
        "condition" => " AND t1.id_sous_projet = t8.id_sous_projet AND t8.ok = 1 AND ( ns.intervenant_be < 1 OR ns.intervenant_be IS NULL OR ns.intervenant_be = '' ) ",
        "left" => " left join sous_projet_transport_recette as ns on t1.id_sous_projet = ns.id_sous_projet left join sous_projet_transport_tirage as ps on t1.id_sous_projet = ps.id_sous_projet",
        "extra_pluck" => "ps.date_ret_prevue AS date_fin_prev_step,'Raccordement CTR' AS etape"
    ),
    6 => array(//Recette CTR
        "tables" => array("sous_projet_transport_recette as t9"),
        "condition" => " AND t1.id_sous_projet = t9.id_sous_projet AND t9.ok = 1 AND ( ns.intervenant_be < 1 OR ns.intervenant_be IS NULL OR ns.intervenant_be = '' ) ",
        "left" => " left join sous_projet_transport_commande_fin_travaux as ns on t1.id_sous_projet = ns.id_sous_projet left join sous_projet_transport_raccordements as ps on t1.id_sous_projet = ps.id_sous_projet",
        "extra_pluck" => "ps.date_ret_prevue AS date_fin_prev_step,'Recette CTR' AS etape"
    ),
    /*7 => array(//CMD Fin Travaux CTR
        "tables" => array("sous_projet_transport_commande_fin_travaux as t10"),
        "condition" => " AND t1.id_sous_projet = t10.id_sous_projet AND t10.ok = 1 ",
        "left" => " left join sous_projet_transport_recette as ps on t1.id_sous_projet = ps.id_sous_projet",
        "extra_pluck" => "ps.date_ret_prevue AS date_fin_prev_step,'CMD Fin Travaux CTR' AS etape"
    ),*/
    //CDI
    7 => array(//Design CDI
        "tables" => array("sous_projet_distribution_design as t11"),
        "condition" => " AND t1.id_sous_projet = t11.id_sous_projet AND t11.ok = 1 AND ( ns.intervenant_be < 1 OR ns.intervenant_be IS NULL OR ns.intervenant_be = '' ) ",
        "left" => " left join sous_projet_distribution_aiguillage as ns on t1.id_sous_projet = ns.id_sous_projet",
        "extra_pluck" => "t1.date_insertion AS date_fin_prev_step,'Design CDI' AS etape"
    ),
    8 => array(//Aiguillage CDI
        "tables" => array("sous_projet_distribution_aiguillage as t12"),
        "condition" => " AND t1.id_sous_projet = t12.id_sous_projet AND t12.ok = 1 AND ( ns.intervenant_be < 1 OR ns.intervenant_be IS NULL OR ns.intervenant_be = '' ) ",
        "left" => " left join sous_projet_distribution_commande_cdi as ns on t1.id_sous_projet = ns.id_sous_projet left join sous_projet_distribution_design as ps on t1.id_sous_projet = ps.id_sous_projet",
        "extra_pluck" => "ps.date_fin AS date_fin_prev_step,'Aiguillage CDI' AS etape"
    ),
    9 => array(//CMD Structurante CDI
        "tables" => array("sous_projet_distribution_commande_cdi as t13"),
        "condition" => " AND t1.id_sous_projet = t13.id_sous_projet AND t13.ok = 1 AND ( ns.intervenant_be < 1 OR ns.intervenant_be IS NULL OR ns.intervenant_be = '' ) ",
        "left" => " left join sous_projet_distribution_tirage as ns on t1.id_sous_projet = ns.id_sous_projet left join sous_projet_distribution_aiguillage as ps on t1.id_sous_projet = ps.id_sous_projet",
        "extra_pluck" => "ps.date_ret_prevue AS date_fin_prev_step,'CMD Structurante CDI' AS etape"
    ),
    10 => array(//Tirage CDI
        "tables" => array("sous_projet_distribution_tirage as t14"),
        "condition" => " AND t1.id_sous_projet = t14.id_sous_projet AND t14.ok = 1 AND ( ns.intervenant_be < 1 OR ns.intervenant_be IS NULL OR ns.intervenant_be = '' ) ",
        "left" => " left join sous_projet_distribution_raccordements as ns on t1.id_sous_projet = ns.id_sous_projet left join sous_projet_distribution_commande_cdi as ps on t1.id_sous_projet = ps.id_sous_projet",
        "extra_pluck" => "ps.date_fin_travaux_ft AS date_fin_prev_step,'Tirage CDI' AS etape"
    ),
    11 => array(//Raccordement CDI
        "tables" => array("sous_projet_distribution_raccordements as t15"),
        "condition" => " AND t1.id_sous_projet = t15.id_sous_projet AND t15.ok = 1 AND ( ns.intervenant_be < 1 OR ns.intervenant_be IS NULL OR ns.intervenant_be = '' ) ",
        "left" => " left join sous_projet_distribution_recette as ns on t1.id_sous_projet = ns.id_sous_projet left join sous_projet_distribution_tirage as ps on t1.id_sous_projet = ps.id_sous_projet",
        "extra_pluck" => "ps.date_ret_prevue AS date_fin_prev_step,'Raccordement CDI' AS etape"
    ),
    12 => array(//Recette CDI
        "tables" => array("sous_projet_distribution_recette as t16"),
        "condition" => " AND t1.id_sous_projet = t16.id_sous_projet AND t16.ok = 1 AND ( ns.intervenant_be < 1 OR ns.intervenant_be IS NULL OR ns.intervenant_be = '' ) ",
        "left" => " left join sous_projet_distribution_commande_fin_travaux as ns on t1.id_sous_projet = ns.id_sous_projet left join sous_projet_distribution_raccordements as ps on t1.id_sous_projet = ps.id_sous_projet",
        "extra_pluck" => "ps.date_ret_prevue AS date_fin_prev_step,'Recette CDI' AS etape"
    )/*,
    14 => array(//CMD Fin Travaux CDI
        "tables" => array("sous_projet_distribution_commande_fin_travaux as t17"),
        "condition" => " AND t1.id_sous_projet = t17.id_sous_projet AND t17.ok = 1 ",
        "left" => " left join sous_projet_distribution_recette as ps on t1.id_sous_projet = ps.id_sous_projet",
        "extra_pluck" => "ps.date_ret_prevue AS date_fin_prev_step,'CMD Fin Travaux CDI' AS etape"
    )*/
);

$table = array("sous_projet as t1","projet as t2","nro as t3");

$columns = array(
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.zone", "dt" => 'zone' ),
    array( "db" => "t3.lib_nro", "dt" => 'lib_nro' )
);

$condition = "t1.id_projet = t2.id_projet AND t2.id_nro = t3.id_nro";


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

echo json_encode(SSP::simpleJoinUnion($_POST,$db,$table,"id_sous_projet",$columns,$condition,"",$tpl_extra_ssp_array,array("date_fin_prev_step","etape")));
?>