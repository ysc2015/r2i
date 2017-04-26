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

$fields = array();

$pos = "";


if($sousProjet !== NULL) {

    if($sousProjet->transporttirage !== NULL) {
        $mailaction_entite = $sousProjet->transporttirage;
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

        if(!(/*$sousProjet->transporttirage->plans == 3 &&*/ $sousProjet->transporttirage->controle_plans == 2 && $sousProjet->transporttirage->lien_plans != "")) {
            if(/*isset($tt_plans) && */ isset($tt_controle_plans) && isset($tt_lien_plans) /*&& $tt_plans == 3*/ && $tt_controle_plans == 2 && $tt_lien_plans != "") {
                $fieldslist .=",date_controle_ok=:date_controle_ok";
                $stm = $db->prepare("update sous_projet_transport_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
                $dt = date('Y-m-d');
                $stm->bindParam(':date_controle_ok',$dt);
                $pos = "1";
            } else {
                $fieldslist .=",date_controle_ok=:date_controle_ok";
                $stm = $db->prepare("update sous_projet_transport_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
                $dt = NULL;
                $stm->bindParam(':date_controle_ok',$dt);
                $pos = "2";
            }
        } else {
            if(!(/*isset($tt_plans) && */ isset($tt_controle_plans) && isset($tt_lien_plans) /*&& $tt_plans == 3*/ && $tt_controle_plans == 2 && $tt_lien_plans != "")) {
                $fieldslist .=",date_controle_ok=:date_controle_ok";
                $stm = $db->prepare("update sous_projet_transport_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
                $dt = NULL;
                $stm->bindParam(':date_controle_ok',$dt);
                $pos = "3";
            } else {
                if($sousProjet->transporttirage->date_controle_ok != NULL) {
                    $stm = $db->prepare("update sous_projet_transport_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
                    $pos = "4";
                }
                else {
                    $fieldslist .=",date_controle_ok=:date_controle_ok";
                    $stm = $db->prepare("update sous_projet_transport_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
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

        if(/*isset($tt_plans) && */ isset($tt_controle_plans) && isset($tt_lien_plans) /*&& $tt_plans == 3*/ && $tt_controle_plans == 2 && $tt_lien_plans != "") {
            $fieldslist .=",date_controle_ok";
            $valueslist .=",:date_controle_ok";
            $stm = $db->prepare("insert into sous_projet_transport_tirage ($fieldslist) values ($valueslist)");
            $dt = date('Y-m-d');
            $stm->bindParam(':date_controle_ok',$dt);
            $date_insertion =  date('Y-m-d G:i:s');
            $stm->bindParam(':date_insertion',$date_insertion);
            $id_createur = intval($connectedProfil->profil->id_utilisateur);
            $stm->bindParam(':id_createur',$id_createur);
        } else {
            $stm = $db->prepare("insert into sous_projet_transport_tirage ($fieldslist) values ($valueslist)");
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

        $sousProjet = SousProjet::find($ids);//re-fetch sp
        if($sousProjet->is_master == 1) {
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->transporttirage == NULL && $sp->id_sous_projet != $sousProjet->id_sous_projet) {
                    $stm_create = $db->prepare("insert into sous_projet_transport_tirage (id_sous_projet) values ($sp->id_sous_projet)");
                    $stm_create->execute();
                }
            }
            $sousProjet = SousProjet::find($ids);//re-fetch sp
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->id_sous_projet !== $sousProjet->id_sous_projet) {
                    $sp->transporttirage->id_sous_projet = $sp->id_sous_projet;
                    foreach($fields as $field) {
                        $sp->transporttirage->{$field} = $sousProjet->transporttirage->{$field};
                    }
                    $sp->transporttirage->save();
                }
            }
        }
        
        if($new) {
            if($sousProjet->transportraccordement == NULL) {
                $transportraccordement = new SousProjetTransportRaccordement(array(
                    'id_sous_projet' => $ids));
                $transportraccordement->save();
            }
        }
        if($mailaction_new
            &&
            (
                (
                    $mailaction_entite == null
                    &&  isset($tt_plans)
                    && ($tt_plans == 3)
                    && isset($tt_controle_plans)
                    && ($tt_controle_plans == 2)
                    && isset($tt_lien_plans)
                    && $tt_lien_plans != ""
                )
            ||
                ( $mailaction_entite != null
                    &&  isset($tt_plans)
                    && ($tt_plans == 3)
                    && isset($tt_controle_plans)
                    && ($tt_controle_plans == 2)
                    && isset($tt_lien_plans)
                    && $tt_lien_plans != ""
                    &&
                    ($mailaction_entite->lien_plans != $tt_lien_plans
                    || $mailaction_entite->plans != $tt_plans
                    || $mailaction_entite->controle_plans != $tt_controle_plans)
                )
            )
        ) {
            //envoi de mail
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Tirage',4,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];


            $mailaction_cc =return_list_mail_cc_notif($db,"transporttirage",4);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);

            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc,$connectedProfil->email_utilisateur)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }
        if($mailaction_new && (
            ($mailaction_entite != null && $mailaction_entite->intervenant_be  != $tt_intervenant_be)
            ||
            ( $mailaction_entite == null && $tt_intervenant_be != "" )
            )){
            $mailaction_email_sender = [];
            //envoi de mail

            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Tirage',2,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc  =return_list_mail_cc_notif_tache($db,$connectedProfil->email_utilisateur,2);
            $mailaction_to  =get_email_by_id($db,[$tt_intervenant_be]);


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
                    && isset($tt_ok)
                    && $tt_ok == 1
                )
                ||
                ( $mailaction_entite!=null
                    && isset($tt_ok)
                    && $tt_ok == 1
                    && $mailaction_entite->ok != $tt_ok

                )
            )
        ) {
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','Tirage',7,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif($db,"transporttirage",7);
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

echo json_encode(array("error" => $err , "message" => $message , "pos" => $pos));
?>