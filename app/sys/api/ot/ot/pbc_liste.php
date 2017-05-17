<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 16/05/2017
 * Time: 16:13
 */

extract($_GET);

$table = array("blq_pbc as t1","ordre_de_travail as t2","sous_projet as t3","projet as t4");
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
    array( "db" => "t1.statut", "dt" => 'statut' ),
    array( "db" => "t2.type_ot", "dt" => 'type_ot' ),
);

$condition = "t1.id_ordre_de_travail = t2.id_ordre_de_travail AND t2.id_sous_projet = t3.id_sous_projet AND t3.id_projet = t4.id_projet";

/*if(isset($idot)) {
    $condition .=" AND t1.id_ordre_de_travail=$idot";
}*/

if(isset($type)) {
    $condition .=" AND t1.type=$type";
}

switch($req) {
    case "1" ://Avec réponse
        $condition .= " AND (REPLACE(t1.reponse_ajustement, ' ', '') <> '' AND t1.reponse_ajustement IS NOT NULL) ";
        break;
    case "2" ://Sans réponse
        $condition .= " AND (REPLACE(t1.reponse_ajustement, ' ', '') = '' OR t1.reponse_ajustement IS NULL) ";
        break;
    case "3" ://Résolus
        $condition .=" AND t1.statut = 1";
        break;

    default :
        $condition .=" AND t1.id_blq_pbc = -1";
        break;
}

switch($connectedProfil->profil->profil->shortlib) {
    case "stt" :
        $condition .=" AND t2.id_entreprise = ".$connectedProfil->profil->id_entreprise;
        /*$condition .=" AND t2.backlog <> 1 ";
        $condition .=" AND t2.id_etat_ot IN(3,4,5,6,8) ";*/
        break;
    case "pci" :
        $table[] = "nro_utilisateur as t6";
        $condition .=" AND t4.id_nro = t6.id_nro AND t6.id_utilisateur = ".$connectedProfil->profil->id_utilisateur;
        /*$condition .=" AND t2.backlog <> 1 ";
        $condition .=" AND t2.id_etat_ot IN(2,3,4,5,6,8) ";*/
        break;
    case "vpi" :
        $table[] = "nro as t6";
        $condition .=" AND t4.id_nro = t6.id_nro AND t6.id_utilisateur = ".$connectedProfil->profil->id_utilisateur;
        /*$condition .=" AND t2.backlog <> 1 ";
        $condition .=" AND t2.id_etat_ot IN(2,3,4,5,6,8) ";*/
        break;

    default : break;
}

/*if(isset($rep) && !empty($rep)) {

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

}*/

$left = "left join utilisateur u on t1.id_createur = u.id_utilisateur";


echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_ordre_de_travail",$columns,$condition,$left));
?>