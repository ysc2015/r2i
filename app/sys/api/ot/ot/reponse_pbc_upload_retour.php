<?php
/**
 * file: reponse_pbc_upload_retour.php
 * User: rabii
 */

$output_dir = __DIR__."/../../uploads/sousprojets/";
extract($_POST);

$ret = array();
$stm = $db->prepare("insert into ressource (id_blq_pbc,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_blq_pbc,'pbc_reponse',:nom_fichier,:nom_fichier_disque,'sousprojets',:date_creation)");

if(isset($idpbc) && !empty($idpbc)) {
    $stm->bindParam(':id_blq_pbc',$idpbc);
    if (isset($_FILES["myfile"])) {
        $error = $_FILES["myfile"]["error"];
        if (!is_array($_FILES["myfile"]["name"])) {

            $fileName = time() . "_" . $_FILES["myfile"]["name"];

            $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
            $stm->bindParam(':nom_fichier_disque',$fileName);
            $dt = date('Y-m-d H:i:s');
            $stm->bindParam(':date_creation',$dt);

            if($stm->execute()) {
                $details = array();
                $details['name'] = $db->lastInsertId()."_".time() . "_" . $_FILES["myfile"]["name"];
                $details['id'] = $db->lastInsertId();

                $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$details:[]);
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