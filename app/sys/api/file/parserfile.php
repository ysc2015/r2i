<?php

extract($_GET);

$templateFile = __DIR__."/../uploads/templates/Bordereaux de Prix FTTH_INT_HRZ_INDA.xlsx";
global $start;
$start = microtime(true);
define('WP_USE_THEMES', true);

if(isset($id)) {

    $stm = $db->prepare("SELECT * FROM ressource WHERE id_ressource=:id");
    $stm->bindParam(':id',$id);
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_OBJ);

    $fileName = $row->nom_fichier;

    loadExcelDEF_CABLE($db,__DIR__."/../uploads/". $row->dossier . "/" .$row->nom_fichier_disque,$templateFile);
    $stop = microtime(true);
    //echo "Contenu généré en ".number_format(($stop-$start), 3)." seconde(s)";

}

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

function loadExcelDEF_CABLE($db,$inputFileName,$templateFileName) {
    $start = microtime(true);
    set_time_limit(0);

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

        $Bordereaux = openExcelFile($templateFileName);
        $sheetbordereaux = $Bordereaux->getSheetByName("LOT7_FO");

        foreach ($tabrac as $item){
            switch ($item[1]){
                case 24 : $sheetbordereaux->getCell("D76")->setValue($item[0]);$TABRAC_24 = $item[0];
                case 48 : $sheetbordereaux->getCell("D74")->setValue($item[0]);$TABRAC_48 = $item[0];
                case 72 :  $sheetbordereaux->getCell("D72")->setValue($item[0]);$TABRAC_72 = $item[0];
                case 144 :  $sheetbordereaux->getCell("D70")->setValue($item[0]);$TABRAC_144 = $item[0];
                case 288 :  $sheetbordereaux->getCell("D68")->setValue($item[0]);$TABRAC_288 = $item[0];
                case 432 :  $sheetbordereaux->getCell("D66")->setValue($item[0]);$TABRAC_720 = $item[0];
            }
        }

        foreach ($tabfen as $item){
            switch ($item[1]){
                case 24 : $sheetbordereaux->getCell("D83")->setValue($item[0]);$TABFEN_24 = $item[0];
                case 48 : $sheetbordereaux->getCell("D82")->setValue($item[0]);$TABFEN_48 = $item[0];
                case 72 :  $sheetbordereaux->getCell("D81")->setValue($item[0]);$TABFEN_72 = $item[0];
                case 144 :  $sheetbordereaux->getCell("D80")->setValue($item[0]);$TABFEN_144 = $item[0];
                case 288 :  $sheetbordereaux->getCell("D79")->setValue($item[0]);$TABFEN_288 = $item[0];
                case 432 :  $sheetbordereaux->getCell("D78")->setValue($item[0]);$TABFEN_432 = $item[0];
            }
        }

        $sheetbordereaux->getCell("D84")->setValue($nbtub);
        $sheetbordereaux->getCell("D86")->setValue($NBSOUD);

        $db->query("INSERT INTO `detaildevis` (`iddevis`, `TABEXT_432`, `TABEXT_288`, `TABEXT_144`, `TABEXT_72`, `TABEXT_48`, `TABEXT_24`, 
`TABRAC_720`, `TABRAC_432`, `TABRAC_288`, `TABRAC_144`, `TABRAC_72`, `TABRAC_48`, `TABRAC_24`,
 `TABFEN_432`, `TABFEN_288`, `TABFEN_144`, `TABFEN_72`,
  `TABFEN_48`, `TABFEN_24`,
  `NBTUB`, `NBSOUD`) VALUES (NULL, '".$TABEXT_432."', '".$TABEXT_288."', '".$TABEXT_144."', '".$TABEXT_72."', '".$TABEXT_48."', '".$TABEXT_24."',
   '".$TABRAC_720."', '".$TABRAC_432."', '".$TABRAC_288."', '".$TABRAC_144."', '".$TABRAC_72."', '".$TABRAC_48."', '".$TABRAC_24."',
   '".$TABFEN_432."', '".$TABFEN_288."', '".$TABFEN_144."', '".$TABFEN_72."', '".$TABFEN_48."', '".$TABFEN_24."',
    '".$nbtub."', '".$NBSOUD."');");

        $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
        $cacheSettings = array( ' memoryCacheSize ' => '16MB');
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

        $writer = PHPExcel_IOFactory::createWriter($Bordereaux,'Excel2007');

        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Bordereaux de Prix FTTH_INT_HRZ_INDA.xlsx"');

        // download
        $writer->save('php://output');

        return json_encode($tabreturn);

    } catch (Exception $e) {
        die ('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }
    return -1;
}