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
    array( "db" => "u.prenom_utilisateur", "dt" => 'prenom_utilisateur' )

);

$condition = "t1.id_sous_projet=t2.id_sous_projet";
$condition .= " AND t1.id_sous_projet=".$id_sous_projet;
$condition .= " AND t1.id_avancement_netgeo=t3.id_avancement_netgeo";



$left = "left join utilisateur u on t1.id_createur = u.id_utilisateur";


echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_ordre_de_travail",$columns,$condition,$left));
?>