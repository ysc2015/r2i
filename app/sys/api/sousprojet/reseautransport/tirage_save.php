<?php
/**
 * file: tirage_save.php
 * User: rabii
 */

extract($_POST);

$duree = "";

$sousProjet = NULL;
$stm = NULL;

$new = false;

if(isset($ids) && !empty($ids)){
    $sousProjet = SousProjet::find($ids);
}

$mailaction_new = false;
$mailaction_entite = NULL;


$insert = false;
$err = 0;
$message = array();

$suffix = "tt";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {

    if($sousProjet->transporttirage !== NULL) {
        $mailaction_entite = $sousProjet->transporttirage;
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_transport_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_transport_tirage ($fieldslist) values ($valueslist)");
        $new = true;
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

if(isset($tt_intervenant_be)){
    $stm->bindParam(':intervenant_be',$tt_intervenant_be);
    $insert = true;
}

if(isset($tt_plans)){
    $stm->bindParam(':plans',$tt_plans);
    $insert = true;
}

/*
 * lineaire debut
 */

if(isset($tt_lineaire1)){
    $stm->bindParam(':lineaire1',$tt_lineaire1);
    $insert = true;
}

if(isset($tt_lineaire2)){
    $stm->bindParam(':lineaire2',$tt_lineaire2);
    $insert = true;
}

if(isset($tt_lineaire3)){
    $stm->bindParam(':lineaire3',$tt_lineaire3);
    $insert = true;
}

if(isset($tt_lineaire4)){
    $stm->bindParam(':lineaire4',$tt_lineaire4);
    $insert = true;
}

if(isset($tt_lineaire5)){
    $stm->bindParam(':lineaire5',$tt_lineaire5);
    $insert = true;
}

if(isset($tt_lineaire6)){
    $stm->bindParam(':lineaire6',$tt_lineaire6);
    $insert = true;
}

if(isset($tt_lineaire7)){
    $stm->bindParam(':lineaire7',$tt_lineaire7);
    $insert = true;
}

if(isset($tt_lineaire8)){
    $stm->bindParam(':lineaire8',$tt_lineaire8);
    $insert = true;
}

if(isset($tt_lineaire9)){
    $stm->bindParam(':lineaire9',$tt_lineaire9);
    $insert = true;
}

if(isset($tt_lineaire10)){
    $stm->bindParam(':lineaire10',$tt_lineaire10);
    $insert = true;
}

if(isset($tt_lineaire11)){
    $stm->bindParam(':lineaire11',$tt_lineaire11);
    $insert = true;
}

if(isset($tt_lineaire12)){
    $stm->bindParam(':lineaire12',$tt_lineaire12);
    $insert = true;
}

if(isset($tt_lineaire13)){
    $stm->bindParam(':lineaire13',$tt_lineaire13);
    $insert = true;
}

if(isset($tt_lineaire14)){
    $stm->bindParam(':lineaire14',$tt_lineaire14);
    $insert = true;
}

/*
 * lineaire fin
 */

if(isset($tt_controle_plans)){
    $stm->bindParam(':controle_plans',$tt_controle_plans);
    $insert = true;
}

if(isset($tt_date_transmission_plans)){
    $stm->bindParam(':date_transmission_plans',$tt_date_transmission_plans);
    $insert = true;
}

if(isset($tt_id_entreprise)){
    $stm->bindParam(':id_entreprise',$tt_id_entreprise);
    $insert = true;
}

/*
 * dates debut
 */

if(isset($tt_date_tirage) && isset($tt_date_ret_prevue)) {
    $dd = DateTime::createFromFormat('Y-m-d', $tt_date_tirage);
    $df = DateTime::createFromFormat('Y-m-d', $tt_date_ret_prevue);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la date prévisionnelle de fin tirage doit étre superieure à la date de début tirage !";
    } else  {

        if(isset($tt_date_tirage)){
            $stm->bindParam(':date_tirage',$tt_date_tirage);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs date de début tirage est obligatoire !";
        }

        if(isset($tt_date_ret_prevue)){
            $stm->bindParam(':date_ret_prevue',$tt_date_ret_prevue);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs date prévisionnelle de fin tirage est obligatoire !";
        }
    }
}

/*
 * dates fin
 */

if(isset($tt_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$tt_controle_demarrage_effectif);
    $insert = true;
}

if(isset($tt_date_retour)){
    $stm->bindParam(':date_retour',$tt_date_retour);
    $insert = true;
}

if(isset($tt_etat_retour)){
    $stm->bindParam(':etat_retour',$tt_etat_retour);
    $insert = true;
}

if(isset($tt_lien_plans)){
    $stm->bindParam(':lien_plans',$tt_lien_plans);
    $insert = true;
}

if(isset($tt_retour_presta)){
    $stm->bindParam(':retour_presta',$tt_retour_presta);
    $insert = true;
}

if(isset($tt_ok)){
    $stm->bindParam(':ok',$tt_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    /*$duree = getDuree($tt_date_tirage,$tt_date_ret_prevue);
    $stm->bindParam(':duree',$duree);*/
    if($stm->execute()){
        if($new) {
            if($sousProjet->transportraccordement == NULL) {
                $transportraccordement = new SousProjetTransportRaccordement(array(
                    'id_sous_projet' => $ids));
                $transportraccordement->save();
            }
        }
        if($mailaction_new && isset($tt_plans) && ($tt_plans == 3) && isset($tt_controle_plans) && ($tt_controle_plans == 2) && isset($tt_lien_plans) && ($tt_lien_plans != "") &&
            ($mailaction_entite->lien_plans != $tt_lien_plans || $mailaction_entite->plans != $tt_plans || $mailaction_entite->controle_plans != $tt_controle_plans) ) {
            //envoi de mail
            $mailaction_object = "[R2i] Plan Tirage CTR disponible ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;//code sous projet;
            $mailaction_html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
            $mailaction_html .='<html>';
            $mailaction_html .='<head>';
            $mailaction_html .='<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
            $mailaction_html .='<title>'.$mailaction_object.'</title>';
            $mailaction_html .='</head>';
            $mailaction_html .='<body>';
            $mailaction_html .='<div style="width: 640px;float: left;text-align: left">';
            $mailaction_html .='<h3>Bonjour,</h3>';
            $mailaction_html .='<p>Un nouveau plan de tirage (CTR) est disponible : «<h5>'.$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone.'</h5>»  </p>';
            $mailaction_html .='<p>Les données sont accessibles sous R2i.</p>';
            $mailaction_html .='</div>';
            $mailaction_html .='</body>';
            $mailaction_html .='</html>';

            $mailaction_cc =return_list_mail_cc_notif($db,"transporttirage",4);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);
            if(MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }else if($mailaction_new && $mailaction_entite->intervenant_be  != $tt_intervenant_be  ){
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
            $mailaction_html .='<h5>CTR</h5>';
            $mailaction_html .='<h5>Tirage</h5>';
            $mailaction_html .='<p>Les données sont accessibles sous R2i.</p>';
            $mailaction_html .='</div>';
            $mailaction_html .='</body>';
            $mailaction_html .='</html>';
            $mailaction_cc  =return_list_mail_cc_notif_tache($db,$connectedProfil->email_utilisateur,2);
            $mailaction_to  =get_email_by_id($db,[$tt_intervenant_be]);
            if(MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }

        }
        //setSousProjetUsers(SousProjet::find($ids));;
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message , "duree" => $duree));
?>