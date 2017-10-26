<?php
/**
 * file: recette_save.php
 * User: rabii
 */

extract($_POST);

$sousProjet = NULL;
$stm = NULL;

$drec_intervenant_free = "";

if(isset($ids) && !empty($ids)){
    $sousProjet = SousProjet::find($ids);
}
$mailaction_new = false;
$mailaction_entite = NULL;

$insert = false;
$err = 0;
$message = array();

$suffix = "drec";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

$fields = array();

if($sousProjet !== NULL) {
    if($sousProjet->distributionrecette !== NULL) {
        $mailaction_entite = $sousProjet->distributionrecette;
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
        (isset($drec_intervenant_be))? $fieldslist .=",date_attribution_be = :date_attribution_be": $fieldslist.="" ;
        (isset($drec_doe))? $fieldslist .=",date_attribution_doe = :date_attribution_doe": $fieldslist.="" ;
        $stm = $db->prepare("update sous_projet_distribution_recette set $fieldslist where id_sous_projet=:id_sous_projet");
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
        (isset($drec_intervenant_be))? $fieldslist .=",date_attribution_be ": $fieldslist.="" ;
        (isset($drec_intervenant_be))? $valueslist .=",:date_attribution_be ": $valueslist.="" ;
        (isset($drec_doe))? $fieldslist .=",date_attribution_doe ": $fieldslist.="" ;
        (isset($drec_doe))? $valueslist .=",:date_attribution_doe ": $valueslist.="" ;
        $stm = $db->prepare("insert into sous_projet_distribution_recette ($fieldslist) values ($valueslist)");
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

if(isset($drec_intervenant_be)){
    $stm->bindParam(':intervenant_be',$drec_intervenant_be);
    $dt_attribution = date('Y-m-d');
    $stm->bindParam(':date_attribution_be',$dt_attribution);
    $insert = true;
}

if(isset($drec_doe)){
    $stm->bindParam(':doe',$drec_doe);
    $dt_attribution_doe = date('Y-m-d');
    $stm->bindParam(':date_attribution_doe',$dt_attribution_doe);
    $insert = true;
}

if(isset($drec_netgeo)){
    $stm->bindParam(':netgeo',$drec_netgeo);
    $insert = true;
}

if(isset($drec_injection_netgeo)){
    $stm->bindParam(':injection_netgeo',$drec_injection_netgeo);
    $insert = true;
}
if(isset($drec_fichier_flag)){
    $stm->bindParam(':fichier_flag',$drec_fichier_flag);
    $insert = true;
}if(isset($drec_fichier_certification)){
    $stm->bindParam(':fichier_certification',$drec_fichier_certification);
    $insert = true;
}if(isset($drec_fichier_coupleur)){
    $stm->bindParam(':fichier_coupleur',$drec_fichier_coupleur);
    $insert = true;
}if(isset($drec_base_netgeo)){
    $stm->bindParam(':base_netgeo',$drec_base_netgeo);
    $insert = true;
}if(isset($drec_dedoe)){
    $stm->bindParam(':dedoe',$drec_dedoe);
    $insert = true;
}if(isset($drec_code_certification)){
    $stm->bindParam(':code_certification',$drec_code_certification);
    $insert = true;
}if(isset($drec_lien_zip_complet)){
    $stm->bindParam(':lien_zip_complet',$drec_lien_zip_complet);
    $insert = true;
}

if(isset($drec_id_entreprise)){
    $stm->bindParam(':id_entreprise',$drec_id_entreprise);
    $insert = true;
}

if(isset($drec_date_recette)){
    $stm->bindParam(':date_recette',$drec_date_recette);
    $insert = true;
}

if(isset($drec_etat_recette)){
    $stm->bindParam(':etat_recette',$drec_etat_recette);
    $insert = true;
}

if(isset($drec_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$drec_controle_demarrage_effectif);
    $insert = true;
}

if(isset($drec_date_retour)){
    $stm->bindParam(':date_retour',$drec_date_retour);
    $insert = true;
}

if(isset($drec_etat_retour)){
    $stm->bindParam(':etat_retour',$drec_etat_retour);
    $insert = true;
}

if(isset($drec_lien_plans)){
    $stm->bindParam(':lien_plans',$drec_lien_plans);
    $insert = true;
}

if(isset($drec_retour_presta)){
    $stm->bindParam(':retour_presta',$drec_retour_presta);
    $insert = true;
}

if(isset($drec_ok)){
    $stm->bindParam(':ok',$drec_ok);
    $insert = true;
}

if(isset($drec_controle_plans)){
    $stm->bindParam(':controle_plans',$drec_controle_plans);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){

        /*$sousProjet = SousProjet::find($ids);//re-fetch sp
        if($sousProjet->is_master == 1) {
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->distributionrecette == NULL && $sp->id_sous_projet != $sousProjet->id_sous_projet) {
                    $stm_create = $db->prepare("insert into sous_projet_distribution_recette (id_sous_projet) values ($sp->id_sous_projet)");
                    $stm_create->execute();
                }
            }
            $sousProjet = SousProjet::find($ids);//re-fetch sp
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->id_sous_projet !== $sousProjet->id_sous_projet) {
                    $sp->distributionrecette->id_sous_projet = $sp->id_sous_projet;
                    foreach($fields as $field) {
                        $sp->distributionrecette->{$field} = $sousProjet->distributionrecette->{$field};
                    }
                    $sp->distributionrecette->save();
                }
            }
        }*/
        
        if($mailaction_new && (
                (   $mailaction_entite == null
                    && isset($drec_etat_recette)
                    && $drec_etat_recette == 3
                )
                ||
                (   $mailaction_entite != null
                    && isset($drec_etat_recette)
                    && $drec_etat_recette == 3
                    && $mailaction_entite ->etat_recette != $drec_etat_recette
                )
            ))

            {
            //envoi de mail
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Recette',4,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];
            $mailaction_cc =return_list_mail_cc_notif($db,"distributionrecette",4);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc,$connectedProfil->email_utilisateur)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }
        if($mailaction_new &&
            (
                ($mailaction_entite != null &&
                ($mailaction_entite->intervenant_be  != $drec_intervenant_be || $mailaction_entite->intervenant_free  != $drec_intervenant_free)
            )
            ||
            ($mailaction_entite == null &&
                ( $drec_intervenant_be!="" || $drec_intervenant_free != "")
            )
        )
        ){
            $mailaction_email_sender = [];
            //envoi de mail;
            if($drec_intervenant_be==null ) $drec_intervenant_be = 0;
            if($drec_intervenant_free==null) $drec_intervenant_free = 0;

            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Recette',2,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc  =return_list_mail_cc_notif_tache($db,$connectedProfil->email_utilisateur,2);
            $mailaction_to  =get_email_by_id($db,[$drec_intervenant_be,$drec_intervenant_free]);

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
                    && isset($drec_ok)
                    && $drec_ok == 1
                )
                ||
                ( $mailaction_entite!=null
                    && isset($drec_ok)
                    && $drec_ok == 1
                    && $mailaction_entite->ok != $drec_ok

                )
            )
        ) {
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Recette',7,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif($db,"distributionrecette",7);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc,$connectedProfil->email_utilisateur)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }
        //mail Avancement Netgeo
        if( $mailaction_new
            &&
            (
                (   $mailaction_entite==null
                    && isset($drec_fichier_flag)
                    && $drec_fichier_flag == 1
                    && isset($drec_fichier_certification)
                    && $drec_fichier_certification == 1
                    && isset($drec_fichier_coupleur)
                    && $drec_fichier_coupleur == 1
                    && isset($drec_base_netgeo)
                    && $drec_base_netgeo == 1
                    && isset($drec_dedoe)
                    && $drec_dedoe == 1
                    && isset($drec_code_certification)
                    && $drec_code_certification != ""
                    && isset($drec_lien_zip_complet)
                    && $drec_lien_zip_complet != ""
                )
                ||
                ( $mailaction_entite!=null
                    && (
                    ( isset($drec_fichier_flag) && $drec_fichier_flag == 1 )
                    &&
                    ( isset($drec_fichier_certification) && $drec_fichier_certification == 1  )
                    &&
                    ( isset($drec_fichier_coupleur) && $drec_fichier_coupleur == 1  )
                    &&
                    ( isset($drec_base_netgeo) && $drec_base_netgeo == 1  )
                    &&
                    ( isset($drec_dedoe) && $drec_dedoe == 1  )
                    &&
                    ( isset($drec_code_certification) && $drec_code_certification != ""  )
                    &&
                    ( isset($drec_lien_zip_complet) && $drec_lien_zip_complet != ""  )
                    )
                    &&
                        ($mailaction_entite->fichier_flag != $drec_fichier_flag
                        ||
                        $mailaction_entite->fichier_certification != $drec_fichier_certification
                        ||
                        $mailaction_entite->fichier_coupleur != $drec_fichier_coupleur
                        ||
                        $mailaction_entite->base_netgeo != $drec_base_netgeo
                        ||
                        $mailaction_entite->base_netgeo != $drec_dedoe
                        ||
                        $mailaction_entite->code_certification != $drec_code_certification
                        ||
                        $mailaction_entite->lien_zip_complet != $drec_lien_zip_complet
                        )
                )
            )
        ) {

            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Recette',11,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet,'',$drec_code_certification,$drec_lien_zip_complet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif($db,"distributionrecette",11);
echo "dede";
            if(isset($drec_netgeo) && $drec_netgeo != ""){

                $mailaction_to =get_email_by_id($db,[$drec_netgeo]);


                if(MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc,$connectedProfil->email_utilisateur)) {
                    $message[] = "Mail envoyé !";
                } else {
                    $message[] = "Mail non envoyé !";
                    $err++;
                }

            }else{
                $message[] = "Mail non envoyé absence du Netgeo !";
                $err++;

            }


        }

        /**
         * Quand le fichier flag + fichier certification + code certification validé
         * Il y a un mail qui part vers l'utilisateur DOE
         */
        if ( $mailaction_new
            &&
            (
                (   $mailaction_entite==null
                    && isset($drec_fichier_flag)
                    && $drec_fichier_flag == 1
                    && isset($drec_fichier_certification)
                    && $drec_fichier_certification == 1
                    && isset($drec_code_certification)
                    && $drec_code_certification != ""
                )
                ||
                ( $mailaction_entite!=null
                    && (
                        ( isset($drec_fichier_flag) && $drec_fichier_flag == 1 )
                        &&
                        ( isset($drec_fichier_certification) && $drec_fichier_certification == 1  )
                        &&
                        ( isset($drec_code_certification) && $drec_code_certification != ""  )
                    )
                    &&
                    ($mailaction_entite->fichier_flag != $drec_fichier_flag
                        ||
                        $mailaction_entite->fichier_certification != $drec_fichier_certification
                        ||
                        $mailaction_entite->code_certification != $drec_code_certification
                    )
                )
            )
        ) {

        $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Recette',13,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet,'',$drec_code_certification);
        $mailaction_object = $mailaction_html[1];
        $mailaction_html =  $mailaction_html[0];

        $mailaction_cc =return_list_mail_cc_notif($db,"distributionrecette",13);

        if(isset($drec_doe) && $drec_doe != ""){

            $mailaction_to =get_email_by_id($db,[$drec_doe]);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc,$connectedProfil->email_utilisateur)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }

        }else{
            $message[] = "Mail non envoyé absence de l'utilisateur DOE !";
            $err++;

        }


    }
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>