<?php
/**
 * file: aiguillage_save.php
 * User: rabii
 */

extract($_POST);

$duree = "";

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

$suffix = "ta";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->transportaiguillage !== NULL) {
        $mailaction_entite = $sousProjet->transportaiguillage;
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_transport_aiguillage set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_transport_aiguillage ($fieldslist) values ($valueslist)");
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

if(isset($ta_intervenant_be)){
    $stm->bindParam(':intervenant_be',$ta_intervenant_be);
    $insert = true;
}

if(isset($ta_plans)){
    $stm->bindParam(':plans',$ta_plans);
    $insert = true;
}

/*
 * lineaire debut
 */

if(isset($ta_lineaire1)){
    $stm->bindParam(':lineaire1',$ta_lineaire1);
    $insert = true;
}

if(isset($ta_lineaire2)){
    $stm->bindParam(':lineaire2',$ta_lineaire2);
    $insert = true;
}

if(isset($ta_lineaire3)){
    $stm->bindParam(':lineaire3',$ta_lineaire3);
    $insert = true;
}

if(isset($ta_lineaire4)){
    $stm->bindParam(':lineaire4',$ta_lineaire4);
    $insert = true;
}

if(isset($ta_lineaire5)){
    $stm->bindParam(':lineaire5',$ta_lineaire5);
    $insert = true;
}

if(isset($ta_lineaire6)){
    $stm->bindParam(':lineaire6',$ta_lineaire6);
    $insert = true;
}

if(isset($ta_lineaire7)){
    $stm->bindParam(':lineaire7',$ta_lineaire7);
    $insert = true;
}

if(isset($ta_lineaire8)){
    $stm->bindParam(':lineaire8',$ta_lineaire8);
    $insert = true;
}

if(isset($ta_lineaire9)){
    $stm->bindParam(':lineaire9',$ta_lineaire9);
    $insert = true;
}

if(isset($ta_lineaire10)){
    $stm->bindParam(':lineaire10',$ta_lineaire10);
    $insert = true;
}

/*
 * lineaire fin
 */

if(isset($ta_controle_plans)){
    $stm->bindParam(':controle_plans',$ta_controle_plans);
    $insert = true;
}

if(isset($ta_date_transmission_plans)){
    $stm->bindParam(':date_transmission_plans',$ta_date_transmission_plans);
    $insert = true;
}

if(isset($ta_id_entreprise)){
    $stm->bindParam(':id_entreprise',$ta_id_entreprise);
    $insert = true;
}

/*
 * dates début
 */

if(isset($ta_date_aiguillage) && isset($ta_date_ret_prevue)) {

    $dd = DateTime::createFromFormat('Y-m-d', $ta_date_aiguillage);
    $df = DateTime::createFromFormat('Y-m-d', $ta_date_ret_prevue);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la date prévisionnelle de fin d’aiguillage doit étre superieure à la date de début aiguillage !";
    } else  {

        if(isset($ta_date_aiguillage)){
            $stm->bindParam(':date_aiguillage',$ta_date_aiguillage);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs date de début aiguillage est obligatoire !";
        }

        if(isset($ta_date_ret_prevue)){
            $stm->bindParam(':date_ret_prevue',$ta_date_ret_prevue);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs date prévisionnelle de fin d’aiguillage est obligatoire !";
        }
    }
}

/*
 * dates fin
 */

if(isset($ta_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$ta_controle_demarrage_effectif);
    $insert = true;
}

if(isset($ta_date_retour)){
    $stm->bindParam(':date_retour',$ta_date_retour);
    $insert = true;
}

if(isset($ta_etat_retour)){
    $stm->bindParam(':etat_retour',$ta_etat_retour);
    $insert = true;
}

if(isset($ta_lien_plans)){
    $stm->bindParam(':lien_plans',$ta_lien_plans);
    $insert = true;
}

if(isset($ta_retour_presta)){
    $stm->bindParam(':retour_presta',$ta_retour_presta);
    $insert = true;
}

if(isset($ta_ok)){
    $stm->bindParam(':ok',$ta_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    /*$duree = getDuree($ta_date_aiguillage,$ta_date_ret_prevue);
    $stm->bindParam(':duree',$duree);*/

    if($stm->execute()){

        if($mailaction_new && (isset($ta_controle_plans)) &&  $ta_controle_plans == 2 && (isset($ta_lien_plans)) && $ta_lien_plans != ""
        && ($mailaction_entite->controle_plans != $ta_controle_plans || $mailaction_entite->lien_plans != $ta_lien_plans) ) {

            //envoi de mail
            $mailaction_object = "[R2i] Plan aiguillage disponible ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;//code sous projet;
            $mailaction_html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
            $mailaction_html .='<html>';
            $mailaction_html .='<head>';
            $mailaction_html .='<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
            $mailaction_html .='<title>'.$mailaction_object.'</title>';
            $mailaction_html .='</head>';
            $mailaction_html .='<body>';
            $mailaction_html .='<div style="width: 640px;float: left;text-align: left">';
            $mailaction_html .='<h3>Bonjour,</h3>';
            $mailaction_html .='<p>Un nouveau plan d’aiguillage réseau transport (CTR) est terminé : </p>';
            $mailaction_html .='<h5>'.$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone.'</h5>';
            $mailaction_html .='<p>Les données sont accessibles sous R2i.</p>';
            $mailaction_html .='</div>';
            $mailaction_html .='</body>';
            $mailaction_html .='</html>';
            $mailaction_cc =return_list_mail_cc_notif("transportaiguillage");
            $mailaction_to =return_list_mail_vpi_par_nro($sousProjet->projet->nro->id_nro);
           if(MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }

        }else if($mailaction_new && $mailaction_entite->intervenant_be != $ta_intervenant_be){
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
            $mailaction_html .='<p>Une nouvelle charge de travail vient de vous être attribuée : : </p>';
            $mailaction_html .='<h5>'.$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone.'</h5>';
            $mailaction_html .='<h5>CDI || CTR</h5>';
            $mailaction_html .='<h5>ETAPE</h5>';
            $mailaction_html .='<p>Les données sont accessibles sous R2i.</p>';
            $mailaction_html .='</div>';
            $mailaction_html .='</body>';
            $mailaction_html .='</html>';
            $mailaction_cc =return_list_mail_cc_notif_tache($connectedProfil->email_utilisateur);
            $mailaction_to =get_email_by_id([$ta_intervenant_be]);
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

echo json_encode(array("error" => $err , "message" => $message , "duree" => $duree));
?>