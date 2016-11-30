<?php

extract($_GET);

$templateFile = __DIR__."/../uploads/templates/EBM_PON_HRZ_indice_E.xlsx";

define('WP_USE_THEMES', true);

if(isset($id)) {



    parse_DEF_BPE_EBM($db,"",$templateFile,$id);

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

function parse_DEF_BPE_EBM($db,$inputFileName,$templateFileName,$id) {

     $tabreturn = [];
    try {
        $stm = $db->prepare("SELECT * FROM detail_EBM WHERE id_detail_EBM=:id");
        $stm->bindParam(':id',$id);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_OBJ);

        $Bordereaux = openExcelFile($templateFileName);
        $sheetbordereaux = $Bordereaux->getSheetByName("EBM_PON_HRZ");

                $sheetbordereaux->getCell("L35")->setValue($row->cdisortant48);
                $sheetbordereaux->getCell("L37")->setValue(ceil($row->somboitie48));
                $sheetbordereaux->getCell("L34")->setValue($row->cdisortant72);
                $sheetbordereaux->getCell("L39")->setValue($row->somboitie72);
                $sheetbordereaux->getCell("L33")->setValue($row->cdisortant144);
                $sheetbordereaux->getCell("L50")->setValue($row->somboitie144);
                $sheetbordereaux->getCell("L32")->setValue($row->cdisortant288);
                $sheetbordereaux->getCell("L47")->setValue($row->somboitie288);
                $sheetbordereaux->getCell("L31")->setValue($row->cdisortant432);
                $sheetbordereaux->getCell("L30")->setValue($row->cdisortant720);

                $sheetbordereaux->getCell("L24")->setValue($row->capaFO48);
                $sheetbordereaux->getCell("L25")->setValue($row->capaFO72);
                $sheetbordereaux->getCell("L26")->setValue($row->capaFO144);
                $sheetbordereaux->getCell("L27")->setValue($row->capaFO288);
                $sheetbordereaux->getCell("L28")->setValue($row->capaFO432);
                $sheetbordereaux->getCell("L29")->setValue($row->capaFO720);

                $sheetbordereaux->getCell("L56")->setValue($row->LINTUBN14);
                $sheetbordereaux->getCell("L58")->setValue($row->LINTUBN18);
                $sheetbordereaux->getCell("L60")->setValue($row->LINTUBN25);






        $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
        $cacheSettings = array( ' memoryCacheSize ' => '16MB');
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

        $writer = PHPExcel_IOFactory::createWriter($Bordereaux,'Excel2007');

        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="DETAIL_EBM.xlsx"');

        // download
        $writer->save('php://output');

        return json_encode($tabreturn);

    } catch (Exception $e) {
        die ('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }
    return -1;
}