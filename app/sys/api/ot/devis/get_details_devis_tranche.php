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
$grid->addColumn("EGC_0", "EGC_0", "string",NULL,  false);
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
$table_titre['EGC_01_01_titre'] = "Forfait Etude APS APD DOE Chantier Linéaire Inférrieur ou égal à 15ML<br />
Avec Obtention des Permissions de voirie ou Autorisation du gestionnaire<br />
Obtention des arrêtés de circulation ou déclaration au gestionnaire (y compris DICT)<br />
Plans de recollement au 200ème géoréfrencés au format DWG";
$table_titre['EGC_01_02_titre'] = "Forfait Etude APS APD DOE Chantier Linéaire entre 15ML et 400ML<br />
Avec Obtention des Permissions de voirie ou Autorisation du gestionnaire<br />
Obtention des arrêtés de circulation ou déclaration au gestionnaire (y compris DICT)<br />
Plans de recollement au 200ème géoréférencés au format DWG";
$table_titre['EGC_01_03_titre'] = "Etude APS APD DOE Chantier Suppérieur à 400ML<br />
Avec Obtention des Permissions de voirie ou Autorisation du gestionnaire<br />
Obtention des arrêtés de circulation ou déclaration au gestionnaire (y compris DICT)<br />
Plans de recollement au 500ème géoréférencés au forfait DWG";

$table_titre['EGC_02_01_titre'] = "Prestation de mise en chantier, balisage, signalisation et mise en sécurité de la zone de travaux";
$table_titre['EGC_02_02_titre'] = "Tranchée traditionnelle en terrain naturel, avec réutilisation des matériaux extraits et évacuation du surplus,largeur 40 cm et profondeur 80 cm maxi sur génératrice supérieure des fourreaux, compris grillage avertisseur";
$table_titre['EGC_02_03_titre'] = "PV pour surlargeur ou surprofondeur tranchée traditionnelle en terrain naturel par tranche de 10 cm";
$table_titre['EGC_02_04_titre'] = "Tranchée pose mécanisée en terrain naturel ou en accotement, sans apport de matériaux, profondeur 60 cm sur génératrice supérieure des fourreaux y compris grillage avertisseur";
$table_titre['EGC_02_05_titre'] = "Tranchée traditionnelle sur trottoir ,largeur 40 cm et profondeur 60 cm sur génératrice supérieure des fourreaux, y compris découpe, apport sable, grillage avertisseur et réfection à l'identique même si enrobé noir à chaud avec joint émulsion";
$table_titre['EGC_02_06_titre'] = "PV pour surlargeur tranchée traditionelle sur Trotoir par tranche de 10 cm";
$table_titre['EGC_02_07_titre'] = "Tranchée traditionnelle sur Chaussée ou Parking ,largeur 40 cm et profondeur 80 cm sur génératrice supérieure des fourreaux, y compris découpe, apport sable, grillage avertisseur et réfection enrobé noir à chaud avec joint émulsion";
$table_titre['EGC_02_08_titre'] = "PV pour surlargeur tranchée traditionelle sur Chaussée ou Parking par tranche de 10 cm";
$table_titre['EGC_02_09_titre'] = "Plus Value Roche sur Tranchée Chaussée";
$table_titre['EGC_02_10_titre'] = "Tranchée traditionnelle chaussée lourde, largeur 40 cm et profondeur 80 cm sur génératrice supérieure des fourreaux, y compris découpe, apport sable, grillage avertisseur et réfection enrobé noir à chaud avec joint émulsion";
$table_titre['EGC_02_11_titre'] = "PV pour surlargeur tranchée traditionelle sur Chaussée Lourde par tranche de 10 cm";
$table_titre['EGC_02_12_titre'] = "PV pour pour remblais en grave ciment à 150kg /m3";
$table_titre['EGC_02_13_titre'] = "PV pour pour remblais en grave bitume";
$table_titre['EGC_02_14_titre'] = "Micro-Tranchée<br />
largeur 20cm et profondeur de 30 sur la génératrice supérieur des fourreaux, apport de sable, grillage avertisseur, remplissage de fouille en beton autocompactant et reprise de l'enrobé avec surlageur de 20cm";
$table_titre['EGC_02_15_titre'] = "Méca-Chaussée<br />
largeur 30cm et profondeur de 60 sur la génératrice supérieur des fourreaux, apport de sable, grillage avertisseur, remplissage de fouille et reprise de l'enrobé avec surlageur de 20cm";
$table_titre['EGC_02_16_titre'] = "Pose d'un fil de détection type plynox avec arrimage en chambre";


$table_unite = array();
$table_unite['EGC_01_01_unit'] = "Forfait";
$table_unite['EGC_01_02_unit'] = "Forfait";
$table_unite['EGC_01_03_unit'] = "ml";

$table_unite['EGC_02_01_unit'] = "Forfait";
$table_unite['EGC_02_02_unit'] = "ml";
$table_unite['EGC_02_03_unit'] = "ml";
$table_unite['EGC_02_04_unit'] = "ml";
$table_unite['EGC_02_05_unit'] = "ml";
$table_unite['EGC_02_06_unit'] = "ml";
$table_unite['EGC_02_07_unit'] = "ml";
$table_unite['EGC_02_08_unit'] = "ml";
$table_unite['EGC_02_09_unit'] = "ml";
$table_unite['EGC_02_10_unit'] = "ml";
$table_unite['EGC_02_11_unit'] = "ml";
$table_unite['EGC_02_12_unit'] = "ml";
$table_unite['EGC_02_13_unit'] = "ml";
$table_unite['EGC_02_14_unit'] = "ml";
$table_unite['EGC_02_15_unit'] = "ml";
$table_unite['EGC_02_16_unit'] = "ml";

$table_int = array();
$table_int['EGC_01_01_int'] = "750";
$table_int['EGC_01_02_int'] = "1250";
$table_int['EGC_01_03_int'] = "3.15";

$table_int['EGC_02_01_int'] = "480";
$table_int['EGC_02_02_int'] = "41";
$table_int['EGC_02_03_int'] = "7";
$table_int['EGC_02_04_int'] = "29";
$table_int['EGC_02_05_int'] = "67";
$table_int['EGC_02_06_int'] = "10";
$table_int['EGC_02_07_int'] = "75";
$table_int['EGC_02_08_int'] = "13";
$table_int['EGC_02_09_int'] = "30";
$table_int['EGC_02_10_int'] = "110";
$table_int['EGC_02_11_int'] = "17";
$table_int['EGC_02_12_int'] = "20";
$table_int['EGC_02_13_int'] = "10";
$table_int['EGC_02_14_int'] = "43";
$table_int['EGC_02_15_int'] = "50";
$table_int['EGC_02_16_int'] = "0.50";
$total_EGC =0;
if($stm->execute()) {
    if($stm->rowCount() > 0) {
        $row = $stm->fetch(PDO::FETCH_ASSOC);


        $data[] = array(
            "EGC_0" => 'EGC_01_01',
            "titre" => $table_titre['EGC_01_01_titre'],
            "qt" => $row['EGC_01_01_qt'],
            "unit" => $table_unite['EGC_01_01_unit'],
            "int" => $table_int['EGC_01_01_int'],
            "total" => $table_int['EGC_01_01_int'] * $row['EGC_01_01_qt']
        );
        $total_EGC +=$table_int['EGC_01_01_int'] * $row['EGC_01_01_qt'];
        $data[] = array(
            "EGC_0" => 'EGC_01_02',
            "titre" => $table_titre['EGC_01_02_titre'],
            "qt" => $row['EGC_01_02_qt'],
            "unit" => $table_unite['EGC_01_02_unit'],
            "int" => $table_int['EGC_01_02_int'],
            "total" => $table_int['EGC_01_02_int'] * $row['EGC_01_02_qt']
        );
        $total_EGC +=$table_int['EGC_01_02_int'] * $row['EGC_01_02_qt'];
        $data[] = array(
            "EGC_0" => 'EGC_01_03',
            "titre" => $table_titre['EGC_01_03_titre'],
            "qt" => $row['EGC_01_03_qt'],
            "unit" => $table_unite['EGC_01_03_unit'],
            "int" => $table_int['EGC_01_03_int'],
            "total" => $table_int['EGC_01_03_int'] * $row['EGC_01_03_qt']
        );
        $total_EGC +=$table_int['EGC_01_03_int'] * $row['EGC_01_03_qt'];
         for($i= 1 ; $i <= 16 ; $i++){
            if($i < 10){
                $data[] = array(
                    "EGC_0" => 'EGC_02_0'.$i,
                    "titre" => $table_titre['EGC_02_0'.$i.'_titre'],
                    "qt" => $row['EGC_02_0'.$i.'_qt'],
                    "unit" => $table_unite['EGC_02_0'.$i.'_unit'],
                    "int" => $table_int['EGC_02_0'.$i.'_int'],
                    "total" => $table_int['EGC_02_0'.$i.'_int']*$row['EGC_02_0'.$i.'_qt']
                );
                $total_EGC +=$table_int['EGC_02_0'.$i.'_int']*$row['EGC_02_0'.$i.'_qt'];
            }

            if($i >= 10  ){
                $data[] = array(
                    "EGC_0" => 'EGC_02_'.$i,
                    "titre" => $table_titre['EGC_02_'.$i.'_titre'],
                    "qt" => $row['EGC_02_'.$i.'_qt'],
                    "unit" => $table_unite['EGC_02_'.$i.'_unit'],
                    "int" => $table_int['EGC_02_'.$i.'_int'],
                    "total" => $row['EGC_02_'.$i.'_qt']*$table_int['EGC_02_'.$i.'_int']
                );
                $total_EGC +=$row['EGC_02_'.$i.'_qt']*$table_int['EGC_02_'.$i.'_int'];
            }

        }
        $data[] = array(
            "EGC_0" => '',
            "titre" => 'Total',
            "qt" => '',
            "unit" => '',
            "int" => '',
            "total" => $total_EGC
        );
    }
}

$grid->renderJSON($data);
