<?php
/**
 * file: gestion_travaux_pbc.php
 * User: rabii
 */

$table = array("ordre_de_travail as t1","sous_projet as t2","projet as t3","nro as t4","etat_ot as t5","select_type_ordre_travail as t6","entreprises_stt as t7","pci_in_nro as t8","pbc_no_rep as t9","ot_steps_nok as t10");
$columns = array(
    array( "db" => "t1.id_ordre_de_travail", "dt" => 'id_ordre_de_travail' ),
    array( "db" => "t1.type_ot", "dt" => 'type_ot' ),
    array( "db" => "t1.type_entree", "dt" => 'type_entree' ),
    array( "db" => "t5.lib_etat_ot", "dt" => 'lib_etat_ot' ),
    array( "db" => "t4.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t6.lib_type_ordre_travail", "dt" => 'lib_type_ordre_travail' ),
    array( "db" => "t8.pci", "dt" => 'pci' ),
    array( "db" => "t7.nom", "dt" => 'nom' ),
    array( "db" => "t2.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t2.zone", "dt" => 'zone' ),
    array( "db" => "t9.nbr_pbc", "dt" => 'nbr_pbc' ),
    array( "db" => "t9.date_oldest", "dt" => 'date_oldest' )
);

$condition = "t1.id_sous_projet = t2.id_sous_projet AND t1.id_ordre_de_travail = t10.id_ordre_de_travail AND t1.id_entreprise = t7.id_entreprise AND t1.id_etat_ot = t5.id_etat_ot AND t1.id_type_ordre_travail = t6.id_type_ordre_travail AND t1.id_ordre_de_travail = t9.id_ordre_de_travail AND t2.id_projet = t3.id_projet AND t3.id_nro = t4.id_nro AND t4.id_nro = t8.id_nro";

$condition .= " AND t6.system = 1";

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

        $condition .=" AND t3.id_nro IN ( ".implode(",",$arr).")";
        break;

    case "vpi" :
        $arr = array(-1);
        $stm = $db->prepare("select id_nro from nro where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
        $stm->execute();
        $nros = $stm->fetchAll();
        foreach($nros as $nro) {
            $arr[] = $nro['id_nro'];
        }

        $condition .=" AND t3.id_nro IN ( ".implode(",",$arr).")";
        break;

    default : break;
}

echo json_encode(SSP::simpleJoin($_POST,$db,$table,"id_ordre_de_travail",$columns,$condition));
?>