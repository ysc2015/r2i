<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 19/04/2017
 * Time: 15:25
 */

extract($_POST);

$tpl_extra_ssp_array = array(
    1 => array(//Aiguillage CTR
        "tables" => array("sous_projet_transport_aiguillage as t4"),
        "condition" => " AND t1.id_sous_projet = t4.id_sous_projet AND t4.etat_retour = 2 AND t4.intervenant_be > 0 AND t4.ok <> 1",
        "left" => "",
        "extra_pluck" => "`t4`.`date_retour_ok`,'Aiguillage CTR' AS etape"
    ),
    2 => array(//Tirage CTR
        "tables" => array("sous_projet_transport_tirage as t5"),
        "condition" => " AND t1.id_sous_projet = t5.id_sous_projet AND t5.etat_retour = 2 AND t5.intervenant_be > 0 AND t5.ok <> 1",
        "left" => "",
        "extra_pluck" => "`t5`.`date_retour_ok`,'Tirage CTR' AS etape"
    ),
    3 => array(//Raccordement CTR
        "tables" => array("sous_projet_transport_raccordements as t6"),
        "condition" => " AND t1.id_sous_projet = t6.id_sous_projet AND t6.etat_retour = 2 AND t6.intervenant_be > 0  AND t6.ok <> 1",
        "left" => "",
        "extra_pluck" => "`t6`.`date_retour_ok`,'Raccordement CTR' AS etape"
    ),
    4 => array(//Recette CTR
        "tables" => array("sous_projet_transport_recette as t7"),
        "condition" => " AND t1.id_sous_projet = t7.id_sous_projet AND t7.etat_recette = 3 AND t7.intervenant_be > 0 AND t7.ok <> 1",
        "left" => "",
        "extra_pluck" => "`t7`.`date_retour_ok`,'Recette CTR' AS etape"
    ),
    5 => array(//Aiguillage CDI
        "tables" => array("sous_projet_distribution_aiguillage as t8"),
        "condition" => " AND t1.id_sous_projet = t8.id_sous_projet AND t8.etat_retour = 2 AND t8.intervenant_be > 0 AND t8.ok <> 1",
        "left" => "",
        "extra_pluck" => "`t8`.`date_retour_ok`,'Aiguillage CDI' AS etape"
    ),
    6 => array(//Tirage CDI
        "tables" => array("sous_projet_distribution_tirage as t9"),
        "condition" => " AND t1.id_sous_projet = t9.id_sous_projet AND t9.etat_retour = 2 AND t9.intervenant_be > 0 AND t9.ok <> 1",
        "left" => "",
        "extra_pluck" => "`t9`.`date_retour_ok`,'Tirage CDI' AS etape"
    ),
    7 => array(//Raccordement CDI
        "tables" => array("sous_projet_distribution_raccordements as t10"),
        "condition" => " AND t1.id_sous_projet = t10.id_sous_projet AND t10.etat_retour = 2 AND t10.intervenant_be > 0 AND t10.ok <> 1",
        "left" => "",
        "extra_pluck" => "`t10`.`date_retour_ok`,'Raccordement CDI' AS etape"
    ),
    8 => array(//Recette CDI
        "tables" => array("sous_projet_distribution_recette as t11"),
        "condition" => " AND t1.id_sous_projet = t11.id_sous_projet AND t11.etat_recette = 3 AND t11.intervenant_be > 0 AND t11.ok <> 1",
        "left" => "",
        "extra_pluck" => "`t11`.`date_retour_ok`,'Recette CDI' AS etape"
    )
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

echo json_encode(SSP::simpleJoinUnion($_POST,$db,$table,"id_sous_projet",$columns,$condition,"",$tpl_extra_ssp_array,array("date_retour_ok","etape")));
?>