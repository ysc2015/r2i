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

$fields = array();

if($sousProjet !== NULL) {

    if($sousProjet->transportrecette !== NULL) {
        $mailaction_entite = $sousProjet->transportrecette;
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
        $fieldslist .=",id_modificateur = :id_modificateur";
        (isset($trec_intervenant_be))? $fieldslist .=",date_attribution_be = :date_attribution_be": $fieldslist.="" ;
        (isset($trec_doe))? $fieldslist .=",date_attribution_doe = :date_attribution_doe": $fieldslist.="" ;
        $stm = $db->prepare("update sous_projet_transport_recette set $fieldslist where id_sous_projet=:id_sous_projet");
        $id_modificateur = intval($connectedProfil->profil->id_utilisateur);
        $stm->bindParam(':id_modificateur',$id_modificateur);
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
        $fieldslist .=",date_insertion,id_createur";
        $valueslist .=",:date_insertion,:id_createur";
        (isset($trec_intervenant_be))? $fieldslist .=",date_attribution_be ": $fieldslist.="" ;
        (isset($trec_intervenant_be))? $valueslist .=",:date_attribution_be ": $valueslist.="" ;
        (isset($trec_doe))? $fieldslist .=",date_attribution_doe ": $fieldslist.="" ;
        (isset($trec_doe))? $valueslist .=",:date_attribution_doe ": $valueslist.="" ;

        $stm = $db->prepare("insert into sous_projet_transport_recette ($fieldslist) values ($valueslist)");
        $date_insertion =  date('Y-m-d G:i:s');
        $stm->bindParam(':date_insertion',$date_insertion);
        $id_createur = intval($connectedProfil->profil->id_utilisateur);
        $stm->bindParam(':id_createur',$id_createur);
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
    $dt_attribution = date('Y-m-d');
    $stm->bindParam(':date_attribution_be',$dt_attribution);
    $insert = true;
}

if(isset($trec_doe)){

    $stm->bindParam(':doe',$trec_doe);
    $dt_attribution_doe = date('Y-m-d');
    $stm->bindParam(':date_attribution_doe',$dt_attribution_doe);
    $insert = true;
}

if(isset($trec_netgeo)){
    $stm->bindParam(':netgeo',$trec_netgeo);
    $insert = true;
}

if(isset($trec_injection_netgeo)){
    $stm->bindParam(':injection_netgeo',$trec_injection_netgeo);
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

if(isset($trec_ok)){
    $stm->bindParam(':ok',$trec_ok);
    $insert = true;
}

if(isset($trec_controle_plans)){
    $stm->bindParam(':controle_plans',$trec_controle_plans);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        
        $sousProjet = SousProjet::find($ids);//re-fetch sp
        if($sousProjet->is_master == 1) {
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->transportrecette == NULL && $sp->id_sous_projet != $sousProjet->id_sous_projet) {
                    $stm_create = $db->prepare("insert into sous_projet_transport_recette (id_sous_projet) values ($sp->id_sous_projet)");
                    $stm_create->execute();
                }
            }
            $sousProjet = SousProjet::find($ids);//re-fetch sp
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->id_sous_projet !== $sousProjet->id_sous_projet) {
                    $sp->transportrecette->id_sous_projet = $sp->id_sous_projet;
                    foreach($fields as $field) {
                        $sp->transportrecette->{$field} = $sousProjet->transportrecette->{$field};
                    }
                    $sp->transportrecette->save();
                }
            }
        }
        
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
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Recette',4,'','','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif($db,"transportrecette",4);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc,$connectedProfil->email_utilisateur)) {
               $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }
        if($mailaction_new
            &&
            (
                ($mailaction_entite!=null && ($mailaction_entite->intervenant_be  != $trec_intervenant_be  ||  $mailaction_entite->injection_netgeo  != $trec_injection_netgeo))
                ||
                ($mailaction_entite==null && ( $trec_intervenant_be !=""  || $trec_injection_netgeo!=""))
            )
            ){
            if($trec_intervenant_be==null ) $trec_intervenant_be = 0;
            if($trec_injection_netgeo==null) $trec_injection_netgeo = 0;
            $mailaction_email_sender = [];
            //envoi de mail
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Recette',2,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];
            $mailaction_cc  =return_list_mail_cc_notif_tache($db,$connectedProfil->email_utilisateur,2);
            $mailaction_to  =get_email_by_id($db,[$trec_intervenant_be,$trec_injection_netgeo]);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc,$connectedProfil->email_utilisateur)) {
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
                    && isset($trec_ok)
                    && $trec_ok == 1
                )
                ||
                ( $mailaction_entite!=null
                    && isset($trec_ok)
                    && $trec_ok == 1
                    && $mailaction_entite->ok != $trec_ok

                )
            )
        ) {
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Recette',7,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif($db,"transportrecette",7);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc,$connectedProfil->email_utilisateur)) {
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