<?php
/**
 * file: chambre_image_upload.php
 * User: rabii
 */

ini_set("display_errors",'1');
//sleep(2);

$output_dir = __DIR__."/../../uploads/chambres/";
extract($_POST);

$ret = array();

$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (id_chambre,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_chambre,'chambre_image',:nom_fichier,:nom_fichier_disque,'chambres',:date_creation)");

if(isset($idch) && !empty($idch)) {
    $stm->bindParam(':id_chambre',$idch);
    if (isset($_FILES["myfile"])) {
        $error = $_FILES["myfile"]["error"];
        if (!is_array($filename)) {

            $MyfileName = time() . "_" . $filename;

            $stm->bindParam(':nom_fichier',$filename);
            $stm->bindParam(':nom_fichier_disque',$MyfileName);
            $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

            if($stm->execute()) {
                $details = array();
                $details['name'] = $db->lastInsertId()."_".time() . "_" . $filename;
                $details['id'] = $db->lastInsertId();

                $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $MyfileName)?$details:[]);
            }

        } else  {
            $fileCount = count($filename);
            for ($i = 0; $i < $fileCount; $i++) {

                $MyfileName = time() . "_" . $filename[$i];

                $stm->bindParam(':nom_fichier',$filename);
                $stm->bindParam(':nom_fichier_disque',$MyfileName);
                $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

                if($stm->execute()) {
                    $details = array();
                    $details['name'] = $db->lastInsertId()."_".time() . "_" . $filename;
                    $details['id'] = $db->lastInsertId();

                    $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $MyfileName)?$details:[]);
                }
            }
        }
    }
}

echo json_encode($ret);