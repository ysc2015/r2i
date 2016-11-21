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

    $sousProjet = NULL;

    $d33 = "";
    $d36 = "";
    $d43 = "";
    $d44 = "";
    $d46 = "";
    $d47 = "";
    $d48 = "";
    $d53 = "";
    $d54 = "";
    $d56 = "";

    if(isset($_GET['idsp']) && !empty($_GET['idsp'])){
        $sousProjet = SousProjet::find($_GET['idsp']);
    }

    $tentree = "";

    if($sousProjet !== NULL) {
        switch($_GET['idtot']) {
            case "1" :
                $tentree = "transportaiguillage";
                break;
            case "2" :
                $tentree = "transporttirage";
                break;
            case "3" :
                $tentree = "transportraccordement";
                break;
            case "4" :
                $tentree = "transporttirage";
                //$tentree = "transportraccordement";
                break;
            case "5" :
                $tentree = "distributionaiguillage";
                break;
            case "6" :
                $tentree = "distributiontirage";
                break;
            case "7" :
                $tentree = "distributionraccordement";
                break;
            case "8" :
                $tentree = "distributiontirage";
                //$tentree = "distributionraccordement";
                break;
            default :
                break;
        }

        if($tentree !== "" ) {
            switch($tentree) {
                case "transportaiguillage" :
                    if($sousProjet->{$tentree} !== NULL) {
                        $d33 = $sousProjet->{$tentree}->lineaire5 + $sousProjet->{$tentree}->lineaire6 + $sousProjet->{$tentree}->lineaire7 + $sousProjet->{$tentree}->lineaire8;
                        $d43 = $sousProjet->{$tentree}->lineaire1 + $sousProjet->{$tentree}->lineaire2 + $sousProjet->{$tentree}->lineaire3 + $sousProjet->{$tentree}->lineaire4;
                        $d44 = "";//nbr chambre
                    }
                    break;
                case "distributionaiguillage" :
                    if($sousProjet->{$tentree} !== NULL) {
                        $d33 = $sousProjet->{$tentree}->lineaire5 + $sousProjet->{$tentree}->lineaire6 + $sousProjet->{$tentree}->lineaire7 + $sousProjet->{$tentree}->lineaire8;
                        $d43 = $sousProjet->{$tentree}->lineaire1 + $sousProjet->{$tentree}->lineaire2 + $sousProjet->{$tentree}->lineaire3 + $sousProjet->{$tentree}->lineaire4;
                        $d44 = "";//nbr chambre
                    }
                    break;

                case "transporttirage" :
                    if($sousProjet->{$tentree} !== NULL) {
                        $d36 = $sousProjet->{$tentree}->lineaire12 / 2;
                        $d46 = $sousProjet->{$tentree}->lineaire9 + $sousProjet->{$tentree}->lineaire10 + $sousProjet->{$tentree}->lineaire11;
                        $d48 = $sousProjet->{$tentree}->lineaire12;
                        $d53 = $sousProjet->{$tentree}->lineaire4;//cables
                        $d54 = $sousProjet->{$tentree}->lineaire1 + $sousProjet->{$tentree}->lineaire2 + $sousProjet->{$tentree}->lineaire3;
                        $d56 = "";//nbrchambre * 3
                    }
                    break;
                case "distributiontirage" :
                    if($sousProjet->{$tentree} !== NULL) {
                        $d36 = $sousProjet->{$tentree}->lineaire12 / 2;
                        $d46 = $sousProjet->{$tentree}->lineaire9 + $sousProjet->{$tentree}->lineaire10;
                        $d47 = $sousProjet->{$tentree}->lineaire11;
                        $d48 = $sousProjet->{$tentree}->lineaire12;
                        $d53 = $sousProjet->{$tentree}->lineaire2 + $sousProjet->{$tentree}->lineaire3 + $sousProjet->{$tentree}->lineaire4;
                        $d54 = $sousProjet->{$tentree}->lineaire1;
                        $d56 = "";//nbr chambre * 2
                    }
                    break;
                default :
                    break;
            }
        }

        $update_statment = $db->prepare("UPDATE detaildevis SET D33=:D33,D36=:D36,D43=:D43,D44=:D44,D46=:D46,D47=:D47,D48=:D48,D53=:D53,D54=:D54,D56=:D56 WHERE iddevis=:id");

        $update_statment->bindParam(':D33',$d33);
        $update_statment->bindParam(':D36',$d36);
        $update_statment->bindParam(':D43',$d43);
        $update_statment->bindParam(':D44',$d44);
        $update_statment->bindParam(':D46',$d46);
        $update_statment->bindParam(':D47',$d47);
        $update_statment->bindParam(':D48',$d48);
        $update_statment->bindParam(':D53',$d53);
        $update_statment->bindParam(':D54',$d54);
        $update_statment->bindParam(':D56',$d56);

        $update_statment->bindParam(':id',$id);

        $update_statment->execute();
    }

    $tabreturn = [];
    try {
        $stm = $db->prepare("SELECT * FROM detaildevis WHERE iddevis=:id");
        $stm->bindParam(':id',$id);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_OBJ);

        $Bordereaux = openExcelFile($templateFileName);
        $sheetbordereaux = $Bordereaux->getSheetByName("LOT7_FO");


        if($_GET['idtot'] !=2 && $_GET['idtot'] !=6) {
            $sheetbordereaux->getCell("D76")->setValue($row->TABRAC_24);
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
            $sheetbordereaux->getCell("D86")->setValue($row->NBSOUD);
        }

        $sheetbordereaux->getCell("D33")->setValue($row->D33);
        $sheetbordereaux->getCell("D36")->setValue($row->D36);
        $sheetbordereaux->getCell("D43")->setValue($row->D43);
        $sheetbordereaux->getCell("D44")->setValue($row->D44);
        $sheetbordereaux->getCell("D46")->setValue($row->D46);
        $sheetbordereaux->getCell("D47")->setValue($row->D47);
        $sheetbordereaux->getCell("D48")->setValue($row->D48);
        $sheetbordereaux->getCell("D53")->setValue($row->D53);
        $sheetbordereaux->getCell("D54")->setValue($row->D54);
        $sheetbordereaux->getCell("D56")->setValue($row->D56);






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