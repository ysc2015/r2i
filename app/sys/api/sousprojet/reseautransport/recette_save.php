<?php
/**
 * file: recette_save.php
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

$suffix = "trec";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {

    if($sousProjet->transportrecette !== NULL) {
        $mailaction_entite = $sousProjet->transportrecette;
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_transport_recette set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_transport_recette ($fieldslist) values ($valueslist)");
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

if(isset($trec_intervenant_be)){
    $stm->bindParam(':intervenant_be',$trec_intervenant_be);
    $insert = true;
}

if(isset($trec_doe)){
    $stm->bindParam(':doe',$trec_doe);
    $insert = true;
}

if(isset($trec_netgeo)){
    $stm->bindParam(':netgeo',$trec_netgeo);
    $insert = true;
}

if(isset($trec_intervenant_free)){
    $stm->bindParam(':intervenant_free',$trec_intervenant_free);
    $insert = true;
}

if(isset($trec_id_entreprise)){
    $stm->bindParam(':id_entreprise',$trec_id_entreprise);
    $insert = true;
}

if(isset($trec_date_recette)){
    $stm->bindParam(':date_recette',$trec_date_recette);
    $insert = true;
}

if(isset($trec_etat_recette)){
    $stm->bindParam(':etat_recette',$trec_etat_recette);
    $insert = true;
}

if(isset($trec_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$trec_controle_demarrage_effectif);
    $insert = true;
}

if(isset($trec_date_retour)){
    $stm->bindParam(':date_retour',$trec_date_retour);
    $insert = true;
}

if(isset($trec_etat_retour)){
    $stm->bindParam(':etat_retour',$trec_etat_retour);
    $insert = true;
}

if(isset($trec_lien_plans)){
    $stm->bindParam(':lien_plans',$trec_lien_plans);
    $insert = true;
}

if(isset($trec_retour_presta)){
    $stm->bindParam(':retour_presta',$trec_retour_presta);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        if($mailaction_new && isset($trec_etat_recette) &&  $trec_etat_recette == 3 && $mailaction_entite->etat_recette != $trec_etat_recette) {
            //envoi de mail
            $mailaction_object = "[R2i] Retour Recette CTR  ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;//code sous projet;
            $mailaction_html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
            $mailaction_html .='<html>';
            $mailaction_html .='<head>';
            $mailaction_html .='<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
            $mailaction_html .='<title>'.$mailaction_object.'</title>';
            $mailaction_html .='</head>';
            $mailaction_html .='<body>';
            $mailaction_html .='<div style="width: 640px;float: left;text-align: left">';
            $mailaction_html .='<h3>Bonjour,</h3>';
            $mailaction_html .='<p>La recette  du CTR : «<h5>'.$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone.'</h5>»  est désormais OK.   </p>';
            $mailaction_html .='<p>Les données sont accessibles sous R2i.</p>';
            $mailaction_html .='</div>';
            $mailaction_html .='</body>';
            $mailaction_html .='</html>';
            //Action = envoyer un mail au VPI concerné par le NRO
            $mailaction_cc =return_list_mail_cc_notif("transportraccordement");
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);
            if(MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }else if($mailaction_new && ( $mailaction_entite->intervenant_be  != $trec_intervenant_be  ||  $mailaction_entite->intervenant_free  != $trec_intervenant_free)){
            $mailaction_email_sender = [];
            //envoi de mail

            $mailaction_object = "[R2i] Attribution charge de Travail « Phase » « type CTR ou CDI » ";//code sous projet;
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
            $mailaction_html .='<h5>CDI || CTR</h5>';
            $mailaction_html .='<h5>ETAPE</h5>';
            $mailaction_html .='<p>Les données sont accessibles sous R2i.</p>';
            $mailaction_html .='</div>';
            $mailaction_html .='</body>';
            $mailaction_html .='</html>';
            $mailaction_cc  =return_list_mail_cc_notif_tache($connectedProfil->email_utilisateur);
            $mailaction_to  =get_email_by_id($db,[$trec_intervenant_be,$trec_intervenant_free]);
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