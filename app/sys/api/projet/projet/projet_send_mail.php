<?php
/**
 * file: projet_send_mail.php
 * User: rabii
 */

ini_set("display_errors",'1');

extract($_POST);

$html = "";
$err = 0;
$message = array();
$files = array();
$subject = "test";
$to = array();

if(isset($idp) && !empty($idp)){
    $stm = $db->prepare("SELECT p.*,sv.nom_ville,n.lib_nro,st.lib_site_origine_type,se.lib_site_origine_etat from projet as p,
                        select_ville as sv, nro as n, select_site_origine_type as st, select_site_origine_etat as se
                        WHERE id_projet=:id AND p.ville=sv.code_ville AND p.id_nro=n.id_nro
                        AND p.type_site_origine = st.id_site_origine_type AND p.etat_site_origine = se.id_site_origine_etat");
    $stm->execute(array(':id' => $idp));
    $projet = $stm->fetch(PDO::FETCH_OBJ);
    //$message[] = $projet->ville;

    $subject = "Lancement Projet d’étude Plaque PON FTTH ".$projet->lib_nro." ".$projet->ville_nom;

    $html .= '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
    $html .='<html>';
    $html .='<head>';
    $html .='<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
    $html .='<title>'.$subject.'</title>';
    $html .='</head>';
    $html .='<body>';
    $html .='<div style="width: 640px;float: left;text-align: left">';
    $html .='<h3>Infos création projet :</h3>';
    $html .='<h5>Ville : '.$projet->ville_nom.'</h5>';
    $html .='<h5>Trigramme de la plaque + Dept : '.$projet->trigramme_dept.'</h5>';
    $html .='<h5>Code site d’origine : '.$projet->lib_nro.'</h5>';
    $html .='<h5>Type de Site d’origine : '.$projet->lib_site_origine_type.'</h5>';
    $html .='<h5>Taille approximative en LR : '.$projet->taille.'</h5>';
    $html .='<h5>Etat Site Origine : '.$projet->lib_site_origine_etat.'</h5>';
    $html .='<h5>Date Mise à disposition site Origine : '.$projet->date_mad_site_origine.'</h5>';
    $html .='</div>';
    $html .='</body>';
    $html .='</html>';

    $stm->closeCursor();

    $stm = $db->prepare("SELECT * from ressource WHERE id_projet=:id AND type_objet='fichier_contour'");
    $stm->execute(array(':id' => $idp));

    $files = $stm->fetchAll();

    $stm2 = $db->prepare("SELECT u.email_utilisateur from projet_mail_creation as pm, utilisateur as u
                        where u.id_utilisateur=pm.id_utilisateur and pm.id_type_notification=1");
    $stm2->execute();

    $receipients = $stm2->fetchAll();

    $to = array();

    foreach($receipients as $receipient) {
        $to[] = $receipient["email_utilisateur"];
    }



    if(MailNotifier::sendMail($subject,$html,$to,$files,array())) {
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