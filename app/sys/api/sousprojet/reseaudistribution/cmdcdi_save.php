<?php
/**
 * file: cmdcdi_save.php
 * User: rabii
 */

extract($_POST);

$sousProjet = NULL;
$stm = NULL;

if(isset($ids) && !empty($ids)){
    $sousProjet = SousProjet::find($ids);
}
$mailaction_new = false;
$mailaction_entite = NULL;


$insert = false;
$err = 0;
$message = array();

$suffix = "dcc";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->distributioncmdcdi !== NULL) {
        $mailaction_entite = $sousProjet->distributioncmdcdi;

        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_distribution_commande_cdi set $fieldslist where id_sous_projet=:id_sous_projet");
        $mailaction_new = true;
    } else {
        $fieldslist = "id_sous_projet,";
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr).",";
                $valueslist .= ":".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");
        $valueslist = rtrim($valueslist,",");

        $stm = $db->prepare("insert into sous_projet_distribution_commande_cdi ($fieldslist) values ($valueslist)");
        $mailaction_new = true;
    }
} else {
    $err++;
    $message[] = "Erreur reférence sous projet";
}

if($paramcount < 1) {
    $err++;
    $message[] = "Vous n'avez pas le droit d'effectuer cette action !";
}

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($dcc_intervenant_be)){
    $stm->bindParam(':intervenant_be',$dcc_intervenant_be);
    $insert = true;
}

if(isset($dcc_date_butoir)){
    $stm->bindParam(':date_butoir',$dcc_date_butoir);
    $insert = true;
}

if(isset($dcc_traitement_retour_terrain)){
    $stm->bindParam(':traitement_retour_terrain',$dcc_traitement_retour_terrain);
    $insert = true;
}

if(isset($dcc_modification_carto)){
    $stm->bindParam(':modification_carto',$dcc_modification_carto);
    $insert = true;
}

if(isset($dcc_commandes_acces)){
    $stm->bindParam(':commandes_acces',$dcc_commandes_acces);
    $insert = true;
}

if(isset($dcc_date_transmission_ca)){
    $stm->bindParam(':date_transmission_ca',$dcc_date_transmission_ca);
    $insert = true;
}

if(isset($dcc_ref_commande_acces)){
    $stm->bindParam(':ref_commande_acces',$dcc_ref_commande_acces);
    $insert = true;
}

if(isset($dcc_go_ft)){
    $stm->bindParam(':go_ft',$dcc_go_ft);
    $insert = true;
}

if(isset($dcc_ok)){
    $stm->bindParam(':ok',$dcc_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        if($mailaction_new && isset($dcc_commandes_acces) && $dcc_commandes_acces == 2 &&  isset($dcc_go_ft) && $dcc_go_ft == 2 && (isset($dcc_ok)) && $dcc_ok == 1 &&
            ($mailaction_entite->commandes_acces != $dcc_commandes_acces
                || $mailaction_entite->go_ft != $dcc_go_ft
                || $mailaction_entite->ok != $dcc_ok )) {
            //envoi de mail
            $mailaction_object = "[R2i] Commande structurante CDI validée ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;//code sous projet;
            $mailaction_html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
            $mailaction_html .='<html>';
            $mailaction_html .='<head>';
            $mailaction_html .='<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
            $mailaction_html .='<title>'.$mailaction_object.'</title>';
            $mailaction_html .='</head>';
            $mailaction_html .='<body>';
            $mailaction_html .='<div style="width: 640px;float: left;text-align: left">';
            $mailaction_html .='<h3>Bonjour,</h3>';
            $mailaction_html .='<p>La commande du CDI <h5>'.$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone.'</h5> a été validée.  </p>';
            $mailaction_html .='<h6>Les données sont accessibles sous R2i.</h6>';
            $mailaction_html .='</div>';
            $mailaction_html .='</body>';
            $mailaction_html .='</html>';
            //Action = envoyer un mail au VPI concerné par le NRO
            $mailaction_cc =return_list_mail_cc_notif($db,"distributioncmdcdi",4);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);
            if(MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }else if($mailaction_new && $mailaction_entite->intervenant_be  != $dcc_intervenant_be  ){
            $mailaction_email_sender = [];
            //envoi de maile

            $mailaction_object = "[R2i] Attribution charge de Travail Commande CDI ";//code sous projet;
            $mailaction_html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
            $mailaction_html .='<html>';
            $mailaction_html .='<head>';
            $mailaction_html .='<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
            $mailaction_html .='<title>'.$mailaction_object.'</title>';
            $mailaction_html .='</head>';
            $mailaction_html .='<body>';
            $mailaction_html .='<div style="width: 640px;float: left;text-align: left">';
            $mailaction_html .='<h3>Bonjour,</h3>';
            $mailaction_html .='<p>Une nouvelle charge de travail vient de vous être attribuée : </p>';
            $mailaction_html .='<h5>'.$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone.'</h5>';
            $mailaction_html .='<h5>CDI</h5>';
            $mailaction_html .='<h5>Commande</h5>';
            $mailaction_html .='<p>Les données sont accessibles sous R2i.</p>';
            $mailaction_html .='</div>';
            $mailaction_html .='</body>';
            $mailaction_html .='</html>';
            $mailaction_cc  =return_list_mail_cc_notif_tache($db,$connectedProfil->email_utilisateur,2);
            $mailaction_to  =get_email_by_id($db,[$dcc_intervenant_be]);
            if(MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }

        }
        //setSousProjetUsers(SousProjet::find($ids));
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>