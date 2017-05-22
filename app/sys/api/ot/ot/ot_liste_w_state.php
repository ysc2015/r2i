<?php
/**
 * file: ot_liste_w_state.php
 * User: rabii
 */

extract($_POST);

$table = array("ordre_de_travail as t1","select_type_ordre_travail as t2","sous_projet as t3","projet as t4","nro as t5");
$columns = array(
    array( "db" => "t1.id_ordre_de_travail", "dt" => 'id_ordre_de_travail' ),
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.type_entree", "dt" => 'type_entree' ),
    array( "db" => "t1.id_entreprise", "dt" => 'id_entreprise' ),
    array( "db" => "t1.id_equipe_stt", "dt" => 'id_equipe_stt' ),
    array( "db" => "t1.type_ot", "dt" => 'type_ot' ),
    array( "db" => "t1.date_debut", "dt" => 'date_debut' ),
    array( "db" => "t1.date_fin", "dt" => 'date_fin' ),
    array( "db" => "t1.backlog", "dt" => 'backlog' ),
    array( "db" => "t1.id_type_ordre_travail", "dt" => 'id_type_ordre_travail' ),
    array( "db" => "t2.lib_type_ordre_travail", "dt" => 'lib_type_ordre_travail' ),
    array( "db" => "t1.commentaire", "dt" => 'commentaire' ),
    array( "db" => "etat.lib_etat_ot", "dt" => 'lib_etat_ot' )
);

$condition = "t1.id_type_ordre_travail=t2.id_type_ordre_travail AND t1.id_sous_projet = t3.id_sous_projet AND t3.id_projet = t4.id_projet AND t4.id_nro = t5.id_nro";

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

        $condition .=" AND t4.id_nro IN ( ".implode(",",$arr).")";
        break;

    case "vpi" :
        $arr = array(-1);
        $stm = $db->prepare("select id_nro from nro where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
        $stm->execute();
        $nros = $stm->fetchAll();
        foreach($nros as $nro) {
            $arr[] = $nro['id_nro'];
        }

        $condition .=" AND t4.id_nro IN ( ".implode(",",$arr).")";
        break;

    default : break;
}


$left = "LEFT join etat_ot as etat ON t1.id_etat_ot = etat.id_etat_ot";

echo json_encode(SSP::simpleJoin($_POST,$db,$table,"id_ordre_de_travail",$columns,$condition,$left));
?>