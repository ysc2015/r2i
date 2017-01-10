<?php
/**
 * file: raccord_save.php
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

$suffix = "tr";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->transportraccordement !== NULL) {
        $mailaction_entite = $sousProjet->transportraccordement;
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_transport_raccordements set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_transport_raccordements ($fieldslist) values ($valueslist)");
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

if(isset($tr_intervenant_be)){
    $stm->bindParam(':intervenant_be',$tr_intervenant_be);
    $insert = true;
}

if(isset($tr_preparation_pds)){
    $stm->bindParam(':preparation_pds',$tr_preparation_pds);
    $insert = true;
}

if(isset($tr_controle_plans)){
    $stm->bindParam(':controle_plans',$tr_controle_plans);
    $insert = true;
}

if(isset($tr_date_transmission_pds)){
    $stm->bindParam(':date_transmission_pds',$tr_date_transmission_pds);
    $insert = true;
}

if(isset($tr_id_entreprise)){
    $stm->bindParam(':id_entreprise',$tr_id_entreprise);
    $insert = true;
}

if(isset($tr_date_racco)){
    $stm->bindParam(':date_racco',$tr_date_racco);
    $insert = true;
}

if(isset($tr_duree)){
    $stm->bindParam(':duree',$tr_duree);
    $insert = true;
}

/*
 * dates début
 */

if(isset($tr_date_racco) && isset($tr_date_ret_prevue)) {

    $dd = DateTime::createFromFormat('Y-m-d', $tr_date_racco);
    $df = DateTime::createFromFormat('Y-m-d', $tr_date_ret_prevue);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la date prévisionnelle de fin du raccordement doit étre superieure à la date de début raccordement !";
    } else  {

        if(isset($tr_date_racco)){
            $stm->bindParam(':date_racco',$tr_date_racco);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs date de début raccordement est obligatoire !";
        }

        if(isset($tr_date_ret_prevue)){
            $stm->bindParam(':date_ret_prevue',$tr_date_ret_prevue);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs date prévisionnelle de fin du raccordement est obligatoire !";
        }
    }
}

/*
 * dates fin
 */

if(isset($tr_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$tr_controle_demarrage_effectif);
    $insert = true;
}

if(isset($tr_date_retour)){
    $stm->bindParam(':date_retour',$tr_date_retour);
    $insert = true;
}

if(isset($tr_etat_retour)){
    $stm->bindParam(':etat_retour',$tr_etat_retour);
    $insert = true;
}

if(isset($tr_lien_plans)){
    $stm->bindParam(':lien_plans',$tr_lien_plans);
    $insert = true;
}

if(isset($tr_retour_presta)){
    $stm->bindParam(':retour_presta',$tr_retour_presta);
    $insert = true;
}

if(isset($tr_ok)){
    $stm->bindParam(':ok',$tr_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    /*$duree = getDuree($tr_date_racco,$tr_date_ret_prevue);
    $stm->bindParam(':duree',$duree);*/

    if($stm->execute()){
        if($mailaction_new &&
            (
                $mailaction_entite == null
                && isset($tr_controle_plans)
                && $tr_controle_plans == 2
                && isset($tr_etat_retour)
                && ($tr_etat_retour == 2)
                && isset($tr_lien_plans)
                && ($tr_lien_plans != "")
            )
            ||
            (
                $mailaction_entite != null
                && isset($tr_controle_plans)
                && $tr_controle_plans == 2
                && isset($tr_etat_retour)
                && ($tr_etat_retour == 2)
                && isset($tr_lien_plans)
                && ($tr_lien_plans != "")
                && ($mailaction_entite->controle_plans != $tr_controle_plans
                || $mailaction_entite->etat_retour != $tr_etat_retour
                || $mailaction_entite->lien_plans != $tr_lien_plans)
            )
        ) {
            //envoi de mail
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Raccordement',4,'');

            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];


            $mailaction_cc =return_list_mail_cc_notif($db,"transportraccordement",4);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);
            $message[] = $mailaction_cc;
            $message[] = $mailaction_to;
            $message[] = $mailaction_object;
            $message[] = $mailaction_html;

            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }
        if($mailaction_new && (($mailaction_entite != null && $mailaction_entite->intervenant_be != $tr_intervenant_be) || ($mailaction_entite == null &&  $tr_intervenant_be != ""))){
            $mailaction_email_sender = [];
            //envoi de mail

            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Raccordement',2,'');
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif_tache($db,$connectedProfil->email_utilisateur,2);
            $mailaction_to =get_email_by_id($db,[$tr_intervenant_be]);
            $message[] = $mailaction_cc;
            $message[] = $mailaction_to;
            $message[] = $mailaction_object;
            $message[] = $mailaction_html;

            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
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

echo json_encode(array("error" => $err , "message" => $message, "duree" => $duree));
?>