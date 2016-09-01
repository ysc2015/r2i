<?php
/**
 * file: ot_upload_chambre_files.php
 * User: rabii
 */

require_once __DIR__."/../../inc/PHPExcel-1.8/Classes/PHPExcel.php";
require_once __DIR__."/../../inc/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";

ini_set("display_errors",'1');

$output_dir = __DIR__."/../uploads/chambres/";
set_time_limit(60);

extract($_POST);


$lastInsertedId = 0;

$excelCfg = array(
    "highestColumn" => 'G'
);
$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (id_objet,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_objet,:type_objet,:nom_fichier,:nom_fichier_disque,'chambres',:date_creation)");

if(isset($idsp) && !empty($idsp)) {
    $stm->bindParam(':id_objet',$idsp);
    $stm->bindParam(':type_objet',$type_objet);
    if (isset($_FILES["myfile"])) {
        $ret = array();
        $error = $_FILES["myfile"]["error"];
        if (!is_array($_FILES["myfile"]["name"])) {
            $fileName = time() . "_" . $_FILES["myfile"]["name"];
            $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$fileName:[]);

            $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
            $stm->bindParam(':nom_fichier_disque',$fileName);
            $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

            if($stm->execute()) {
                $lastInsertedId = $db->lastInsertId();
                $stm = $db->prepare("insert into chambre (id_sous_projet,id_ressource,type_entree,ref_chambre,villet,sous_projet,ref_note,code_ch1,code_ch2,gps) values (:id_sous_projet,:id_ressource,:type_entree,:ref_chambre,:villet,:sous_projet,:ref_note,:code_ch1,:code_ch2,:gps)");
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

                $ret = array();
                $rowData = array();
                $rowData[0][0] = "1";
                //  Loop through each row of the worksheet in turn
                while($rowData[0][0] != "") {
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $excelCfg['highestColumn'] . $row,"",TRUE,FALSE);
                    if($rowData[0][0] != "") {
                        //used for log & dev  test
                        array_push($ret,$rowData[0]);
                    }

                    $row++;
                }
                $row = 1;
                foreach($ret as $key=>$value) {
                    $stm->bindParam(':id_sous_projet',$idsp);
                    $stm->bindParam(':id_ressource',$lastInsertedId);
                    $stm->bindParam(':type_entree',$type_objet);
                    $stm->bindParam(':ref_chambre',$value[0]);
                    $stm->bindParam(':villet',$value[1]);
                    $stm->bindParam(':sous_projet',$value[2]);
                    $stm->bindParam(':ref_note',$value[3]);
                    $stm->bindParam(':code_ch1',$value[4]);
                    $stm->bindParam(':code_ch2',$value[5]);
                    $stm->bindParam(':gps',$value[6]);
                    //inject values SQL
                    $stm->execute();

                    $row++;
                }

                $message[] = "Opération terminée avec succés !";
            } else {
                $err++;
                $message[] = "Erreur enregstrement de fichier !";
            }

        } else  {
            $fileCount = count($_FILES["myfile"]["name"]);
            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = time() . "_" . $_FILES["myfile"]["name"][$i];
                $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName)?$fileName:[]);

                $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
                $stm->bindParam(':nom_fichier_disque',$fileName);
                $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

                $stm->execute();
            }
        }
    }
} else {
    $err++;
    $message[] = "Référence sous projet introuvable !";
}

echo json_encode(array("error" => $err , "message" => $message));