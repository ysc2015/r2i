<?php
/**
 * Created by PhpStorm.
 * User: fadil
 * Date: 10/05/17
 * Time: 04:41 م
 */
extract($_POST);
function get_date_to_compare_ouvre($interval){
    $date_to_day_plus_4_ouver = null;
    $increment = $interval + 2 ;
    $j = 0;
    for($i = 1 ; $i <= $increment; $i++ ){
        $date = date_create(date('Y-m-d'));
        date_add($date, date_interval_create_from_date_string($i.' days'));
        $date_to_day_plus_4_ouver  =  date_format($date, 'Y-m-d');
        $date = strtotime($date_to_day_plus_4_ouver);
        $date = date("l", $date);
        $date = strtolower($date);
        if($date == "saturday" || $date == "sunday") {
            $j++;
        }



    }
    $nbre_date_ajout = $j + $interval;
    return date_add(date_create(date('Y-m-d')), date_interval_create_from_date_string($nbre_date_ajout.' days'));
}
$tat = get_date_to_compare_ouvre(5);
$date_plus_4_jours = $tat->format('Y-m-d');


$table = array("sous_projet as t1","projet as t2","nro as t3","ordre_de_travail as t4","`sous_projet_distribution_design` as t5" );
$columns = array(
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.id_projet", "dt" => 'id_projet' ),
    array( "db" => "t2.projet_nom", "dt" => 'projet_nom' ),
    array( "db" => "t1.dep", "dt" => 'dep' ),
    array( "db" => "t1.ville", "dt" => 'ville' ),
    array( "db" => "t1.plaque", "dt" => 'plaque' ),
    array( "db" => "t1.zone", "dt" => 'zone' ),
    array( "db" => "t3.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t3.id_nro", "dt" => 'id_nro' ),
    array( "db" => "t4.date_debut", "dt" => 'date_debut' ),
    array( "db" => "t4.date_fin", "dt" => 'date_fin' ),
    array( "db" => "t7.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t7.prenom_utilisateur", "dt" => 'prenom_utilisateur' )
);
$condition  = " t1.id_projet=t2.id_projet AND t2.id_nro=t3.id_nro ";
$condition .= " AND t1.id_sous_projet=t4.id_sous_projet ";
$condition .= " AND t1.id_sous_projet=t5.id_sous_projet ";



$condition .= " AND t5.date_debut <  '".$date_plus_4_jours."' ";
$condition .= " group by t1.id_sous_projet  ";


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

$left = " LEFT JOIN `nro_utilisateur` as t6 on t6.id_nro =  t3.id_nro ";
$left .= " LEFT JOIN utilisateur as t7 on t7.id_utilisateur = t6.id_utilisateur ";
$left .= " LEFT JOIN profil_utilisateur as t8 on  t8.id_profil_utilisateur=t7.id_profil_utilisateur and t8.id_profil_utilisateur=4 ";

echo json_encode(SSP::simpleJoin($_POST,$db,$table,"id_sous_projet",$columns,$condition,$left));
?>