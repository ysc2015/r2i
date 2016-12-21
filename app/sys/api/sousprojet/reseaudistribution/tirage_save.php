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

$suffix = "dt";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->distributiontirage !== NULL) {
        $mailaction_entite = $sousProjet->distributiontirage;

        foreach( $_POST as $key => $value ) {
            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_distribution_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_distribution_tirage ($fieldslist) values ($valueslist)");
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

if(isset($dt_intervenant_be)){
    $stm->bindParam(':intervenant_be',$dt_intervenant_be);
    $insert = true;
}

if(isset($dt_date_previsionnelle)){
    $stm->bindParam(':date_previsionnelle',$dt_date_previsionnelle);
    $insert = true;
}

if(isset($dt_prep_plans)){
    $stm->bindParam(':prep_plans',$dt_prep_plans);
    $insert = true;
}

/*
 * lineaire debut
 */

if(isset($dt_lineaire1)){
    $stm->bindParam(':lineaire1',$dt_lineaire1);
    $insert = true;
}

if(isset($dt_lineaire2)){
    $stm->bindParam(':lineaire2',$dt_lineaire2);
    $insert = true;
}

if(isset($dt_lineaire3)){
    $stm->bindParam(':lineaire3',$dt_lineaire3);
    $insert = true;
}

if(isset($dt_lineaire4)){
    $stm->bindParam(':lineaire4',$dt_lineaire4);
    $insert = true;
}

if(isset($dt_lineaire5)){
    $stm->bindParam(':lineaire5',$dt_lineaire5);
    $insert = true;
}

if(isset($dt_lineaire6)){
    $stm->bindParam(':lineaire6',$dt_lineaire6);
    $insert = true;
}

if(isset($dt_lineaire7)){
    $stm->bindParam(':lineaire7',$dt_lineaire7);
    $insert = true;
}

if(isset($dt_lineaire8)){
    $stm->bindParam(':lineaire8',$dt_lineaire8);
    $insert = true;
}

if(isset($dt_lineaire9)){
    $stm->bindParam(':lineaire9',$dt_lineaire9);
    $insert = true;
}

if(isset($dt_lineaire10)){
    $stm->bindParam(':lineaire10',$dt_lineaire10);
    $insert = true;
}

if(isset($dt_lineaire11)){
    $stm->bindParam(':lineaire11',$dt_lineaire11);
    $insert = true;
}

if(isset($dt_lineaire12)){
    $stm->bindParam(':lineaire12',$dt_lineaire12);
    $insert = true;
}

/*
 * lineaire fin
 */

if(isset($dt_controle_plans)){
    $stm->bindParam(':controle_plans',$dt_controle_plans);
    $insert = true;
}

if(isset($dt_date_transmission_plans)){
    $stm->bindParam(':date_transmission_plans',$dt_date_transmission_plans);
    $insert = true;
}

if(isset($dt_id_entreprise)){
    $stm->bindParam(':id_entreprise',$dt_id_entreprise);
    $insert = true;
}

/*
 * dates début
 */

if(isset($dt_date_tirage) && isset($dt_date_ret_prevue)) {

    $dd = DateTime::createFromFormat('Y-m-d', $dt_date_tirage);
    $df = DateTime::createFromFormat('Y-m-d', $dt_date_ret_prevue);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la Date prévisionnelle de fin de tirage doit étre superieure à la date de début tirage !";
    } else  {

        if(isset($dt_date_tirage)){
            $stm->bindParam(':date_tirage',$dt_date_tirage);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs date de début tirage est obligatoire !";
        }

        if(isset($dt_date_ret_prevue)){
            $stm->bindParam(':date_ret_prevue',$dt_date_ret_prevue);
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

if(isset($dt_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$dt_controle_demarrage_effectif);
    $insert = true;
}

if(isset($dt_date_retour)){
    $stm->bindParam(':date_retour',$dt_date_retour);
    $insert = true;
}

if(isset($dt_etat_retour)){
    $stm->bindParam(':etat_retour',$dt_etat_retour);
    $insert = true;
}

if(isset($dt_lien_plans)){
    $stm->bindParam(':lien_plans',$dt_lien_plans);
    $insert = true;
}

if(isset($dt_retour_presta)){
    $stm->bindParam(':retour_presta',$dt_retour_presta);
    $insert = true;
}

if(isset($dt_ok)){
    $stm->bindParam(':ok',$dt_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    /*$duree = getDuree($dt_date_tirage,$dt_date_ret_prevue);
    $stm->bindParam(':duree',$duree);*/
    if($stm->execute()){
        if($new) {
            if($sousProjet->distributionraccordement == NULL) {
                $distributionraccordement = new SousProjetDistributionRaccordement(array(
                    'id_sous_projet' => $ids));
                $distributionraccordement->save();
            }
        }
        if($mailaction_new &&  isset($dt_controle_plans) && $dt_controle_plans == 2 &&  isset($dt_etat_retour) && $dt_etat_retour == 2 && (isset($dt_lien_plans)) && $dt_lien_plans != "" &&
            ($mailaction_entite->controle_plans != $dt_controle_plans || $mailaction_entite->etat_retour != $dt_etat_retour || $mailaction_entite->lien_plans != $dt_lien_plans )) {
            //envoi de mail
            $mailaction_object = "[R2i] Plan Tirage CDI disponible ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;//code sous projet;
            $mailaction_html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
            $mailaction_html .='<html>';
            $mailaction_html .='<head>';
            $mailaction_html .='<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
            $mailaction_html .='<title>'.$mailaction_object.'</title>';
            $mailaction_html .='</head>';
            $mailaction_html .='<body>';
            $mailaction_html .='<div style="width: 640px;float: left;text-align: left">';
            $mailaction_html .='<h3>Bonjour,</h3>';
            $mailaction_html .='<p>Un nouveau plan de tirage (CDI) est disponible : <h5>'.$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone.'</h5></p>';
            $mailaction_html .='<p>Les données sont accessibles sous R2i.</p>';
            $mailaction_html .='</div>';
            $mailaction_html .='</body>';
            $mailaction_html .='</html>';
            //Action = envoyer un mail au VPI concerné par le NRO
            $mailaction_cc =return_list_mail_cc_notif($db,"distributiontirage",1);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);
            if(MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }else if($mailaction_new && $mailaction_entite->intervenant_be  != $dt_intervenant_be  ){
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
            $mailaction_html .='<h5>CDI</h5>';
            $mailaction_html .='<h5>Tirage</h5>';
            $mailaction_html .='<p>Les données sont accessibles sous R2i.</p>';
            $mailaction_html .='</div>';
            $mailaction_html .='</body>';
            $mailaction_html .='</html>';
            $mailaction_cc  =   return_list_mail_cc_notif_tache($db,$connectedProfil->email_utilisateur,2);
            $mailaction_to  =   get_email_by_id($db,[$dt_intervenant_be]);
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