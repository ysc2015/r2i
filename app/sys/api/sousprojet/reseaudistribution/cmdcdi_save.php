<?php
/**
 * file: cmdcdi_save.php
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

$suffix = "dcc";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

$fields = array();

if($sousProjet !== NULL) {
    if($sousProjet->distributioncmdcdi !== NULL) {
        $mailaction_entite = $sousProjet->distributioncmdcdi;

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

        $stm = $db->prepare("update sous_projet_distribution_commande_cdi set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_distribution_commande_cdi ($fieldslist) values ($valueslist)");
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

if(isset($dcc_intervenant_be)){
    $stm->bindParam(':intervenant_be',$dcc_intervenant_be);
    $insert = true;
}

if(isset($dcc_date_butoir)){
    $stm->bindParam(':date_butoir',$dcc_date_butoir);
    $insert = true;
}

if(isset($dcc_traitement_retour_terrain)){
    $stm->bindParam(':traitement_retour_terrain',$dcc_traitement_retour_terrain);
    $insert = true;
}

if(isset($dcc_modification_carto)){
    $stm->bindParam(':modification_carto',$dcc_modification_carto);
    $insert = true;
}

if(isset($dcc_commandes_acces)){
    $stm->bindParam(':commandes_acces',$dcc_commandes_acces);
    $insert = true;
}

if(isset($dcc_date_transmission_ca)){
    $stm->bindParam(':date_transmission_ca',$dcc_date_transmission_ca);
    $insert = true;
}

if(isset($dcc_ref_commande_acces)){
    $stm->bindParam(':ref_commande_acces',$dcc_ref_commande_acces);
    $insert = true;
}

if(isset($dcc_go_ft)){
    $stm->bindParam(':go_ft',$dcc_go_ft);
    $insert = true;
}

if(isset($dcc_ok)){
    $stm->bindParam(':ok',$dcc_ok);
    $insert = true;
}

if(isset($dcc_date_debut_travaux_ft)){
    $stm->bindParam(':date_debut_travaux_ft',$dcc_date_debut_travaux_ft);
    $insert = true;
}

if(isset($dcc_date_fin_travaux_ft)){
    $stm->bindParam(':date_fin_travaux_ft',$dcc_date_fin_travaux_ft);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){

        $sousProjet = SousProjet::find($ids);//re-fetch sp
        if($sousProjet->is_master == 1) {
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->distributioncmdcdi == NULL && $sp->id_sous_projet != $sousProjet->id_sous_projet) {
                    $stm_create = $db->prepare("insert into sous_projet_distribution_commande_cdi (id_sous_projet) values ($sp->id_sous_projet)");
                    $stm_create->execute();
                }
            }
            $sousProjet = SousProjet::find($ids);//re-fetch sp
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->id_sous_projet !== $sousProjet->id_sous_projet) {
                    $sp->distributioncmdcdi->id_sous_projet = $sp->id_sous_projet;
                    foreach($fields as $field) {
                        $sp->distributioncmdcdi->{$field} = $sousProjet->distributioncmdcdi->{$field};
                    }
                    $sp->distributioncmdcdi->save();
                }
            }
        }
        
        if($mailaction_new
            &&
            (
                ($mailaction_entite ==null
                && isset($dcc_commandes_acces)
                && $dcc_commandes_acces == 2
                &&  isset($dcc_go_ft)
                && $dcc_go_ft == 2
                && isset($dcc_ok)
                && $dcc_ok == 1 )
            ||
                ($mailaction_entite!=null
                    && isset($dcc_commandes_acces)
                    && $dcc_commandes_acces == 2
                    &&  isset($dcc_go_ft)
                    && $dcc_go_ft == 2
                    && isset($dcc_ok)
                    && $dcc_ok == 1
                    &&
                    ($mailaction_entite->commandes_acces != $dcc_commandes_acces
                    || $mailaction_entite->go_ft != $dcc_go_ft
                    || $mailaction_entite->ok != $dcc_ok)
                )
            )
        ) {
            //envoi de mail
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Commande',4,'');
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];


            $mailaction_cc =return_list_mail_cc_notif($db,"distributioncmdcdi",4);
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
        }else if($mailaction_new && (( $mailaction_entite !=null && $mailaction_entite->intervenant_be  != $dcc_intervenant_be ) || ($dcc_intervenant_be!="" && $mailaction_entite==null))  ){
            $mailaction_email_sender = [];
            //envoi de maile

            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Commande',2,'');
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc  =return_list_mail_cc_notif_tache($db,$connectedProfil->email_utilisateur,2);
            $mailaction_to  =get_email_by_id($db,[$dcc_intervenant_be]);
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
        //setSousProjetUsers(SousProjet::find($ids));
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>