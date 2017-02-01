<?php
/**
 * file: info_pblq_liste.php
 * User: rabii
 */

extract($_GET);

$table = array("traitement_pbt as t1","point_bloquant as t2");

$columns = array(
    array( "db" => "t1.id_traitement_pbt", "dt" => 'id_traitement_pbt' ),
    array( "db" => "t1.id_point_bloquant", "dt" => 'id_point_bloquant' ),
    array( "db" => "t1.ville", "dt" => 'ville' ),
    array( "db" => "t1.planches", "dt" => 'planches' ),
    array( "db" => "t1.chambre1", "dt" => 'chambre1' ),
    array( "db" => "t1.chambre2", "dt" => 'chambre2' ),
    array( "db" => "t1.date_creation", "dt" => 'date_creation' ),
    array( "db" => "t1.id_pci_user", "dt" => 'id_pci_user' ),
    array( "db" => "t1.id_bei_user", "dt" => 'id_bei_user' ),
    array( "db" => "t1.id_type_traitement_pbt", "dt" => 'id_type_traitement_pbt' ),
    array( "db" => "t1.commentaire", "dt" => 'commentaire' ),
    array( "db" => "t1.date_rendu", "dt" => 'date_rendu' ),
    array( "db" => "t1.id_solution_traitement_pbt", "dt" => 'id_solution_traitement_pbt' ),
    array( "db" => "t1.id_entreprise", "dt" => 'id_entreprise' ),
    array( "db" => "u.prenom_utilisateur", "dt" => 'prenom_utilisateur' ),
    array( "db" => "u.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "u2.prenom_utilisateur as prenom_utilisateur2", "dt" => 'prenom_utilisateur2' ),
    array( "db" => "u2.nom_utilisateur as nom_utilisateur2", "dt" => 'nom_utilisateur2' ),
);

$condition = "t1.id_point_bloquant=t2.id_point_bloquant";

if(isset($idpblq) && $idpblq > 0) {
    $condition .= " AND t1.id_point_bloquant=$idpblq";
}

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_traitement_pbt",$columns,$condition,"left join utilisateur as u on t1.id_pci_user=u.id_utilisateur left join utilisateur as u2 on t1.id_bei_user=u2.id_utilisateur"));
?>