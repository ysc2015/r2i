<?php
/**
 * file: commandefintravaux_save.php
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

$suffix = "cftrvx";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

$fields = array();

if($sousProjet !== NULL) {
    if($sousProjet->transportcmdfintravaux !== NULL) {
        $mailaction_entite = $sousProjet->transportcmdfintravaux;
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
        (isset($cftrvx_intervenant_be))? $fieldslist .=",date_attribution_be = :date_attribution_be": $fieldslist.="" ;

        $stm = $db->prepare("update sous_projet_transport_commande_fin_travaux set $fieldslist where id_sous_projet=:id_sous_projet");
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
        (isset($cftrvx_intervenant_be))? $fieldslist .=",date_attribution_be ": $fieldslist.="" ;
        (isset($cftrvx_intervenant_be))? $valueslist .=",:date_attribution_be ": $valueslist.="" ;

        $stm = $db->prepare("insert into sous_projet_transport_commande_fin_travaux ($fieldslist) values ($valueslist)");
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

if(isset($cftrvx_intervenant_be)){
    $stm->bindParam(':intervenant_be',$cftrvx_intervenant_be);
    $dt_attribution = date('Y-m-d');
    $stm->bindParam(':date_attribution_be',$dt_attribution);
    $insert = true;
}

if(isset($cftrvx_date_butoir)){
    $stm->bindParam(':date_butoir',$cftrvx_date_butoir);
    $insert = true;
}

if(isset($cftrvx_traitement_retour_terrain)){
    $stm->bindParam(':traitement_retour_terrain',$cftrvx_traitement_retour_terrain);
    $insert = true;
}

if(isset($cftrvx_modification_carto)){
    $stm->bindParam(':modification_carto',$cftrvx_modification_carto);
    $insert = true;
}

if(isset($cftrvx_commandes_fin_travaux)){
    $stm->bindParam(':commandes_fin_travaux',$cftrvx_commandes_fin_travaux);
    $insert = true;
}

if(isset($cftrvx_date_transmission_tfx)){
    $stm->bindParam(':date_transmission_tfx',$cftrvx_date_transmission_tfx);
    $insert = true;
}

if(isset($cftrvx_ref_commande_fin_travaux)){
    $stm->bindParam(':ref_commande_fin_travaux',$cftrvx_ref_commande_fin_travaux);
    $insert = true;
}

if(isset($cftrvx_go_ft)){
    $stm->bindParam(':go_ft',$cftrvx_go_ft);
    $insert = true;
}

if(isset($cftrvx_ok)){
    $stm->bindParam(':ok',$cftrvx_ok);
    $insert = true;
}

if(isset($cftrvx_date_debut_travaux_ft)){
    $stm->bindParam(':date_debut_travaux_ft',$cftrvx_date_debut_travaux_ft);
    $insert = true;
}

if(isset($cftrvx_date_fin_travaux_ft)){
    $stm->bindParam(':date_fin_travaux_ft',$cftrvx_date_fin_travaux_ft);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){

        $sousProjet = SousProjet::find($ids);//re-fetch sp
        if($sousProjet->is_master == 1) {
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->transportcmdfintravaux == NULL && $sp->id_sous_projet != $sousProjet->id_sous_projet) {
                    $stm_create = $db->prepare("insert into sous_projet_transport_commande_fin_travaux (id_sous_projet) values ($sp->id_sous_projet)");
                    $stm_create->execute();
                }
            }
            $sousProjet = SousProjet::find($ids);//re-fetch sp
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->id_sous_projet !== $sousProjet->id_sous_projet) {
                    $sp->transportcmdfintravaux->id_sous_projet = $sp->id_sous_projet;
                    foreach($fields as $field) {
                        $sp->transportcmdfintravaux->{$field} = $sousProjet->transportcmdfintravaux->{$field};
                    }
                    $sp->transportcmdfintravaux->save();
                }
            }
        }
        $message [] = "Enregistrement fait avec succès";

        //mail validation etape
        if($mailaction_new
            &&
            (
                (   $mailaction_entite==null
                    && isset($cftrvx_ok)
                    && $cftrvx_ok == 1
                )
                ||
                ( $mailaction_entite!=null
                    && isset($cftrvx_ok)
                    && $cftrvx_ok == 1
                    && $mailaction_entite->ok != $cftrvx_ok
                )
            )
        ) {
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','cmdfintravaux',7,'','','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif($db,"transportcmdfintravaux",7);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc,$connectedProfil->email_utilisateur)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>