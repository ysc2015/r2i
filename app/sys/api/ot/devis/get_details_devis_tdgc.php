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
$grid->addColumn("TGC_0", "TGC_0", "string",NULL,  false);
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
$table_titre['TGC_01_01_titre'] = "Obtention Autorisation du gestionnaire de la circulation sur la voirie pour intervention génie civil sur une infrastructure existante (Arrêté de Circulation) y compris démarches DICT pour le compte du maître d'ouvrage";

$table_titre['TGC_02_01_titre'] = "Prestation de mise en chantier, balisage, signalisation et mise en sécurité de la zone de travaux";
$table_titre['TGC_02_02_titre'] = "Fouille ponctuelle jusqu'à 80cm de profondeur avec réparation de conduite, amené du matériel et  remise en état à l'identique";
$table_titre['TGC_02_03_titre'] = "Décroutage de Chambre, amené du matériel et  remise en état à l'identique";
$table_titre['TGC_02_04_titre'] = "Décroutage avec réhausse de chambre avec utilisation du cadre et tampons existants, amené du matériel et  remise en état à l'identique";
$table_titre['TGC_02_05_titre'] = "Décroutage avec réhausse de chambre avec utilisation des tampons existants et changement de cadre";
$table_titre['TGC_02_06_titre'] = "Demi journée recherche d'infrastucture sous enrobée ou recouverte";

$table_titre['TGC_03_01_titre'] = "Refection de pavés autoblocants avec remise en place à l'identique<br />
casses prises en charge dans la prestation<br />
la prestation comprend la dépose et la pose";
$table_titre['TGC_03_02_titre'] = "Refection Beton désactivé standard avec remise en place du grain à l'identique";
$table_titre['TGC_03_03_titre'] = "Refection Enrobé Rouge";
$table_titre['TGC_03_04_titre'] = "Refection pavés collés hors fourniture (la fourniture fera l'objet d'un devis sup)<br />
y compris joints";
$table_titre['TGC_03_05_titre'] = "Remise en place d'une pelouse à l'identique de l'existant
y compris fourniture";

$table_titre['TGC_04_01_titre'] = "Fourniture Borne Pavillonaire pour pose sur emprise TDF";
$table_titre['TGC_04_02_titre'] = "Pose de Borne Pavillonaire et adductiion de deux fourreaux";

$table_titre['TGC_05_01_titre'] = "Forfait de mise en place matériel et/ou fouille d'assistance y compris la mise en sécurité";
$table_titre['TGC_05_02_titre'] = "Forage<br />
Linéaire Minimal de 15ML avec arrivée à +/- 5ML d'altimétrie";
$table_titre['TGC_05_03_titre'] = "Fonçage<br />
Y compris fouille en Amont et Aval de l'ouvrage";
$table_titre['TGC_05_04_titre'] = "Encorbellement<br />
avec fourniture d'un tube diamètre 100mm soutubé de 3 fourreaux PEHD 26/32<br />
hors percement de chambre Amont et Aval<br />
Point d'ancrage tous les Mètres";




$table_unite = array();
$table_unite['TGC_01_01_unit'] = "Forfait";

$table_unite['TGC_02_01_unit'] = "Forfait";
$table_unite['TGC_02_02_unit'] = "Forfait";
$table_unite['TGC_02_03_unit'] = "Forfait";
$table_unite['TGC_02_04_unit'] = "Forfait";
$table_unite['TGC_02_05_unit'] = "Forfait";
$table_unite['TGC_02_06_unit'] = "Forfait";
$table_unite['TGC_03_01_unit'] = "M²";
$table_unite['TGC_03_02_unit'] = "M²";
$table_unite['TGC_03_03_unit'] = "M²";
$table_unite['TGC_03_04_unit'] = "M²";
$table_unite['TGC_03_05_unit'] = "M²";

$table_unite['TGC_04_01_unit'] = "Unité";
$table_unite['TGC_04_02_unit'] = "Forfait";
$table_unite['TGC_05_01_unit'] = "Forfait";
$table_unite['TGC_05_02_unit'] = "ML";
$table_unite['TGC_05_03_unit'] = "ML";
$table_unite['TGC_05_04_unit'] = "ML";

$table_int = array();
$table_int['TGC_01_01_int'] = "250";

$table_int['TGC_02_01_int'] = "140";
$table_int['TGC_02_02_int'] = "360";
$table_int['TGC_02_03_int'] = "320";
$table_int['TGC_02_04_int'] = "470";
$table_int['TGC_02_05_int'] = "530";
$table_int['TGC_02_06_int'] = "180";
$table_int['TGC_03_01_int'] = "80";
$table_int['TGC_03_02_int'] = "120";
$table_int['TGC_03_03_int'] = "110";
$table_int['TGC_03_04_int'] = "35";
$table_int['TGC_03_05_int'] = "40";

$table_int['TGC_04_01_int'] = "100";
$table_int['TGC_04_02_int'] = "120";
$table_int['TGC_05_01_int'] = "750";
$table_int['TGC_05_02_int'] = "170";
$table_int['TGC_05_03_int'] = "98";
$table_int['TGC_05_04_int'] = "98";
$total_TGC = 0;
if($stm->execute()) {
    if($stm->rowCount() > 0) {
        $row = $stm->fetch(PDO::FETCH_ASSOC);


        for($i= 1 ; $i <= 1 ; $i++){
            $data[] = array(
                "TGC_0" => 'TGC_01_0'.$i,
                "titre" => $table_titre['TGC_01_0'.$i.'_titre'],
                "qt" => $row['TGC_01_0'.$i.'_qt'],
                "unit" => $table_unite['TGC_01_0'.$i.'_unit'],
                "int" => $table_int['TGC_01_0'.$i.'_int'],
                "total" => $table_int['TGC_01_0'.$i.'_int']*$row['TGC_01_0'.$i.'_qt']
            );
            $total_TGC +=$table_int['TGC_01_0'.$i.'_int']*$row['TGC_01_0'.$i.'_qt'];
        }
        for($i= 1 ; $i <= 6 ; $i++){
            $data[] = array(
                "TGC_0" => 'TGC_02_0'.$i,
                "titre" => $table_titre['TGC_02_0'.$i.'_titre'],
                "qt" => $row['TGC_02_0'.$i.'_qt'],
                "unit" => $table_unite['TGC_02_0'.$i.'_unit'],
                "int" => $table_int['TGC_02_0'.$i.'_int'],
                "total" => $table_int['TGC_02_0'.$i.'_int']*$row['TGC_02_0'.$i.'_qt']
            );
            $total_TGC +=$table_int['TGC_02_0'.$i.'_int']*$row['TGC_02_0'.$i.'_qt'];
        }
        for($i= 1 ; $i <= 5 ; $i++){
            $data[] = array(
                "TGC_0" => 'TGC_03_0'.$i,
                "titre" => $table_titre['TGC_03_0'.$i.'_titre'],
                "qt" => $row['TGC_03_0'.$i.'_qt'],
                "unit" => $table_unite['TGC_03_0'.$i.'_unit'],
                "int" => $table_int['TGC_03_0'.$i.'_int'],
                "total" => $table_int['TGC_03_0'.$i.'_int']*$row['TGC_03_0'.$i.'_qt']
            );
            $total_TGC +=$table_int['TGC_03_0'.$i.'_int']*$row['TGC_03_0'.$i.'_qt'];
        }
        for($i= 1 ; $i <= 2 ; $i++){
            $data[] = array(
                "TGC_0" => 'TGC_04_0'.$i,
                "titre" => $table_titre['TGC_04_0'.$i.'_titre'],
                "qt" => $row['TGC_04_0'.$i.'_qt'],
                "unit" => $table_unite['TGC_04_0'.$i.'_unit'],
                "int" => $table_int['TGC_04_0'.$i.'_int'],
                "total" => $table_int['TGC_04_0'.$i.'_int']*$row['TGC_04_0'.$i.'_qt']
            );
            $total_TGC +=$table_int['TGC_04_0'.$i.'_int']*$row['TGC_04_0'.$i.'_qt'];
        }
        for($i= 1 ; $i <= 4 ; $i++){
            $data[] = array(
                "TGC_0" => 'TGC_05_0'.$i,
                "titre" => $table_titre['TGC_05_0'.$i.'_titre'],
                "qt" => $row['TGC_05_0'.$i.'_qt'],
                "unit" => $table_unite['TGC_05_0'.$i.'_unit'],
                "int" => $table_int['TGC_05_0'.$i.'_int'],
                "total" => $table_int['TGC_05_0'.$i.'_int']*$row['TGC_05_0'.$i.'_qt']
            );
            $total_TGC +=$table_int['TGC_05_0'.$i.'_int']*$row['TGC_05_0'.$i.'_qt'];
        }
        $data[] = array(
            "TGC_0" => '',
            "titre" => 'Total',
            "qt" => '',
            "unit" => '',
            "int" => '',
            "total" => $total_TGC
        );

    }
}

$grid->renderJSON($data);
