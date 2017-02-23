<?php

// This PHP script demonstrates how to generate XML grid data "on-the-fly"
// To achieve this, here we use our simple "PHP wrapper class" EditableGrid.php, but this is not mandatory.
// The only thing is that the generated XML must have the expected structure .
// Here we get the data from a CSV file; in real life, these data would probably come from a database.

//require_once("api/sys/libs/vendor/EditableGrid/EditableGrid.php");

// create grid and declare its columns
$grid = new EditableGrid();

extract($_GET);
$editable_chaine = FALSE;

if(isset($editable) && $editable == 1){
    $editable_chaine = FALSE;
}else{
    $editable_chaine = TRUE;
}
$grid->addColumn("ITF_0", "ITF_0", "string",NULL,  false);
$grid->addColumn("titre", "Titre", "html",NULL,  false);
$grid->addColumn("qt", "Quantite", "integer",NULL,$editable_chaine);
$grid->addColumn("unit", "Unité", "string",NULL,  false);
$grid->addColumn("int", "INT", "double(€,2)",NULL,  false);
$grid->addColumn("total", "Total", "double(€,2)",NULL,  false);



$detailsDevis = array();

$stm = $db->prepare("select * from detaildevis where detaildevis.iddevis =$iddevis LIMIT 1");
$i = 0;
$data = array();
$table_titre = array();
$table_titre['ITF_01_01_titre'] = "Pose d'un câble  de diammètre ≤12mm en chemin de câble ou selon cheminement défini<br />
cette prestation comprend l'arrimage du câble s'il est nécéssaire";
$table_titre['ITF_01_02_titre'] = "Pose d'un câble de diammètre >12mm en chemin de câble ou selon cheminement défini<br />
cette prestation comprend l'arrimage du câble s'il est nécéssaire";

$table_titre['ITF_02_01_titre'] = "Fourniture et pose d'un tube iro ou équivalent fixé";
$table_titre['ITF_02_02_titre'] = "Dépose, stockage et remise en place de faux-plancher ou faux-plafond";
$table_titre['ITF_02_03_titre'] = "Percement cloison , gaine, platre interpalier y compris rebouchage";
$table_titre['ITF_02_04_titre'] = "Percement mur plein, tubage anti feu + remise mousse M1";
$table_titre['ITF_02_05_titre'] = "Fourniture et pose gaine anti UV non fendue";
$table_titre['ITF_02_06_titre'] = "Fourniture et pose gaine fendue LSOH";


$table_unite = array();
$table_unite['ITF_01_01_unit'] = "ml";
$table_unite['ITF_01_02_unit'] = "ml";

$table_unite['ITF_02_01_unit'] = "ml";
$table_unite['ITF_02_02_unit'] = "m²";
$table_unite['ITF_02_03_unit'] = "Unité";
$table_unite['ITF_02_04_unit'] = "Unité";
$table_unite['ITF_02_05_unit'] = "ml";
$table_unite['ITF_02_06_unit'] = "ml";

$table_int = array();
$table_int['ITF_01_01_int'] = "3.2";
$table_int['ITF_01_02_int'] = "4.3";

$table_int['ITF_02_01_int'] = "2.5";
$table_int['ITF_02_02_int'] = "6";
$table_int['ITF_02_03_int'] = "25";
$table_int['ITF_02_04_int'] = "40";
$table_int['ITF_02_05_int'] = "3.7";
$table_int['ITF_02_06_int'] = "3.7";

if($stm->execute()) {
    if($stm->rowCount() > 0) {
        $row = $stm->fetch(PDO::FETCH_ASSOC);


        $data[] = array(
            "ITF_0" => 'ITF_01_01',
            "titre" => $table_titre['ITF_01_01_titre'],
            "qt" => $row['ITF_01_01_qt'],
            "unit" => $table_unite['ITF_01_01_unit'],
            "int" => $table_int['ITF_01_01_int'],
            "total" => $table_int['ITF_01_01_int'] * $row['ITF_01_01_qt']
        );
        $data[] = array(
            "ITF_0" => 'ITF_01_02',
            "titre" => $table_titre['ITF_01_02_titre'],
            "qt" => $row['ITF_01_02_qt'],
            "unit" => $table_unite['ITF_01_02_unit'],
            "int" => $table_int['ITF_01_02_int'],
            "total" => $table_int['ITF_01_02_int'] * $row['ITF_01_02_qt']
        );

        $data[] = array(
            "ITF_0" => 'ITF_02_01',
            "titre" => $table_titre['ITF_02_01_titre'],
            "qt" =>  $row['ITF_02_01_qt'],
            "unit" => $table_unite['ITF_02_01_unit'],
            "int" => $table_int['ITF_02_01_int'],
            "total" => $table_int['ITF_02_01_int'] * $row['ITF_02_01_qt']
        );
        $data[] = array(
            "ITF_0" => 'ITF_02_02',
            "titre" => $table_titre['ITF_02_02_titre'],
            "qt" => $row['ITF_02_02_qt'],
            "unit" => $table_unite['ITF_02_02_unit'],
            "int" => $table_int['ITF_02_02_int'],
            "total" => $table_int['ITF_02_02_int'] * $row['ITF_02_02_qt']
        );
        $data[] = array(
            "ITF_0" => 'ITF_02_03',
            "titre" => $table_titre['ITF_02_03_titre'],
            "qt" => $row['ITF_02_03_qt'],
            "unit" => $table_unite['ITF_02_03_unit'],
            "int" => $table_int['ITF_02_03_int'],
            "total" => $table_int['ITF_02_03_int'] * $row['ITF_02_03_qt']
        );
        $data[] = array(
            "ITF_0" => 'ITF_02_04',
            "titre" => $table_titre['ITF_02_04_titre'],
            "qt" => $row['ITF_02_04_qt'],
            "unit" => $table_unite['ITF_02_04_unit'],
            "int" => $table_int['ITF_02_04_int'],
            "total" => $table_int['ITF_02_04_int'] * $row['ITF_02_04_qt']
        );
        $data[] = array(
            "ITF_0" => 'ITF_02_05',
            "titre" => $table_titre['ITF_02_05_titre'],
            "qt" => $row['ITF_02_05_qt'],
            "unit" => $table_unite['ITF_02_05_unit'],
            "int" => $table_int['ITF_02_05_int'],
            "total" => $table_int['ITF_02_05_int'] * $row['ITF_02_05_qt']
        );
        $data[] = array(
            "ITF_0" => 'ITF_02_06',
            "titre" => $table_titre['ITF_02_06_titre'],
            "qt" => $row['ITF_02_06_qt'],
            "unit" => $table_unite['ITF_02_06_unit'],
            "int" => $table_int['ITF_02_06_int'],
            "total" => $table_int['ITF_02_06_int'] * $row['ITF_02_06_qt']
        );


    }
}

$grid->renderJSON($data);
