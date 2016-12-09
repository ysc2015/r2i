<?php
/**
 * file: utils.functions.php
 * User: rabii
 */

function getDuree($date_debut,$date_ret) {
    $now = new DateTime();

    $dd = DateTime::createFromFormat('Y-m-d', $date_debut);
    $df = DateTime::createFromFormat('Y-m-d', $date_ret);

    if($dd && $df && $df < $dd) return "erreur";

    if($dd) {
        if($dd > $now) {
            return "plannifié";
        } else {
            if(!$df) {
                return "en cours";
            } else {
                return ($dd->diff($df)->format("%a") + 1);
            }
        }
    } else {
        return "non démarrée";
    }
}

function getObjectNameForEntry($entree) {
    $str = "";
    switch ($entree) {
        case 'transportaiguillage' : $str='Aiguillage CTR';break;
        case 'transporttirage' : $str='Tirage CTR';break;
        case 'transportraccordement' : $str='Raccordement CTR';break;
        case 'distributionaiguillage' : $str='Aiguillage CDI';break;
        case 'distributiontirage' : $str='Tirage CDI';break;
        case 'distributionraccordement' : $str='Raccordement CDI';break;
        default : break;
    }

    return $str;
}

function setSousProjetUsers($sousprojet) {
    $users_list = array();

    if($sousprojet !== NULL) {
        if($sousprojet instanceof SousProjet) {

            if($sousprojet->plaqueetude !== NULL) {

                if($sousprojet->plaqueetude->charge_etude > 0) {
                    if(!in_array($sousprojet->plaqueetude->charge_etude,$users_list)) {
                        $users_list[] = $sousprojet->plaqueetude->charge_etude;
                    }
                }
            }

            if($sousprojet->plaquecarto !== NULL) {

                if($sousprojet->plaquecarto->intervenant_be > 0) {
                    if(!in_array($sousprojet->plaquecarto->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->plaquecarto->intervenant_be;
                    }
                }
            }

            if($sousprojet->plaqueposadr !== NULL) {

                if($sousprojet->plaqueposadr->intervenant_be > 0) {
                    if(!in_array($sousprojet->plaqueposadr->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->plaqueposadr->intervenant_be;
                    }
                }

                if($sousprojet->plaqueposadr->intervenant > 0) {
                    if(!in_array($sousprojet->plaqueposadr->intervenant,$users_list)) {
                        $users_list[] = $sousprojet->plaqueposadr->intervenant;
                    }
                }

            }

            if($sousprojet->plaquesurvadr !== NULL) {

                if($sousprojet->plaquesurvadr->intervenant > 0) {
                    if(!in_array($sousprojet->plaquesurvadr->intervenant,$users_list)) {
                        $users_list[] = $sousprojet->plaquesurvadr->intervenant;
                    }
                }

            }

            if($sousprojet->transportdesign !== NULL) {

                if($sousprojet->transportdesign->intervenant_be > 0) {
                    if(!in_array($sousprojet->transportdesign->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transportdesign->intervenant_be;
                    }
                }

                if($sousprojet->transportdesign->valideur_bei > 0) {
                    if(!in_array($sousprojet->transportdesign->valideur_bei,$users_list)) {
                        $users_list[] = $sousprojet->transportdesign->valideur_bei;
                    }
                }

            }

            if($sousprojet->transportaiguillage !== NULL) {

                if($sousprojet->transportaiguillage->intervenant_be > 0) {
                    if(!in_array($sousprojet->transportaiguillage->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transportaiguillage->intervenant_be;
                    }
                }

            }

            if($sousprojet->transportcmcctr !== NULL) {

                if($sousprojet->transportcmcctr->intervenant_be > 0) {
                    if(!in_array($sousprojet->transportcmcctr->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transportcmcctr->intervenant_be;
                    }
                }

            }

            if($sousprojet->transporttirage !== NULL) {

                if($sousprojet->transporttirage->intervenant_be > 0) {
                    if(!in_array($sousprojet->transporttirage->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transporttirage->intervenant_be;
                    }
                }

            }

            if($sousprojet->transportraccordement !== NULL) {

                if($sousprojet->transportraccordement->intervenant_be > 0) {
                    if(!in_array($sousprojet->transportraccordement->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transportraccordement->intervenant_be;
                    }
                }

                if($sousprojet->transportraccordement->preparation_pds > 0) {
                    if(!in_array($sousprojet->transportraccordement->preparation_pds,$users_list)) {
                        $users_list[] = $sousprojet->transportraccordement->preparation_pds;
                    }
                }

            }

            if($sousprojet->transportrecette !== NULL) {

                if($sousprojet->transportrecette->intervenant_be > 0) {
                    if(!in_array($sousprojet->transportrecette->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transportrecette->intervenant_be;
                    }
                }

                if($sousprojet->transportrecette->doe > 0) {
                    if(!in_array($sousprojet->transportrecette->doe,$users_list)) {
                        $users_list[] = $sousprojet->transportrecette->doe;
                    }
                }

                if($sousprojet->transportrecette->netgeo > 0) {
                    if(!in_array($sousprojet->transportrecette->netgeo,$users_list)) {
                        $users_list[] = $sousprojet->transportrecette->netgeo;
                    }
                }

                if($sousprojet->transportrecette->intervenant_free > 0) {
                    if(!in_array($sousprojet->transportrecette->intervenant_free,$users_list)) {
                        $users_list[] = $sousprojet->transportrecette->intervenant_free;
                    }
                }

            }

            if($sousprojet->transportcmdfintravaux !== NULL) {

                if($sousprojet->transportcmdfintravaux->intervenant_be > 0) {
                    if(!in_array($sousprojet->transportcmdfintravaux->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transportcmdfintravaux->intervenant_be;
                    }
                }

            }

            if($sousprojet->distributiondesign !== NULL) {

                if($sousprojet->distributiondesign->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributiondesign->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributiondesign->intervenant_be;
                    }
                }

                if($sousprojet->distributiondesign->intervenant_bex > 0) {
                    if(!in_array($sousprojet->distributiondesign->intervenant_bex,$users_list)) {
                        $users_list[] = $sousprojet->distributiondesign->intervenant_bex;
                    }
                }

            }

            if($sousprojet->distributionaiguillage !== NULL) {

                if($sousprojet->distributionaiguillage->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributionaiguillage->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributionaiguillage->intervenant_be;
                    }
                }

            }

            if($sousprojet->distributioncmdcdi !== NULL) {

                if($sousprojet->distributioncmdcdi->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributioncmdcdi->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributioncmdcdi->intervenant_be;
                    }
                }

            }

            if($sousprojet->distributiontirage !== NULL) {

                if($sousprojet->distributiontirage->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributiontirage->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributiontirage->intervenant_be;
                    }
                }

                if($sousprojet->distributiontirage->prep_plans > 0) {
                    if(!in_array($sousprojet->distributiontirage->prep_plans,$users_list)) {
                        $users_list[] = $sousprojet->distributiontirage->prep_plans;
                    }
                }

            }

            if($sousprojet->distributionraccordement !== NULL) {

                if($sousprojet->distributionraccordement->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributionraccordement->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributionraccordement->intervenant_be;
                    }
                }

                if($sousprojet->distributionraccordement->preparation_pds > 0) {
                    if(!in_array($sousprojet->distributionraccordement->preparation_pds,$users_list)) {
                        $users_list[] = $sousprojet->distributionraccordement->preparation_pds;
                    }
                }

            }

            if($sousprojet->distributionrecette !== NULL) {

                if($sousprojet->distributionrecette->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributionrecette->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributionrecette->intervenant_be;
                    }
                }

                if($sousprojet->distributionrecette->doe > 0) {
                    if(!in_array($sousprojet->distributionrecette->doe,$users_list)) {
                        $users_list[] = $sousprojet->distributionrecette->doe;
                    }
                }

                if($sousprojet->distributionrecette->netgeo > 0) {
                    if(!in_array($sousprojet->distributionrecette->netgeo,$users_list)) {
                        $users_list[] = $sousprojet->distributionrecette->netgeo;
                    }
                }

                if($sousprojet->distributionrecette->intervenant_free > 0) {
                    if(!in_array($sousprojet->distributionrecette->intervenant_free,$users_list)) {
                        $users_list[] = $sousprojet->distributionrecette->intervenant_free;
                    }
                }

            }

            if($sousprojet->distributioncmdfintravaux !== NULL) {

                if($sousprojet->distributioncmdfintravaux->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributioncmdfintravaux->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributioncmdfintravaux->intervenant_be;
                    }
                }

            }

            if(!empty($users_list)) {
                $sousprojet->users_in = "|".implode("|",$users_list)."|";
            } else {
                $sousprojet->users_in = "";
            }

            $sousprojet->save();
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

function loadExcelDEF_CABLE($db,$inputFileName,$idressource) {


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
    '".$nbtub."', '".$NBSOUD."','".date('Y-m-d G:i:s')."');") or die("error insertion");


        return json_encode($tabreturn);

    } catch (Exception $e) {
        die ('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }
    return -1;
}
function parse_loadExcelDEF_CABLE($db,$inputFileName,$templateFileName,$id) {

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

                    switch ($selcap['capa_cable_entrant']){
                        case '48':
                            $cdisortant48   = $selcap['sommenb_cdi_sortant'];
                            $somboitie48    = ceil($selcap['somme_boitier']/60);//Diviser le volume total par 60, arrondir à l’entier supérieur et mettre la valeur dans la ligne 37 (Référence FREE MFOA20276)
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

                $stm = $db->prepare(
                    "INSERT INTO `detail_EBM` (
  `id_detail_EBM`,`id_ressource`, `cdisortant48`, `cdisortant72`, `cdisortant144`, `cdisortant288`, `cdisortant432`, `cdisortant720`, `somboitie48`, `somboitie72`, `somboitie144`, `somboitie288`, `somboitie432`, `somboitie720`, `LINTUBN14`, `LINTUBN18`, `LINTUBN25`, `capaFO48`, `capaFO72`, `capaFO144`, `capaFO288`, `capaFO432`, `capaFO720`) VALUES (
                    NULL,:id_ressource, :cdisortant48, :cdisortant72, :cdisortant144, :cdisortant288, :cdisortant432, :cdisortant720, :somboitie48, :somboitie72,
                :somboitie144, :somboitie288, :somboitie432, :somboitie720, :LINTUBN14, :LINTUBN18, :LINTUBN25, :capaFO48, :capaFO72, :capaFO144, :capaFO288, :capaFO432, :capaFO720)");
                $stm->bindValue(':id_ressource',$idressource);
                $stm->bindValue(':cdisortant48',$cdisortant48);
                $stm->bindValue(':cdisortant72',$cdisortant72);
                $stm->bindValue(':cdisortant144',$cdisortant144);
                $stm->bindValue(':cdisortant288',$cdisortant288);
                $stm->bindValue(':cdisortant432',$cdisortant432);
                $stm->bindValue(':cdisortant720',$cdisortant720);
                $stm->bindValue(':somboitie48',$somboitie48);
                $stm->bindValue(':somboitie72',$somboitie72);
                $stm->bindValue(':somboitie144',$somboitie144);
                $stm->bindValue(':somboitie288',$somboitie288);
                $stm->bindValue(':somboitie432',$somboitie432);
                $stm->bindValue(':somboitie720',$somboitie720);

                $stm->bindValue(':LINTUBN14',$LINTUBN14);
                $stm->bindValue(':LINTUBN18',$LINTUBN18);
                $stm->bindValue(':LINTUBN25',$LINTUBN25);

                $stm->bindValue(':capaFO48',$capaFO48);
                $stm->bindValue(':capaFO72',$capaFO72);
                $stm->bindValue(':capaFO144',$capaFO144);
                $stm->bindValue(':capaFO288',$capaFO288);
                $stm->bindValue(':capaFO432',$capaFO432);
                $stm->bindValue(':capaFO720',$capaFO720);

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
function loadExcelDEF_BPE_EBM_CTR($db,$inputFileName,$idressource) {
    $stm = $db->prepare("insert into detail_EBM (id_ressource) values (:id_ressource)");
    $stm->bindParam(":id_ressource",$idressource);
    if($stm->execute()) {
        return true;
    }

    return false;
}
function parse_DEF_BPE_EBM($db,$inputFileName,$templateFileName,$id) {

    $sousProjet = NULL;

    $l8 = 0;
    $l9 = 0;
    $l14 = 0;

    //$l23 = 0;//288
    $l24 = 0;//48
    $l25 = 0;//72
    $l26 = 0;//144
    $l27 = 0;//288
    $l28 = 0;//432
    $l29 = 0;//720

    $l30 = 0;
    $l31 = 0;
    $l32 = 0;
    $l33 = 0;
    $l34 = 0;
    $l35 = 0;

    $l56 = 0;//11/14
    $l58 = 0;//15/18
    $l60 = 0;//21/25

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

                        $l8 = $sousProjet->{$tentree}->lineaire9;
                        $l9 = (!empty($sousProjet->{$tentree}->lineaire10) ? 1 : 0);
                        $l14 = $sousProjet->{$tentree}->lineaire10;

                        //$l23 = $sousProjet->{$tentree}->lineaire3;//288
                        //$l24 = $sousProjet->{$tentree}->lineaire5;//48
                        //$l25 = $sousProjet->{$tentree}->lineaire5;//72
                        $l26 = $sousProjet->{$tentree}->lineaire4;//144
                        $l27 = $sousProjet->{$tentree}->lineaire3;//288
                        $l28 = $sousProjet->{$tentree}->lineaire2;//432
                        $l29 = $sousProjet->{$tentree}->lineaire1;//720

                        $l30 = $sousProjet->{$tentree}->lineaire5;//720
                        $l31 = $sousProjet->{$tentree}->lineaire6;//432
                        $l32 = $sousProjet->{$tentree}->lineaire7;//288
                        $l33 = $sousProjet->{$tentree}->lineaire8;//144
                        //$l34 = $sousProjet->{$tentree}->lineaire8;//48
                        //$l35 = $sousProjet->{$tentree}->lineaire8;//48


                    }
                    break;
                case "distributionaiguillage" :
                    if($sousProjet->{$tentree} !== NULL) {

                        //$l8 = $sousProjet->{$tentree}->lineaire9;
                        //$l9 = (!empty($sousProjet->{$tentree}->lineaire10) ? 1 : 0);
                        //$l14 = $sousProjet->{$tentree}->lineaire10;

                        //$l23 = $sousProjet->{$tentree}->lineaire1;//288
                        $l24 = $sousProjet->{$tentree}->lineaire4;//48
                        $l25 = $sousProjet->{$tentree}->lineaire3;//72
                        $l26 = $sousProjet->{$tentree}->lineaire2;//144
                        $l27 = $sousProjet->{$tentree}->lineaire1;//288
                        //$l28 = $sousProjet->{$tentree}->lineaire2;//432
                        //$l29 = $sousProjet->{$tentree}->lineaire1;//720

                        //$l30 = $sousProjet->{$tentree}->lineaire5;//720
                        //$l31 = $sousProjet->{$tentree}->lineaire6;//432
                        $l32 = $sousProjet->{$tentree}->lineaire5;//288
                        $l33 = $sousProjet->{$tentree}->lineaire6;//144
                        $l34 = $sousProjet->{$tentree}->lineaire8;//48
                        $l35 = $sousProjet->{$tentree}->lineaire8;//48
                    }
                    break;

                case "transporttirage" :
                    if($sousProjet->{$tentree} !== NULL) {

                        $l8 = $sousProjet->{$tentree}->lineaire13;
                        $l9 = (!empty($sousProjet->{$tentree}->lineaire14) ? 1 : 0);
                        $l14 = $sousProjet->{$tentree}->lineaire14;

                        //$l23 = $sousProjet->{$tentree}->lineaire3;//288
                        //$l24 = $sousProjet->{$tentree}->lineaire5;//48
                        //$l25 = $sousProjet->{$tentree}->lineaire5;//72
                        $l26 = $sousProjet->{$tentree}->lineaire4;//144
                        $l27 = $sousProjet->{$tentree}->lineaire3;//288
                        $l28 = $sousProjet->{$tentree}->lineaire2;//432
                        $l29 = $sousProjet->{$tentree}->lineaire1;//720

                        //$l56 = $sousProjet->{$tentree}->lineaire11;//11/14
                        $l58 = $sousProjet->{$tentree}->lineaire11;//15/18
                        $l60 = $sousProjet->{$tentree}->lineaire9;//21/25

                        $l30 = $sousProjet->{$tentree}->lineaire5;//720
                        $l31 = $sousProjet->{$tentree}->lineaire6;//432
                        $l32 = $sousProjet->{$tentree}->lineaire7;//288
                        $l33 = $sousProjet->{$tentree}->lineaire8;//144
                        //$l34 = $sousProjet->{$tentree}->lineaire8;//48
                        //$l35 = $sousProjet->{$tentree}->lineaire8;//48
                    }
                    break;
                case "distributiontirage" :
                    if($sousProjet->{$tentree} !== NULL) {

                        //$l8 = $sousProjet->{$tentree}->lineaire9;
                        //$l9 = (!empty($sousProjet->{$tentree}->lineaire10) ? 1 : 0);
                        //$l14 = $sousProjet->{$tentree}->lineaire10;

                        //$l23 = $sousProjet->{$tentree}->lineaire1;//288
                        $l24 = $sousProjet->{$tentree}->lineaire4;//48
                        $l25 = $sousProjet->{$tentree}->lineaire3;//72
                        $l26 = $sousProjet->{$tentree}->lineaire2;//144
                        $l27 = $sousProjet->{$tentree}->lineaire1;//288
                        //$l28 = $sousProjet->{$tentree}->lineaire2;//432
                        //$l29 = $sousProjet->{$tentree}->lineaire1;//720

                        $l56 = $sousProjet->{$tentree}->lineaire11;//11/14
                        $l58 = $sousProjet->{$tentree}->lineaire10;//15/18
                        //$l60 = $sousProjet->{$tentree}->lineaire9;//21/25

                        //$l30 = $sousProjet->{$tentree}->lineaire5;//720
                        //$l31 = $sousProjet->{$tentree}->lineaire6;//432
                        $l32 = $sousProjet->{$tentree}->lineaire5;//288
                        $l33 = $sousProjet->{$tentree}->lineaire6;//144
                        $l34 = $sousProjet->{$tentree}->lineaire8;//48
                        $l35 = $sousProjet->{$tentree}->lineaire8;//48
                    }
                    break;
                default :
                    break;
            }
        }

        $update_statment = $db->prepare("UPDATE detail_EBM SET L8=:L8,L9=:L9,L14=:L14,cdisortant720=:cdisortant720,cdisortant432=:cdisortant432,cdisortant288=:cdisortant288,cdisortant144=:cdisortant144,cdisortant48=:cdisortant48,capaFO48=:capaFO48,capaFO72=:capaFO72,capaFO144=:capaFO144,capaFO288=:capaFO288,capaFO432=:capaFO432,capaFO720=:capaFO720,LINTUBN14=:LINTUBN14,LINTUBN18=:LINTUBN18,LINTUBN25=:LINTUBN25 WHERE id_detail_EBM=:id");

        $update_statment->bindParam(':L8',$l8);
        $update_statment->bindParam(':L9',$l9);
        $update_statment->bindParam(':L14',$l14);

        $update_statment->bindParam(':capaFO48',$l24);
        $update_statment->bindParam(':capaFO72',$l25);
        $update_statment->bindParam(':capaFO144',$l26);
        $update_statment->bindParam(':capaFO288',$l27);
        $update_statment->bindParam(':capaFO432',$l28);
        $update_statment->bindParam(':capaFO720',$l29);

        $update_statment->bindParam(':cdisortant720',$l30);
        $update_statment->bindParam(':cdisortant432',$l31);
        $update_statment->bindParam(':cdisortant288',$l32);
        $update_statment->bindParam(':cdisortant144',$l33);
        $update_statment->bindParam(':cdisortant48',$l34);

        $update_statment->bindParam(':LINTUBN14',$l56);
        $update_statment->bindParam(':LINTUBN18',$l58);
        $update_statment->bindParam(':LINTUBN25',$l60);

        $update_statment->bindParam(':id',$id);

        $update_statment->execute();
    }

    $tabreturn = [];
    try {
        $stm = $db->prepare("SELECT * FROM detail_EBM WHERE id_detail_EBM=:id");
        $stm->bindParam(':id',$id);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_OBJ);

        $Bordereaux = openExcelFile($templateFileName);
        $sheetbordereaux = $Bordereaux->getSheetByName("EBM_PON_HRZ");

        $sheetbordereaux->getCell("L8")->setValue($row->L8);
        $sheetbordereaux->getCell("L9")->setValue($row->L9);
        $sheetbordereaux->getCell("L14")->setValue($row->L14);

        $sheetbordereaux->getCell("L30")->setValue($row->cdisortant720);
        $sheetbordereaux->getCell("L31")->setValue($row->cdisortant432);
        $sheetbordereaux->getCell("L32")->setValue($row->cdisortant288);
        $sheetbordereaux->getCell("L33")->setValue($row->cdisortant144);
        $sheetbordereaux->getCell("L34")->setValue($row->cdisortant48);
        $sheetbordereaux->getCell("L35")->setValue($row->cdisortant48);

        $sheetbordereaux->getCell("L37")->setValue($row->somboitie48);
        $sheetbordereaux->getCell("L39")->setValue($row->somboitie72);
        $sheetbordereaux->getCell("L50")->setValue($row->somboitie144);
        $sheetbordereaux->getCell("L47")->setValue($row->somboitie288);


        //$sheetbordereaux->getCell("L23")->setValue($row->capaFO288); //Si capa non existante = 0

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
        header('Content-Disposition: attachment; filename="DETAIL_EBM_.xlsx"');

        // download
        $writer->save('php://output');

        return json_encode($tabreturn);

    } catch (Exception $e) {
        die ('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }
    return -1;
}


function checkLinearsForEntry($sousProjet,$entree,$lcount) {
    if($sousProjet->{$entree} !== NULL) {
        for($i=1;$i<=$lcount;$i++) {
            if($sousProjet->{$entree}->{"lineaire".$i} == NULL || /*empty($sousProjet->{$entree}->{"lineaire".$i})*/ $sousProjet->{$entree}->{"lineaire".$i} < 0 || !is_numeric($sousProjet->{$entree}->{"lineaire".$i})) return false;
        }
    }
    return true;
}