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

$suffix = "dr";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

$fields = array();

$pos = "";

if($sousProjet !== NULL) {
    if($sousProjet->distributionraccordement !== NULL) {
        $mailaction_entite = $sousProjet->distributionraccordement;
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
        if(!(/*$sousProjet->distributionraccordement->plans == 3 &&*/ $sousProjet->distributionraccordement->controle_plans == 2 && $sousProjet->distributionraccordement->lien_plans != "")) {
            if(/*isset($dr_plans) && */ isset($dr_controle_plans) && isset($dr_lien_plans) /*&& $dr_plans == 3*/ && $dr_controle_plans == 2 && $dr_lien_plans != "") {
                $fieldslist .=",date_controle_ok=:date_controle_ok";
                $stm = $db->prepare("update sous_projet_distribution_raccordements set $fieldslist where id_sous_projet=:id_sous_projet");
                $dt = date('Y-m-d');
                $stm->bindParam(':date_controle_ok',$dt);
                $pos = "1";
            } else {
                $fieldslist .=",date_controle_ok=:date_controle_ok";
                $stm = $db->prepare("update sous_projet_distribution_raccordements set $fieldslist where id_sous_projet=:id_sous_projet");
                $dt = NULL;
                $stm->bindParam(':date_controle_ok',$dt);
                $pos = "2";
            }
        } else {
            if(!(/*isset($dr_plans) && */ isset($dr_controle_plans) && isset($dr_lien_plans) /*&& $dr_plans == 3*/ && $dr_controle_plans == 2 && $dr_lien_plans != "")) {
                $fieldslist .=",date_controle_ok=:date_controle_ok";
                $stm = $db->prepare("update sous_projet_distribution_raccordements set $fieldslist where id_sous_projet=:id_sous_projet");
                $dt = NULL;
                $stm->bindParam(':date_controle_ok',$dt);
                $pos = "3";
            } else {
                if($sousProjet->distributionraccordement->date_controle_ok != NULL) {
                    $stm = $db->prepare("update sous_projet_distribution_raccordements set $fieldslist where id_sous_projet=:id_sous_projet");
                    $pos = "4";
                }
                else {
                    $fieldslist .=",date_controle_ok=:date_controle_ok";
                    $stm = $db->prepare("update sous_projet_distribution_raccordements set $fieldslist where id_sous_projet=:id_sous_projet");
                    $dt = date('Y-m-d');
                    $stm->bindParam(':date_controle_ok',$dt);
                    $pos = "5";
                }
            }
        }
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
        if(/*isset($dr_plans) && */ isset($dr_controle_plans) && isset($dr_lien_plans)/* && $dr_plans == 3*/ && $dr_controle_plans == 2 && $dr_lien_plans != "") {
            $fieldslist .=",date_controle_ok";
            $valueslist .=",:date_controle_ok";
            $stm = $db->prepare("insert into sous_projet_distribution_raccordements ($fieldslist) values ($valueslist)");
            $dt = date('Y-m-d');
            $stm->bindParam(':date_controle_ok',$dt);
            $date_insertion =  date('Y-m-d G:i:s');
            $stm->bindParam(':date_insertion',$date_insertion);
            $id_createur = intval($connectedProfil->profil->id_utilisateur);
            $stm->bindParam(':id_createur',$id_createur);
        } else {
            $stm = $db->prepare("insert into sous_projet_distribution_raccordements ($fieldslist) values ($valueslist)");
            $date_insertion =  date('Y-m-d G:i:s');
            $stm->bindParam(':date_insertion',$date_insertion);
            $id_createur = intval($connectedProfil->profil->id_utilisateur);
            $stm->bindParam(':id_createur',$id_createur);
        }
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

if(isset($dr_intervenant_be)){
    $stm->bindParam(':intervenant_be',$dr_intervenant_be);
    $insert = true;
}

if(isset($dr_preparation_pds)){
    $stm->bindParam(':preparation_pds',$dr_preparation_pds);
    $insert = true;
}

if(isset($dr_controle_plans)){
    $stm->bindParam(':controle_plans',$dr_controle_plans);
    $insert = true;
}

if(isset($dr_date_transmission_pds)){
    $stm->bindParam(':date_transmission_pds',$dr_date_transmission_pds);
    $insert = true;
}

if(isset($dr_id_entreprise)){
    $stm->bindParam(':id_entreprise',$dr_id_entreprise);
    $insert = true;
}

/*
 * dates début
 */

if(isset($dr_date_racco) && isset($dr_date_ret_prevue)) {

    $dd = DateTime::createFromFormat('Y-m-d', $dr_date_racco);
    $df = DateTime::createFromFormat('Y-m-d', $dr_date_ret_prevue);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la Date prévisionnelle de fin du raccordement doit étre superieure à la date de début raccordement !";
    } else  {

        if(isset($dr_date_racco)){
            $stm->bindParam(':date_racco',$dr_date_racco);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs date de début du raccordement est obligatoire !";
        }

        if(isset($dr_date_ret_prevue)){
            $stm->bindParam(':date_ret_prevue',$dr_date_ret_prevue);
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

if(isset($dr_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$dr_controle_demarrage_effectif);
    $insert = true;
}

if(isset($dr_date_retour)){
    $stm->bindParam(':date_retour',$dr_date_retour);
    $insert = true;
}

if(isset($dr_etat_retour)){
    $stm->bindParam(':etat_retour',$dr_etat_retour);
    $insert = true;
}

if(isset($dr_lien_plans)){
    $stm->bindParam(':lien_plans',$dr_lien_plans);
    $insert = true;
}

if(isset($dr_retour_presta)){
    $stm->bindParam(':retour_presta',$dr_retour_presta);
    $insert = true;
}

if(isset($dr_ok)){
    $stm->bindParam(':ok',$dr_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    /*$duree = getDuree($dr_date_racco,$dr_date_ret_prevue);
    $stm->bindParam(':duree',$duree);;*/
    if($stm->execute()){

        /*$sousProjet = SousProjet::find($ids);//re-fetch sp
        if($sousProjet->is_master == 1) {
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->distributionraccordement == NULL && $sp->id_sous_projet != $sousProjet->id_sous_projet) {
                    $stm_create = $db->prepare("insert into sous_projet_distribution_raccordements (id_sous_projet) values ($sp->id_sous_projet)");
                    $stm_create->execute();
                }
            }
            $sousProjet = SousProjet::find($ids);//re-fetch sp
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->id_sous_projet !== $sousProjet->id_sous_projet) {
                    $sp->distributionraccordement->id_sous_projet = $sp->id_sous_projet;
                    foreach($fields as $field) {
                        $sp->distributionraccordement->{$field} = $sousProjet->distributionraccordement->{$field};
                    }
                    $sp->distributionraccordement->save();
                }
            }
        }*/
        
        if($mailaction_new
            &&
            (
                ( $mailaction_entite==null
                && isset($dr_controle_plans)
                && $dr_controle_plans == 2
                && isset($dr_lien_plans)
                && $dr_lien_plans != ""
                )
                ||
                (   $mailaction_entite!=null
                    && isset($dr_controle_plans)
                    && $dr_controle_plans == 2
                    && isset($dr_lien_plans)
                    && $dr_lien_plans != ""
                    &&
                    ($mailaction_entite->controle_plans != $dr_controle_plans
                        || $mailaction_entite->lien_plans != $dr_lien_plans)

                )
            )) {
            //envoi de mail
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Raccordement',4,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);
            $mailaction_cc =return_list_mail_cc_notif($db,"distributionraccordement",4);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc,$connectedProfil->email_utilisateur)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }
        if($mailaction_new && $mailaction_entite->intervenant_be  != $dr_intervenant_be  ){
            $mailaction_email_sender = [];
            //envoi de mail
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Raccordement',2,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];


            $mailaction_cc  =return_list_mail_cc_notif_tache($db,$connectedProfil->email_utilisateur,2);
            $mailaction_to  =get_email_by_id($db,[$dr_intervenant_be]);


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
                    && isset($dr_ok)
                    && $dr_ok == 1
                )
                ||
                ( $mailaction_entite!=null
                    && isset($dcc_ok)
                    && $dr_ok == 1
                    && $mailaction_entite->ok != $dr_ok

                )
            )
        ) {
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Raccordement',7,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif($db,"distributionraccordement",7);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc,$connectedProfil->email_utilisateur)) {
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

echo json_encode(array("error" => $err , "message" => $message , "pos" => $pos));
?>