<?php
/**
 * file: upload_recette_chambre_file.php
 * User: rabii
 */

$output_dir = __DIR__."/../../uploads/flag_csv/";
extract($_POST);

$excelCfg = array(
    "highestColumn" => 'G'
);

$ret = array();

$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (id_sous_projet,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_sous_projet,'distribution_recette_flag_csv',:nom_fichier,:nom_fichier_disque,'flag_csv',:date_creation)");

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
                $stm = $db->prepare("insert into flag_csv (id_sous_projet,id_ressource,type_entree,ref_flag_csv) values (:id_sous_projet,:id_ressource,'distribution_recette_flag_csv',:ref_flag_csv)");
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


                    $stm->bindParam(':id_sous_projet',$idsp);
                    $stm->bindParam(':id_ressource',$lastInsertedId);
                    $stm->bindValue(':ref_flag_csv','ref to change');
                    //inject values SQL
                    $stm->execute();


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