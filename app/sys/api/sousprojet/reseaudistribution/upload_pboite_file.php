<?php
/**
 * file: upload_pboite_file.php
 * User: rabii
 */

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

set_time_limit(0);

$output_dir = __DIR__."/../../uploads/plansboites/";
extract($_POST);

$ret = array();

$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (id_sous_projet,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_sous_projet,'distribution_racoord_pboite',:nom_fichier,:nom_fichier_disque,'plansboites',:date_creation)");

if(isset($idsp) && !empty($idsp)) {
    $stm->bindParam(':id_sous_projet',$idsp);
    if (isset($_FILES["myfile"])) {
        $error = $_FILES["myfile"]["error"];
        if (!is_array($_FILES["myfile"]["name"])) {

            $fileName = time() . "_" . $_FILES["myfile"]["name"];

            $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
            $stm->bindParam(':nom_fichier_disque',$fileName);
            $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

            if($stm->execute()) {
                $details = array();
                $details['name'] = $db->lastInsertId()."_".time() . "_" . $_FILES["myfile"]["name"];
                $details['id'] = $db->lastInsertId();

                $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$details:[]);
                //traitement du devis pour l'enregistrement dans la base
                $templateFile = __DIR__."/../../uploads/templates/Bordereaux de Prix FTTH_INT_HRZ_INDA.xlsx";

                $stm = $db->prepare("SELECT * FROM ressource WHERE id_ressource=:id");
                $stm->bindParam(':id',$details['id']);
                $stm->execute();
                $row = $stm->fetch(PDO::FETCH_OBJ);

                $fileName = $row->nom_fichier;

                loadExcelDEF_CABLE($db,__DIR__."/../../uploads/". $row->dossier . "/" .$row->nom_fichier_disque,$templateFile,$details['id']);
                //fin de traitement du devis pour l'enregistrement dans la base
            }

        } else  {
            $fileCount = count($_FILES["myfile"]["name"]);
            for ($i = 0; $i < $fileCount; $i++) {

                $fileName = time() . "_" . $_FILES["myfile"]["name"][$i];

                $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
                $stm->bindParam(':nom_fichier_disque',$fileName);
                $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

                if($stm->execute()) {
                    $details = array();
                    $details['name'] = $db->lastInsertId()."_".time() . "_" . $_FILES["myfile"]["name"];
                    $details['id'] = $db->lastInsertId();

                    $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$details:[]);
                    //traitement du devis pour l'enregistrement dans la base
                    $templateFile = __DIR__."/../../uploads/templates/Bordereaux de Prix FTTH_INT_HRZ_INDA.xlsx";

                    $stm = $db->prepare("SELECT * FROM ressource WHERE id_ressource=:id");
                    $stm->bindParam(':id',$details['id']);
                    $stm->execute();
                    $row = $stm->fetch(PDO::FETCH_OBJ);

                    $fileName = $row->nom_fichier;

                    loadExcelDEF_CABLE($db,__DIR__."/../../uploads/". $row->dossier . "/" .$row->nom_fichier_disque,$templateFile,$details['id']);

                    //fin de traitement du devis pour l'enregistrement dans la base

                }
            }
        }
    }
}

//traitement de fichier excel

function openExcelFile($file) {
    try {
        $inputFileType = PHPExcel_IOFactory::identify($file);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($file);
        return $objPHPExcel;
    } catch (Exception $ex) {
        throw $ex;
    }
}

function getHeader(PHPExcel_Worksheet $sheet) {
    $col = 0;
    $stop = false;
    $header = array();
    while(!$stop) {
        $cell = $sheet->getCellByColumnAndRow($col,1);
        $col++;
        if(empty($cell->getValue())) {
            $stop = true;
        } else {
            $header[] = $cell;
        }
    }
    return $header;
}

function getLine(PHPExcel_Worksheet $sheet,$line,$max_column) {
    $col = 0;
    $cells = [];
    $nEmpty = 0;

    while($col < $max_column) {
        $cell = $sheet->getCellByColumnAndRow($col,$line);
        $col++;

        /*if($cell->getDataType() == 'n' && $cell->getValue() != $cell->getFormattedValue() && preg_match("|[0-9][0-9]?[/\-][0-9][0-9]?[/\-][0-9][0-9]+|",$cell->getFormattedValue())) {
            $time = strtotime($cell->getFormattedValue());
            $date = date('Y-m-d',$time);
            $cell->setDataType(PHPExcel_Cell_DataType::TYPE_STRING);
            $cell->setValue($date);
        }*/

        if(empty($cell->getValue()) || $cell->getValue() == NULL) {
            $nEmpty++;
        }
        $cells[] = $cell;
    }
    if($nEmpty >= $max_column) {
        return null;
    }
    return $cells;
}

function loadExcelDEF_CABLE($db,$inputFileName,$templateFileName,$idressource) {


    $tabreturn = [];
    try {
        $excel = openExcelFile($inputFileName);
        $stop = microtime(true);
        // echo "Contenu openExcelFile généré en ".number_format(($stop-$start), 3)." seconde(s)<br /><br />";

        $arr = $excel->getSheetNames();
        $stop = microtime(true);
        // echo "Contenu getSheetNames généré en ".number_format(($stop-$start), 3)." seconde(s)<br /><br />";

        $tab=array();
        $i=0;$j=0;$valtrouve = 0;
        $countcap = [];$cap = 0;
        $countg1=0 ;
        $NBSOUD = 0;
        foreach ($arr as $key => $value) {

            $sheet = $excel->getSheetByName($value);
            $header = getHeader($sheet);
            $stop = microtime(true);
            //  echo "Contenu ".$value." généré en ".number_format(($stop-$start), 3)." seconde(s)<br /><br />";

            if($value=="DEF_CABLE"){
                $db->query("TRUNCATE testDEF_CABLE");
                //echo '<table border="1">';
                $row = 4;
                $max = count($header);
                while($read = getLine($sheet,$row,20)) {

                    if( strstr($read[0], "CDI")) {
                        $tab[$i][0] = $read[0];
                        $tab[$i][1] = $read[1];
                        $db->query("insert into testDEF_CABLE (id,nom,capacite,total) values(NULL,'" . $read[0] . "','" . $read[1] . "',1)");
                        $i++;
                    }
                    $row++;
                }
                //echo '</table>';
                $row--;
            }
            elseif ($value=="DEF_BPE"){
                $db->query("TRUNCATE testDEF_BPE_CABLE");

                // echo '<table border="1">';
                $row = 4;
                $max = count($header);
                while($read = getLine($sheet,$row,100)) {

                    if( strstr($read[11], "CDI") && $read[2]=="OUI") {

                        $db->query("insert into testDEF_BPE_CABLE (id,nom,passage,capacite,NB_FO_SOUD) values(NULL,'" . $read[11] . "','" . $read[2] . "','" . $read[12] . "','" . $read[6] . "')") or die();
                        $i++;
                    }
                    $row++;
                }
                $row--;
            }elseif(strstr($value,"CDI")){
                $g1 = $sheet->getCell("G1")->getValue();
                $countg1 = ($countg1 + intval($g1));

            }elseif (strstr($value,"CTR")) {

                $row = 9;
                //$max = count($header);
                $i=0;
                $loop = true;

                while($loop) {
                    $read = getLine($sheet,$row,15);
                    if ($i>5){
                        $loop = false;
                        break;
                    }
                    if($read==null) {
                        $row++;
                        $i++;
                        continue;
                    }
                    $i = 0;
                    if( ( $read[7]== "E") && (strstr($read[13],"CDI"))) {
                        $NBSOUD++;
                    }
                    $row++;
                }


            }

        }
        $tabext = [];
        $tabfen = [];
        $tabrac = [];
        $nbtubtab = [];


        $i=0;


        $reqpercapacite = $db->query("select count(nom),capacite from testDEF_CABLE group by capacite order by capacite ");
        while($percapacite= $reqpercapacite->fetch()){
            $tabext[$i][0] = $percapacite[0] * 2 ;
            $tabext[$i][1] = $percapacite[1];
            $i++;

        }

        $reqpercapacite = $db->query("select count(nom),capacite from testDEF_BPE_CABLE group by capacite order by capacite ");
        while($percapacite = $reqpercapacite->fetch()){
            $tabfen[$i][0] = $percapacite[0];
            $tabfen[$i][1] = $percapacite[1];
            $i++;

        }
        $totalnbtub = 0;

        $reqpercapacite = $db->query("select nom,capacite,NB_FO_SOUD from testDEF_BPE_CABLE where nom like 'CDI%' and passage like 'OUI' ");
        while($percapacite = $reqpercapacite->fetch()){
            $nbtubtab[$i][0] = $percapacite[0];
            $nbtubtab[$i][1] = $percapacite[2];
            $nbtubtab[$i][2] = ceil($percapacite[2]/12);
            $totalnbtub = $totalnbtub + ceil($percapacite[2]/12);
            $i++;

        }
        $nbtub = $totalnbtub;

        $TABEXT_432 = 0; $TABEXT_288= 0; $TABEXT_144= 0; $TABEXT_72= 0; $TABEXT_48= 0; $TABEXT_24= 0;
        $TABRAC_720=0; $TABRAC_432 = 0; $TABRAC_288= 0; $TABRAC_144= 0; $TABRAC_72= 0; $TABRAC_48= 0; $TABRAC_24= 0;
        $TABFEN_432 = 0; $TABFEN_288= 0; $TABFEN_144= 0; $TABFEN_72= 0; $TABFEN_48= 0; $TABFEN_24= 0;

        foreach ($tabext as $item){
            switch ($item[1]){
                case 24 : $TABEXT_24 = $item[0];break;
                case 48 :  $TABEXT_48 = $item[0];break;
                case 72 :  $TABEXT_72 = $item[0];break;
                case 144 :  $TABEXT_144 = $item[0];break;
                case 288 :  $TABEXT_288 = $item[0];break;
                case 432 :   $TABEXT_432 = $item[0];break;
            }
            $insred = 0;
            foreach ($tabfen as $value){

                if($item[1]==$value[1]){
                    $tabrac[$j][1] = $item[1];
                    $tabrac[$j][0] = $item[0] - ($value[0]*2);
                    $insred = 1;
                    $j++;
                }

            }
            // valeur qui ne se trouve plus sur $tabfen

            if($insred==0){
                $tabrac[$j][1] = $item[1];
                $tabrac[$j][0] = $item[0];

            }


        }

        $tabreturn[0] = $tabext;
        $tabreturn[1] = $tabfen;
        $tabreturn[2] = $tabrac;
        $tabreturn[3] = $nbtub;
        $tabreturn[4] = $NBSOUD ;



        foreach ($tabrac as $item){
            switch ($item[1]){
                case 24 : $TABRAC_24 = $item[0];break;
                case 48 : $TABRAC_48 = $item[0];break;
                case 72 :   $TABRAC_72 = $item[0];break;
                case 144 :  $TABRAC_144 = $item[0];break;
                case 288 :  $TABRAC_288 = $item[0];break;
                case 432 :  $TABRAC_720 = $item[0];break;
            }
        }

        foreach ($tabfen as $item){
            switch ($item[1]){
                case 24 :  $TABFEN_24 = $item[0];break;
                case 48 :  $TABFEN_48 = $item[0];break;
                case 72 :   $TABFEN_72 = $item[0];break;
                case 144 :  $TABFEN_144 = $item[0];break;
                case 288 :   $TABFEN_288 = $item[0];break;
                case 432 :   $TABFEN_432 = $item[0];break;
            }
        }


        $db->query("INSERT INTO `detaildevis` (`iddevis`,id_ressource, `TABEXT_432`, `TABEXT_288`, `TABEXT_144`, `TABEXT_72`, `TABEXT_48`, `TABEXT_24`, 
`TABRAC_720`, `TABRAC_432`, `TABRAC_288`, `TABRAC_144`, `TABRAC_72`, `TABRAC_48`, `TABRAC_24`,
 `TABFEN_432`, `TABFEN_288`, `TABFEN_144`, `TABFEN_72`,
  `TABFEN_48`, `TABFEN_24`,
  `NBTUB`, `NBSOUD`, `dateinsert`) VALUES (NULL,$idressource, '".$TABEXT_432."', '".$TABEXT_288."', '".$TABEXT_144."', '".$TABEXT_72."', '".$TABEXT_48."', '".$TABEXT_24."',
   '".$TABRAC_720."', '".$TABRAC_432."', '".$TABRAC_288."', '".$TABRAC_144."', '".$TABRAC_72."', '".$TABRAC_48."', '".$TABRAC_24."',
   '".$TABFEN_432."', '".$TABFEN_288."', '".$TABFEN_144."', '".$TABFEN_72."', '".$TABFEN_48."', '".$TABFEN_24."',
    '".$nbtub."', '".$NBSOUD."','".date('Y-m-d G:i:s')."');");


        return json_encode($tabreturn);

    } catch (Exception $e) {
        die ('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }
    return -1;
}
function loadExcelDEF_BPE_EBM($db,$inputFileName,$idressource) {

    $tabreturn = [];



    try {
        $excel = openExcelFile($inputFileName);

        $arr = $excel->getSheetNames();
        $tab=[];
        $i=0;

        foreach ($arr as $key => $value) {

            $sheet = $excel->getSheetByName($value);
            $header = getHeader($sheet);

            //if(!strstr($value,'CTR')) continue;

            if($value=="DEF_BPE"){
                $db->query("TRUNCATE testDEF_BPE");

                $row = 5;
                $max = count($header);
                while($read = getLine($sheet,$row,13)) {
                    if( strstr($read[0], "PDB")) {
                        $tab[$i][0] = strval($read[0]);//nom
                        $tab[$i][1] = strval($read[1]);//cpaacite
                        $tab[$i][2] = strval($read[8]);//nb_cdi_sortant
                        $tab[$i][3] = strval($read[9]);//nb_cad_sortant
                        $tab[$i][4] = strval(   $read[12]);//capa_cable_entrant

                        $db->query("insert into testDEF_BPE (id,nom,capacite,nb_cdi_sortant,nb_cad_sortant,capa_cable_entrant) values(NULL,'" . $read[0] . "','" . $read[1] . "','" . $read[8] . "','" . $read[9] . "','" . $read[12] . "')");
                        $i++;

                    }
                    $row++;
                }



                $cdisortant48 = 0;
                $cdisortant72 = 0;
                $cdisortant144 = 0;
                $cdisortant288 = 0;
                $cdisortant432 = 0;
                $cdisortant720 = 0;

                $somboitie720   = 0;
                $somboitie432   = 0;
                $somboitie288   = 0;
                $somboitie144   = 0;
                $somboitie72   = 0;
                $somboitie48   = 0;

                $LINTUBN14 = 0;
                $LINTUBN18 = 0;
                $LINTUBN25 = 0;
                $capaFO48 = 0;
                $capaFO72 = 0;
                $capaFO144 = 0;
                $capaFO288 = 0;
                $capaFO432 = 0;
                $capaFO720 = 0;

                $reqselcap =  $db->query("SELECT count(nom) as somme_boitier,SUM(nb_cdi_sortant) as sommenb_cdi_sortant,capa_cable_entrant FROM `testDEF_BPE` group by capa_cable_entrant");
                while ($selcap = $reqselcap->fetch()){
                    print_r($selcap );
                    switch ($selcap['capa_cable_entrant']){
                        case '48':
                            $cdisortant48   = $selcap['sommenb_cdi_sortant'];
                            $somboitie48    = ceil($selcap['somme_boitier']/60);
                            break;
                        case '72':
                            $cdisortant72   = $selcap['sommenb_cdi_sortant'];
                            $somboitie72    = $selcap['somme_boitier'];
                            break;
                        case '144' :
                            $cdisortant144 = $selcap['sommenb_cdi_sortant'];
                            $val144 = (6 * $selcap['somme_boitier']) - $selcap['sommenb_cdi_sortant'];
                            if($val144 < 0 ){
                                $val144 = 0;
                            }else{
                                $val144 = ceil($val144 / 5 );
                            }
                            $somboitie144   =   $val144; //Soustraire le nombre total de CDI sortant par (6* le nombre de BPE 144) si le résultat est négatif mettre la valeur 0 sinon diviser le résultat par 5. Mettre la valeur dans la ligne 50 (Référence FREE TENIO-SKG3-7/10).
                            break;
                        case '288':
                            $cdisortant288  = $selcap['sommenb_cdi_sortant'];
                            $somboitie288   = $selcap['somme_boitier'];
                            break;
                        case '432':
                            $cdisortant432 = $selcap['sommenb_cdi_sortant'];

                            break;
                        case '720':
                            $cdisortant720 = $selcap['sommenb_cdi_sortant'];

                            break;


                    }
                }

                $stm = $db->prepare("INSERT INTO `detail_EBM` (`id_detail_EBM`,`id_ressource`, `cdisortant48`, `cdisortant72`, `cdisortant144`, `cdisortant288`, `cdisortant432`, `cdisortant720`, `somboitie48`, `somboitie72`, `somboitie144`, `somboitie288`, `somboitie432`, `somboitie720`, `LINTUBN14`, `LINTUBN18`, `LINTUBN25`, `capaFO48`, `capaFO72`, `capaFO144`, `capaFO288`, `capaFO432`, `capaFO720`) VALUES (
                    NULL,:id_ressource, :cdisortant48, :cdisortant72, :cdisortant144, :cdisortant288, :cdisortant432, :cdisortant720, :somboitie48, :somboitie72, 
                :somboitie144, :somboitie288, :somboitie432, :somboitie720, :LINTUBN14, :LINTUBN18, :LINTUBN25, :capaFO48, :capaFO72, :capaFO144, :capaFO288, :capaFO432, :capaFO720)");
                $stm->bindParam(':id_ressource',$idressource);
                $stm->bindParam(':cdisortant48',$cdisortant48);
                $stm->bindParam(':cdisortant72',$cdisortant72);
                $stm->bindParam(':cdisortant144',$cdisortant144);
                $stm->bindParam(':cdisortant288',$cdisortant288);
                $stm->bindParam(':cdisortant432',$cdisortant432);
                $stm->bindParam(':cdisortant720',$cdisortant720);
                $stm->bindParam(':somboitie48',$somboitie48);
                $stm->bindParam(':somboitie72',$somboitie72);
                $stm->bindParam(':somboitie144',$somboitie144);
                $stm->bindParam(':somboitie288',$somboitie288);
                $stm->bindParam(':somboitie432',$somboitie432);
                $stm->bindParam(':somboitie720',$somboitie720);

                $stm->bindParam(':LINTUBN14',$LINTUBN14);
                $stm->bindParam(':LINTUBN18',$LINTUBN18);
                $stm->bindParam(':LINTUBN25',$LINTUBN25);

                $stm->bindParam(':capaFO48',$capaFO48);
                $stm->bindParam(':capaFO72',$capaFO72);
                $stm->bindParam(':capaFO144',$capaFO144);
                $stm->bindParam(':capaFO288',$capaFO288);
                $stm->bindParam(':capaFO432',$capaFO432);
                $stm->bindParam(':capaFO720',$capaFO720);

                if($stm->execute()){
                    $tabreturn[0] =  "OK";
                } else  $tabreturn[0] = "NOK";


                $row--;
            }


        }














        return json_encode($tabreturn);

    } catch (Exception $e) {
        die ('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }
    return -1;
}


//fin traitement de fichier excel
echo json_encode($ret);