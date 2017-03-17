<?php
/**
 * file: lineaires_liste.php
 * User: rabii
 */

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
    array( "db" => "t4.lr_sur_pm", "dt" => 'lr_sur_pm' ),
    //CTR
/*    //Aiguillage
    array( "db" => "t5.lineaire1 as t5_lineaire1", "dt" => 't5_lineaire1' ),
    array( "db" => "t5.lineaire2 as t5_lineaire2", "dt" => 't5_lineaire2' ),
    array( "db" => "t5.lineaire3 as t5_lineaire3", "dt" => 't5_lineaire3' ),
    array( "db" => "t5.lineaire4 as t5_lineaire4", "dt" => 't5_lineaire4' ),
    array( "db" => "t5.lineaire5 as t5_lineaire5", "dt" => 't5_lineaire5' ),
    array( "db" => "t5.lineaire6 as t5_lineaire6", "dt" => 't5_lineaire6' ),
    array( "db" => "t5.lineaire7 as t5_lineaire7", "dt" => 't5_lineaire7' ),
    array( "db" => "t5.lineaire8 as t5_lineaire8", "dt" => 't5_lineaire8' ),
    array( "db" => "t5.lineaire9 as t5_lineaire9", "dt" => 't5_lineaire9' ),
    array( "db" => "t5.lineaire10 as t5_lineaire10", "dt" => 't5_lineaire10' ),*/
    //Aiguillage & Tirage
    //Cables
    array( "db" => "if(t6.lineaire1>0,t6.lineaire1,t5.lineaire1) as t6_lineaire1", "dt" => 't6_lineaire1' ),//720FO
    array( "db" => "if(t6.lineaire2>0,t6.lineaire2,t5.lineaire2) as t6_lineaire2", "dt" => 't6_lineaire2' ),//432FO
    array( "db" => "if(t6.lineaire3>0,t6.lineaire3,t5.lineaire3) as t6_lineaire3", "dt" => 't6_lineaire3' ),//288FO
    array( "db" => "if(t6.lineaire4>0,t6.lineaire4,t5.lineaire4) as t6_lineaire4", "dt" => 't6_lineaire4' ),//144FO
    //Tubage
    array( "db" => "t6.lineaire9 as t6_lineaire9", "dt" => 't6_lineaire9' ),//21/25
    array( "db" => "t6.lineaire10 as t6_lineaire10", "dt" => 't6_lineaire10' ),//16/20
    array( "db" => "t6.lineaire11 as t6_lineaire11", "dt" => 't6_lineaire11' ),//15/18
    array( "db" => "t6.lineaire12 as t6_lineaire12", "dt" => 't6_lineaire12' ),//Trançons à tuber
    //Boites
    array( "db" => "if(t6.lineaire5>0,t6.lineaire5,t5.lineaire5) as t6_lineaire5", "dt" => 't6_lineaire5' ),//720FO
    array( "db" => "if(t6.lineaire6>0,t6.lineaire6,t5.lineaire6) as t6_lineaire6", "dt" => 't6_lineaire6' ),//432FO
    array( "db" => "if(t6.lineaire7>0,t6.lineaire7,t5.lineaire7) as t6_lineaire7", "dt" => 't6_lineaire7' ),//288FO
    array( "db" => "if(t6.lineaire8>0,t6.lineaire8,t5.lineaire8) as t6_lineaire8", "dt" => 't6_lineaire8' ),//144FO
    //Tiroirs
    array( "db" => "if(t6.lineaire13>0,t6.lineaire13,t5.lineaire9) as t6_lineaire13", "dt" => 't6_lineaire13' ),//CTR
    array( "db" => "if(t6.lineaire14>0,t6.lineaire14,t5.lineaire10) as t6_lineaire14", "dt" => 't6_lineaire14' ),//TOR
    //CDI
    /*//Aiguillage
    array( "db" => "t7.lineaire1 as t7_lineaire1", "dt" => 't7_lineaire1' ),
    array( "db" => "t7.lineaire2 as t7_lineaire2", "dt" => 't7_lineaire2' ),
    array( "db" => "t7.lineaire3 as t7_lineaire3", "dt" => 't7_lineaire3' ),
    array( "db" => "t7.lineaire4 as t7_lineaire4", "dt" => 't7_lineaire4' ),
    array( "db" => "t7.lineaire5 as t7_lineaire5", "dt" => 't7_lineaire5' ),
    array( "db" => "t7.lineaire6 as t7_lineaire6", "dt" => 't7_lineaire6' ),
    array( "db" => "t7.lineaire7 as t7_lineaire7", "dt" => 't7_lineaire7' ),
    array( "db" => "t7.lineaire8 as t7_lineaire8", "dt" => 't7_lineaire8' ),*/
    //Aiguillage & Tirage
    //Cables
    array( "db" => "if(t8.lineaire1>0,t8.lineaire1,t7.lineaire1) as t8_lineaire1", "dt" => 't8_lineaire1' ),//288FO
    array( "db" => "if(t8.lineaire2>0,t8.lineaire2,t7.lineaire2) as t8_lineaire2", "dt" => 't8_lineaire2' ),//144FO
    array( "db" => "if(t8.lineaire3>0,t8.lineaire3,t7.lineaire3) as t8_lineaire3", "dt" => 't8_lineaire3' ),//72FO
    array( "db" => "if(t8.lineaire4>0,t8.lineaire4,t7.lineaire4) as t8_lineaire4", "dt" => 't8_lineaire4' ),//48FO
    //Tubage
    array( "db" => "t8.lineaire9 as t8_lineaire9", "dt" => 't8_lineaire9' ),//18/21
    array( "db" => "t8.lineaire10 as t8_lineaire10", "dt" => 't8_lineaire10' ),//15/18
    array( "db" => "t8.lineaire11 as t8_lineaire11", "dt" => 't8_lineaire11' ),//11/14
    array( "db" => "t8.lineaire12 as t8_lineaire12", "dt" => 't8_lineaire12' ),//Trançons à tuber
    //Boites
    array( "db" => "if(t8.lineaire5>0,t8.lineaire5,t7.lineaire5) as t8_lineaire5", "dt" => 't8_lineaire5' ),//288FO
    array( "db" => "if(t8.lineaire6>0,t8.lineaire6,t7.lineaire6) as t8_lineaire6", "dt" => 't8_lineaire6' ),//144FO
    array( "db" => "if(t8.lineaire7>0,t8.lineaire7,t7.lineaire7) as t8_lineaire7", "dt" => 't8_lineaire7' ),//72FO
    array( "db" => "if(t8.lineaire8>0,t8.lineaire8,t7.lineaire8) as t8_lineaire8", "dt" => 't8_lineaire8' )//48FO


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
$left .= " left join sous_projet_transport_aiguillage t5 on t1.id_sous_projet = t5.id_sous_projet";
$left .= " left join sous_projet_transport_tirage t6 on t1.id_sous_projet = t6.id_sous_projet";
$left .= " left join sous_projet_distribution_aiguillage t7 on t1.id_sous_projet = t7.id_sous_projet";
$left .= " left join sous_projet_distribution_tirage t8 on t1.id_sous_projet = t8.id_sous_projet";


echo json_encode(@SSP::simpleJoin($_POST,$db,$table,"id_sous_projet",$columns,$condition,$left,true));
?>