<?php

// This PHP script demonstrates how to generate XML grid data "on-the-fly"
// To achieve this, here we use our simple "PHP wrapper class" EditableGrid.php, but this is not mandatory.
// The only thing is that the generated XML must have the expected structure .
// Here we get the data from a CSV file; in real life, these data would probably come from a database.

//require_once("api/sys/libs/vendor/EditableGrid/EditableGrid.php");

// create grid and declare its columns
$grid = new EditableGrid();

// add two "string" columns
// if you wish you can specify the desired length of the text edition field like this: string(24)
$grid->addColumn("RFO_01", "RFO_01", "string",NULL,  false);
$grid->addColumn("racc", "Raccordements", "html",NULL,  false);
$grid->addColumn("qt", "Quantite", "integer");
$grid->addColumn("unit", "Unité", "string",NULL,  false);
$grid->addColumn("int", "INT", "double(€,2)",NULL,  false);
$grid->addColumn("total", "Total", "double(€,2)",NULL,  false);


extract($_GET);
$detailsDevis = array();

$stm = $db->prepare("select * from detaildevis where detaildevis.iddevis =$iddevis LIMIT 1");
$i = 0;
$data = array();
$table_raccordement = array();
$table_raccordement['RFO_01_01_racc'] = "Préparation d'un Câble 720FO Stockage en Cassette des fibres détubées
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_02_racc'] = "Réalisation Join droit 720FO
cette prestation comprends la préparation de deux câbles, préparation et pose boite, soudure de 720FO";
$table_raccordement['RFO_01_03_racc'] = "Préparation d'un Câble 432FO Stockage en Cassette des fibres détubées
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_04_racc'] = "Réalisation Join droit 432FO
cette prestation comprends la préparation de deux câbles, préparation et pose boite, soudure de 432FO";
$table_raccordement['RFO_01_05_racc'] = "Préparation d'un Câble 288FO Stockage en Cassette des fibres détubées
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_06_racc'] = "Réalisation Join droit 288FO
cette prestation comprends la préparation de deux câbles, préparation et pose boite, soudure de 288FO";
$table_raccordement['RFO_01_07_racc'] = "Préparation d'un Câble 144FO Stockage en Cassette des fibres détubées
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_08_racc'] = "Réalisation Join droit 144FO
cette prestation comprends la préparation de deux câbles, préparation et pose boite, soudure de 144FO";
$table_raccordement['RFO_01_09_racc'] = "Préparation d'un Câble 72FO Stockage en Cassette des fibres détubées
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_10_racc'] = "Réalisation Join droit 72FO
cette prestation comprends la préparation de deux câbles, préparation et pose boite, soudure de 72FO";
$table_raccordement['RFO_01_11_racc'] = "Préparation d'un Câble 48FO Stockage en Cassette des fibres détubées
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_12_racc'] = "Réalisation Join droit 48FO
cette prestation comprends la préparation de deux câbles, préparation et pose boite, soudure de 48FO";
$table_raccordement['RFO_01_13_racc'] = "Préparation d'un Câble 24FO Stockage en Cassette des fibres détubées
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_14_racc'] = "Réalisation Join droit 24FO
cette prestation comprends la préparation de deux câbles, préparation et pose boite, soudure de 24FO";
$table_raccordement['RFO_01_15_racc'] = "Fenêtre sur câble sur câble 432FO
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_16_racc'] = "Fenêtre sur câble sur câble 288FO
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_17_racc'] = "Fenêtre sur câble sur câble 144FO
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_18_racc'] = "Fenêtre sur câble sur câble 72FO
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_19_racc'] = "Fenêtre sur câble sur câble 48FO
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_20_racc'] = "Fenêtre sur câble sur câble 24FO
cette prestation comprends la pose du manchon";
$table_raccordement['RFO_01_21_racc'] = "Débutable d'un tube en passage pour stockage FO en passage dans une casette";
$table_raccordement['RFO_01_22_racc'] = "Intervention sur réseau en HNO (1 Equipe de deux Techniciens Equipé Raccordement FO et Réflectomètre)
La fenêtre d'intervention va de 23h à 7h du matin";
$table_raccordement['RFO_01_23_racc'] = "Soudure à l'unité sur câble préparé et intervenant sur place";
$table_raccordement['RFO_01_24_racc'] = "Moins Value soudure non réalisée";
$table_unite = array();
$table_unite['RFO_01_01_unit'] = "Forfait";
$table_unite['RFO_01_02_unit'] = "Forfait";
$table_unite['RFO_01_03_unit'] = "Forfait";
$table_unite['RFO_01_04_unit'] = "Forfait";
$table_unite['RFO_01_05_unit'] = "Forfait";
$table_unite['RFO_01_06_unit'] = "Forfait";
$table_unite['RFO_01_07_unit'] = "Forfait";
$table_unite['RFO_01_08_unit'] = "Forfait";
$table_unite['RFO_01_09_unit'] = "Forfait";
$table_unite['RFO_01_10_unit'] = "Forfait";
$table_unite['RFO_01_11_unit'] = "Forfait";
$table_unite['RFO_01_12_unit'] = "Forfait";
$table_unite['RFO_01_13_unit'] = "Forfait";
$table_unite['RFO_01_14_unit'] = "Forfait";
$table_unite['RFO_01_15_unit'] = "Forfait";
$table_unite['RFO_01_16_unit'] = "Forfait";
$table_unite['RFO_01_17_unit'] = "Forfait";
$table_unite['RFO_01_18_unit'] = "Forfait";
$table_unite['RFO_01_19_unit'] = "Forfait";
$table_unite['RFO_01_20_unit'] = "Forfait";
$table_unite['RFO_01_21_unit'] = "Forfait";
$table_unite['RFO_01_22_unit'] = "Unité";
$table_unite['RFO_01_23_unit'] = "Soudure";
$table_unite['RFO_01_24_unit'] = "Soudure";
if($stm->execute()) {
    if($stm->rowCount() > 0) {
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $i =1;
        for($i= 1 ; $i <= 24 ; $i++){
            if($i < 10)
                $data[] = array(
                    "RFO_01" => $row['RFO_01_0'.$i],
                    "racc" => $table_raccordement['RFO_01_0'.$i.'_racc'],
                    "qt" => $row['RFO_01_0'.$i.'_qt'],
                    "unit" => $table_unite['RFO_01_0'.$i.'_unit'],
                    "int" => $row['RFO_01_0'.$i.'_int'],
                    "total" => $row['RFO_01_0'.$i.'_total']
                );
            if($i >= 10  )
                $data[] = array(
                    "RFO_01" => $row['RFO_01_'.$i],
                    "racc" => $table_raccordement['RFO_01_'.$i.'_racc'],
                    "qt" => $row['RFO_01_'.$i.'_qt'],
                    "unit" => $table_unite['RFO_01_'.$i.'_unit'],
                    "int" => $row['RFO_01_'.$i.'_int'],
                    "total" => $row['RFO_01_'.$i.'_total']
                );


        }


    }
}

$grid->renderJSON($data);
