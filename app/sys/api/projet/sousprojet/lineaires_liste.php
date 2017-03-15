<?php
/**
 * file: lineaires_liste.php
 * User: rabii
 */

//extract($_GET);

$table = array(
    "sous_projet as t1",
    "projet as t2",
    "nro as t3"
);
$columns = array(
    array( "db" => "t1.id_sous_projet", "dt" => 'id_sous_projet' ),
    array( "db" => "t1.dep", "dt" => 'dep' ),
    array( "db" => "t1.ville", "dt" => 'ville' ),
    array( "db" => "t1.plaque", "dt" => 'plaque' ),
    array( "db" => "t1.zone", "dt" => 'zone' ),
    array( "db" => "t2.id_nro", "dt" => 'id_nro' ),
    array( "db" => "t3.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t4.lr", "dt" => 'lr' ),
    array( "db" => "t4.lr_sur_pm", "dt" => 'lr_sur_pm' )
);

$condition = "t1.id_projet=t2.id_projet AND t2.id_nro=t3.id_nro";

switch($connectedProfil->profil->profil->shortlib) {

    case "pci" :
    case "bei" :
        $arr = array(-1);
        $stm_bei_pci = $db->prepare("select id_nro from nro_utilisateur where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
        $stm_bei_pci->execute();
        $nros = $stm_bei_pci->fetchAll();
        foreach($nros as $nro) {
            $arr[] = $nro['id_nro'];
        }

        $condition .=" AND t2.id_nro IN ( ".implode(",",$arr).")";
        break;

    case "vpi" :
        $arr = array(-1);
        $stm = $db->prepare("select id_nro from nro where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
        $stm->execute();
        $nros = $stm->fetchAll();
        foreach($nros as $nro) {
            $arr[] = $nro['id_nro'];
        }

        $condition .=" AND t2.id_nro IN ( ".implode(",",$arr).")";
        break;

    default : break;
}

$left = "left join sous_projet_zone t4 on t1.id_sous_projet = t4.id_sous_projet";
$left .= "";


echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_sous_projet",$columns,$condition,$left));
?>