<?php
/**
 * file: upload_bkp.php
 * User: rabii
 */

ini_set("display_errors",'1');
//sleep(2);

$output_dir = __DIR__."/../../uploads/chambres/";
extract($_POST);

$excelCfg = array(
    "highestColumn" => 'T'
);

$ret = array();

$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values ('bkp',:nom_fichier,:nom_fichier_disque,'chambres',:date_creation)");

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

            $lastInsertedId = $db->lastInsertId();
            $stm = $db->prepare("insert into abkp (dep,Ville,Emprise,Zone,Phase,Type1,nb_zone_plaque,lr_pm_exist,lr,nbr_site,nb_fo_pm,nb_fo_pmz,code_site,Type2,Auto_Adduction,Travaux_adduction,Recette_Adduction,Instigateur,Vague,Date_Lancement) values (:dep,:Ville,:Emprise,:Zone,:Phase,:Type1,:nb_zone_plaque,:lr_pm_exist,:lr,:nbr_site,:nb_fo_pm,:nb_fo_pmz,:code_site,:Type2,:Auto_Adduction,:Travaux_adduction,:Recette_Adduction,:Instigateur,:Vague,:Date_Lancement)");
            //  Read your Excel workbook
            try {
                $inputFileType = PHPExcel_IOFactory::identify($output_dir . $fileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($output_dir . $fileName);
            } catch(Exception $e) {
                $message[] = 'Error loading file "'.pathinfo($output_dir . $fileName,PATHINFO_BASENAME).'": '.$e->getMessage();
            }

            //  Get worksheet dimensions
            $sheet = $objPHPExcel->getSheet(0);

            $row = 2;

            $ret2 = array();
            $rowData = array();
            $rowData[0][0] = "1";
            //  Loop through each row of the worksheet in turn
            while($rowData[0][0] != "") {
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $excelCfg['highestColumn'] . $row,"",TRUE,FALSE);
                if($rowData[0][0] != "") {
                    //used for log & dev  test
                    array_push($ret2,$rowData[0]);
                }

                $row++;
            }
            $row = 1;
            foreach($ret2 as $key=>$value) {
                $stm->bindParam(':dep',trim($value[0]));
                $stm->bindParam(':Ville',trim($value[1]));
                $stm->bindParam(':Emprise',trim($value[2]));
                $stm->bindParam(':Zone',trim($value[3]));
                $stm->bindParam(':Phase',trim($value[4]));
                $stm->bindParam(':Type1',trim($value[5]));
                $stm->bindParam(':nb_zone_plaque',trim($value[6]));
                $stm->bindParam(':lr_pm_exist',trim($value[7]));
                $stm->bindParam(':lr',trim($value[8]));
                $stm->bindParam(':nbr_site',trim($value[9]));
                $stm->bindParam(':nb_fo_pm',trim($value[10]));
                $stm->bindParam(':nb_fo_pmz',trim($value[11]));
                $stm->bindParam(':code_site',trim($value[12]));
                $stm->bindParam(':Type2',trim($value[13]));
                $stm->bindParam(':Auto_Adduction',trim($value[14]));
                $stm->bindParam(':Travaux_adduction',trim($value[15]));
                $stm->bindParam(':Recette_Adduction',trim($value[16]));
                $stm->bindParam(':Instigateur',trim($value[17]));
                $stm->bindParam(':Vague',trim($value[18]));
                $stm->bindParam(':Date_Lancement',date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($value[19])));

                //inject values SQL
                $stm->execute();

                $row++;
            }
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
            }
        }
    }
}

echo json_encode($ret);