<?php
/**
 * file: upload_aiguillage_chambre.php
 * User: rabii
 */

ini_set("display_errors",'1');
//sleep(2);

$output_dir = __DIR__."/../../uploads/chambres/";
extract($_POST);

$excelCfg = array(
    "highestColumn" => 'G'
);

$ret = array();

$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (id_sous_projet,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_sous_projet,'transport_aiguillage_chambre',:nom_fichier,:nom_fichier_disque,'chambres',:date_creation)");

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

                $lastInsertedId = $db->lastInsertId();
                $stm = $db->prepare("insert into chambre (id_sous_projet,id_ressource,type_entree,ref_chambre,villet,sous_projet,ref_note,code_ch1,code_ch2,gps) values (:id_sous_projet,:id_ressource,'transport_aiguillage_chambre',:ref_chambre,:villet,:sous_projet,:ref_note,:code_ch1,:code_ch2,:gps)");
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
                    $stm->bindParam(':id_sous_projet',$idsp);
                    $stm->bindParam(':id_ressource',$lastInsertedId);
                    $stm->bindParam(':ref_chambre',$value[0]);
                    $stm->bindParam(':villet',$value[1]);
                    $stm->bindParam(':sous_projet',$value[2]);
                    $stm->bindParam(':ref_note',$value[3]);
                    $stm->bindParam(':code_ch1',$value[4]);
                    $stm->bindParam(':code_ch2',$value[5]);
                    $stm->bindParam(':gps',str_replace(" ","",$value[6]));
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
}

echo json_encode($ret);