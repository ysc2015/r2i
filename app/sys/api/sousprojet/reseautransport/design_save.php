<?php
/**
 * file: design_save.php
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

$suffix = "td";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

$fields = array();

if($sousProjet !== NULL) {
    if($sousProjet->transportdesign !== NULL) {
        $mailaction_entite = $sousProjet->transportdesign;
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

        $stm = $db->prepare("update sous_projet_transport_design set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_transport_design ($fieldslist) values ($valueslist)");
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

if(isset($td_intervenant_be)){
    if(!empty($td_intervenant_be)){
        if($td_intervenant_be !== $td_valideur_bei) {
            $stm->bindParam(':intervenant_be',$td_intervenant_be);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le valideur BEI doit étre différent de li'intervenant BE !";
        }
    } else {
        $stm->bindParam(':intervenant_be',$td_intervenant_be);
        $insert = true;
    }
}

if(isset($td_valideur_bei)){
    $stm->bindParam(':valideur_bei',$td_valideur_bei);
    $insert = true;
}

/*
 * dates debut
 */

if(isset($td_date_debut) && isset($td_date_ret_prevue)) {
    $dd = DateTime::createFromFormat('Y-m-d', $td_date_debut);
    $df = DateTime::createFromFormat('Y-m-d', $td_date_ret_prevue);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la date de retour prévue doit étre superieure à la date de début !";
    } else  {

        if(isset($td_date_debut)){
            $stm->bindParam(':date_debut',$td_date_debut);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs Date de début est obligatoire !";
        }

        if(isset($td_date_ret_prevue)){
            $stm->bindParam(':date_ret_prevue',$td_date_ret_prevue);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs Date retour prévue est obligatoire !";
        }
    }
}

/*
 * dates fin
 */

if(isset($td_lineaire_transport)){
    $stm->bindParam(':lineaire_transport',$td_lineaire_transport);
    $insert = true;
}

if(isset($td_nb_zones)){
    $stm->bindParam(':nb_zones',$td_nb_zones);
    $insert = true;
}

if(isset($td_ok)){
    $stm->bindParam(':ok',$td_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    $duree = getDuree($td_date_debut,$td_date_ret_prevue);
    $stm->bindParam(':duree',$duree);
    if($stm->execute()){

        $sousProjet = SousProjet::find($ids);//re-fetch sp
        if($sousProjet->is_master == 1) {
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->transportdesign == NULL && $sp->id_sous_projet != $sousProjet->id_sous_projet) {
                    $stm_create = $db->prepare("insert into sous_projet_transport_design (id_sous_projet) values ($sp->id_sous_projet)");
                    $stm_create->execute();
                }
            }
            $sousProjet = SousProjet::find($ids);//re-fetch sp
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->id_sous_projet !== $sousProjet->id_sous_projet) {
                    $sp->transportdesign->id_sous_projet = $sp->id_sous_projet;
                    foreach($fields as $field) {
                        $sp->transportdesign->{$field} = $sousProjet->transportdesign->{$field};
                    }
                    $sp->transportdesign->save();
                }
            }
        }
        $message [] = "Enregistrement fait avec succès";
        //mail validation etape
        if($mailaction_new
            &&
            (
                (   $mailaction_entite==null
                    && isset($td_ok)
                    && $td_ok == 1
                )
                ||
                ( $mailaction_entite!=null
                    && isset($td_ok)
                    && $td_ok == 1
                    && $mailaction_entite->ok != $td_ok
                )
            )
        ) {
            $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CTR','design',7,'','','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
            $mailaction_object = $mailaction_html[1];
            $mailaction_html =  $mailaction_html[0];

            $mailaction_cc =return_list_mail_cc_notif($db,"transportdesign",7);
            $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);


            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
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

echo json_encode(array("error" => $err , "message" => $message , "duree" => $duree));
?>