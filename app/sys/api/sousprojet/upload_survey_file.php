<?php
/**
 * file: upload_survey_file.php
 * User: rabii
 */

ini_set("display_errors",'1');

$output_dir = __DIR__."/../uploads/sousprojets/";
set_time_limit(60);

extract($_POST);

$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (id_objet,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_objet,:type_objet,:nom_fichier,:nom_fichier_disque,'sousprojets',:date_creation)");

if(isset($idsp) && !empty($idsp)) {
    $sousprojet_suradresse = SousProjetPlaqueSurveyAdresse::first(array('conditions' => array("id_sous_projet = ?", $idsp)));
    if($sousprojet_suradresse !== NULL) {
        $stm->bindParam(':id_objet',$sousprojet_suradresse->id_sous_projet_plaque_survey_adresse);
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

                $stm->execute();

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
        $message[] = "Référence survey adresse terrain introuvable !";
    }
} else {
    $err++;
    $message[] = "Référence sous projet introuvable !";
}

if($err == 0) {
    $app_folder = ($_SERVER['SERVER_NAME'] == "localhost") ? "r2i-gestion" : "r2i";
    //send mail to vpi
    $subject = "Nouveau fichier survey adresses";

    $html  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
    $html .='<html>';
    $html .='<head>';
    $html .='<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
    $html .='<title>Nouveau fichier survey adresses dispo en base</title>';
    $html .='</head>';
    $html .='<body>';
    $html .='<div style="width: 640px;float: left;text-align: left">';
    $html .='<h3>Nouveau '.'<a href="http://'.$_SERVER['SERVER_NAME'].'/'.$app_folder.'/index.php?page=sousprojet&idsousprojet='.$idsp.'">fichier(s)</a>'.' survey adresses dispo en base ! </h3>';
    $html .='</div>';
    $html .='</body>';
    $html .='</html>';

    //vpi receipients

    $receipients = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 5)));

    $to = array();
    //$to[] = "bitlord1980@gmail.com";

    foreach($receipients as $receipient) {
        $to[] = $receipient->email_utilisateur;
    }


    if(MailNotifier::sendMail($subject,$html,$to,array())) {
        $message[] = "Mail envoyé !";
    } else {
        $message[] = "Mail vpi non envoyé !";
        $err++;
    }
}

echo json_encode(array("error" => $err , "message" => $message));