<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 04/05/2017
 * Time: 11:54
 */

//

$output_dir = __DIR__."/../../uploads/sousprojets/";
extract($_POST);

$ret = array();

$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (id_ordre_de_travail,id_sous_projet,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation,id_utilisateur) values (:id_ordre_de_travail,:id_sous_projet,'fcomp_file',:nom_fichier,:nom_fichier_disque,'sousprojets',:date_creation,".$connectedProfil->profil->id_utilisateur.")");

if(isset($idot) && !empty($idot) && isset($idsp) && !empty($idsp)) {
    $stm->bindParam(':id_ordre_de_travail',$idot);
    $stm->bindParam(':id_sous_projet',$idsp);
    if (isset($_FILES["myfile"])) {
        $error = $_FILES["myfile"]["error"];
        if (!is_array($_FILES["myfile"]["name"])) {

            $fileName = time() . "_" . $_FILES["myfile"]["name"];

            $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
            $stm->bindParam(':nom_fichier_disque',$fileName);
            $dc = date('Y-m-d H:i:s');
            $stm->bindParam(':date_creation',$dc);

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