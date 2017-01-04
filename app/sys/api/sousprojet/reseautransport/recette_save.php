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
        if($mailaction_new
            &&
            (
                ($mailaction_entite!=null
                 && isset($trec_etat_recette)
                 &&  $trec_etat_recette == 3
                 && $mailaction_entite->etat_recette != $trec_etat_recette
                )
            ||
                (   $mailaction_entite==null
                    && isset($trec_etat_recette)
                    &&  $trec_etat_recette == 3
                )
            )
        ) {
            //envoi de mail
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Recette',4,'');
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif($db,"transportraccordement",4);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);
            $message[] = $mailaction_cc;
            $message[] = $mailaction_to;
            $message[] = $mailaction_object;
            $message[] = $mailaction_html;

            if(MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
               $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }
        if($mailaction_new
            &&
            (
                ($mailaction_entite!=null && ($mailaction_entite->intervenant_be  != $trec_intervenant_be  ||  $mailaction_entite->intervenant_free  != $trec_intervenant_free))
                ||
                ($mailaction_entite==null && ( $trec_intervenant_be !=""  || $trec_intervenant_free!=""))
            )
            ){
            if($trec_intervenant_be==null ) $trec_intervenant_be = 0;
            if($trec_intervenant_free==null) $trec_intervenant_free = 0;
            $mailaction_email_sender = [];
            //envoi de mail
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Recette',2,'');
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];
            $mailaction_cc  =return_list_mail_cc_notif_tache($db,$connectedProfil->email_utilisateur,2);
            $mailaction_to  =get_email_by_id($db,[$trec_intervenant_be,$trec_intervenant_free]);
            $message[] = $mailaction_cc;
            $message[] = $mailaction_to;
            $message[] = $mailaction_object;
            $message[] = $mailaction_html;

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

echo json_encode(array("error" => $err , "message" => $message));
?>