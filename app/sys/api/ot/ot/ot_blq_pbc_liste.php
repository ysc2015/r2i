<?php
/**
 * file: ot_blq_pbc_liste.php
 * User: rabii
 */

extract($_GET);

$table = array("blq_pbc as t1","ordre_de_travail as t2");
$columns = array(
    array( "db" => "t1.id_blq_pbc", "dt" => 'id_blq_pbc' ),
    array( "db" => "t1.id_ordre_de_travail", "dt" => 'id_ordre_de_travail' ),
    array( "db" => "t1.type", "dt" => 'type' ),
    array( "db" => "t1.snake", "dt" => 'snake' ),
    array( "db" => "t1.planche_a3", "dt" => 'planche_a3' ),
    array( "db" => "t1.chambre_amont", "dt" => 'chambre_amont' ),
    array( "db" => "t1.chambre_aval", "dt" => 'chambre_aval' ),
    array( "db" => "t1.question_information", "dt" => 'question_information' ),
    array( "db" => "t1.reponse_ajustement", "dt" => 'reponse_ajustement' ),
    array( "db" => "u.nom_utilisateur", "dt" => 'nom_utilisateur' ),
    array( "db" => "u.prenom_utilisateur", "dt" => 'prenom_utilisateur' ),
    array( "db" => "t1.statut", "dt" => 'statut' )
);

$condition = "t1.id_ordre_de_travail=t2.id_ordre_de_travail";

if(isset($idot) && isset($type)) {
    $condition .=" AND t1.id_ordre_de_travail=$idot AND t1.type=$type";
}

/*if(isset($nr)) { replaced but last update : filter avec rep, sans rep, resolus, non reolus ,...
    $condition .=" AND t1.statut <> 1";
}*/

if(isset($rep) && !empty($rep)) {

    switch($rep) {

        case "1" : $condition .= " AND (REPLACE(t1.reponse_ajustement, ' ', '') = '' OR t1.reponse_ajustement IS NULL) ";
            break;
        case "2" : $condition .= " AND (REPLACE(t1.reponse_ajustement, ' ', '') <> '' AND t1.reponse_ajustement IS NOT NULL) ";
            break;

        default : break;
    }

}

if(isset($resol) && !empty($resol)) {

    switch($resol) {

        case "1" : $condition .=" AND t1.statut = 1";
            break;
        case "2" : $condition .=" AND t1.statut <> 1";
            break;

        default : break;
    }

}

$left = "left join utilisateur u on t1.id_createur = u.id_utilisateur";


echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_ordre_de_travail",$columns,$condition,$left));
?>