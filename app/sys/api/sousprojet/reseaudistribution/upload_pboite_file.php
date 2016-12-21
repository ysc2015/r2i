<?php
/**
 * file: upload_pboite_file.php
 * User: rabii
 */

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

set_time_limit(0);

$output_dir = __DIR__."/../../uploads/plansboites/";
extract($_POST);

$ret = array();

$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (id_sous_projet,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_sous_projet,'distribution_racoord_pboite',:nom_fichier,:nom_fichier_disque,'plansboites',:date_creation)");

if(isset($idsp) && !empty($idsp)) {
    $stm->bindParam(':id_sous_projet',$idsp);
    if (isset($_FILES["myfile"])) {
        $error = $_FILES["myfile"]["error"];
        if (!is_array($_FILES["myfile"]["name"])) {

            $fileName = time() . "_" . $_FILES["myfile"]["name"];

            $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
            $stm->bindParam(':nom_fichier_disque',$fileName);
            $date = date('Y-m-d H:i:s');
            $stm->bindParam(':date_creation',$date);

            if($stm->execute()) {
                $details = array();
                $details['name'] = $db->lastInsertId()."_".time() . "_" . $_FILES["myfile"]["name"];
                $details['id'] = $db->lastInsertId();

                $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$details:[]);
                //traitement du devis pour l'enregistrement dans la base
                $templateFile = __DIR__."/../../uploads/templates/Bordereaux de Prix FTTH_INT_HRZ_INDA.xlsx";

                $stm = $db->prepare("SELECT * FROM ressource WHERE id_ressource=:id");
                $stm->bindParam(':id',$details['id']);
                $stm->execute();
                $row = $stm->fetch(PDO::FETCH_OBJ);

                $fileName = $row->nom_fichier;
                loadExcelDEF_CABLE($db,__DIR__."/../../uploads/". $row->dossier . "/" .$row->nom_fichier_disque,$details['id']);
                loadExcelDEF_BPE_EBM($db,__DIR__."/../../uploads/". $row->dossier . "/" .$row->nom_fichier_disque,$details['id']);

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
                    //traitement du devis pour l'enregistrement dans la base
                    $templateFile = __DIR__."/../../uploads/templates/Bordereaux de Prix FTTH_INT_HRZ_INDA.xlsx";

                    $stm = $db->prepare("SELECT * FROM ressource WHERE id_ressource=:id");
                    $stm->bindParam(':id',$details['id']);
                    $stm->execute();
                    $row = $stm->fetch(PDO::FETCH_OBJ);

                    $fileName = $row->nom_fichier;

                    loadExcelDEF_CABLE($db,__DIR__."/../../uploads/". $row->dossier . "/" .$row->nom_fichier_disque,$details['id']);
                    loadExcelDEF_BPE_EBM($db,__DIR__."/../../uploads/". $row->dossier . "/" .$row->nom_fichier_disque,$details['id']);

                    //fin de traitement du devis pour l'enregistrement dans la base

                }
            }
        }
    }
}

//fin traitement de fichier excel
echo json_encode($ret);