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

$pos = "";

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

$fields = array();

if($sousProjet !== NULL) {
    if($sousProjet->distributiontirage !== NULL) {
        $mailaction_entite = $sousProjet->distributiontirage;

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
        if(!(/*$sousProjet->distributiontirage->plans == 3 &&*/ $sousProjet->distributiontirage->controle_plans == 2 && $sousProjet->distributiontirage->lien_plans != "")) {
            if(/*isset($dt_plans) && */ isset($dt_controle_plans) && isset($dt_lien_plans) /*&& $dt_plans == 3*/ && $dt_controle_plans == 2 && $dt_lien_plans != "") {
                $fieldslist .=",date_controle_ok=:date_controle_ok";
                $stm = $db->prepare("update sous_projet_distribution_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
                $dt = date('Y-m-d');
                $stm->bindParam(':date_controle_ok',$dt);
                $pos = "1";
            } else {
                $fieldslist .=",date_controle_ok=:date_controle_ok";
                $stm = $db->prepare("update sous_projet_distribution_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
                $dt = NULL;
                $stm->bindParam(':date_controle_ok',$dt);
                $pos = "2";
            }
        } else {
            if(!(/*isset($dt_plans) && */ isset($dt_controle_plans) && isset($dt_lien_plans) /*&& $dt_plans == 3*/ && $dt_controle_plans == 2 && $dt_lien_plans != "")) {
                $fieldslist .=",date_controle_ok=:date_controle_ok";
                $stm = $db->prepare("update sous_projet_distribution_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
                $dt = NULL;
                $stm->bindParam(':date_controle_ok',$dt);
                $pos = "3";
            } else {
                if($sousProjet->distributiontirage->date_controle_ok != NULL) {
                    $stm = $db->prepare("update sous_projet_distribution_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
                    $pos = "4";
                }
                else {
                    $fieldslist .=",date_controle_ok=:date_controle_ok";
                    $stm = $db->prepare("update sous_projet_distribution_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
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

        if(/*isset($dt_plans) && */ isset($dt_controle_plans) && isset($dt_lien_plans)/* && $dt_plans == 3*/ && $dt_controle_plans == 2 && $dt_lien_plans != "") {
            $fieldslist .=",date_controle_ok";
            $valueslist .=",:date_controle_ok";
            $stm = $db->prepare("insert into sous_projet_distribution_tirage ($fieldslist) values ($valueslist)");
            $dt = date('Y-m-d');
            $stm->bindParam(':date_controle_ok',$dt);
            $date_insertion =  date('Y-m-d G:i:s');
            $stm->bindParam(':date_insertion',$date_insertion);
            $id_createur = intval($connectedProfil->profil->id_utilisateur);
            $stm->bindParam(':id_createur',$id_createur);
        } else {
            $stm = $db->prepare("insert into sous_projet_distribution_tirage ($fieldslist) values ($valueslist)");
            $date_insertion =  date('Y-m-d G:i:s');
            $stm->bindParam(':date_insertion',$date_insertion);
            $id_createur = intval($connectedProfil->profil->id_utilisateur);
            $stm->bindParam(':id_createur',$id_createur);
        }

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

        /*$sousProjet = SousProjet::find($ids);//re-fetch sp
        if($sousProjet->is_master == 1) {
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->distributiontirage == NULL && $sp->id_sous_projet != $sousProjet->id_sous_projet) {
                    $stm_create = $db->prepare("insert into sous_projet_distribution_tirage (id_sous_projet) values ($sp->id_sous_projet)");
                    $stm_create->execute();
                }
            }
            $sousProjet = SousProjet::find($ids);//re-fetch sp
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->id_sous_projet !== $sousProjet->id_sous_projet) {
                    $sp->distributiontirage->id_sous_projet = $sp->id_sous_projet;
                    foreach($fields as $field) {
                        $sp->distributiontirage->{$field} = $sousProjet->distributiontirage->{$field};
                    }
                    $sp->distributiontirage->save();
                }
            }
        }*/
        
        if($new) {
            if($sousProjet->distributionraccordement == NULL) {
                $distributionraccordement = new SousProjetDistributionRaccordement(array(
                    'id_sous_projet' => $ids));
                $distributionraccordement->save();
            }
        }
        if($mailaction_new
            &&
            (
            (   $mailaction_entite ==null
                &&  isset($dt_controle_plans)
                && $dt_controle_plans == 2
                && isset($dt_lien_plans)
                && $dt_lien_plans != "" )
            ||
            ($mailaction_entite !=null
                &&  isset($dt_controle_plans)
                && $dt_controle_plans == 2
                && isset($dt_lien_plans)
                && $dt_lien_plans != ""
            &&
                ($mailaction_entite->controle_plans != $dt_controle_plans || $mailaction_entite->lien_plans != $dt_lien_plans )
            )
            ) ) {
            //envoi de mail
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Tirage',4,'');
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif($db,"distributiontirage",4);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }
        if($mailaction_new && (
            ($mailaction_entite != null && $mailaction_entite->intervenant_be  != $dt_intervenant_be )
            ||
            ($mailaction_entite==null && $dt_intervenant_be!="")
            ) ){
            $mailaction_email_sender = [];
            //envoi de mail

            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Tirage',2,'','','','','','','',$sousProjet->projet->id_chef_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc  =   return_list_mail_cc_notif_tache($db,$connectedProfil->email_utilisateur,2);
            $mailaction_to  =   get_email_by_id($db,[$dt_intervenant_be]);


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
                    && isset($dt_ok)
                    && $dt_ok == 1
                )
                ||
                ( $mailaction_entite!=null
                    && isset($dt_ok)
                    && $dt_ok == 1
                    && $mailaction_entite->ok != $dt_ok

                )
            )
        ) {
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Tirage',7,'');
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif($db,"distributiontirage",7);
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

echo json_encode(array("error" => $err , "message" => $message , "pos" => $pos));
?>