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

$grid->addColumn("CGC_0", "CGC_0", "string",NULL,  false);
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
$table_titre['CGC_01_01_titre'] = "Forfait Etude APS APD DOE Chantier de pose de chambre avec un Linéaire Inférrieur ou égal à 15ML<br />
Avec Obtention des Permissions de voirie ou Autorisation du gestionnaire<br />
Obtention des arrêtés de circulation ou déclaration au gestionnaire (y compris DICT)<br />
Plans de recollement au 200ème géoréfrencés au format DWG";
$table_titre['CGC_01_02_titre'] = "Gestion pose de chambre dans le cadre de la réalisation d'un CDD dégroupage<br />
Rdv FT pour Annexe A,B et C avec signature sous mandat de représentation FREE";

$table_titre['CGC_02_01_titre'] = "Prestation de mise en chantier, balisage, signalisation et mise en sécurité de la zone de travaux";
$table_titre['CGC_02_02_titre'] = "Fourniture et pose d'une chambre type L1T en béton Armé avec grille de protection<br />
y compris térrassement et remblayage, percement des masques et reprise, tampon 250KN, remise en état à l'identique";
$table_titre['CGC_02_03_titre'] = "Fourniture et pose d'une chambre type L2T en béton Armé avec grille de protection<br />
y compris térrassement et remblayage, percement des masques et reprise, tampon 250KN, remise en état à l'identique";
$table_titre['CGC_02_04_titre'] = "Fourniture et pose d'une chambre type L2C en béton Armé avec grille de protection<br />
y compris térrassement et remblayage, percement des masques et reprise, tampon 400KN, remise en état à l'identique";
$table_titre['CGC_02_05_titre'] = "Fourniture et pose d'une chambre type L3T en béton Armé avec grille de protection<br />
y compris térrassement et remblayage, percement des masques et reprise, tampon 250KN, remise en état à l'identique";
$table_titre['CGC_02_06_titre'] = "Fourniture et pose d'une chambre type L3C en béton Armé avec grille de protection<br />
y compris térrassement et remblayage, percement des masques et reprise, tampon 400KN, remise en état à l'identique";
$table_titre['CGC_02_07_titre'] ="Fourniture et pose d'une chambre type K2C en béton Armé avec grille de protection<br />
y compris térrassement et remblayage, percement des masques et reprise, tampon 400KN, remise en état à l'identique";
$table_titre['CGC_02_08_titre'] ="PV Pose de chambre sur réseau existant en service y compris semele et ouverture de 2 fourreaux";

$table_titre['CGC_03_01_titre'] ="L2T<br />
Forfait pose d'une chambre ainsi que 2 fourreaux type PVC 42/45 sur un linéaire inférieur ou égal à 15ML<br />
y compris percements";
$table_titre['CGC_03_02_titre'] ="L2C<br />
Forfait pose d'une chambre ainsi que 2 fourreaux type PVC 42/45 sur un linéaire inférieur ou égal à 15ML<br />
y compris percements";
$table_titre['CGC_03_03_titre'] ="L3T<br />
Forfait pose d'une chambre ainsi que 2 fourreaux type PVC 42/45 sur un linéaire inférieur ou égal à 15ML<br />
y compris percements";
$table_titre['CGC_03_04_titre'] ="L3C<br />
Forfait pose d'une chambre ainsi que 2 fourreaux type PVC 42/45 sur un linéaire inférieur ou égal à 15ML<br />
y compris percements";
$table_titre['CGC_03_05_titre'] ="K2C<br />
Forfait pose d'une chambre ainsi que 2 fourreaux type PVC 42/45 sur un linéaire inférieur ou égal à 15ML<br />
y compris percements";

$table_titre['CGC_04_01_titre'] ="Percement chambre existante standard pour 2 fourreaux à une profondeur de 0,6ml";
$table_titre['CGC_04_02_titre'] ="Percement chambre Plafonnée pour 2 fourreaux jusqu'à 1,30ml de profondeur de fouille";

$table_unite = array();
$table_unite['CGC_01_01_unit'] = "Forfait";
$table_unite['CGC_01_02_unit'] = "Forfait";

$table_unite['CGC_02_01_unit'] = "Forfait";
$table_unite['CGC_02_02_unit'] = "Forfait";
$table_unite['CGC_02_03_unit'] = "Forfait";
$table_unite['CGC_02_04_unit'] = "Forfait";
$table_unite['CGC_02_05_unit'] = "Forfait";
$table_unite['CGC_02_06_unit'] = "Forfait";
$table_unite['CGC_02_07_unit'] = "Forfait";
$table_unite['CGC_02_08_unit'] = "Forfait";
$table_unite['CGC_03_01_unit'] = "Forfait";
$table_unite['CGC_03_02_unit'] = "Forfait";
$table_unite['CGC_03_03_unit'] = "Forfait";
$table_unite['CGC_03_04_unit'] = "Forfait";
$table_unite['CGC_03_05_unit'] = "Forfait";
$table_unite['CGC_04_01_unit'] = "Forfait";
$table_unite['CGC_04_02_unit'] = "Forfait";

$table_int = array();
$table_int['CGC_01_01_int'] = "750";
$table_int['CGC_01_02_int'] = "320";

$table_int['CGC_02_01_int'] = "480";
$table_int['CGC_02_02_int'] = "650";
$table_int['CGC_02_03_int'] = "750";
$table_int['CGC_02_04_int'] = "900";
$table_int['CGC_02_05_int'] = "1200";
$table_int['CGC_02_06_int'] = "1350";
$table_int['CGC_02_07_int'] = "1850";
$table_int['CGC_02_08_int'] = "650";
$table_int['CGC_03_01_int'] = "2700";
$table_int['CGC_03_02_int'] = "2850";
$table_int['CGC_03_03_int'] = "3000";
$table_int['CGC_03_04_int'] = "3150";
$table_int['CGC_03_05_int'] = "4100";
$table_int['CGC_04_01_int'] = "104";
$table_int['CGC_04_02_int'] = "340";
$total_CGC = 0;
if($stm->execute()) {
    if($stm->rowCount() > 0) {
        $row = $stm->fetch(PDO::FETCH_ASSOC);


        for($i= 1 ; $i <= 2 ; $i++){
            $data[] = array(
                "CGC_0" => 'CGC_01_0'.$i,
                "titre" => $table_titre['CGC_01_0'.$i.'_titre'],
                "qt" => $row['CGC_01_0'.$i.'_qt'],
                "unit" => $table_unite['CGC_01_0'.$i.'_unit'],
                "int" => $table_int['CGC_01_0'.$i.'_int'],
                "total" => $table_int['CGC_01_0'.$i.'_int']*$row['CGC_01_0'.$i.'_qt']

            );
            $total_CGC += $table_int['CGC_01_0'.$i.'_int']*$row['CGC_01_0'.$i.'_qt'];
        }
        for($i= 1 ; $i <= 8 ; $i++){
            $data[] = array(
                "CGC_0" => 'CGC_02_0'.$i,
                "titre" => $table_titre['CGC_02_0'.$i.'_titre'],
                "qt" => $row['CGC_02_0'.$i.'_qt'],
                "unit" => $table_unite['CGC_02_0'.$i.'_unit'],
                "int" => $table_int['CGC_02_0'.$i.'_int'],
                "total" => $table_int['CGC_02_0'.$i.'_int']*$row['CGC_02_0'.$i.'_qt']
            );
            $total_CGC +=$table_int['CGC_02_0'.$i.'_int']*$row['CGC_02_0'.$i.'_qt'];
        }
        for($i= 1 ; $i <= 5 ; $i++){
            $data[] = array(
                "CGC_0" => 'CGC_03_0'.$i,
                "titre" => $table_titre['CGC_03_0'.$i.'_titre'],
                "qt" => $row['CGC_03_0'.$i.'_qt'],
                "unit" => $table_unite['CGC_03_0'.$i.'_unit'],
                "int" => $table_int['CGC_03_0'.$i.'_int'],
                "total" => $table_int['CGC_03_0'.$i.'_int']*$row['CGC_03_0'.$i.'_qt']
            );
            $total_CGC +=$table_int['CGC_03_0'.$i.'_int']*$row['CGC_03_0'.$i.'_qt'];
        }
        for($i= 1 ; $i <= 2 ; $i++){
            $data[] = array(
                "CGC_0" => 'CGC_04_0'.$i,
                "titre" => $table_titre['CGC_04_0'.$i.'_titre'],
                "qt" => $row['CGC_04_0'.$i.'_qt'],
                "unit" => $table_unite['CGC_04_0'.$i.'_unit'],
                "int" => $table_int['CGC_04_0'.$i.'_int'],
                "total" => $table_int['CGC_04_0'.$i.'_int']*$row['CGC_04_0'.$i.'_qt']
            );
            $total_CGC +=$table_int['CGC_04_0'.$i.'_int']*$row['CGC_04_0'.$i.'_qt'];
        }

        $data[] = array(
            "CGC_0" => '',
            "titre" => 'Total',
            "qt" => '',
            "unit" => '',
            "int" => '',
            "total" => $total_CGC
        );
    }
}

$grid->renderJSON($data);
