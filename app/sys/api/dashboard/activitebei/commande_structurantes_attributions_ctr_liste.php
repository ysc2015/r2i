<?php
/**
 * Created by PhpStorm.
 * User: fadil
 * Date: 10/05/17
 * Time: 04:41 م
 */
extract($_POST);

 $tat = get_date_to_compare_ouvre(date('Y-m-d'),2);
$date_plus_2_jours = $tat->format('Y-m-d');


$table = array("retour_presta_sans_intervenant_ctr as t1");
$columns = array(
    array( "db" => "t1.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t1.zone", "dt" => 'zone' ),
    array( "db" => "t1.idsp", "dt" => 'idsp' ),
    array( "db" => "t1.date_r_p_j_p2", "dt" => 'date_r_p_j_p2' ),
    array( "db" => "t1.etape", "dt" => 'etape' ),
    array( "db" => "t1.type", "dt" => 'type' ),
    array( "db" => "t1.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t1.prenom_utilisateur", "dt" => 'prenom_utilisateur' )
);


$condition = " 1 group by t1.idsp ";


echo json_encode(@SSP::simpleJoin($_POST,$db,$table,"idsp",$columns,$condition,$left));
?>