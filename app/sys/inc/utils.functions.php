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
        case 'transportrecette' : $str='Recette CTR';break;
        case 'distributionaiguillage' : $str='Aiguillage CDI';break;
        case 'distributiontirage' : $str='Tirage CDI';break;
        case 'distributionraccordement' : $str='Raccordement CDI';break;
        case 'distributionrecette' : $str='Recette CDI';break;
        default : break;
    }

    return $str;
}

function getTableNameForEntry($entree,$fake=false) {
    $table = "";
    switch ($entree) {
        case 'transportaiguillage' : $table='sous_projet_transport_aiguillage';break;
        case 'transporttirage' : $table='sous_projet_transport_tirage';break;
        case 'transportraccordement' : $table=($fake?'sous_projet_transport_tirage':'sous_projet_transport_raccordements');break;
        case 'transportrecette' : $table='sous_projet_transport_recette';break;
        case 'distributionaiguillage' : $table='sous_projet_distribution_aiguillage';break;
        case 'distributiontirage' : $table='sous_projet_distribution_tirage';break;
        case 'distributionraccordement' : $table=($fake?'sous_projet_distribution_tirage':'sous_projet_distribution_raccordements');break;
        case 'distributionrecette' : $table='sous_projet_distribution_recette';break;
        default : break;
    }

    return $table;
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
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($file);
        return $objPHPExcel;

    } catch (Exception $ex) {
        throw $ex;
    }
}

function openExcelFile_write($file) {
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
    $RFO_01_01 = 0;
    $RFO_01_03 = 0;
    $RFO_01_05 = 0;
    $RFO_01_07 = 0;
    $RFO_01_09 = 0;
    $RFO_01_11 = 0;
    $RFO_01_13 = 0;

    $RFO_01_15_432 = 0;
    $RFO_01_16_288 = 0;
    $RFO_01_17_144 = 0;
    $RFO_01_18_72 = 0;
    $RFO_01_19_48 = 0;
    $RFO_01_20_24 = 0;

    $RFO_01_21 = 0;
    $RFO_01_23 = 0;

    $capacite4 = 0;
    $capacite12 = 0;
    $capacite24 = 0;
    $capacite48 = 0;
    $capacite72 = 0;
    $capacite144= 0;
    $capacite288 = 0;
    $capacite432 = 0;
    $capacite720 = 0;
    $capacite4_pec = 0;// à voir
    $capacite12_pec = 0;// à voir
    $capacite24_pec = 0;
    $capacite48_pec = 0;
    $capacite72_pec = 0;
    $capacite144_pec= 0;
    $capacite288_pec = 0;
    $capacite432_pec = 0;
    $capacite720_pec = 0;
    $RFO_01_23_pec = 0;
    $tab_pdb_E_pec_capacite = [];

    $tabreturn = [];
    try {
        $excel = openExcelFile($inputFileName);



        $arr = $excel->getSheetNames();




        $i=0;

        $tab_defcable_vol_extremites = array(0,0,0,0,0,0,0);
        $tab_defcable_vol_extremites_passage = array(0,0,0,0,0,0,0);
        $tab_defcable_vol_extremites_rac = array(0,0,0,0,0,0,0);
        $nombre_E = 0;

        foreach ($arr as $key => $value) {

            $sheet = $excel->getSheetByName($value);
            $header = getHeader($sheet);

            if ($value=="DEF_CABLE"){
                $row = 5;
                while($read = getLine($sheet,$row,20)) {
                     if( strstr($sheet->getCellByColumnAndRow(0,$row)->getValue(), "CDI")  ) {
                         switch (intval($sheet->getCellByColumnAndRow(1,$row)->getValue()) ){
                            case 24:$tab_defcable_vol_extremites[0]=$tab_defcable_vol_extremites[0] + 2;
                                break;
                            case 48:$tab_defcable_vol_extremites[1] = $tab_defcable_vol_extremites[1] + 2;
                                break;
                            case 72:$tab_defcable_vol_extremites[2]= $tab_defcable_vol_extremites[2] + 2;
                                break;
                            case 144:$tab_defcable_vol_extremites[3]= $tab_defcable_vol_extremites[3] + 2;
                                break;
                            case 288:$tab_defcable_vol_extremites[4]= $tab_defcable_vol_extremites[4] + 2;
                                break;
                            case 432:$tab_defcable_vol_extremites[5]= $tab_defcable_vol_extremites[5] + 2;
                                break;
                            case 720:$tab_defcable_vol_extremites[6]= $tab_defcable_vol_extremites[6] + 2;
                                break;
                        }

                    }
                    $row++;
                }

            }
            if ($value=="DEF_BPE"){


                $row = 5;

                while($read = getLine($sheet,$row,20)) {
                     if( strstr($sheet->getCellByColumnAndRow(0,$row)->getValue(), "PDB") && $sheet->getCellByColumnAndRow(5,$row)->getValue()=="OUI") {
                         switch (intval($sheet->getCellByColumnAndRow(12,$row)->getValue()) ){

                            case 24:$tab_defcable_vol_extremites_passage[0]++;
                                break;
                            case 48:$tab_defcable_vol_extremites_passage[1]++;
                                break;
                            case 72:$tab_defcable_vol_extremites_passage[2]++;
                                break;
                            case 144:$tab_defcable_vol_extremites_passage[3]++;
                                break;
                            case 288:$tab_defcable_vol_extremites_passage[4]++;
                                break;
                            case 432:$tab_defcable_vol_extremites_passage[5]++;
                                break;
                            case 720:$tab_defcable_vol_extremites_passage[6]++;
                                break;


                        }

                    }

                    if( strstr($sheet->getCellByColumnAndRow(0,$row)->getValue(), "PDB") && $sheet->getCellByColumnAndRow(5,$row)->getValue() =="NON") {

                        switch (intval($sheet->getCellByColumnAndRow(12,$row)->getValue()) ){

                            case 24:$tab_defcable_vol_extremites_rac[0]++;
                                break;
                            case 48:$tab_defcable_vol_extremites_rac[1]++;
                                break;
                            case 72:$tab_defcable_vol_extremites_rac[2]++;
                                break;
                            case 144:$tab_defcable_vol_extremites_rac[3]++;
                                break;
                            case 288:$tab_defcable_vol_extremites_rac[4]++;
                                break;
                            case 432:$tab_defcable_vol_extremites_rac[5]++;
                                break;
                            case 720:$tab_defcable_vol_extremites_rac[6]++;
                                break;

                        }
                    }



                    //$tmp = intval($sheet->getCellByColumnAndRow(8,$row)->getValue());
                    //calcule RFO_01_21
                    if( strstr($read[0], "PDB") && $read[5]=="OUI"  ) {

                        $nom_feuille_pdb = substr_replace($read[0],'_',16,0);
                        $nom_feuille_pdb = str_replace('PDB','CDI',$nom_feuille_pdb);
                        $sheet_pdb = $excel->getSheetByName($nom_feuille_pdb);
                        $compteur = 1;
                        $val_E_P="";
                        if($sheet_pdb!=null){
                            $row_pdb = 8;
                            $i=0;
                            $loop = true;
                            while($loop) {

                                $read_pdb = getLine($sheet_pdb,$row_pdb,20);
                                $nom_cable = "";
                                if ($i>5){
                                    $loop = false;
                                    break;
                                }
                                if($read_pdb==null) {

                                    if(strstr($val_E_P,"P") && strstr($val_E_P,"E") ){

                                        $nombre_E++;
                                    }
                                    $compteur=0;
                                    $val_E_P="";

                                    $row_pdb++;
                                    $i++;
                                    continue;
                                }
                                $i = 0;

                                if( $sheet_pdb->getCellByColumnAndRow(1,$row_pdb)->getValue()==$nom_feuille_pdb && ($read_pdb[7]=="E" || $read_pdb[7]=="P" )   && strstr($sheet_pdb->getCellByColumnAndRow(13,$row_pdb)->getValue(),"CDI") ) {
                                    $val_E_P .= $read_pdb[7];
                                    $compteur++;

                                    $nom_cable = $sheet_pdb->getCellByColumnAndRow(1,$row_pdb)->getValue();
                                }
                                $row_pdb++;
                            }

                        }


                        $i++;
                    }

                    // Identification des valeurs Racco Au PEC
                     if( strstr($read[0], "PEC") ) {

                        $nom_feuille_pdb = substr_replace($read[0],'_',16,-2);
                        $nom_feuille_pdb = str_replace('PEC','CTR',$nom_feuille_pdb);
                        $sheet_pdb = $excel->getSheetByName($nom_feuille_pdb);


                        if($sheet_pdb!=null){
                            $row_pdb = 8;
                            $i=0;
                            $loop = true;

                            while($loop) {
                                $read_pdb = getLine($sheet_pdb,$row_pdb,20);
                                if ($i>5){
                                    $loop = false;
                                    break;
                                }
                                if($read_pdb==null) {
                                    $row_pdb++;
                                    $i++;
                                    continue;
                                }
                                $i = 0;
                                if( $read_pdb[7]=="E" ) {
                                    $tab_pdb_E_pec[]= $sheet_pdb->getCellByColumnAndRow(13,$row_pdb)->getValue();
                                    if(strstr($sheet_pdb->getCellByColumnAndRow(13,$row_pdb)->getValue(), "CDI")){
                                        $RFO_01_23_pec++;
                                    }
                                }
                                $row_pdb++;
                            }
                        }
                        $i++;
                    }
                    $row++;
                }
            }
            //Soudures
            if (strstr($value,"CDI")) {

                $row = 9;
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
                        $RFO_01_23++;
                    }
                    $row++;
                }

            }

        }

        $i=0;

        foreach ($tab_defcable_vol_extremites as $val){
        switch ($i){
            case 0:$RFO_01_13 = $val - ($tab_defcable_vol_extremites_passage[$i]*2);$RFO_01_20_24= $tab_defcable_vol_extremites_passage[$i];
                break;
            case 1:$RFO_01_11 = $val - ($tab_defcable_vol_extremites_passage[$i]*2);$RFO_01_19_48= $tab_defcable_vol_extremites_passage[$i];
                break;
            case 2:$RFO_01_09 = $val - ($tab_defcable_vol_extremites_passage[$i]*2);$RFO_01_18_72= $tab_defcable_vol_extremites_passage[$i];
                break;
            case 3:$RFO_01_07 = $val - ($tab_defcable_vol_extremites_passage[$i]*2);$RFO_01_17_144 = $tab_defcable_vol_extremites_passage[$i];
                break;
            case 4:$RFO_01_05 = $val - ($tab_defcable_vol_extremites_passage[$i]*2);$RFO_01_16_288 = $tab_defcable_vol_extremites_passage[$i];
                break;
            case 5:$RFO_01_03 = $val - ($tab_defcable_vol_extremites_passage[$i]*2);$RFO_01_15_432 = $tab_defcable_vol_extremites_passage[$i];
                break;
            case 6:$RFO_01_01 = $val - ($tab_defcable_vol_extremites_passage[$i]*2);
                break;

        }
            $i++;
        }


        $RFO_01_21 = $nombre_E;

        //traitement pec
        $tab_pdb_E_pec = array_unique($tab_pdb_E_pec);
        $sheet_def_cable = $excel->getSheetByName("DEF_CABLE");
        $row_def_cable = 5;

        while ($read_def_cable = getLine($sheet_def_cable, $row_def_cable, 20)) {
            if( in_array($read_def_cable[0],$tab_pdb_E_pec) ){
                foreach ($tab_pdb_E_pec as $val) {
                    if ($val == $read_def_cable[0]) {
                        $tab_pdb_E_pec_capacite[] =array($sheet_def_cable->getCellByColumnAndRow(0,$row_def_cable)->getValue(), $sheet_def_cable->getCellByColumnAndRow(1,$row_def_cable)->getValue());
                    }
                }
            }
            $row_def_cable++;
        }

        foreach ($tab_pdb_E_pec_capacite as $key ){
            switch ($key[1]){
                case 4:$capacite4_pec++;
                    break;
                case 12:$capacite12_pec++;
                    break;
                case 24:$capacite24_pec++;
                    break;
                case 48:$capacite48_pec++;
                    break;
                case 72:$capacite72_pec++;
                    break;
                case 144:$capacite144_pec++;
                    break;
                case 288:$capacite288_pec++;
                    break;
                case 432:$capacite432_pec++;
                    break;
                case 720:$capacite720_pec++;
                    break;
            }
        }

        //traitement d'enregistrement sur la base
        $stm_sel_idressource = $db->prepare("select * from `detaildevis` where id_ressource = :id_ressource");
        $stm_sel_idressource->bindValue(':id_ressource',$idressource);
        $stm_sel_idressource->execute();
        if($stm_sel_idressource->rowCount() > 0){
            //update devis
            $stm = $db->prepare("update `detaildevis` set RFO_01_01_qt = :RFO_01_01_qt,RFO_01_03_qt = :RFO_01_03_qt, RFO_01_05_qt = :RFO_01_05_qt, RFO_01_07_qt=:RFO_01_07_qt,
RFO_01_09_qt= :RFO_01_09_qt, RFO_01_11_qt= :RFO_01_11_qt, RFO_01_13_qt= :RFO_01_13_qt, RFO_01_15_qt= :RFO_01_15_qt, RFO_01_16_qt= :RFO_01_16_qt, RFO_01_17_qt= :RFO_01_17_qt,
RFO_01_18_qt= :RFO_01_18_qt, RFO_01_19_qt= :RFO_01_19_qt, RFO_01_20_qt= :RFO_01_20_qt,  RFO_01_21_qt= :RFO_01_21_qt, RFO_01_23_qt = :RFO_01_23_qt, RFO_01_01_PEC= :RFO_01_01_PEC,
RFO_01_03_PEC= :RFO_01_03_PEC, RFO_01_05_PEC= :RFO_01_05_PEC, RFO_01_07_PEC= :RFO_01_07_PEC, RFO_01_09_PEC= :RFO_01_09_PEC, RFO_01_11_PEC= :RFO_01_11_PEC,
RFO_01_13_PEC= :RFO_01_13_PEC,RFO_01_23_qt_PEC= :RFO_01_23_qt_PEC, dateinsert= :dateinsert where id_ressource =:id_ressource ");
            $dateaction = date('Y-m-d G:i:s');

            $stm->bindValue(':id_ressource',$idressource);
            $stm->bindValue(':RFO_01_01_qt',$RFO_01_01);
            $stm->bindValue(':RFO_01_03_qt',$RFO_01_03);
            $stm->bindValue(':RFO_01_05_qt',$RFO_01_05);
            $stm->bindValue(':RFO_01_07_qt',$RFO_01_07);
            $stm->bindValue(':RFO_01_09_qt',$RFO_01_09);
            $stm->bindValue(':RFO_01_11_qt',$RFO_01_11);
            $stm->bindValue(':RFO_01_13_qt',$RFO_01_13);
            $stm->bindValue(':RFO_01_15_qt',$RFO_01_15_432);
            $stm->bindValue(':RFO_01_16_qt',$RFO_01_16_288);
            $stm->bindValue(':RFO_01_17_qt',$RFO_01_17_144);
            $stm->bindValue(':RFO_01_18_qt',$RFO_01_18_72);
            $stm->bindValue(':RFO_01_19_qt',$RFO_01_19_48);
            $stm->bindValue(':RFO_01_20_qt',$RFO_01_20_24);
            $stm->bindValue(':RFO_01_21_qt',$RFO_01_21);
            $stm->bindValue(':RFO_01_23_qt',$RFO_01_23);
            $stm->bindValue(':RFO_01_01_PEC',$capacite720_pec);
            $stm->bindValue(':RFO_01_03_PEC',$capacite432_pec);
            $stm->bindValue(':RFO_01_05_PEC',$capacite288_pec);
            $stm->bindValue(':RFO_01_07_PEC',$capacite144_pec);
            $stm->bindValue(':RFO_01_09_PEC',$capacite72_pec);
            $stm->bindValue(':RFO_01_11_PEC',$capacite48_pec);
            $stm->bindValue(':RFO_01_13_PEC',$capacite24_pec);
            $stm->bindValue(':RFO_01_23_qt_PEC',$RFO_01_23_pec);
            $stm->bindValue(':dateinsert',$dateaction);
            $stm->execute();
        }else{
            //insert devis
            $stm = $db->prepare("INSERT INTO `detaildevis` (`iddevis`,id_ressource, `RFO_01_01_qt`, `RFO_01_03_qt`, `RFO_01_05_qt`, `RFO_01_07_qt`, `RFO_01_09_qt`, `RFO_01_11_qt`,
`RFO_01_13_qt`, `RFO_01_15_qt`, `RFO_01_16_qt`, `RFO_01_17_qt`, `RFO_01_18_qt`, `RFO_01_19_qt`, `RFO_01_20_qt`,
 `RFO_01_21_qt`, `RFO_01_23_qt`, `RFO_01_01_PEC`, `RFO_01_03_PEC`,  `RFO_01_05_PEC`, `RFO_01_07_PEC`,`RFO_01_09_PEC`, `RFO_01_11_PEC`, `RFO_01_13_PEC`, `RFO_01_23_qt_PEC`, `dateinsert`) 
 VALUES (NULL,  :id_ressource,  :RFO_01_01_qt, :RFO_01_03_qt, :RFO_01_05_qt,  :RFO_01_07_qt, :RFO_01_09_qt, :RFO_01_11_qt,
   :RFO_01_13_qt, :RFO_01_15_qt,    :RFO_01_16_qt, :RFO_01_17_qt, :RFO_01_18_qt,   :RFO_01_19_qt, :RFO_01_20_qt,
   :RFO_01_21_qt, :RFO_01_23_qt,    :RFO_01_01_PEC, :RFO_01_03_PEC,  :RFO_01_05_PEC,   :RFO_01_07_PEC, :RFO_01_09_PEC, :RFO_01_11_PEC,:RFO_01_13_PEC,:RFO_01_23_qt_PEC,:dateaction  )");
            $dateaction = date('Y-m-d G:i:s');
            $stm->bindValue(':id_ressource',$idressource);
            $stm->bindValue(':RFO_01_01_qt',$RFO_01_01);
            $stm->bindValue(':RFO_01_03_qt',$RFO_01_03);
            $stm->bindValue(':RFO_01_05_qt',$RFO_01_05);
            $stm->bindValue(':RFO_01_07_qt',$RFO_01_07);
            $stm->bindValue(':RFO_01_09_qt',$RFO_01_09);
            $stm->bindValue(':RFO_01_11_qt',$RFO_01_11);
            $stm->bindValue(':RFO_01_13_qt',$RFO_01_13);
            $stm->bindValue(':RFO_01_15_qt',$RFO_01_15_432);
            $stm->bindValue(':RFO_01_16_qt',$RFO_01_16_288);
            $stm->bindValue(':RFO_01_17_qt',$RFO_01_17_144);
            $stm->bindValue(':RFO_01_18_qt',$RFO_01_18_72);
            $stm->bindValue(':RFO_01_19_qt',$RFO_01_19_48);
            $stm->bindValue(':RFO_01_20_qt',$RFO_01_20_24);
            $stm->bindValue(':RFO_01_21_qt',$RFO_01_21);
            $stm->bindValue(':RFO_01_23_qt',$RFO_01_23);
            $stm->bindValue(':RFO_01_01_PEC',$capacite720_pec);
            $stm->bindValue(':RFO_01_03_PEC',$capacite432_pec);
            $stm->bindValue(':RFO_01_05_PEC',$capacite288_pec);
            $stm->bindValue(':RFO_01_07_PEC',$capacite144_pec);
            $stm->bindValue(':RFO_01_09_PEC',$capacite72_pec);
            $stm->bindValue(':RFO_01_11_PEC',$capacite48_pec);
            $stm->bindValue(':RFO_01_13_PEC',$capacite24_pec);
            $stm->bindValue(':RFO_01_23_qt_PEC',$RFO_01_23_pec);
            $stm->bindValue(':dateaction',$dateaction);
            $stm->execute();

        }


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

        $Bordereaux = openExcelFile_write($templateFileName);
        $sheetbordereaux = $Bordereaux->getSheetByName("LOT7_FO");


        if($_GET['idtot'] !=2 && $_GET['idtot'] !=6) {
            $sheetbordereaux->getCell("D76")->setValue($row->RFO_01_13_qt);
            $sheetbordereaux->getCell("D74")->setValue($row->RFO_01_11_qt);
            $sheetbordereaux->getCell("D72")->setValue($row->RFO_01_09_qt);
            $sheetbordereaux->getCell("D70")->setValue($row->RFO_01_07_qt);
            $sheetbordereaux->getCell("D68")->setValue($row->RFO_01_05_qt);
            $sheetbordereaux->getCell("D66")->setValue($row->RFO_01_03_qt);


            $sheetbordereaux->getCell("D83")->setValue($row->RFO_01_20_qt);
            $sheetbordereaux->getCell("D82")->setValue($row->RFO_01_19_qt);
            $sheetbordereaux->getCell("D81")->setValue($row->RFO_01_18_qt);
            $sheetbordereaux->getCell("D80")->setValue($row->RFO_01_17_qt);
            $sheetbordereaux->getCell("D79")->setValue($row->RFO_01_16_qt);
            $sheetbordereaux->getCell("D78")->setValue($row->RFO_01_15_qt);


            $sheetbordereaux->getCell("D84")->setValue($row->RFO_01_21_qt);
            $sheetbordereaux->getCell("D86")->setValue($row->RFO_01_23_qt);
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
    $stm_ckeck = $db->prepare("select * from detail_EBM where id_ressource=:id_ressource");

    $stm_ckeck->bindParam(":id_ressource",$idressource);

    if($stm_ckeck->execute()) {

        if($stm_ckeck->rowCount() == 0) {

            $stm = $db->prepare("insert into detail_EBM (id_ressource) values (:id_ressource)");
            $stm->bindParam(":id_ressource",$idressource);
            if($stm->execute()) {
                return true;
            }

        }

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

        $Bordereaux = openExcelFile_write($templateFileName);
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
function return_list_mail_cc_notif($db,$etape,$type,$id_equipe_stt=null){
    $mailaction_stm = $db->prepare("SELECT u.email_utilisateur from projet_mail_creation as pm, utilisateur as u
                        where u.id_utilisateur=pm.id_utilisateur and pm.id_type_notification=$type");
    $mailaction_stm->execute();
    $mailaction_cc = [];

    $mailactions_mail_cc = $mailaction_stm->fetchAll();
    foreach($mailactions_mail_cc as $mailaction_mail_cc){
        $mailaction_cc[] = $mailaction_mail_cc['email_utilisateur'];
    }
    if($type==3){
        $mailaction_stm_stt = $db->prepare("SELECT mail FROM `equipe_stt`,`ordre_de_travail` where `ordre_de_travail`.`id_equipe_stt` = `equipe_stt`.`id_equipe_stt` and  `equipe_stt`.`id_equipe_stt` = $id_equipe_stt");
        $mailaction_stm_stt->execute();
        $mailactions_mail_cc = $mailaction_stm_stt->fetchAll();
        foreach($mailactions_mail_cc as $mailaction_mail_cc){
            $mailaction_cc[] = $mailaction_mail_cc['mail'];
        }

    }
    return $mailaction_cc;
}
function return_list_mail_cc_notif_tache($db,$email_utilisateur_connecte,$type){
    $mailaction_stm = $db->prepare("SELECT u.email_utilisateur from projet_mail_creation as pm, utilisateur as u
                        where u.id_utilisateur=pm.id_utilisateur and pm.id_type_notification=$type");
    $mailaction_stm->execute();
    $mailaction_cc = [];
    $mailaction_cc[] = $email_utilisateur_connecte;
    $mailactions_mail_cc = $mailaction_stm->fetchAll();
    foreach($mailactions_mail_cc as $mailaction_mail_cc){
        $mailaction_cc[] = $mailaction_mail_cc['email_utilisateur'];
    }

    return $mailaction_cc;

}
function return_list_mail_vpi_par_nro($db,$idnro){
    $mailaction_stm = $db->prepare("SELECT utilisateur.email_utilisateur FROM `nro`,utilisateur where  nro.id_nro =  $idnro and utilisateur.id_utilisateur = nro.id_utilisateur and utilisateur.id_profil_utilisateur = 7");//7 = id vpi
    $mailaction_stm->execute();
    $mailaction_cc = [];
    $mailactions_mail_cc = $mailaction_stm->fetchAll();
    foreach($mailactions_mail_cc as $mailaction_mail_cc){
        $mailaction_cc[] = $mailaction_mail_cc['email_utilisateur'];
    }
    return $mailaction_cc;
}
function return_list_mail_vpi_par_nro_ot($db,$idnro,$id_equipe_stt, $id_entreprise){
    $mailaction_cc = [];
    $sql_contact_entreprise = "SELECT contact_email FROM entreprises_stt where  `entreprises_stt`.`id_entreprise`  = $id_entreprise";
    $stm_mail_entreprise = $db->prepare($sql_contact_entreprise);
    $stm_mail_entreprise->execute();
    $mail_entreprise = $stm_mail_entreprise->fetchAll();
    foreach($mail_entreprise as $mail_entreprise_email){
        $mailaction_cc[] = $mail_entreprise_email['contact_email'];
    }
    return $mailaction_cc;
}
function return_list_bei_du_nro($db,$idnro){
    $mailaction_cc = [];
    $sql = "SELECT utilisateur.email_utilisateur FROM `nro`,utilisateur,profil_utilisateur where  nro.id_nro =  $idnro and utilisateur.id_utilisateur = nro.id_utilisateur and `profil_utilisateur`.`id_profil_utilisateur`= `utilisateur`.`id_profil_utilisateur` and `utilisateur`.`id_profil_utilisateur` = 4 ";
    $mailaction_stm = $db->prepare($sql);
    $mailaction_stm->execute();

    $mailactions_mail_cc = $mailaction_stm->fetchAll();
    foreach($mailactions_mail_cc as $mailaction_mail_cc){
        $mailaction_cc[] = $mailaction_mail_cc['email_utilisateur'];
    }
    return $mailaction_cc;
}

function return_list_vpi_pci_du_nro($db,$idnro){
$mailaction_cc = [];
    $sql = "SELECT utilisateur.email_utilisateur FROM `nro`,utilisateur,profil_utilisateur where  nro.id_nro =  $idnro and utilisateur.id_utilisateur = nro.id_utilisateur and `profil_utilisateur`.`id_profil_utilisateur`= `utilisateur`.`id_profil_utilisateur` and (`utilisateur`.`id_profil_utilisateur` = 8 || `utilisateur`.`id_profil_utilisateur` = 7)";
    $mailaction_stm = $db->prepare($sql);
    $mailaction_stm->execute();

    $mailactions_mail_cc = $mailaction_stm->fetchAll();
    foreach($mailactions_mail_cc as $mailaction_mail_cc){
        $mailaction_cc[] = $mailaction_mail_cc['email_utilisateur'];
    }
    return $mailaction_cc;
}
function return_list_pci_du_nro($db,$idnro){
    $mailaction_cc = [];
    $sql = "SELECT utilisateur.email_utilisateur FROM `nro`,utilisateur,profil_utilisateur where  nro.id_nro =  $idnro and utilisateur.id_utilisateur = nro.id_utilisateur and `profil_utilisateur`.`id_profil_utilisateur`= `utilisateur`.`id_profil_utilisateur` and `utilisateur`.`id_profil_utilisateur` = 8 ";
    $mailaction_stm = $db->prepare($sql);
    $mailaction_stm->execute();

    $mailactions_mail_cc = $mailaction_stm->fetchAll();
    foreach($mailactions_mail_cc as $mailaction_mail_cc){
        $mailaction_cc[] = $mailaction_mail_cc['email_utilisateur'];
    }
    return $mailaction_cc;
}
function return_list_entreprise_stt($db,$id_equipe_stt=null, $id_order_travail){
    $mailaction_cc = [];
    $mailaction_stm_stt = $db->prepare("SELECT mail FROM `equipe_stt`,`ordre_de_travail` where `ordre_de_travail`.`id_equipe_stt` = `equipe_stt`.`id_equipe_stt` and  `ordre_de_travail`.`id_ordre_de_travail` = $id_order_travail");
    $mailaction_stm_stt->execute();
    $mailactions_mail_cc = $mailaction_stm_stt->fetchAll();
    foreach($mailactions_mail_cc as $mailaction_mail_cc){
        $mailaction_cc[] = $mailaction_mail_cc['mail'];
    }
    return $mailaction_cc;
}

function get_email_by_id($db,$tabusers){
     $sql = "SELECT utilisateur.email_utilisateur FROM utilisateur where utilisateur.id_utilisateur IN (".implode(",",$tabusers).") ";

    $mailaction_stm = $db->prepare($sql);
    $mailaction_stm->execute();
    $mailaction_cc = [];
    $mailactions_mail_cc = $mailaction_stm->fetchAll();
    foreach($mailactions_mail_cc as $mailaction_mail_cc){
        $mailaction_cc[] = $mailaction_mail_cc['email_utilisateur'];
    }


    return $mailaction_cc;
}

/**
 * @param $db
 * @param $
 * @param $code_sous_projet
 * @param $ctr_cdi
 * @param $etape
 * @param $type_mail
 * @return array
 */
function get_content_html_mail_by_type($db,$code_sous_projet,$ctr_cdi,$etape=null,$type_mail,$nom_entreprise=null,$nom_ot=null,$ville=null,$boite=null,$chambre=null,$nberchambre=null,$totallineaire=null,$id_chef_equipe=null){
    $sql = "SELECT * FROM `mail_notification_template` where type = :type";
    $sqlstatement = $db->prepare($sql);
    $sqlstatement->bindValue(':type',$type_mail);
    $sqlstatement->execute();
    $statement = $sqlstatement->fetchAll();
    $num_tel_chef_projet = "";
    if($id_chef_equipe!=null){
        $sql = "SELECT * FROM `utilisateur` where id_utilisateur = :id_utilisateur";
        $sqlstatement_utilisateur = $db->prepare($sql);
        $sqlstatement_utilisateur->bindValue(':id_utilisateur',$id_chef_equipe);
        $sqlstatement_utilisateur->execute();
        $statement_utilisateur = $sqlstatement_utilisateur->fetch();

        $num_tel_chef_projet = $statement_utilisateur['telephone_utilisateur'];
    }

    $statement[0][1]    = str_replace('@etape_sous_projet',$etape,$statement[0][1]);
    $statement[0][1]    = str_replace('@code_sous_projet',$code_sous_projet,$statement[0][1] );
    $statement[0][1]    = str_replace('@CDI_CTR',$ctr_cdi,$statement[0][1] );
    $statement[0][1]    = str_replace('@nom_entreprise_stt',$nom_entreprise,$statement[0][1] );
    //$statement[0][1]    = str_replace('@nom_traiteur_action',$connectedProfil->profil->prenom_utilisateur." ".$connectedProfil->profil->nom_utilisateur,$statement[0][1] );
    if($boite!=null){
        $statement[0][1]    = str_replace('@b_720',$boite[0],$statement[0][1] );
        $statement[0][1]    = str_replace('@b_432',$boite[1],$statement[0][1] );
        $statement[0][1]    = str_replace('@b_288',$boite[2],$statement[0][1] );
        $statement[0][1]    = str_replace('@b_144',$boite[3],$statement[0][1] );
        $statement[0][1]    = str_replace('@b_72',$boite[4],$statement[0][1] );
        $statement[0][1]    = str_replace('@b_48',$boite[4],$statement[0][1] );
    }
    if($chambre!=null){
        $statement[0][1]    = str_replace('@c_720',$chambre[0],$statement[0][1] );
        $statement[0][1]    = str_replace('@c_432',$chambre[1],$statement[0][1] );
        $statement[0][1]    = str_replace('@c_288',$chambre[2],$statement[0][1] );
        $statement[0][1]    = str_replace('@c_144',$chambre[3],$statement[0][1] );
        $statement[0][1]    = str_replace('@c_72',$chambre[4],$statement[0][1] );
        $statement[0][1]    = str_replace('@c_48',$chambre[4],$statement[0][1] );

    }

    $statement[0][1]    = str_replace('@nom_ot',$nom_ot,$statement[0][1] );
    $statement[0][1]    = str_replace('@ville',$ville,$statement[0][1] );
    $statement[0][1]    = str_replace('@nombres_chambre',$nberchambre,$statement[0][1] );
    $statement[0][1]    = str_replace('@total_lineaire',$totallineaire,$statement[0][1] );

    $statement[0][1]    = str_replace('@num_tel_chef_equipe',$num_tel_chef_projet,$statement[0][1] );

    $statement[0][3]    = str_replace('@etape_sous_projet',$etape,$statement[0][3]);
    $statement[0][3]    = str_replace('@code_sous_projet',$code_sous_projet,$statement[0][3] );
    $statement[0][3]    = str_replace('@CDI_CTR',$ctr_cdi,$statement[0][3] );
    $statement[0][3]    = str_replace('@nom_entreprise_stt',$nom_entreprise,$statement[0][3] );
    $statement[0][3]    = str_replace('@nom_ot',$nom_ot,$statement[0][3] );






    return array($statement[0][1],$statement[0][3]);

}
function checkLinearsForEntry($sousProjet,$entree,$lcount) {
    if($sousProjet->{$entree} !== NULL) {
        for($i=1;$i<=$lcount;$i++) {
            if($sousProjet->{$entree}->{"lineaire".$i} == NULL || /*empty($sousProjet->{$entree}->{"lineaire".$i})*/ $sousProjet->{$entree}->{"lineaire".$i} < 0 || !is_numeric($sousProjet->{$entree}->{"lineaire".$i})) return false;
        }
    }
    return true;
}

function getOTColorFromStatus($status) {
    $color = "#ffe699";
    switch($status) {
        case 1 : //Crée
            $color = "#ffe699";
            break;
        case 2 ://Affecté
            $color = "#bdd7ee";
            break;
        case 3 ://Transmis
            $color = "#2e75b6";
            break;
        case 4 ://Pris en charge
            $color = "#c5e0b4";
            break;
        case 5 ://En cours de Traitement
            $color = "#548235";
            break;
        case 6 ://Traité
            $color = "#7030a0";
            break;
        case 7 ://Annulé
            $color = "#c9c9c9";
            break;
        case 8 ://Reprogrammé
            $color = "#9dc3e6";
            break;
        case 9 ://Indisponibilité Equipe
            $color = "#ff0000";
            break;

        default : $color = "#ffe699";break;
    }

    return $color;

}

