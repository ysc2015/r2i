<?php
/**
 * Created by PhpStorm.
 * User: fadil
 * Date: 23/05/17
 * Time: 09:41 م
 */
extract($_POST);



$table = array("sous_projet as t1","projet as t2","nro as t3","`sous_projet_distribution_commande_cdi` as t5" );
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
    array( "db" => "t5.date_transmission_ca", "dt" => 'date_transmission_ca' ),
    array( "db" => "t7.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t7.prenom_utilisateur", "dt" => 'prenom_utilisateur' )
);
$condition  = " t1.id_projet=t2.id_projet AND t2.id_nro=t3.id_nro";
$condition .= " AND t1.id_sous_projet=t5.id_sous_projet ";
$condition .= " AND ((t5.date_transmission_ca + interval 5 day) < now())";
$condition .= " AND t5.ref_commande_acces like ''  ";
$condition .= " group by t1.id_sous_projet ";


$left = " LEFT JOIN `nro_utilisateur` as t6 on t6.id_nro =  t3.id_nro ";
$left .= " LEFT JOIN utilisateur as t7 on t7.id_utilisateur = t6.id_utilisateur ";
$left .= " LEFT JOIN profil_utilisateur as t8 on  t8.id_profil_utilisateur=t7.id_profil_utilisateur and t8.id_profil_utilisateur=4 ";


echo json_encode(@SSP::simpleJoin($_POST,$db,$table,"id_sous_projet",$columns,$condition,$left));
?>