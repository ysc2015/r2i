<?php
/**
 * file: details_liste.php
 * User: rabii
 */

extract($_GET);

$table = array(
    "sous_projet as t1",
    "projet as t2",
    "nro as t3"
);
$columns = array(
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.dep", "dt" => 'dep' ),
    array( "db" => "t1.ville", "dt" => 'ville' ),
    array( "db" => "t1.plaque", "dt" => 'plaque' ),
    array( "db" => "t1.zone", "dt" => 'zone' ),
    array( "db" => "t2.id_nro", "dt" => 'id_nro' ),
    array( "db" => "t3.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t4.lr", "dt" => 'lr' ),
    array( "db" => "t4.lr_sur_pm", "dt" => 'lr_sur_pm' ),
    //array( "db" => "t5.ok as ctr_design_ok", "dt" => 'ctr_design_ok' ),
    array( "db" => "so1.lib_ok as ctr_design_lib_ok", "dt" => 'ctr_design_lib_ok' ),
    //array( "db" => "t6.controle_plans as ctr_aiguillage_plans", "dt" => 'ctr_aiguillage_plans' ),
    array( "db" => "scp1.lib_controle_plan as ctr_aiguillage_lib_controle_plan", "dt" => 'ctr_aiguillage_lib_controle_plan' ),
    array( "db" => "ot1.type_ot as ctr_aiguillage_ordre_de_travail", "dt" => 'ctr_aiguillage_ordre_de_travail' ),
    array( "db" => "ser1.lib_etat_retour as ctr_aiguillage_lib_etat_retour", "dt" => 'ctr_aiguillage_lib_etat_retour' ),
    array( "db" => "sca1.lib_commande_acces as ctr_aiguillage_lib_commande_acces", "dt" => 'ctr_aiguillage_lib_commande_acces' ),
    array( "db" => "sgf1.lib_go_ft as ctr_aiguillage_lib_go_ft", "dt" => 'ctr_aiguillage_lib_go_ft' ),
    array( "db" => "scp2.lib_controle_plan as ctr_tirage_lib_controle_plan", "dt" => 'ctr_tirage_lib_controle_plan' ),
    array( "db" => "ot2.type_ot as ctr_tirage_ordre_de_travail", "dt" => 'ctr_tirage_ordre_de_travail' ),
    array( "db" => "ser2.lib_etat_retour as ctr_tirage_lib_etat_retour", "dt" => 'ctr_tirage_lib_etat_retour' ),
    array( "db" => "scp3.lib_controle_plan as ctr_raccord_lib_controle_plan", "dt" => 'ctr_raccord_lib_controle_plan' ),
    array( "db" => "ot3.type_ot as ctr_raccord_ordre_de_travail", "dt" => 'ctr_raccord_ordre_de_travail' ),
    array( "db" => "ser3.lib_etat_retour as ctr_raccord_lib_etat_retour", "dt" => 'ctr_raccord_lib_etat_retour' ),
    array( "db" => "so2.lib_ok as cdi_design_lib_ok", "dt" => 'cdi_design_lib_ok' ),
    array( "db" => "scp4.lib_controle_plan as cdi_raccord_lib_controle_plan", "dt" => 'cdi_raccord_lib_controle_plan' ),
    array( "db" => "ot4.type_ot as cdi_raccord_ordre_de_travail", "dt" => 'cdi_raccord_ordre_de_travail' ),
    array( "db" => "ser4.lib_etat_retour as cdi_raccord_lib_etat_retour", "dt" => 'cdi_raccord_lib_etat_retour' ),
    array( "db" => "sca2.lib_commande_acces as cdi_aiguillage_lib_commande_acces", "dt" => 'cdi_aiguillage_lib_commande_acces' ),
    array( "db" => "sgf2.lib_go_ft as cdi_aiguillage_lib_go_ft", "dt" => 'cdi_aiguillage_lib_go_ft' ),
    array( "db" => "scp5.lib_controle_plan as cdi_tirage_lib_controle_plan", "dt" => 'cdi_tirage_lib_controle_plan' ),
    array( "db" => "ot5.type_ot as cdi_tirage_ordre_de_travail", "dt" => 'cdi_tirage_ordre_de_travail' ),
    array( "db" => "ser5.lib_etat_retour as cdi_tirage_lib_etat_retour", "dt" => 'cdi_tirage_lib_etat_retour' ),
    array( "db" => "scp6.lib_controle_plan as cdi_raccord_lib_controle_plan", "dt" => 'cdi_raccord_lib_controle_plan' ),
    array( "db" => "ot6.type_ot as cdi_raccord_ordre_de_travail", "dt" => 'cdi_raccord_ordre_de_travail' ),
    array( "db" => "ser6.lib_etat_retour as cdi_raccord_lib_etat_retour", "dt" => 'cdi_raccord_lib_etat_retour' ),
);

$condition = "t1.id_projet=t2.id_projet AND t2.id_nro=t3.id_nro";

switch($connectedProfil->profil->profil->shortlib) {

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


if(isset($idp) && !empty($idp)) {

    $condition .= " AND t1.id_projet = $idp";

}

$left = "left join sous_projet_zone t4 on t1.id_sous_projet = t4.id_sous_projet";

$left .= " left join sous_projet_transport_design t5 left join select_ok so1 on t5.ok=so1.id_ok on t1.id_sous_projet = t5.id_sous_projet";

$left .= " left join sous_projet_transport_aiguillage t6 left join select_controle_plan scp1 on t6.controle_plans=scp1.id_controle_plan left join ordre_de_travail ot1 on t6.id_sous_projet=ot1.id_sous_projet and ot1.id_type_ordre_travail = 1 left join select_etat_retour ser1 on t6.etat_retour=ser1.id_etat_retour on t1.id_sous_projet = t6.id_sous_projet";

$left .= " left join sous_projet_transport_commande_ctr t7 left join select_commande_acces sca1 on t7.commandes_acces = sca1.id_commande_acces left join select_go_ft sgf1 on t7.go_ft=sgf1.id_go_ft on t1.id_sous_projet = t7.id_sous_projet";

$left .= " left join sous_projet_transport_tirage t8 left join select_controle_plan scp2 on t8.controle_plans=scp2.id_controle_plan left join ordre_de_travail ot2 on t8.id_sous_projet=ot2.id_sous_projet and ot2.id_type_ordre_travail IN (2,4) left join select_etat_retour ser2 on t8.etat_retour=ser2.id_etat_retour on t1.id_sous_projet = t8.id_sous_projet";

$left .= " left join sous_projet_transport_raccordements t9 left join select_controle_plan scp3 on t9.controle_plans=scp3.id_controle_plan left join ordre_de_travail ot3 on t9.id_sous_projet=ot3.id_sous_projet and ot3.id_type_ordre_travail IN (3,4) left join select_etat_retour ser3 on t9.etat_retour=ser3.id_etat_retour on t1.id_sous_projet = t9.id_sous_projet";

$left .= " left join sous_projet_distribution_design t10 left join select_ok so2 on t10.ok=so2.id_ok on t1.id_sous_projet = t10.id_sous_projet";

$left .= " left join sous_projet_distribution_aiguillage t11 left join select_controle_plan scp4 on t11.controle_plans=scp4.id_controle_plan left join ordre_de_travail ot4 on t11.id_sous_projet=ot4.id_sous_projet and ot4.id_type_ordre_travail = 5 left join select_etat_retour ser4 on t11.etat_retour=ser4.id_etat_retour on t1.id_sous_projet = t11.id_sous_projet";

$left .= " left join sous_projet_distribution_commande_cdi t12 left join select_commande_acces sca2 on t12.commandes_acces = sca2.id_commande_acces left join select_go_ft sgf2 on t12.go_ft=sgf2.id_go_ft on t1.id_sous_projet = t12.id_sous_projet";

$left .= " left join sous_projet_distribution_tirage t13 left join select_controle_plan scp5 on t13.controle_plans=scp5.id_controle_plan left join ordre_de_travail ot5 on t13.id_sous_projet=ot5.id_sous_projet and ot5.id_type_ordre_travail IN (6,8) left join select_etat_retour ser5 on t13.etat_retour=ser5.id_etat_retour on t1.id_sous_projet = t13.id_sous_projet";

$left .= " left join sous_projet_distribution_raccordements t14 left join select_controle_plan scp6 on t14.controle_plans=scp6.id_controle_plan left join ordre_de_travail ot6 on t14.id_sous_projet=ot6.id_sous_projet and ot6.id_type_ordre_travail IN (7,8) left join select_etat_retour ser6 on t14.etat_retour=ser6.id_etat_retour on t1.id_sous_projet = t14.id_sous_projet";

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_sous_projet",$columns,$condition,$left));
?>