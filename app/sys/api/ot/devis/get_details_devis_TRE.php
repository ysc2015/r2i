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
$grid->addColumn("TFO_0", "TFO_0", "string",NULL,  false);
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
$table_titre['TFO_01_01_titre'] = "Aiguillage d'une conduite existante avec pose d'un filin et étiquette, détection des points de blocage. ";
$table_titre['TFO_01_02_titre'] = "Choix de l'alvéole selon règles d'occupation de tubages FT en vigueur (comprend l'ouverture de la chambre et le choix de l'alvéole allant être aiguillée";
$table_titre['TFO_02_01_titre'] = "Pose d'un sous-tubage avec tube PEHD (>16mm) en couronne dans une conduite existante comprenant toutes les sujétions, par métre du premier tube";
$table_titre['TFO_02_02_titre'] = "Pose d'un sous-tubage avec micro-tube PEHD (≤ 16mm) dans une conduite existante comprenant toutes les sujétions, par mètre du premier tube, bitube ou nappe";
$table_titre['TFO_02_03_titre'] = "Fourniture et pose d'un blocage et étanchéité du tubage kit MCR par extrémité";
$table_titre['TFO_02_04_titre'] = "Pose sous tubage souple poche textile MAXCELL";
$table_titre['TFO_02_05_titre'] = "Fourniture gaine souple MAXCELL";
$table_titre['TFO_02_06_titre'] = "Fourniture sous-tubage rigide <16mm (en cas de rupture de stock free)";
$table_titre['TFO_03_01_titre'] = "Cable inférieur à 12mm - love,fixation et étiquetages compris";
$table_titre['TFO_03_02_titre'] = "Cable égale et supérieur à 12mm - love, fixation et étiquetage compris compris";
$table_titre['TFO_04_01_titre'] = "Plus value pour fourniture et pose de gaine annelée blanche en chambre (en continuité dans chambre L2T ou inférieure, et dans chambre de taille supérieure, jusqu'au premier point d'ancrage de la paroi latérale à l'arrivée du fourreau)";
$table_titre['TFO_05_01_titre'] = "Demi Journée recette FT (en fin de travaux)";

$table_unite = array();
$table_unite['TFO_01_01_unit'] = "ml";
$table_unite['TFO_01_02_unit'] = "Forfait";
$table_unite['TFO_02_01_unit'] = "ml";
$table_unite['TFO_02_02_unit'] = "ml";
$table_unite['TFO_02_03_unit'] = "Unité";
$table_unite['TFO_02_04_unit'] = "ml";
$table_unite['TFO_02_05_unit'] = "ml";
$table_unite['TFO_02_06_unit'] = "ml";
$table_unite['TFO_03_01_unit'] = "ml";
$table_unite['TFO_03_02_unit'] = "ml";
$table_unite['TFO_04_01_unit'] = "ml";
$table_unite['TFO_05_01_unit'] = "Unité";

$table_int = array();
$table_int['TFO_01_01_int'] = "0.6";
$table_int['TFO_01_02_int'] = "9";
$table_int['TFO_02_01_int'] = "2.3";
$table_int['TFO_02_02_int'] = "2";
$table_int['TFO_02_03_int'] = "10";
$table_int['TFO_02_04_int'] = "1.5";
$table_int['TFO_02_05_int'] = "4.5";
$table_int['TFO_02_06_int'] = "0.5";
$table_int['TFO_03_01_int'] = "1.27";
$table_int['TFO_03_02_int'] = "1.6";
$table_int['TFO_04_01_int'] = "2.9";
$table_int['TFO_05_01_int'] = "208";

if($stm->execute()) {
    if($stm->rowCount() > 0) {
        $row = $stm->fetch(PDO::FETCH_ASSOC);


        $data[] = array(
            "TFO_0" => 'TFO_01_01',
            "titre" => $table_titre['TFO_01_01_titre'],
            "qt" => $row['TFO_01_01_qt'],
            "unit" => $table_unite['TFO_01_01_unit'],
            "int" => $table_int['TFO_01_01_int'],
            "total" => $table_int['TFO_01_01_int']*$row['TFO_01_01_qt']
        );
        $data[] = array(
            "TFO_0" => 'TFO_01_02',
            "titre" => $table_titre['TFO_01_02_titre'],
            "qt" => $row['TFO_01_02_qt'],
            "unit" => $table_unite['TFO_01_02_unit'],
            "int" => $table_int['TFO_01_02_int'],
            "total" => $table_int['TFO_01_02_int']*$row['TFO_01_02_qt']
        );
        $data[] = array(
            "TFO_0" => 'TFO_02_01',
            "titre" => $table_titre['TFO_02_01_titre'],
            "qt" => $row['TFO_02_01_qt'],
            "unit" => $table_unite['TFO_02_01_unit'],
            "int" => $table_int['TFO_02_01_int'],
            "total" => $table_int['TFO_02_01_int']*$row['TFO_02_01_qt']
        );
        $data[] = array(
            "TFO_0" => 'TFO_02_02',
            "titre" => $table_titre['TFO_02_02_titre'],
            "qt" => $row['TFO_02_02_qt'],
            "unit" => $table_unite['TFO_02_02_unit'],
            "int" => $table_int['TFO_02_02_int'],
            "total" => $table_int['TFO_02_02_int']*$row['TFO_02_02_qt']
        );
        $data[] = array(
            "TFO_0" => 'TFO_02_03',
            "titre" => $table_titre['TFO_02_03_titre'],
            "qt" => $row['TFO_02_03_qt'],
            "unit" => $table_unite['TFO_02_03_unit'],
            "int" => $table_int['TFO_02_03_int'],
            "total" => $table_int['TFO_02_03_int']*$row['TFO_02_03_qt']
        );
        $data[] = array(
            "TFO_0" => 'TFO_02_04',
            "titre" => $table_titre['TFO_02_04_titre'],
            "qt" => $row['TFO_02_04_qt'],
            "unit" => $table_unite['TFO_02_04_unit'],
            "int" => $table_int['TFO_02_04_int'],
            "total" => $table_int['TFO_02_04_int'] * $row['TFO_02_04_qt']
        );
        $data[] = array(
            "TFO_0" => 'TFO_02_05',
            "titre" => $table_titre['TFO_02_05_titre'],
            "qt" => $row['TFO_02_05_qt'],
            "unit" => $table_unite['TFO_02_05_unit'],
            "int" => $table_int['TFO_02_05_int'],
            "total" => $table_int['TFO_02_05_int'] * $row['TFO_02_05_qt']
        );
        $data[] = array(
            "TFO_0" => 'TFO_02_06',
            "titre" => $table_titre['TFO_02_06_titre'],
            "qt" => $row['TFO_02_06_qt'],
            "unit" => $table_unite['TFO_02_06_unit'],
            "int" => $table_int['TFO_02_06_int'],
            "total" => $table_int['TFO_02_06_int'] * $row['TFO_02_06_qt']
        );
        $data[] = array(
            "TFO_0" => 'TFO_03_01',
            "titre" => $table_titre['TFO_03_01_titre'],
            "qt" => $row['TFO_03_01_qt'],
            "unit" => $table_unite['TFO_03_01_unit'],
            "int" =>  $table_int['TFO_03_01_int'],
            "total" => $table_int['TFO_03_01_int'] * $row['TFO_03_01_qt']
        );
        $data[] = array(
            "TFO_0" => 'TFO_03_02',
            "titre" => $table_titre['TFO_03_02_titre'],
            "qt" =>  $row['TFO_03_02_qt'],
            "unit" => $table_unite['TFO_03_02_unit'],
            "int" => $table_int['TFO_03_02_int'],
            "total" => $table_int['TFO_03_02_int']*$row['TFO_03_02_qt']
        );
        $data[] = array(
            "TFO_0" => 'TFO_04_01',
            "titre" => $table_titre['TFO_04_01_titre'],
            "qt" =>  $row['TFO_04_01_qt'],
            "unit" => $table_unite['TFO_04_01_unit'],
            "int" => $table_int['TFO_04_01_int'],
            "total" => $table_int['TFO_04_01_int']*$row['TFO_04_01_qt']
        );
        $data[] = array(
            "TFO_0" => 'TFO_05_01',
            "titre" => $table_titre['TFO_05_01_titre'],
            "qt" =>  $row['TFO_05_01_qt'],
            "unit" => $table_unite['TFO_05_01_unit'],
            "int" => $table_int['TFO_05_01_int'],
            "total" => $table_int['TFO_05_01_int'] * $row['TFO_05_01_qt']
        );


    }
}

$grid->renderJSON($data);
