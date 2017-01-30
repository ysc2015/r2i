<?php
/**
 * file: cmdctr_save.php
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

$suffix = "cctr";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

$fields = array();

if($sousProjet !== NULL) {
    if($sousProjet->transportcmcctr !== NULL) {
        $mailaction_entite = $sousProjet->transportcmcctr;
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";

                $fields[] = implode("_",$arr);
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_transport_commande_ctr set $fieldslist where id_sous_projet=:id_sous_projet");
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

                $fields[] = implode("_",$arr);
            }
        }

        $fieldslist = rtrim($fieldslist,",");
        $valueslist = rtrim($valueslist,",");

        $stm = $db->prepare("insert into sous_projet_transport_commande_ctr ($fieldslist) values ($valueslist)");
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

if(isset($cctr_intervenant_be)){
    $stm->bindParam(':intervenant_be',$cctr_intervenant_be);
    $insert = true;
}

if(isset($cctr_date_butoir)){
    $stm->bindParam(':date_butoir',$cctr_date_butoir);
    $insert = true;
}

if(isset($cctr_traitement_retour_terrain)){
    $stm->bindParam(':traitement_retour_terrain',$cctr_traitement_retour_terrain);
    $insert = true;
}

if(isset($cctr_modification_carto)){
    $stm->bindParam(':modification_carto',$cctr_modification_carto);
    $insert = true;
}

if(isset($cctr_commandes_acces)){
    $stm->bindParam(':commandes_acces',$cctr_commandes_acces);
    $insert = true;
}

if(isset($cctr_date_transmission_ca)){
    $stm->bindParam(':date_transmission_ca',$cctr_date_transmission_ca);
    $insert = true;
}

if(isset($cctr_date_depot_cmd)){
    $stm->bindParam(':date_depot_cmd',$cctr_date_depot_cmd);
    $insert = true;
}

if(isset($cctr_ref_commande_acces)){
    $stm->bindParam(':ref_commande_acces',$cctr_ref_commande_acces);
    $insert = true;
}

if(isset($cctr_go_ft)){
    $stm->bindParam(':go_ft',$cctr_go_ft);
    $insert = true;
}

if(isset($cctr_ok)){
    $stm->bindParam(':ok',$cctr_ok);
    $insert = true;
}

if(isset($cctr_date_debut_travaux_ft)){
    $stm->bindParam(':date_debut_travaux_ft',$cctr_date_debut_travaux_ft);
    $insert = true;
}

if(isset($cctr_date_fin_travaux_ft)){
    $stm->bindParam(':date_fin_travaux_ft',$cctr_date_fin_travaux_ft);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){

        $sousProjet = SousProjet::find($ids);//re-fetch sp
        if($sousProjet->is_master == 1) {
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->transportcmcctr == NULL && $sp->id_sous_projet != $sousProjet->id_sous_projet) {
                    $stm_create = $db->prepare("insert into sous_projet_transport_commande_ctr (id_sous_projet) values ($sp->id_sous_projet)");
                    $stm_create->execute();
                }
            }
            $sousProjet = SousProjet::find($ids);//re-fetch sp
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->id_sous_projet !== $sousProjet->id_sous_projet) {
                    $sp->transportcmcctr->id_sous_projet = $sp->id_sous_projet;
                    foreach($fields as $field) {
                        $sp->transportcmcctr->{$field} = $sousProjet->transportcmcctr->{$field};
                    }
                    $sp->transportcmcctr->save();
                }
            }
        }
        
        if($mailaction_new
            && (
                (isset($cctr_go_ft) && ($cctr_go_ft == 2) && $mailaction_entite ==null )
                ||
                ((isset($cctr_go_ft) && ($cctr_go_ft == 2) &&  $mailaction_entite->go_ft != $cctr_go_ft && $mailaction_entite != null))
            ) )  {
            //envoi de mail
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Commande',4,'');
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];
            $mailaction_cc =return_list_mail_cc_notif($db,"transportcmdctr",4);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }

        if($mailaction_new && (($mailaction_entite!= null && $mailaction_entite->intervenant_be != $cctr_intervenant_be) || ($mailaction_entite == null && $cctr_intervenant_be!=""  && isset($cctr_intervenant_be) )) ){
            $mailaction_email_sender = [];
            //envoi de mail

            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Commande',2,'','','','','','','',$sousProjet->projet->id_chef_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif_tache($db,$connectedProfil->email_utilisateur,2);
            $mailaction_to =get_email_by_id($db,[$cctr_intervenant_be]);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }

        }
        //mail validation etape
        if($mailaction_new
            &&
            (
                (   $mailaction_entite==null
                    && isset($cctr_ok)
                    && $cctr_ok == 1
                )
                ||
                ( $mailaction_entite!=null
                    && isset($cctr_ok)
                    && $cctr_ok == 1
                    && $mailaction_entite->ok != $cctr_ok

                )
            )
        ) {
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Commande',7,'');
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif($db,"transportcmdctr",7);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);


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

echo json_encode(array("error" => $err , "message" => $message));
?>