<?php

require_once __DIR__."/config/PHPExcel-1.8/Classes/PHPExcel.php";
require_once __DIR__."/config/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";

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

function lineInsert(PDO $pdo,$line,$sheet_id,$index_line,$params) {
    $i_col = 0;
    $stm_cell = $pdo->prepare("INSERT INTO {$params['cell']} (`cell_value`,`cell_type`,`index_row`,`index_column`,`index`,`sheet_id`) VALUES (:cell_value,:cell_type,:index_row,:index_column,:index,:sheet_id)");

    foreach($line as $k => $cellule) {
        $stm_cell->bindParam(":cell_value",$cellule->getValue());
        $stm_cell->bindParam(":cell_type",$cellule->getDataType());
        $stm_cell->bindParam(":index_row",$index_line);
        $stm_cell->bindParam(":index_column",$i_col);
        $stm_cell->bindParam(":index",$cellule->getCoordinate());
        $stm_cell->bindParam(":sheet_id",$sheet_id);

        $stm_cell->execute();

        $stm_cell->closeCursor();
        $i_col++;
    }

}

class SubTask {
    public $id_parent_tache;
    public $object;
    public $date_debut;
    public $duree;
    public $besoin;
    public $id_priority;
    public $id_projet;
    public $pourcentage;
    public $id_etat;
    public $id_creator;
    public $date_cloture;
    public $date_creation;
    public $payload;
}

function getNewTaskPriority($priority) {
    if(empty($priority) || $priority == null) {
        return 2;
    }
    switch($priority) {
        case '1':
        case '2':
        case '3':
        case '4':
        case '5':
        case 1:
        case 2:
        case 3:
        case 4:
        case 5:
            return $priority;
    }
    $priority = strtolower($priority);
    switch($priority) {
        case 'faible':
            return 1;
        case 'elevée':
            return 3;
        case 'à traiter immédiatement':
            return 4;
        case 'urgent':
            return 5;
    }
    return 2;
}

function getNewTaskEtat($etat) {
    if(empty($etat) || $etat == null) {
        return 1;
    }
    switch($etat) {
        case '1':
        case '2':
        case '3':
        case '4':
        case '5':
        case '6':
        case 1:
        case 2:
        case 3:
        case 4:
        case 5:
        case 6:
            return $etat;
    }
    $etat = strtoupper($etat);
    switch($etat) {
        case 'ATTRIBUE':
            return 2;
        case 'EN COURS':
            return 3;
        case 'TERMINE':
            return 4;
        case 'SUSPENDU':
            return 5;
        case 'ANNULE':
            return 6;
    }
    return 1;
}

function newSubTask(PDO $pdo,SubTask $subTask,$parent_id,$user_id) {

    $stmt = $pdo->prepare("SELECT id_projet FROM tache WHERE id_tache=:id");
    $stmt->bindParam(':id',$parent_id);
    $stmt->execute();
    $id_projet = $stmt->fetch(PDO::FETCH_OBJ)->id_projet;
    $stmt->closeCursor();


    $subTask->id_priority = getNewTaskPriority($subTask->id_priority);
    $subTask->id_etat = getNewTaskEtat($subTask->id_etat);

    if(empty($subTask->pourcentage) || $subTask->pourcentage == null) {
        $subTask->pourcentage = 0;
    }

    $stm = $pdo->prepare('INSERT INTO tache(id_parent_tache,objet_tache,date_debut_tache,duree_tache,besoin_tache,id_priorite,id_projet,pourcentage_tache,id_etat,id_createur,date_creation,subTaskPayload)
    VALUES (:id_parent_tache,:objet_tache,:date_debut_tache,:duree_tache,:besoin_tache,:id_priorite,:id_projet,:pourcentage_tache,:id_etat,:id_createur, Now(),:subTaskPayload)');

    $stm->bindParam(':id_parent_tache',$parent_id);
    $stm->bindParam(':objet_tache',$subTask->object);

    if(!empty($subTask->date_debut) && $subTask->date_debut != null) {
        $stm->bindParam(':date_debut_tache',$subTask->date_debut);
    } else {
        $stm->bindValue(':date_debut_tache',null);
    }
    $stm->bindParam(':duree_tache',$subTask->duree);
    $stm->bindParam(':besoin_tache',$subTask->besoin);
    $stm->bindParam(':id_priorite',$subTask->id_priority);
    $stm->bindParam(':id_projet',$id_projet);
    $stm->bindParam(':pourcentage_tache',$subTask->pourcentage);
    $stm->bindParam(':id_etat',$subTask->id_etat);
    $stm->bindParam(':id_createur',$user_id);

    if($subTask->payload != null && !empty($subTask->payload)) {
        $stm->bindParam(':subTaskPayload',$subTask->payload);
    } else {
        $stm->bindValue(':subTaskPayload',null);
    }

    return $stm->execute();
}

function checkFileStructure($inputFileName) {
    $excel = openExcelFile($inputFileName);
    $indexes['object'] = -1;
    $indexes['date_debut'] = -1;
    $indexes['duree'] = -1;
    $indexes['besoin'] = -1;

    $arr = $excel->getSheetNames();
    foreach ($arr as $key => $value) {
        $sheet = $excel->getSheetByName($value);
        $header = getHeader($sheet);
        $i = 1;
        $found = 0;
        foreach($header as $k => $cellule) {
            $value = $cellule->getValue();
            if(strtolower($value) == "objet" ) {
                $indexes['object'] = $i;
                $found++;
            } else if(strtolower($value) == "duree" || strtolower($value) == "durée") {
                $indexes['duree'] = $i;
                $found++;
            } else if(strtolower($value) == "besoin") {
                $indexes['besoin'] = $i;
                $found++;
            } else if(strtolower($value) == "date_debut" || strtolower($value) == "date" || strtolower($value) == "date debut") {
                $indexes['date_debut'] = $i;
                $found++;
            }
            $i++;
        }
    }
}
 function loadExcelDEF_CABLE($db,$inputFileName) {

     $tabreturn = [];
    //include("config/config.php");
    // $bdd = bdd_connect();

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
               // $bdd->query("TRUNCATE testDEF_BPE");

                $row = 5;
                $max = count($header);
                while($read = getLine($sheet,$row,13)) {
                    if( strstr($read[0], "PDB")) {
                       // $tab[$i][0] = $read[12];//nom
                        //$tab[$i][1] = $read[1];//cpaacite
                        //$tab[$i][2] = $read[8];//nb_cdi_sortant
                        //$tab[$i][3] = $read[9];//nb_cad_sortant
                        //$tab[$i][4] = $read[12];//capa_cable_entrant

                                 die( $read[12]);
                 //       $bdd->query("insert into testDEF_BPE (id,nom,capacite,nb_cdi_sortant,nb_cad_sortant,capa_cable_entrant) values(NULL,'" . $read[0] . "','" . $read[1] . "','" . $read[8] . "','" . $read[9] . "','" . $read[12] . "')");
                        $i++;

                    }
                    $row++;
                }



                die("heeeeeer");
                //echo '</table>';
                $row--;
            }


        }
        die("herrrrrrr");
            $tabext = [];
            $tabfen = [];
            $tabrac = [];
            $nbtubtab = [];


        $i=0;


            $reqpercapacite = $bdd->query("select count(nom),capacite from testDEF_CABLE group by capacite order by capacite ");
        while($percapacite= $reqpercapacite->fetch()){
            $tabext[$i][0] = $percapacite[0] * 2 ;
            $tabext[$i][1] = $percapacite[1];
            $i++;

        }

        $reqpercapacite = $bdd->query("select count(nom),capacite from testDEF_BPE_CABLE group by capacite order by capacite ");
        while($percapacite = $reqpercapacite->fetch()){
            $tabfen[$i][0] = $percapacite[0];
            $tabfen[$i][1] = $percapacite[1];
            $i++;

        }
        $totalnbtub = 0;

        $reqpercapacite = $bdd->query("select nom,capacite,NB_FO_SOUD from testDEF_BPE_CABLE where nom like 'CDI%' and passage like 'OUI' ");
        while($percapacite = $reqpercapacite->fetch()){
            $nbtubtab[$i][0] = $percapacite[0];
            $nbtubtab[$i][1] = $percapacite[2];
            $nbtubtab[$i][2] = ceil($percapacite[2]/12);
            $totalnbtub = $totalnbtub + ceil($percapacite[2]/12);
            $i++;

        }
        $nbtub = $totalnbtub;
        /*echo '<table border="1">';
        echo '<h2>'.$nbtub = $totalnbtub.'</h2>';

        foreach ($tabext as $item){

            echo '<tr><td>' .  $item[0]  . '</td><td>' .  $item[1]   . '</td></tr>';


        }
        echo '</table>';
        echo '<table border="1">';

        foreach ($tabfen as $item){

            echo '<tr><td>' .  $item[0]  . '</td><td>' .  $item[1]   . '</td></tr>';


        }
        echo '</table>';*/

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


        /* echo '<table border="1">';

        foreach ($tabrac as $item){

            echo '<tr><td>' .  $item[0]  . '</td><td>' .  $item[1]   . '</td></tr>';


        }
        echo '</table>';*/



        $tabreturn[0] = $tabext;
        $tabreturn[1] = $tabfen;
        $tabreturn[2] = $tabrac;
        $tabreturn[3] = $nbtub;
        $tabreturn[4] = $NBSOUD ;

        $Bordereaux = openExcelFile("/opt/lampp/htdocs/congresm/pds/file/Bordereaux de Prix FTTH_INT_HRZ_INDA.xlsx");
        $sheetbordereaux = $Bordereaux->getSheetByName("LOT7_FO");

        foreach ($tabrac as $item){
            switch ($item[1]){
                case 48 : $sheetbordereaux->getCell("D74")->setValue($item[0]);
                case 48 : $sheetbordereaux->getCell("D74")->setValue($item[0]);
                case 72 :  $sheetbordereaux->getCell("D72")->setValue($item[0]);;
                case 144 :  $sheetbordereaux->getCell("D70")->setValue($item[0]);;
            }
        }

        foreach ($tabfen as $item){
            switch ($item[1]){
                case 48 : $sheetbordereaux->getCell("D82")->setValue($item[0]);
                case 72 :  $sheetbordereaux->getCell("D81")->setValue($item[0]);
                case 144 :  $sheetbordereaux->getCell("D80")->setValue($item[0]);
            }
        }

        $sheetbordereaux->getCell("D84")->setValue($nbtub);;
        $sheetbordereaux->getCell("D86")->setValue($NBSOUD);;


        $writer = PHPExcel_IOFactory::createWriter($Bordereaux,'Excel2007');
        $writer->save('/opt/lampp/htdocs/congresm/pds/file/file_saved.xlsx');




        return json_encode($tabreturn);

    } catch (Exception $e) {
        die ('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }
    return -1;
}



function getLineFromArray($rows,$index) {
    $lastIndexRow = $rows[$index]->index_row;
    $line = array();
    while($rows[$index]->index_row == $lastIndexRow) {
        $line[] = $rows[$index];
        $index++;
    }
    return $line;
}

function transform(PDO $pdo,$userId,$taskId,$sheetId) {
    try{
        $stmt = $pdo->prepare("SELECT * FROM excel_sheet WHERE sheet_id=:id");
        $stmt->bindParam(':id',$sheetId);
        $stmt->execute();
        $sheetInfo = $stmt->fetch(PDO::FETCH_OBJ);

        $columns = $sheetInfo->columns_nbr;
        $lines = $sheetInfo->lines_nbr;

        $stmt->closeCursor();

        $stmt = $pdo->prepare("SELECT * FROM excel_cell WHERE sheet_id=:id AND index_row = 1 ORDER BY index_row,index_column");
        $stmt->bindParam(':id',$sheetId);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);

        $line = array();
        for($i = 4 ; $i < $columns ; $i++) {
            $line[] = getParamObject($rows[$i]);
        }

        $stmt->closeCursor();

        $stmt = $pdo->prepare("SELECT * FROM excel_cell WHERE sheet_id=:id AND index_row > 1 ORDER BY index_row,index_column");
        $stmt->bindParam(':id',$sheetId);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);

        $j = 0;

        for($i = 0 ; $i < $lines - 1 ; $i++) {
            $subTask = new SubTask();
            $subTask->object = $rows[$i + $j]->cell_value;
            $j++;
            if(preg_match("|([0-9]{4})[/\-]([0-9][0-9]?)[/\-]([0-9][0-9])?|",$rows[$i + $j]->cell_value,$match)) {
                $subTask->date_debut = $match[1]."-".$match[2]."-".$match[3];
            } else if(preg_match("|([0-9][0-9]?)[/\-]([0-9][0-9])?[/-]([0-9]{4})|",$rows[$i + $j]->cell_value,$match)) {
                $subTask->date_debut = $match[3]."-".$match[2]."-".$match[1];
            } else {
                $subTask->date_debut = $rows[$i + $j]->cell_value;
            }
            $j++;
            $subTask->duree = $rows[$i + $j]->cell_value;
            $j++;
            $subTask->besoin = $rows[$i + $j]->cell_value;
            if(count($line) > 0) {
                $subTask->payload = json_encode($line);
            } else {
                $subTask->payload = null;
            }
            newSubTask($pdo,$subTask,$taskId,$userId);

        }

    }catch(Exception $e) {
        var_dump($e);
    }
}

//ini_set('max_execution_time',0);
set_time_limit(0);
loadExcelDEF_CABLE(null,'http://sd-83414.dedibox.fr/svn/r2i/app/sys/readexcel/file/PDS_PEI69-02-test.xls');
//loadExcelDEF_CABLE(null,'/opt/lampp/htdocs/congresm/pds/file/PDS_PEI69-02-test.xls');