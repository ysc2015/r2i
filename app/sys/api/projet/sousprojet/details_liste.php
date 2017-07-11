<?php
/**
 * file: details_liste.php
 * User: rabii
 */

extract($_POST);

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
    array( "db" => "t1.is_master", "dt" => 'is_master' ),
    array( "db" => "t2.id_nro", "dt" => 'id_nro' ),
    array( "db" => "t3.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t4.lr", "dt" => 'lr' ),
    array( "db" => "t4.lr_sur_pm", "dt" => 'lr_sur_pm' ),
    //array( "db" => "so1.lib_ok as ctr_design_lib_ok", "dt" => 'ctr_design_lib_ok' ),
    array( "db" => "t5.ok as ctr_design_lib_ok", "dt" => 'ctr_design_lib_ok' ),
    array( "db" => "scp1.lib_controle_plan as ctr_aiguillage_lib_controle_plan", "dt" => 'ctr_aiguillage_lib_controle_plan' ),
    array( "db" => "ot1.type_ot as ctr_aiguillage_ordre_de_travail", "dt" => 'ctr_aiguillage_ordre_de_travail' ),
    array( "db" => "ot1.date_debut as ctr_aiguillage_ordre_de_travail_date_debut", "dt" => 'ctr_aiguillage_ordre_de_travail_date_debut' ),
    array( "db" => "ot1.date_fin as ctr_aiguillage_ordre_de_travail_date_fin", "dt" => 'ctr_aiguillage_ordre_de_travail_date_fin' ),
    array( "db" => "ser1.lib_etat_retour as ctr_aiguillage_lib_etat_retour", "dt" => 'ctr_aiguillage_lib_etat_retour' ),
    //array( "db" => "t6.date_retour as ctr_aiguillage_date_retour", "dt" => 'ctr_aiguillage_date_retour' ),
    array( "db" => "olsu1.date_retour as ctr_aiguillage_date_retour", "dt" => 'ctr_aiguillage_date_retour' ),
    array( "db" => "bpu1.bp_no_resolu as ctr_aiguillage_bp_no_resolu", "dt" => 'ctr_aiguillage_bp_no_resolu' ),
    //array( "db" => "sota.lib_ok as ctr_aiguillage_lib_ok", "dt" => 'ctr_aiguillage_lib_ok' ),
    array( "db" => "t6.ok as ctr_aiguillage_ok", "dt" => 'ctr_aiguillage_ok' ),

    array( "db" => "t7.ref_commande_acces", "dt" => 'ref_commande_acces' ),
    array( "db" => "t7.traitement_retour_terrain", "dt" => 'traitement_retour_terrain' ),
    array( "db" => "sca1.lib_commande_acces as ctr_aiguillage_lib_commande_acces", "dt" => 'ctr_aiguillage_lib_commande_acces' ),
    array( "db" => "sgf1.lib_go_ft as ctr_aiguillage_lib_go_ft", "dt" => 'ctr_aiguillage_lib_go_ft' ),
    //array( "db" => "sotc.lib_ok as ctr_commande_acces_lib_ok", "dt" => 'ctr_commande_acces_lib_ok' ),
    array( "db" => "t7.ok as ctr_commande_acces_ok", "dt" => 'ctr_commande_acces_ok' ),

    array( "db" => "t77.ref_commande_fin_travaux", "dt" => 'ref_commande_fin_travaux' ),
    array( "db" => "sca11.lib_commande_acces as ctr_aiguillage_lib_commande_acces2", "dt" => 'ctr_aiguillage_lib_commande_acces2' ),
    array( "db" => "sgf11.lib_go_ft as ctr_aiguillage_lib_go_ft2", "dt" => 'ctr_aiguillage_lib_go_ft2' ),

    array( "db" => "t8.date_ret_prevue as ctr_tirage_date_ret_prevue", "dt" => 'ctr_tirage_date_ret_prevue' ),
    array( "db" => "t8.date_charge_be as ctr_tirage_date_charge_be", "dt" => 'ctr_tirage_date_charge_be' ),
    array( "db" => "scp2.lib_controle_plan as ctr_tirage_lib_controle_plan", "dt" => 'ctr_tirage_lib_controle_plan' ),
    array( "db" => "ot2.type_ot as ctr_tirage_ordre_de_travail", "dt" => 'ctr_tirage_ordre_de_travail' ),
    array( "db" => "ot2.date_debut as ctr_tirage_ordre_de_travail_date_debut", "dt" => 'ctr_tirage_ordre_de_travail_date_debut' ),
    array( "db" => "ot2.date_fin as ctr_tirage_ordre_de_travail_date_fin", "dt" => 'ctr_tirage_ordre_de_travail_date_fin' ),
    //array( "db" => "t8.date_retour as ctr_tirage_date_retour", "dt" => 'ctr_tirage_date_retour' ),
    array( "db" => "t8.date_retour as ctr_tirage_date_retour", "dt" => 'ctr_tirage_date_retour' ),
    array( "db" => "ser2.lib_etat_retour as ctr_tirage_lib_etat_retour", "dt" => 'ctr_tirage_lib_etat_retour' ),
    array( "db" => "bpu2.bp_no_resolu as ctr_tirage_bp_no_resolu", "dt" => 'ctr_tirage_bp_no_resolu' ),
    //array( "db" => "sott.lib_ok as ctr_tirage_lib_ok", "dt" => 'ctr_tirage_lib_ok' ),
    array( "db" => "t8.ok as ctr_tirage_ok", "dt" => 'ctr_tirage_ok' ),

    array( "db" => "t9.date_ret_prevue as ctr_raccord_date_ret_prevue", "dt" => 'ctr_raccord_date_ret_prevue' ),
    array( "db" => "t9.date_charge_be as ctr_raccord_date_charge_be", "dt" => 'ctr_raccord_date_charge_be' ),
    array( "db" => "scp3.lib_controle_plan as ctr_raccord_lib_controle_plan", "dt" => 'ctr_raccord_lib_controle_plan' ),
    array( "db" => "ot3.type_ot as ctr_raccord_ordre_de_travail", "dt" => 'ctr_raccord_ordre_de_travail' ),
    array( "db" => "ot3.date_debut as ctr_raccord_ordre_de_travail_date_debut", "dt" => 'ctr_raccord_ordre_de_travail_date_debut' ),
    array( "db" => "ot3.date_fin as ctr_raccord_ordre_de_travail_date_fin", "dt" => 'ctr_raccord_ordre_de_travail_date_fin' ),
    //array( "db" => "t9.date_retour as ctr_raccord_date_retour", "dt" => 'ctr_raccord_date_retour' ),
    array( "db" => "olsu3.date_retour as ctr_raccord_date_retour", "dt" => 'ctr_raccord_date_retour' ),
    array( "db" => "ser3.lib_etat_retour as ctr_raccord_lib_etat_retour", "dt" => 'ctr_raccord_lib_etat_retour' ),
    array( "db" => "bpu3.bp_no_resolu as ctr_raccord_bp_no_resolu", "dt" => 'ctr_raccord_bp_no_resolu' ),
    //array( "db" => "sotr.lib_ok as ctr_raccord_lib_ok", "dt" => 'ctr_raccord_lib_ok' ),
    array( "db" => "t9.ok as ctr_raccord_ok", "dt" => 'ctr_raccord_ok' ),

    array( "db" => "so2.lib_ok as cdi_design_lib_ok", "dt" => 'cdi_design_lib_ok' ),
    array( "db" => "scp4.lib_controle_plan as cdi_aiguillage_lib_controle_plan", "dt" => 'cdi_aiguillage_lib_controle_plan' ),
    array( "db" => "ot4.type_ot as cdi_aiguillage_ordre_de_travail", "dt" => 'cdi_aiguillage_ordre_de_travail' ),
    array( "db" => "ot4.date_debut as cdi_aiguillage_ordre_de_travail_date_debut", "dt" => 'cdi_aiguillage_ordre_de_travail_date_debut' ),
    array( "db" => "ot4.date_fin as cdi_aiguillage_ordre_de_travail_date_fin", "dt" => 'cdi_aiguillage_ordre_de_travail_date_fin' ),
    //array( "db" => "t11.date_retour as cdi_aiguillage_date_retour", "dt" => 'cdi_aiguillage_date_retour' ),
    array( "db" => "olsu4.date_retour as cdi_aiguillage_date_retour", "dt" => 'cdi_aiguillage_date_retour' ),
    array( "db" => "ser4.lib_etat_retour as cdi_aiguillage_lib_etat_retour", "dt" => 'cdi_aiguillage_lib_etat_retour' ),
    array( "db" => "bpu4.bp_no_resolu as cdi_aiguillage_bp_no_resolu", "dt" => 'cdi_aiguillage_bp_no_resolu' ),
    //array( "db" => "soda.lib_ok as cdi_aiguillage_lib_ok", "dt" => 'cdi_aiguillage_lib_ok' ),
    array( "db" => "t11.ok as cdi_aiguillage_ok", "dt" => 'cdi_aiguillage_ok' ),

    array( "db" => "t12.traitement_retour_terrain as traitement_retour_terrain2", "dt" => 'traitement_retour_terrain2' ),
    array( "db" => "t12.ref_commande_acces as ref_commande_acces2", "dt" => 'ref_commande_acces2' ),
    array( "db" => "sca2.lib_commande_acces as cdi_aiguillage_lib_commande_acces", "dt" => 'cdi_aiguillage_lib_commande_acces' ),
    array( "db" => "sgf2.lib_go_ft as cdi_aiguillage_lib_go_ft", "dt" => 'cdi_aiguillage_lib_go_ft' ),
    //array( "db" => "sodc.lib_ok as cdi_commande_acces_lib_ok", "dt" => 'cdi_commande_acces_lib_ok' ),
    array( "db" => "t12.ok as cdi_commande_acces_ok", "dt" => 'cdi_commande_acces_ok' ),

    array( "db" => "t122.ref_commande_fin_travaux as ref_commande_fin_travaux2", "dt" => 'ref_commande_fin_travaux2' ),
    array( "db" => "sca22.lib_commande_acces as cdi_aiguillage_lib_commande_acces22", "dt" => 'cdi_aiguillage_lib_commande_acces22' ),
    array( "db" => "sgf22.lib_go_ft as cdi_aiguillage_lib_go_ft22", "dt" => 'cdi_aiguillage_lib_go_ft22' ),

    array( "db" => "t13.date_ret_prevue as cdi_tirage_date_ret_prevue", "dt" => 'cdi_tirage_date_ret_prevue' ),
    array( "db" => "t13.date_ret_prevue as cdi_tirage_date_ret_prevue", "dt" => 'cdi_tirage_date_ret_prevue' ),
    array( "db" => "t13.date_charge_be as cdi_tirage_date_charge_be", "dt" => 'cdi_tirage_date_charge_be' ),
    array( "db" => "scp5.lib_controle_plan as cdi_tirage_lib_controle_plan", "dt" => 'cdi_tirage_lib_controle_plan' ),
    array( "db" => "ot5.type_ot as cdi_tirage_ordre_de_travail", "dt" => 'cdi_tirage_ordre_de_travail' ),
    array( "db" => "ot5.date_debut as cdi_tirage_ordre_de_travail_date_debut", "dt" => 'cdi_tirage_ordre_de_travail_date_debut' ),
    array( "db" => "ot5.date_fin as cdi_tirage_ordre_de_travail_date_fin", "dt" => 'cdi_tirage_ordre_de_travail_date_fin' ),
    array( "db" => "t13.date_retour as cdi_tirage_date_retour", "dt" => 'cdi_tirage_date_retour' ),
    array( "db" => "ser5.lib_etat_retour as cdi_tirage_lib_etat_retour", "dt" => 'cdi_tirage_lib_etat_retour' ),
    array( "db" => "bpu5.bp_no_resolu as cdi_tirage_bp_no_resolu", "dt" => 'cdi_tirage_bp_no_resolu' ),
    //array( "db" => "sodt.lib_ok as cdi_tirage_lib_ok", "dt" => 'cdi_tirage_lib_ok' ),
    array( "db" => "t13.ok as cdi_tirage_ok", "dt" => 'cdi_tirage_ok' ),

    array( "db" => "t14.date_ret_prevue as cdi_raccord_date_ret_prevue", "dt" => 'cdi_raccord_date_ret_prevue' ),
    array( "db" => "t14.date_charge_be as cdi_raccord_date_charge_be", "dt" => 'cdi_raccord_date_charge_be' ),
    array( "db" => "scp6.lib_controle_plan as cdi_raccord_lib_controle_plan", "dt" => 'cdi_raccord_lib_controle_plan' ),
    array( "db" => "ot6.type_ot as cdi_raccord_ordre_de_travail", "dt" => 'cdi_raccord_ordre_de_travail' ),
    array( "db" => "ot6.date_debut as cdi_raccord_ordre_de_travail_date_debut", "dt" => 'cdi_raccord_ordre_de_travail_date_debut' ),
    array( "db" => "ot6.date_fin as cdi_raccord_ordre_de_travail_date_fin", "dt" => 'cdi_raccord_ordre_de_travail_date_fin' ),
    array( "db" => "t14.date_retour as cdi_raccord_date_retour", "dt" => 'cdi_raccord_date_retour' ),
    array( "db" => "ser6.lib_etat_retour as cdi_raccord_lib_etat_retour", "dt" => 'cdi_raccord_lib_etat_retour' ),
    array( "db" => "bpu6.bp_no_resolu as cdi_raccord_bp_no_resolu", "dt" => 'cdi_raccord_bp_no_resolu' ),
    array( "db" => "t14.ok as cdi_raccord_ok", "dt" => 'cdi_raccord_ok' ),

    array( "db" => "trec.lib_injection_netgeo as ctr_recette_injection_netgeo", "dt" => 'ctr_recette_injection_netgeo' ),
    array( "db" => "drec.lib_injection_netgeo as cdi_recette_injection_netgeo", "dt" => 'cdi_recette_injection_netgeo' ),
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

$left .= " left join sous_projet_transport_design t5 on t1.id_sous_projet = t5.id_sous_projet";//left join sous_projet_transport_design t5 left join select_ok so1 on t5.ok=so1.id_ok on t1.id_sous_projet = t5.id_sous_projet
//left join ot_last_stt_upload olsu1 on ot1.id_ordre_de_travail = olsu1.id_ordre_de_travail and olsu1.id_type_ordre_travail = 1
$left .= " left join sous_projet_transport_aiguillage t6 left join select_controle_plan scp1 on t6.controle_plans=scp1.id_controle_plan left join ordre_de_travail ot1 left join ot_last_stt_upload olsu1 on ot1.id_ordre_de_travail = olsu1.id_ordre_de_travail and olsu1.id_type_ordre_travail = 1 left join blq_pbc_unresolved bpu1 on ot1.id_ordre_de_travail = bpu1.id_ordre_de_travail on t6.id_sous_projet=ot1.id_sous_projet and ot1.id_type_ordre_travail = 1 left join select_etat_retour ser1 on t6.etat_retour=ser1.id_etat_retour on t1.id_sous_projet = t6.id_sous_projet";

$left .= " left join sous_projet_transport_commande_ctr t7 left join select_commande_acces sca1 on t7.commandes_acces = sca1.id_commande_acces left join select_go_ft sgf1 on t7.go_ft=sgf1.id_go_ft on t1.id_sous_projet = t7.id_sous_projet";

$left .= " left join sous_projet_transport_commande_fin_travaux t77 left join select_commande_acces sca11 on t77.commandes_fin_travaux = sca11.id_commande_acces left join select_go_ft sgf11 on t77.go_ft=sgf11.id_go_ft on t1.id_sous_projet = t77.id_sous_projet";

$left .= " left join sous_projet_transport_tirage t8 left join select_controle_plan scp2 on t8.controle_plans=scp2.id_controle_plan left join ordre_de_travail ot2 left join ot_last_stt_upload olsu2 on ot2.id_ordre_de_travail = olsu2.id_ordre_de_travail and olsu2.id_type_ordre_travail IN (2,4) left join blq_pbc_unresolved bpu2 on ot2.id_ordre_de_travail = bpu2.id_ordre_de_travail on t8.id_sous_projet=ot2.id_sous_projet and ot2.id_type_ordre_travail IN (2,4) left join select_etat_retour ser2 on t8.etat_retour=ser2.id_etat_retour on t1.id_sous_projet = t8.id_sous_projet";

$left .= " left join sous_projet_transport_raccordements t9 left join select_controle_plan scp3 on t9.controle_plans=scp3.id_controle_plan left join ordre_de_travail ot3 left join ot_last_stt_upload olsu3 on ot3.id_ordre_de_travail = olsu3.id_ordre_de_travail and olsu3.id_type_ordre_travail IN (3,4) left join blq_pbc_unresolved bpu3 on ot3.id_ordre_de_travail = bpu3.id_ordre_de_travail on t9.id_sous_projet=ot3.id_sous_projet and ot3.id_type_ordre_travail IN (3,4) left join select_etat_retour ser3 on t9.etat_retour=ser3.id_etat_retour on t1.id_sous_projet = t9.id_sous_projet";

$left .= " left join sous_projet_distribution_design t10 left join select_ok so2 on t10.ok=so2.id_ok on t1.id_sous_projet = t10.id_sous_projet";

$left .= " left join sous_projet_distribution_aiguillage t11 left join select_controle_plan scp4 on t11.controle_plans=scp4.id_controle_plan left join ordre_de_travail ot4 left join ot_last_stt_upload olsu4 on ot4.id_ordre_de_travail = olsu4.id_ordre_de_travail and olsu4.id_type_ordre_travail = 5 left join blq_pbc_unresolved bpu4 on ot4.id_ordre_de_travail = bpu4.id_ordre_de_travail on t11.id_sous_projet=ot4.id_sous_projet and ot4.id_type_ordre_travail = 5 left join select_etat_retour ser4 on t11.etat_retour=ser4.id_etat_retour on t1.id_sous_projet = t11.id_sous_projet";

$left .= " left join sous_projet_distribution_commande_cdi t12 left join select_commande_acces sca2 on t12.commandes_acces = sca2.id_commande_acces left join select_go_ft sgf2 on t12.go_ft=sgf2.id_go_ft on t1.id_sous_projet = t12.id_sous_projet";

$left .= " left join sous_projet_distribution_commande_fin_travaux t122 left join select_commande_acces sca22 on t122.commandes_fin_travaux = sca22.id_commande_acces left join select_go_ft sgf22 on t122.go_ft=sgf22.id_go_ft on t1.id_sous_projet = t122.id_sous_projet";

$left .= " left join sous_projet_distribution_tirage t13 left join select_controle_plan scp5 on t13.controle_plans=scp5.id_controle_plan left join ordre_de_travail ot5 left join blq_pbc_unresolved bpu5 on ot5.id_ordre_de_travail = bpu5.id_ordre_de_travail on t13.id_sous_projet=ot5.id_sous_projet and ot5.id_type_ordre_travail IN (6,8) left join select_etat_retour ser5 on t13.etat_retour=ser5.id_etat_retour on t1.id_sous_projet = t13.id_sous_projet";

$left .= " left join sous_projet_distribution_raccordements t14 left join select_controle_plan scp6 on t14.controle_plans=scp6.id_controle_plan left join ordre_de_travail ot6 left join blq_pbc_unresolved bpu6 on ot6.id_ordre_de_travail = bpu6.id_ordre_de_travail on t14.id_sous_projet=ot6.id_sous_projet and ot6.id_type_ordre_travail IN (7,8) left join select_etat_retour ser6 on t14.etat_retour=ser6.id_etat_retour on t1.id_sous_projet = t14.id_sous_projet";//left join select_ok sodr on t14.ok=sodr.id_ok

$left .= " left join sous_projet_transport_recette t15 left join select_injection_netgeo trec on t15.injection_netgeo=trec.id_injection_netgeo on t1.id_sous_projet = t15.id_sous_projet";

$left .= " left join sous_projet_distribution_recette t16 left join select_injection_netgeo drec on t16.injection_netgeo=drec.id_injection_netgeo on t1.id_sous_projet = t16.id_sous_projet";


echo json_encode(SSP::simpleJoin($_POST,$db,$table,"id_sous_projet",$columns,$condition,$left));
?>