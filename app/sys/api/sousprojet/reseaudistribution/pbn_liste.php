<?php
/**
 * file: ot_blq_pbc_liste.php
 * User: rabii
 */

extract($_GET);

$table = array("pbn as t1","sous_projet as t2","avancement_netgeo as t3");
$columns = array(
    array( "db" => "t1.id_pbn", "dt" => 'id_pbn' ),
    array( "db" => "t1.text_pbn", "dt" => 'text_pbn' ),
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.id_createur", "dt" => 'id_createur' ),
    array( "db" => "t1.date_creation", "dt" => 'date_creation' ),
    array( "db" => "t3.titre_avancement_netgeo", "dt" => 'titre_avancement_netgeo' ),
    array( "db" => "u.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "u.prenom_utilisateur", "dt" => 'prenom_utilisateur' ),
    array( "db" => "t1.statut", "dt" => 'statut' ),
    array( "db" => "t4.id_discution", "dt" => 'id_discution' )

);

$condition = "t1.id_sous_projet=t2.id_sous_projet";
$condition .= " AND t1.id_sous_projet=".$id_sous_projet;
$condition .= " AND t1.id_avancement_netgeo=t3.id_avancement_netgeo";
$condition .= " group by t1.id_pbn ";



$left = "left join utilisateur u on t1.id_createur = u.id_utilisateur";
$left .= " left join pbn_discution t4 on t1.id_pbn = t4.id_pbn";


echo @json_encode(SSP::simpleJoin($_GET,$db,$table,"id_ordre_de_travail",$columns,$condition,$left));
?>