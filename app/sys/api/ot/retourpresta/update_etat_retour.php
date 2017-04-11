<?php
/**
 * file: update_etat_retour.php
 * User: rabii
 */

extract($_POST);

$sousProjet = NULL;

$err = 0;
$message = array();

if(isset($idsp) && !empty($idsp)){
    $sousProjet = SousProjet::find($idsp);
}

$tentree = array();

if($sousProjet !== NULL) {
    switch($idtot) {
        case "1" :
            $tentree[] = "transportaiguillage";
            break;
        case "2" :
            $tentree[] = "transporttirage";
            break;
        case "3" :
            $tentree[] = "transportraccordement";
            break;
        case "4" :
            $tentree[] = "transporttirage";
            $tentree[] = "transportraccordement";
            break;
        case "5" :
            $tentree[] = "distributionaiguillage";
            break;
        case "6" :
            $tentree[] = "distributiontirage";
            break;
        case "7" :
            $tentree[] = "distributionraccordement";
            break;
        case "8" :
            $tentree[] = "distributiontirage";
            $tentree[] = "distributionraccordement";
            break;
        case "9" :
            $tentree[] = "transportrecette";
            break;
        case "10" :
            $tentree[] = "distributionrecette";
            break;
        default :
            $err++;
            $message[] = "cet OT n'est pas natif ou erreur traitement !";
            break;
    }
} else {
    $err++;
    $message[] = "Erreur reférence sous projet";
}
$val_test = 2;
if($err == 0) {
    foreach($tentree as $key => $value) {
        if($sousProjet->{$value} !== NULL) {
            if($idtot == 9 || $idtot == 10){
                $sousProjet->{$value}->etat_recette = $val;//$val posted
                $val_test = 3;
            }else
                $sousProjet->{$value}->etat_retour = $val;


            $sousProjet->{$value}->save();
        }
    }
    if($val == $val_test ){

        //send mail
        $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'','',6,'',$typeot,$sousProjet->ville,'','','','','',$idsp);
        $mailaction_object = $mailaction_html[1];
        $mailaction_html =  $mailaction_html[0];
        $mailaction_cc = array_merge(return_list_mail_cc_notif($db,"",6),return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro));

        $mailaction_to =return_list_bei_du_nro($db,$sousProjet->projet->nro->id_nro);//à voir avec rabii

        $mailaction_to[] = "fadelghani@rc2k.fr";
        if(count($mailaction_to)>0){

            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
            //if(true){
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }else{
            $message[] = "Liste des BEI associés au NRO vide Mail non envoyé !";
            $err++;
        }

    }

    $message[] = "MAJ Réussite !";
}

echo json_encode(array("error" => $err, "message" => $message, "val" => $val));