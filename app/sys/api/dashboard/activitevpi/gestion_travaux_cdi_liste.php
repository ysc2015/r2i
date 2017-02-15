<?php
/**
 * file: gestion_travaux_cdi_liste.php
 * User: rabii
 */

extract($_POST);

$table = array("sous_projet as t1","projet as t2","nro as t3","ordre_de_travail as t4","sous_projet_distribution_tirage as t5","sous_projet_distribution_raccordements as t6","sous_projet_distribution_commande_cdi as t7");
$columns = array(
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.id_projet", "dt" => 'id_projet' ),
    array( "db" => "t2.projet_nom", "dt" => 'projet_nom' ),
    array( "db" => "t1.dep", "dt" => 'dep' ),
    array( "db" => "t1.ville", "dt" => 'ville' ),
    array( "db" => "t1.plaque", "dt" => 'plaque' ),
    array( "db" => "t1.zone", "dt" => 'zone' ),
    array( "db" => "t3.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t7.ref_commande_acces", "dt" => 'ref_commande_acces' ),
    array( "db" => "sgf.lib_go_ft", "dt" => 'lib_go_ft' ),
    array( "db" => "t7.date_debut_travaux_ft", "dt" => 'date_debut_travaux_ft' ),
    array( "db" => "t7.date_fin_travaux_ft", "dt" => 'date_fin_travaux_ft' ),
    array( "db" => "t7.date_depot_cmd", "dt" => 'date_depot_cmd' ),
    array( "db" => "t4.type_ot", "dt" => 'type_ot' ),
    array( "db" => "t4.date_debut", "dt" => 'date_debut' ),
    array( "db" => "t4.date_fin", "dt" => 'date_fin' ),
);

$condition = "t1.id_projet=t2.id_projet AND t2.id_nro=t3.id_nro";
$condition .= " AND (t1.id_sous_projet=t4.id_sous_projet AND t4.id_type_ordre_travail IN (6,7,8))";
$condition .= " AND t1.id_sous_projet=t5.id_sous_projet AND t1.id_sous_projet=t6.id_sous_projet AND t1.id_sous_projet=t7.id_sous_projet";

$condition .= " AND t7.ref_commande_acces <> '' ";

$condition .=" AND (t5.etat_retour <> 2 OR t6.etat_retour <> 2)";

//$condition .=" AND ((select count(*) from sous_projet where sous_projet.is_master = 1 AND sous_projet.id_projet = t1.id_projet) = 0 OR (t1.is_master = 1))";


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

$left = "left join select_go_ft sgf on t7.go_ft = sgf.id_go_ft";

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_sous_projet",$columns,$condition,$left));
?>