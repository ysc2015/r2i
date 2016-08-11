<?php
/**
 * file: tdesign_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$mailtemplatesfolder = __DIR__."/../templates/mails/";

$insert = false;
$err = 0;
$message = array();
$stm;

if(isset($ids) && !empty($ids)){
    $sousprojet_tdesign = SousProjetTransportDesign::first(array('conditions' => array("id_sous_projet = ?", $ids)));
    if($connectedProfil->id_utilisateur == $sousprojet_tdesign->valideur_bei) {
        $stm = $db->prepare("update sous_projet_transport_design set intervenant_be=:intervenant_be,valideur_bei=:valideur_bei,date_debut=:date_debut,date_ret_prevue=:date_ret_prevue,duree=:duree,lineaire_transport=:lineaire_transport,nb_zones=:nb_zones,ok=:ok where id_sous_projet=:id_sous_projet");
    } else {
        $stm = $db->prepare("update sous_projet_transport_design set intervenant_be=:intervenant_be,valideur_bei=:valideur_bei,date_debut=:date_debut,date_ret_prevue=:date_ret_prevue,duree=:duree,lineaire_transport=:lineaire_transport,nb_zones=:nb_zones where id_sous_projet=:id_sous_projet");
    }
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($td_intervenant_be) && !empty($td_intervenant_be)){
    if($td_intervenant_be !== $td_valideur_bei) {
        $stm->bindParam(':intervenant_be',$td_intervenant_be);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le valideur BEI doit étre différent de li'intervenant BE !";
    }
} else {
    $err++;
    $message[] = "Le champs Intervenant BE est obligatoire !";
}

if(isset($td_valideur_bei)){
    $stm->bindParam(':valideur_bei',$td_valideur_bei);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Valideur BEI est obligatoire !";
}

/*if(isset($td_date_debut) && !empty($td_date_debut)){
    $stm->bindParam(':date_debut',$td_date_debut);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date début est obligatoire !";
}

if(isset($td_date_ret_prevue) && !empty($td_date_ret_prevue)){
    $stm->bindParam(':date_ret_prevue',$td_date_ret_prevue);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour prévue est obligatoire !";
}*/

/*
 * dates debut
 */

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

/*
 * dates fin
 */

if(isset($td_duree) && !empty($td_duree)){
    $stm->bindParam(':duree',$td_duree);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Durée est obligatoire !";
}

if(isset($td_lineaire_transport) && !empty($td_lineaire_transport)){
    $stm->bindParam(':lineaire_transport',$td_lineaire_transport);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Linéaire transport est obligatoire !";
}

if(isset($td_nb_zones) && !empty($td_nb_zones)){
    $stm->bindParam(':nb_zones',$td_nb_zones);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Nombre de zones est obligatoire !";
}

if($connectedProfil->id_utilisateur == $sousprojet_tdesign->valideur_bei) {
    if(isset($td_ok)){
        $stm->bindParam(':ok',$td_ok);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs OK est obligatoire !";
    }
}

if($insert == true && $err == 0){
    $sousprojet_tdesign = SousProjetTransportDesign::first(array('conditions' => array("id_sous_projet = ?", $ids)));
    if($stm->execute()){
        $message [] = "Modification faite avec succès";

        if($connectedProfil->id_utilisateur == $sousprojet_tdesign->valideur_bei && $td_ok == 1 && ($td_ok !== "$sousprojet_tdesign->ok") ) {
            $sousprojet = SousProjet::first(array('conditions' => array("id_sous_projet = ?", $ids)));

            if($sousprojet !== NULL) {
                $projet = Projet::first(array('conditions' => array("id_projet = ?", $sousprojet->id_projet)));
            }
            //subject
            $subject = "[DESIGN CTR] ".($projet !== NULL ? $projet->code_site_origine : "n/a")."–NUMSOUSPROJET";

            //mail content
            ob_start();
            include $mailtemplatesfolder."design_validation.php";
            $content = ob_get_contents();
            ob_end_clean();

            //users to
            $receipients = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 5)));

            $to = array();
            //$to[] = "bitlord1980@gmail.com";

            foreach($receipients as $receipient) {
                $to[] = $receipient->email_utilisateur;
            }

            MailNotifier::sendMail($subject,$content,$to,array());
        }
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>