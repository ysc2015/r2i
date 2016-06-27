<?php
/**
 * file: projet_send_mail.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";
include_once __DIR__."/../../inc/mail.notifier.class.php";

ini_set("display_errors",'1');

extract($_POST);

$html = "";
$err = 0;
$message = array();
$files = array();
$subject = "test";
$to = array();

if(isset($idp) && !empty($idp)){
    $stm = $db->prepare("SELECT p.*,sv.nom_ville from projet as p,select_ville as sv WHERE id_projet=:id AND p.ville=sv.code_ville");
    $stm->execute(array(':id' => $idp));
    $projet = $stm->fetch(PDO::FETCH_OBJ);
    //$message[] = $projet->ville;

    $subject = "Lancement Projet d’étude Plaque PON FTTH ".$projet->code_site_origine." ".$projet->nom_ville;

    $html .= '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
    $html .='<html>';
    $html .='<head>';
    $html .='<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
    $html .='<title>'.$subject.'</title>';
    $html .='</head>';
    $html .='<body>';
    $html .='<div style="width: 640px;float: left;text-align: left">';
    $html .='<h3>Infos création projet :</h3>';
    $html .='<h5>Ville : '.$projet->nom_ville.'</h5>';
    $html .='<h5>Trigramme de la plaque + Dept : '.$projet->trigramme_dept.'</h5>';
    $html .='<h5>Code site d’origine : '.$projet->code_site_origine.'</h5>';
    $html .='<h5>Type de Site d’origine : '.$projet->type_site_origine.'</h5>';
    $html .='<h5>Taille approximative en LR : '.$projet->taille.'</h5>';
    $html .='<h5>Etat Site Origine : '.$projet->etat_site_origine.'</h5>';
    $html .='<h5>Date Mise à disposition site Origine : '.$projet->date_mad_site_origine.'</h5>';
    $html .='</div>';
    $html .='</body>';
    $html .='</html>';

    $stm->closeCursor();

    $stm = $db->prepare("SELECT * from ressource WHERE id_objet=:id AND type_objet='projet'");
    $stm->execute(array(':id' => $idp));

    $files = $stm->fetchAll();

    /*foreach($files as $file) {
        $message[] = "file => ".$file['id_ressource'];
    }

    $stm->closeCursor();*/

    $stm2 = $db->prepare("SELECT * from projet_mail_creation");
    $stm2->execute();

    $receipients = $stm2->fetchAll();

    $to = array();
    $to[] = "bitlord1980@gmail.com";

    foreach($receipients as $receipient) {
        $to[] = $receipient["mail"];
    }



    if(MailNotifier::sendMail($subject,$html,$to,$files)) {
        $message[] = "Mail envoyé !";
    } else {
        $message[] = "Mail non envoyé !";
        $err++;
    }

} else {
    $err++;
    $message[] = "Référence projet introuvable !";
}

echo json_encode(array("error" => $err , "message" => $message, "r" => $to));