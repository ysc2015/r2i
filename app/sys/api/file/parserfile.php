<?php

extract($_GET);

$templateFile = __DIR__."/../uploads/templates/Bordereaux de Prix FTTH_INT_HRZ_INDA.xlsx";

define('WP_USE_THEMES', true);

if(isset($id)) {



    loadExcelDEF_CABLE($db,"",$templateFile,$id);

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

function loadExcelDEF_CABLE($db,$inputFileName,$templateFileName,$id) {

     $tabreturn = [];
    try {
        $stm = $db->prepare("SELECT * FROM detaildevis WHERE id_ressource=:id");
        $stm->bindParam(':id',$id);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_OBJ);

        $Bordereaux = openExcelFile($templateFileName);
        $sheetbordereaux = $Bordereaux->getSheetByName("LOT7_FO");

        print_r($row);
        echo '<br />';
        echo '*'.$row->TABRAC_24.'*<br />';
        echo '*'.$row->NBSOUD.'*<br />';
        echo '*'.$row->NBTUB.'*<br />';
        /*$sheetbordereaux->getCell("D76")->setValue($row->TABRAC_24);
        $sheetbordereaux->getCell("D74")->setValue($row->TABRAC_48);
        $sheetbordereaux->getCell("D72")->setValue($row->TABRAC_72);
        $sheetbordereaux->getCell("D70")->setValue($row->TABRAC_144);
        $sheetbordereaux->getCell("D68")->setValue($row->TABRAC_288);
        $sheetbordereaux->getCell("D66")->setValue($row->TABRAC_720);


        $sheetbordereaux->getCell("D83")->setValue($row->TABFEN_24);
        $sheetbordereaux->getCell("D82")->setValue($row->TABFEN_48);
        $sheetbordereaux->getCell("D81")->setValue($row->TABFEN_72);
        $sheetbordereaux->getCell("D80")->setValue($row->TABFEN_144);
        $sheetbordereaux->getCell("D79")->setValue($row->TABFEN_288);
        $sheetbordereaux->getCell("D78")->setValue($row->TABFEN_432);


        $sheetbordereaux->getCell("D84")->setValue($row->NBTUB);
        $sheetbordereaux->getCell("D86")->setValue($row->NBSOUD);*/


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