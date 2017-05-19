<?php
/**
 * Created by PhpStorm.
 * User: fadil
 * Date: 10/05/17
 * Time: 04:41 م
 */
extract($_POST);
//Liste des CDI pour lesquels le design est terminé mais pour lesquels les plans d’aiguillage ne sont pas « Contrôlés OK » ou « Lien vers les plans » est vide.

$table = array("sous_projet as t1","projet as t2","nro as t3","`sous_projet_distribution_design` as t5","`sous_projet_distribution_aiguillage` as t9" );
$columns = array(
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.id_projet", "dt" => 'id_projet' ),
    array( "db" => "t1.dep", "dt" => 'dep' ),
    array( "db" => "t1.ville", "dt" => 'ville' ),
    array( "db" => "t1.plaque", "dt" => 'plaque' ),
    array( "db" => "t1.zone", "dt" => 'zone' ),
    array( "db" => "t3.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t3.id_nro", "dt" => 'id_nro' ),
    array( "db" => "t5.date_fin", "dt" => 'date_fin' ),
    array( "db" => "t7.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "t7.prenom_utilisateur", "dt" => 'prenom_utilisateur' )
);
$condition  = " t1.id_projet=t2.id_projet AND t2.id_nro=t3.id_nro ";
$condition .= " AND t1.id_sous_projet=t5.id_sous_projet ";
$condition .= " AND t1.id_sous_projet=t9.id_sous_projet ";
$condition .= " AND t5.ok = 1 ";
$condition .= " AND t9.plans = 3 ";
$condition .= " AND (t9.controle_plans != 2 || t9.lien_plans = '' ) ";
$condition .= " group by t1.id_sous_projet";



$left = " LEFT JOIN `nro_utilisateur` as t6 on t6.id_nro =  t3.id_nro ";
$left .= " LEFT JOIN utilisateur as t7 on t7.id_utilisateur = t6.id_utilisateur ";
$left .= " LEFT JOIN profil_utilisateur as t8 on  t8.id_profil_utilisateur=t7.id_profil_utilisateur and t8.id_profil_utilisateur=4 ";

echo json_encode(@SSP::simpleJoin($_POST,$db,$table,"id_sous_projet",$columns,$condition,$left));
?>