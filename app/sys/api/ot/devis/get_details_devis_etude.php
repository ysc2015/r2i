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

$grid->addColumn("EFO_0", "EFO_0", "string",NULL,  false);
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
$table_titre['EFO_01_01_titre'] = "Visite NRO FAI";
$table_titre['EFO_01_02_titre'] = "Collecte Info Concessionnaires";
$table_titre['EFO_01_03_titre'] = "Etudes Adductions Phase FAI (Analyse des Adductions + Forfait Aiguillage selon CDC)";
$table_titre['EFO_01_04_titre'] = "Préparation des Livrables du dossier FAI";

$table_titre['EFO_02_01_titre'] = "Re-Positionnement des adresses sur carto et regroupement des Adresses Arrières au PM Zone Avant";
$table_titre['EFO_02_02_titre'] = "Relevé terrain des anomalies d'adresses avec un taux moyen de 25% des adresses";
$table_titre['EFO_02_03_titre'] = "Réalisation fichier FLR";
$table_titre['EFO_02_04_titre'] = "Préparation de la cartographie du dossier APS";
$table_titre['EFO_02_05_titre'] = "Préparation des Livrables du dossier APS";
$table_titre['EFO_02_06_titre'] = "Préparation de la base APS sous format Netgeo";

$table_titre['EFO_03_01_titre'] = "Préparation des Plans de Piquetage";
$table_titre['EFO_03_02_titre'] = "Obtention des autorisations de voirie en vue du Piquetage";
$table_titre['EFO_03_04_titre'] = "Préparation des Livrables du dossier PIQ";

$table_titre['EFO_04_01_titre'] = "Mise à jour câblage par rapport à l'APS suite à changement de parcourt";
$table_titre['EFO_04_02_titre'] = "Réalisation d'un plan de soudure aux format Excel selon Proformat";
$table_titre['EFO_04_03_titre'] = "Préparation des Livrables du dossier APD";
$table_titre['EFO_04_04_titre'] = "Préparation de la base APD sous format Netgeo";

$table_titre['EFO_05_01_titre'] = "Mise à jour câblage par rapport à l'APD suite à changement de parcourt";
$table_titre['EFO_05_02_titre'] = "Mise à jour d'un plan de soudure";
$table_titre['EFO_05_03_titre'] = "Rendu DOE Poche au (Format Shape) PDS compris selon mod-op \"export netgeo\"";
$table_titre['EFO_05_04_titre'] = "Rendu de la base DOE sous format Netgeo";

$table_titre['EFO_06_01_titre'] = "Préparation d'un livrable type Déclaration d'étude";
$table_titre['EFO_06_02_titre'] = "Réalistation commande d'accès Structurante de la poche depuis les retous Piquetage";
$table_titre['EFO_06_03_titre'] = "Réalisation prestation Relevé FOA d'une pose de manchon (cette prestation inclus les livrables de la commande  structurante et fin de travaux)";
$table_titre['EFO_06_04_titre'] = "Réalisation prestation Relevé FOA d'un percement (cette prestation inclus les livrables de la commande  structurante et fin de travaux)";
$table_titre['EFO_06_05_titre'] = "Réalisation des livrables type Fin de Travaux relatifs à une commande d'accès Structurante de la poche depuis les retours Travaux";
$table_titre['EFO_06_06_titre'] = "Réalisation prestation Relevé FOA après tubage du masque logique amont et aval (cette prestation inclus la partie Terrain et la partie BE)";
$table_titre['EFO_06_07_titre'] = "Réintervention sur Chambre sécurisée avec accompagnement FT";

$table_unite = array();
$table_unite['EFO_01_01_unit'] = "Forfait";
$table_unite['EFO_01_02_unit'] = "Forfait";
$table_unite['EFO_01_03_unit'] = "Forfait";
$table_unite['EFO_01_04_unit'] = "Forfait";

$table_unite['EFO_02_01_unit'] = "Adresse";
$table_unite['EFO_02_02_unit'] = "Adresse";
$table_unite['EFO_02_03_unit'] = "Site";
$table_unite['EFO_02_04_unit'] = "Site";
$table_unite['EFO_02_05_unit'] = "Site";
$table_unite['EFO_02_06_unit'] = "Site";

$table_unite['EFO_03_01_unit'] = "Forfait";
$table_unite['EFO_03_02_unit'] = "Forfait";
$table_unite['EFO_03_04_unit'] = "Site";

$table_unite['EFO_04_01_unit'] = "Câble";
$table_unite['EFO_04_02_unit'] = "PDS";
$table_unite['EFO_04_03_unit'] = "Site";
$table_unite['EFO_04_04_unit'] = "Site";

$table_unite['EFO_05_01_unit'] = "Câble";
$table_unite['EFO_05_02_unit'] = "PDS";
$table_unite['EFO_05_03_unit'] = "Site";
$table_unite['EFO_05_04_unit'] = "Site";

$table_unite['EFO_06_01_unit'] = "Forfait";
$table_unite['EFO_06_02_unit'] = "Site";
$table_unite['EFO_06_03_unit'] = "Manchon";
$table_unite['EFO_06_04_unit'] = "Chambre";
$table_unite['EFO_06_05_unit'] = "Site";
$table_unite['EFO_06_06_unit'] = "Tronçon";
$table_unite['EFO_06_07_unit'] = "Chambre";

$table_int = array();
$table_int['EFO_01_01_int'] = "";
$table_int['EFO_01_02_int'] = "";
$table_int['EFO_01_03_int'] = "";
$table_int['EFO_01_04_int'] = "";

$table_int['EFO_02_01_int'] = "";
$table_int['EFO_02_02_int'] = "8";
$table_int['EFO_02_03_int'] = "";
$table_int['EFO_02_04_int'] = "";
$table_int['EFO_02_05_int'] = "";
$table_int['EFO_02_06_int'] = "";

$table_int['EFO_03_01_int'] = "";
$table_int['EFO_03_02_int'] = "210";
$table_int['EFO_03_04_int'] = "";

$table_int['EFO_04_01_int'] = "";
$table_int['EFO_04_02_int'] = "";
$table_int['EFO_04_03_int'] = "";
$table_int['EFO_04_04_int'] = "";

$table_int['EFO_05_01_int'] = "";
$table_int['EFO_05_02_int'] = "";
$table_int['EFO_05_03_int'] = "";
$table_int['EFO_05_04_int'] = "";

$table_int['EFO_06_01_int'] = "";
$table_int['EFO_06_02_int'] = "";
$table_int['EFO_06_03_int'] = "55";
$table_int['EFO_06_04_int'] = "50";
$table_int['EFO_06_05_int'] = "";
$table_int['EFO_06_06_int'] = "47";
$table_int['EFO_06_07_int'] = "104";
if($stm->execute()) {
    if($stm->rowCount() > 0) {
        $row = $stm->fetch(PDO::FETCH_ASSOC);


        $data[] = array(
            "EFO_0" => 'EFO_01_01',
            "titre" => $table_titre['EFO_01_01_titre'],
            "qt" => $row['EFO_01_01_qt'],
            "unit" => $table_unite['EFO_01_01_unit'],
            "int" => $table_int['EFO_01_01_int'],
            "total" => $table_int['EFO_01_01_int'] * $row['EFO_01_01_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_01_02',
            "titre" => $table_titre['EFO_01_02_titre'],
            "qt" => $row['EFO_01_02_qt'],
            "unit" => $table_unite['EFO_01_02_unit'],
            "int" => $table_int['EFO_01_02_int'],
            "total" => $table_int['EFO_01_02_int'] * $row['EFO_01_02_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_01_03',
            "titre" => $table_titre['EFO_01_03_titre'],
            "qt" => $row['EFO_01_03_qt'],
            "unit" => $table_unite['EFO_01_03_unit'],
            "int" => $table_int['EFO_01_03_int'],
            "total" => $table_int['EFO_01_03_int'] * $row['EFO_01_03_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_01_04',
            "titre" => $table_titre['EFO_01_04_titre'],
            "qt" => $row['EFO_01_04_qt'],
            "unit" => $table_unite['EFO_01_04_unit'],
            "int" => $table_int['EFO_01_04_int'],
            "total" => $table_int['EFO_01_04_int'] * $row['EFO_01_04_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_02_01',
            "titre" => $table_titre['EFO_02_01_titre'],
            "qt" => $row['EFO_02_01_qt'],
            "unit" => $table_unite['EFO_02_01_unit'],
            "int" => $table_int['EFO_02_01_int'],
            "total" => $table_int['EFO_02_01_int'] * $row['EFO_02_01_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_02_02',
            "titre" => $table_titre['EFO_02_02_titre'],
            "qt" => $row['EFO_02_02_qt'],
            "unit" => $table_unite['EFO_02_02_unit'],
            "int" => $table_int['EFO_02_02_int'],
            "total" => $table_int['EFO_02_02_int'] * $row['EFO_02_02_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_02_03',
            "titre" => $table_titre['EFO_02_03_titre'],
            "qt" => $row['EFO_02_03_qt'],
            "unit" => $table_unite['EFO_02_03_unit'],
            "int" => $table_int['EFO_02_03_int'],
            "total" => $table_int['EFO_02_03_int'] * $row['EFO_02_03_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_02_04',
            "titre" => $table_titre['EFO_02_04_titre'],
            "qt" => $row['EFO_02_04_qt'],
            "unit" => $table_unite['EFO_02_04_unit'],
            "int" => $table_int['EFO_02_04_int'],
            "total" => $table_int['EFO_02_04_int'] * $row['EFO_02_04_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_02_05',
            "titre" => $table_titre['EFO_02_05_titre'],
            "qt" =>  $row['EFO_02_05_qt'],
            "unit" => $table_unite['EFO_02_05_unit'],
            "int" => $table_int['EFO_02_05_int'],
            "total" => $table_int['EFO_02_05_int'] * $row['EFO_02_05_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_02_06',
            "titre" => $table_titre['EFO_02_06_titre'],
            "qt" => $row['EFO_02_06_qt'],
            "unit" => $table_unite['EFO_02_06_unit'],
            "int" => $table_int['EFO_02_06_int'],
            "total" => $table_int['EFO_02_06_int'] * $row['EFO_02_06_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_03_01',
            "titre" => $table_titre['EFO_03_01_titre'],
            "qt" => $row['EFO_03_01_qt'],
            "unit" => $table_unite['EFO_03_01_unit'],
            "int" =>  $table_int['EFO_03_01_int'],
            "total" => $table_int['EFO_03_01_int'] * $row['EFO_03_01_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_03_02',
            "titre" => $table_titre['EFO_03_02_titre'],
            "qt" =>  $row['EFO_03_02_qt'],
            "unit" => $table_unite['EFO_03_02_unit'],
            "int" => $table_int['EFO_03_02_int'],
            "total" => $table_int['EFO_03_02_int'] * $row['EFO_03_02_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_03_04',
            "titre" => $table_titre['EFO_03_04_titre'],
            "qt" =>  $row['EFO_03_04_qt'],
            "unit" => $table_unite['EFO_03_04_unit'],
            "int" => $table_int['EFO_03_04_int'],
            "total" => $table_int['EFO_03_04_int'] * $row['EFO_03_04_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_04_01',
            "titre" => $table_titre['EFO_04_01_titre'],
            "qt" =>  $row['EFO_04_01_qt'],
            "unit" => $table_unite['EFO_04_01_unit'],
            "int" => $table_int['EFO_04_01_int'],
            "total" => $table_int['EFO_04_01_int'] * $row['EFO_04_01_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_04_02',
            "titre" => $table_titre['EFO_04_02_titre'],
            "qt" =>  $row['EFO_04_02_qt'],
            "unit" => $table_unite['EFO_04_02_unit'],
            "int" => $table_int['EFO_04_02_int'],
            "total" => $table_int['EFO_04_02_int'] * $row['EFO_04_02_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_04_03',
            "titre" => $table_titre['EFO_04_03_titre'],
            "qt" =>  $row['EFO_04_03_qt'],
            "unit" => $table_unite['EFO_04_03_unit'],
            "int" => $table_int['EFO_04_03_int'],
            "total" => $table_int['EFO_04_03_int'] * $row['EFO_04_03_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_04_04',
            "titre" => $table_titre['EFO_04_04_titre'],
            "qt" =>  $row['EFO_04_04_qt'],
            "unit" => $table_unite['EFO_04_04_unit'],
            "int" => $table_int['EFO_04_04_int'],
            "total" => $table_int['EFO_04_04_int'] * $row['EFO_04_04_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_05_01',
            "titre" => $table_titre['EFO_05_01_titre'],
            "qt" =>  $row['EFO_05_01_qt'],
            "unit" => $table_unite['EFO_05_01_unit'],
            "int" => $table_int['EFO_05_01_int'],
            "total" => $table_int['EFO_05_01_int'] * $row['EFO_05_01_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_05_02',
            "titre" => $table_titre['EFO_05_02_titre'],
            "qt" =>  $row['EFO_05_02_qt'],
            "unit" => $table_unite['EFO_05_02_unit'],
            "int" => $table_int['EFO_05_02_int'],
            "total" => $table_int['EFO_05_02_int'] * $row['EFO_05_02_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_05_03',
            "titre" => $table_titre['EFO_05_03_titre'],
            "qt" =>  $row['EFO_05_03_qt'],
            "unit" => $table_unite['EFO_05_03_unit'],
            "int" => $table_int['EFO_05_03_int'],
            "total" => $table_int['EFO_05_03_int'] * $row['EFO_05_03_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_05_04',
            "titre" => $table_titre['EFO_05_04_titre'],
            "qt" =>  $row['EFO_05_04_qt'],
            "unit" => $table_unite['EFO_05_04_unit'],
            "int" => $table_int['EFO_05_04_int'],
            "total" => $table_int['EFO_05_04_int'] * $row['EFO_05_04_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_06_01',
            "titre" => $table_titre['EFO_06_01_titre'],
            "qt" =>  $row['EFO_06_01_qt'],
            "unit" => $table_unite['EFO_06_01_unit'],
            "int" => $table_int['EFO_06_01_int'],
            "total" => $table_int['EFO_06_01_int'] * $row['EFO_06_01_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_06_02',
            "titre" => $table_titre['EFO_06_02_titre'],
            "qt" =>  $row['EFO_06_02_qt'],
            "unit" => $table_unite['EFO_06_02_unit'],
            "int" => $table_int['EFO_06_02_int'],
            "total" => $table_int['EFO_06_02_int'] * $row['EFO_06_02_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_06_03',
            "titre" => $table_titre['EFO_06_03_titre'],
            "qt" =>  $row['EFO_06_03_qt'],
            "unit" => $table_unite['EFO_06_03_unit'],
            "int" => $table_int['EFO_06_03_int'],
            "total" => $table_int['EFO_06_03_int']*$row['EFO_06_03_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_06_04',
            "titre" => $table_titre['EFO_06_04_titre'],
            "qt" =>  $row['EFO_06_04_qt'],
            "unit" => $table_unite['EFO_06_04_unit'],
            "int" => $table_int['EFO_06_04_int'],
            "total" => $table_int['EFO_06_04_int'] * $row['EFO_06_04_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_06_05',
            "titre" => $table_titre['EFO_06_05_titre'],
            "qt" =>  $row['EFO_06_05_qt'],
            "unit" => $table_unite['EFO_06_05_unit'],
            "int" => $table_int['EFO_06_05_int'],
            "total" => $table_int['EFO_06_05_int'] * $row['EFO_06_05_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_06_06',
            "titre" => $table_titre['EFO_06_06_titre'],
            "qt" =>  $row['EFO_06_06_qt'],
            "unit" => $table_unite['EFO_06_06_unit'],
            "int" => $table_int['EFO_06_06_int'],
            "total" => $table_int['EFO_06_06_int'] * $row['EFO_06_06_qt']
        );
        $data[] = array(
            "EFO_0" => 'EFO_06_07',
            "titre" => $table_titre['EFO_06_07_titre'],
            "qt" =>  $row['EFO_06_07_qt'],
            "unit" => $table_unite['EFO_06_07_unit'],
            "int" => $table_int['EFO_06_07_int'],
            "total" => $table_int['EFO_06_07_int'] * $row['EFO_06_07_qt']
        );


    }
}

$grid->renderJSON($data);
