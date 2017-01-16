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
$grid->addColumn("racc", "Raccordements", "string",NULL,  false);
$grid->addColumn("qt", "Quantite", "integer");
$grid->addColumn("unit", "Unité", "string",NULL,  false);
$grid->addColumn("int", "INT", "double(€,2)");
$grid->addColumn("total", "Total", "double(€,2)",NULL,  false);


extract($_GET);
$detailsDevis = array();

$stm = $db->prepare("select * from detaildevis where detaildevis.iddevis =$iddevis LIMIT 1");
$i = 0;
$data = array();
if($stm->execute()) {
    if($stm->rowCount() > 0) {
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $i =1;
        for($i= 1 ; $i <= 24 ; $i++){
            if($i < 10)
                $data[] = array(
                    "RFO_01" => $row['RFO_01_0'.$i],
                    "racc" => $row['RFO_01_0'.$i.'_racc'],
                    "qt" => $row['RFO_01_0'.$i.'_qt'],
                    "unit" => $row['RFO_01_0'.$i.'_unit'],
                    "int" => $row['RFO_01_0'.$i.'_int'],
                    "total" => $row['RFO_01_0'.$i.'_total']
                );
            if($i >= 10  )
                $data[] = array(
                    "RFO_01" => $row['RFO_01_'.$i],
                    "racc" => $row['RFO_01_'.$i.'_racc'],
                    "qt" => $row['RFO_01_'.$i.'_qt'],
                    "unit" => $row['RFO_01_'.$i.'_unit'],
                    "int" => $row['RFO_01_'.$i.'_int'],
                    "total" => $row['RFO_01_'.$i.'_total']
                );


        }


    }
}

$grid->renderJSON($data);
