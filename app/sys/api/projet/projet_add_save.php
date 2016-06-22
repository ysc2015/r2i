<?php
/**
 * file: projet_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

ini_set("display_errors",'1');

$output_dir = __DIR__."/uploads/projets/";
set_time_limit(60);

extract($_POST);

$err = 0;
$message = array();

if(!isset($ville) || empty($ville)) {
    $err++;
    $message[] = "Le champs ville est obligatoire !";
}

if(!isset($trigramme_dept) || empty($trigramme_dept)) {
    $err++;
    $message[] = "Le champs Trigramme de la plaque est obligatoire !";
}

if(!isset($code_site_origine) || empty($code_site_origine)) {
    $err++;
    $message[] = "Le champs Code site d’origine est obligatoire !";
}

if(!isset($type_site_origine) || empty($type_site_origine)) {
    $err++;
    $message[] = "Le champs Type de Site d’origine est obligatoire !";
}

if(!isset($taille) || empty($taille)) {
    $err++;
    $message[] = "Le champs Taille est obligatoire !";
}

if(!isset($etat_site_origine) || empty($etat_site_origine)) {
    $err++;
    $message[] = "Le champs Etat Site Origine est obligatoire !";
}

if(!isset($date_mad_site_origine) || empty($date_mad_site_origine)) {
    $err++;
    $message[] = "Le champs Date Mise à disposition est obligatoire !";
}

if($err > 0) {
    echo json_encode(array("error" => $err , "message" => $message));
} else {
    $stm = $db->prepare("insert into projet (ville,trigramme_dept,code_site_origine,type_site_origine,taille,etat_site_origine,date_mad_site_origine,date_creation,date_attribution) values (:ville,:trigramme_dept,:code_site_origine,:type_site_origine,:taille,:etat_site_origine,:date_mad_site_origine,:date_creation,:date_attribution)");

    $stm->bindParam(':ville',$ville);
    $stm->bindParam(':trigramme_dept',$trigramme_dept);
    $stm->bindParam(':code_site_origine',$code_site_origine);
    $stm->bindParam(':type_site_origine',$type_site_origine);
    $stm->bindParam(':taille',$taille);
    $stm->bindParam(':etat_site_origine',$etat_site_origine);
    $stm->bindParam(':date_mad_site_origine',$date_mad_site_origine);
    $stm->bindParam(':date_creation',date('Y-m-d'));
    $stm->bindParam(':date_attribution',date('Y-m-d'));

    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
        $insertedId = $db->lastInsertId();

        if (isset($_FILES["myfile"])) {
            $ret = array();
            $error = $_FILES["myfile"]["error"];
            if (!is_array($_FILES["myfile"]["name"])) {
                $fileName = $_FILES["myfile"]["name"] . "_" . time();
                $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$fileName:[]);

                /*$stm->closeCursor();

                $stm = $db->prepare("insert into ressource (id_objet,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_objet,'projet',:nom_fichier,:nom_fichier_disque,'projets',:date_creation)");

                $stm->bindParam(':id_objet',$insertedId);
                $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
                $stm->bindParam(':nom_fichier_disque',$fileName);
                $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

                $stm->execute();*/

            } else  {
                $fileCount = count($_FILES["myfile"]["name"]);
                for ($i = 0; $i < $fileCount; $i++) {
                    $fileName = $_FILES["myfile"]["name"][$i] . "_" . time();
                    $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName)?$fileName:[]);

                    /*$stm->closeCursor();

                    $stm = $db->prepare("insert into ressource (id_objet,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_objet,'projet',:nom_fichier,:nom_fichier_disque,'projets',:date_creation)");

                    $stm->bindParam(':id_objet',$insertedId);
                    $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
                    $stm->bindParam(':nom_fichier_disque',$fileName);
                    $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

                    $stm->execute();*/
                }
            }

            echo json_encode(array("error" => $err , "message" => $message));
        }

    } else {
        $message [] = $stm->errorInfo();
    }
}



?>