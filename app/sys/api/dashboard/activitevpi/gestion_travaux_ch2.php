<?php
/**
 * file: gestion_travaux_ch2.php
 * User: rabii
 */

extract($_POST);

$tpl_extra_ssp_array = array(
    1 => array(//Aiguillage CTR
        "tables" => array("sous_projet_transport_commande_ctr as t8","sous_projet_transport_aiguillage as t9"),
        "condition" => " AND t1.id_sous_projet = t9.id_sous_projet AND t9.ok <> 1 AND t1.id_type_ordre_travail = 1",
        "left" => " left join ressource res on t1.id_ordre_de_travail = res.id_ordre_de_travail AND res.type_objet = 'stt_retour_terrain'"
    ),
    2 => array(//Tirage CTR
        "tables" => array("sous_projet_transport_commande_ctr as t8","sous_projet_transport_tirage as t9"),
        "condition" => " AND t1.id_sous_projet = t9.id_sous_projet AND t9.ok <> 1 AND t1.id_type_ordre_travail = 2",
        "left" => " left join ressource res on t1.id_ordre_de_travail = res.id_ordre_de_travail AND res.type_objet = 'stt_retour_terrain'"
    ),
    3 => array(//Raccordement CTR
        "tables" => array("sous_projet_transport_commande_ctr as t8","sous_projet_transport_raccordements as t9"),
        "condition" => " AND t1.id_sous_projet = t9.id_sous_projet AND t9.ok <> 1 AND t1.id_type_ordre_travail = 3",
        "left" => " left join ressource res on t1.id_ordre_de_travail = res.id_ordre_de_travail AND res.type_objet = 'stt_retour_terrain'"
    ),
    4 => array(//Tirage et Raccordement CTR
        "tables" => array("sous_projet_transport_commande_ctr as t8","sous_projet_transport_tirage as t9","sous_projet_transport_raccordements as t10"),
        "condition" => " AND t1.id_sous_projet = t9.id_sous_projet AND t1.id_sous_projet = t10.id_sous_projet AND t9.ok <> 1 AND t10.ok <> 1 AND t1.id_type_ordre_travail = 4",
        "left" => " left join ressource res on t1.id_ordre_de_travail = res.id_ordre_de_travail AND res.type_objet = 'stt_retour_terrain'"
    ),
    5 => array(//Aiguillage CDI
        "tables" => array("sous_projet_distribution_commande_cdi as t8","sous_projet_distribution_aiguillage as t9"),
        "condition" => " AND t1.id_sous_projet = t9.id_sous_projet AND t9.ok <> 1 AND t1.id_type_ordre_travail = 5",
        "left" => " left join ressource res on t1.id_ordre_de_travail = res.id_ordre_de_travail AND res.type_objet = 'stt_retour_terrain'"
    ),
    6 => array(//Tirage CDI
        "tables" => array("sous_projet_distribution_commande_cdi as t8","sous_projet_distribution_tirage as t9"),
        "condition" => " AND t1.id_sous_projet = t9.id_sous_projet AND t9.ok <> 1 AND t1.id_type_ordre_travail = 6",
        "left" => " left join ressource res on t1.id_ordre_de_travail = res.id_ordre_de_travail AND res.type_objet = 'stt_retour_terrain'"
    ),
    7 => array(//Raccordement CDI
        "tables" => array("sous_projet_distribution_commande_cdi as t8","sous_projet_distribution_raccordements as t9"),
        "condition" => " AND t1.id_sous_projet = t9.id_sous_projet AND t9.ok <> 1 AND t1.id_type_ordre_travail = 7",
        "left" => " left join ressource res on t1.id_ordre_de_travail = res.id_ordre_de_travail AND res.type_objet = 'stt_retour_terrain'"
    ),
    8 => array(//Tirage et Raccordement CDI
        "tables" => array("sous_projet_distribution_commande_cdi as t8","sous_projet_distribution_tirage as t9","sous_projet_distribution_raccordements as t10"),
        "condition" => " AND t1.id_sous_projet = t9.id_sous_projet AND t1.id_sous_projet = t10.id_sous_projet AND t9.ok <> 1 AND t10.ok <> 1 AND t1.id_type_ordre_travail = 8",
        "left" => " left join ressource res on t1.id_ordre_de_travail = res.id_ordre_de_travail AND res.type_objet = 'stt_retour_terrain'"
    ),
    9 => array(//Recette Optique CTR
        "tables" => array("sous_projet_transport_commande_ctr as t8","sous_projet_transport_recette as t9"),
        "condition" => " AND t1.id_sous_projet = t9.id_sous_projet AND t9.ok <> 1 AND t1.id_type_ordre_travail = 9",
        "left" => " left join ressource res on t1.id_ordre_de_travail = res.id_ordre_de_travail AND res.type_objet = 'stt_retour_terrain'"
    ),
    10 => array(//Recette Optique CDI
        "tables" => array("sous_projet_distribution_commande_cdi as t8","sous_projet_distribution_recette as t9"),
        "condition" => " AND t1.id_sous_projet = t9.id_sous_projet AND t9.ok <> 1 AND t1.id_type_ordre_travail = 10",
        "left" => " left join ressource res on t1.id_ordre_de_travail = res.id_ordre_de_travail AND res.type_objet = 'stt_retour_terrain'"
    )
);

$table = array("ordre_de_travail as t1","sous_projet as t2","projet as t3","nro as t4","etat_ot as t5","select_type_ordre_travail as t6","entreprises_stt as t7");
$columns = array(
    array( "db" => "t1.id_ordre_de_travail", "dt" => 'id_ordre_de_travail' ),
    array( "db" => "t1.type_ot", "dt" => 'type_ot' ),
    array( "db" => "t5.lib_etat_ot", "dt" => 'lib_etat_ot' ),
    array( "db" => "t4.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t6.lib_type_ordre_travail", "dt" => 'lib_type_ordre_travail' ),
    array( "db" => "u.prenom_utilisateur", "dt" => 'prenom_utilisateur' ),
    array( "db" => "u.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t7.nom", "dt" => 'nom' ),
    array( "db" => "t1.date_fin", "dt" => 'date_fin' ),
    array( "db" => "t8.date_fin_travaux_ft", "dt" => 'date_fin_travaux_ft' ),
    array( "db" => "t1.type_entree", "dt" => 'type_entree' ),
    array( "db" => "t2.id_sous_projet", "dt" => 'id_sous_projet' ),
);

$condition = "t1.id_sous_projet = t2.id_sous_projet AND t1.id_sous_projet = t8.id_sous_projet AND t1.id_entreprise = t7.id_entreprise AND t1.id_etat_ot = t5.id_etat_ot AND t1.id_type_ordre_travail = t6.id_type_ordre_travail AND t2.id_projet = t3.id_projet AND t3.id_nro = t4.id_nro";

$condition .= " AND t1.date_debut IS NOT NULL";
$condition .= " AND t1.date_fin IS NOT NULL";

$condition .= " AND t6.system = 1";

$condition .= " AND t8.date_fin_travaux_ft BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 6 DAY)";

$condition .= " AND pu.id_profil_utilisateur = 8";

$condition .= " AND res.id_ordre_de_travail IS NULL";

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

        $condition .=" AND t3.id_nro IN ( ".implode(",",$arr).")";
        break;

    case "vpi" :
        $arr = array(-1);
        $stm = $db->prepare("select id_nro from nro where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
        $stm->execute();
        $nros = $stm->fetchAll();
        foreach($nros as $nro) {
            $arr[] = $nro['id_nro'];
        }

        $condition .=" AND t3.id_nro IN ( ".implode(",",$arr).")";
        break;

    default : break;
}


$left = "left join nro_utilisateur nu left join utilisateur u left join profil_utilisateur pu on u.id_profil_utilisateur = pu.id_profil_utilisateur on nu.id_utilisateur = u.id_utilisateur on t4.id_nro = nu.id_nro";

echo json_encode(@SSP::simpleJoinUnion($_GET,$db,$table,"id_ordre_de_travail",$columns,$condition,$left,$tpl_extra_ssp_array));
?>