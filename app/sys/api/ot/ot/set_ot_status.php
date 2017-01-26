<?php
/**
 * file: set_ot_status.php
 * User: rabii
 */

extract($_POST);

$err=0;
$message = array();
$stm = NULL;

$b720 = 0;
$b432 = 0;
$b288 = 0;
$b144 = 0;
$b48 = 0;

$c720 = 0;
$c432 = 0;
$c288 = 0;
$c144 = 0;
$c48 = 0;

$nberchambre = 0 ;
$totallineaire = 0 ;

$sql = "";

$ot = NULL;

if(isset($status) && !empty($status) && isset($idot) && !empty($idot)) {
    $stm = $db->prepare("update ordre_de_travail set id_etat_ot = $status where id_ordre_de_travail=$idot");
} else {
    $err++;
    $message[] = "Paramétres de MAJ statut OT incorrects !";
}

if($err==0) {
    if($stm->execute()) {
        $message[] = "MAJ réussite !";

        if($status == 3 || $status == 5) {

            /**
             * maj etapes fields
             */
            $ot = OrdreDeTravail::first(
                array('conditions' =>
                    array("id_ordre_de_travail = ?", $idot)
                )
            );

            $tentree = array();

            $sousProjet = SousProjet::first(
                array('conditions' =>
                    array("id_sous_projet = ?", $ot->id_sous_projet)
                )
            );

            if($sousProjet !== NULL) {
                switch($ot->id_type_ordre_travail) {
                    case "1" :
                        $tentree[] = array("transportaiguillage","date_aiguillage");//(step,begin step date field):end field is the same for all steps
                        break;
                    case "2" :
                        $tentree[] = array("transporttirage","date_tirage");
                        break;
                    case "3" :
                        $tentree[] = array("transportraccordement","date_racco");
                        break;
                    case "4" :
                        $tentree[] = array("transporttirage","date_tirage");
                        $tentree[] = array("transportraccordement","date_racco");
                        break;
                    case "5" :
                        $tentree[] = array("distributionaiguillage","date_aiguillage");
                        break;
                    case "6" :
                        $tentree[] = array("distributiontirage","date_tirage");
                        break;
                    case "7" :
                        $tentree[] = array("distributionraccordement","date_racco");
                        break;
                    case "8" :
                        $tentree[] = array("distributiontirage","date_tirage");
                        $tentree[] = array("distributionraccordement","date_racco");
                        break;
                    case "9" :
                        $tentree[] = array("transportrecette","date_recette");
                        break;
                    case "10" :
                        $tentree[] = array("distributionrecette","date_recette");
                        break;
                    default :
                        break;
                }

                foreach($tentree as $key => $value) {
                    if($sousProjet->{$value[0]} == NULL) {
                        switch($value[0]) {
                            case "transportaiguillage" :
                                $step = new SousProjetTransportAiguillage(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                break;
                            case "transporttirage" :
                                $step = new SousProjetTransportTirage(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                break;
                            case "transportraccordement" :
                                $step = new SousProjetTransportRaccordement(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                break;
                            case "distributionaiguillage" :
                                $step = new SousProjetDistributionAiguillage(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                break;
                            case "distributiontirage" :
                                $step = new SousProjetDistributionTirage(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                break;
                            case "distributionraccordement" :
                                $step = new SousProjetDistributionRaccordement(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                break;
                            case "transportrecette" :
                                $step = new SousProjetTransportRecette(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                break;
                            case "distributionrecette" :
                                $step = new SousProjetDistributionRecette(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                break;
                            default : break;
                        }
                    }else{
                        if($value[0] == "transportaiguillage" || $value[0] == "transporttirage" || $value[0] == "distributionaiguillage" || $value[0] == "distributiontirage" ){
                            $sql = "select ch.* from chambre as ch,ressource as res, ordre_de_travail as ot  where ch.id_ressource = res.id_ressource and res.id_ordre_de_travail = ot.id_ordre_de_travail and ot.id_ordre_de_travail =  $idot";
                            $chstmt = $db->prepare($sql);
                            if($chstmt->execute()) {
                                $nberchambre = $chstmt->rowCount();
                            }
                            //print_r($countchambre);
                            switch ($value[0]){
                                case "transportaiguillage" :
                                    $b720 = $sousProjet->{$value[0]}->lineaire5;
                                    $b432 = $sousProjet->{$value[0]}->lineaire6;
                                    $b288 = $sousProjet->{$value[0]}->lineaire7;
                                    $b144 = $sousProjet->{$value[0]}->lineaire8;
                                    $b48 = 0;
                                    $c720 = $sousProjet->{$value[0]}->lineaire1;
                                    $c432 = $sousProjet->{$value[0]}->lineaire2;
                                    $c288 = $sousProjet->{$value[0]}->lineaire3;
                                    $c144 = $sousProjet->{$value[0]}->lineaire4;
                                    $c48 = 0;
                                    break;
                                case "transporttirage" :
                                    $b720 = $sousProjet->{$value[0]}->lineaire5;
                                    $b432 = $sousProjet->{$value[0]}->lineaire6;
                                    $b288 = $sousProjet->{$value[0]}->lineaire7;
                                    $b144 = $sousProjet->{$value[0]}->lineaire8;
                                    $b48 = 0;
                                    $c720 = $sousProjet->{$value[0]}->lineaire1;
                                    $c432 = $sousProjet->{$value[0]}->lineaire2;
                                    $c288 = $sousProjet->{$value[0]}->lineaire3;
                                    $c144 = $sousProjet->{$value[0]}->lineaire4;
                                    $c48 = 0;
                                    break;
                                case "transportraccordement" :
                                    break;
                                case "distributionaiguillage" :
                                    $b288 = $sousProjet->{$value[0]}->lineaire5;
                                    $b144 = $sousProjet->{$value[0]}->lineaire6;
                                    $b48 = $sousProjet->{$value[0]}->lineaire8;
                                    $c720 = 0;
                                    $c432 = 0;
                                    $c288 = $sousProjet->{$value[0]}->lineaire1;
                                    $c144 = $sousProjet->{$value[0]}->lineaire2;
                                    $c48 = $sousProjet->{$value[0]}->lineaire4;
                                    break;
                                case "distributiontirage" :
                                    $b288 = $sousProjet->{$value[0]}->lineaire5;
                                    $b144 = $sousProjet->{$value[0]}->lineaire6;
                                    $b48 = $sousProjet->{$value[0]}->lineaire8;
                                    $c720 = 0;
                                    $c432 = 0;
                                    $c288 = $sousProjet->{$value[0]}->lineaire1;
                                    $c144 = $sousProjet->{$value[0]}->lineaire2;
                                    $c48 = $sousProjet->{$value[0]}->lineaire4;
                                    break;
                                case "distributionraccordement" :
                                    break;
                                case "transportrecette" :
                                    break;
                                case "distributionrecette" :
                                    break;
                                default : break;

                            }
                        }


                    }

                    if($status == 3) {
                        $boite = array($b720,$b432,$b288,$b144,$b48);
                        $chambre = array($c720,$c432,$c288,$c144,$c48);
                        //svn
                        $sousProjet->{$value[0]}->date_transmission_plans = date('Y-m-d');
                        //envoi de mail
                        $totallineaire = $c720 + $c432 + $c144 + $c48 ;

                        $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'','',3,'',$ot->type_ot,$ot->sousprojet->ville,$boite,$chambre,$nberchambre,$totallineaire);
                        $mailaction_object = $mailaction_html[1];
                        $mailaction_html =  $mailaction_html[0];
                        $mailaction_to = return_list_mail_vpi_par_nro_ot($db, $sousProjet->projet->id_nro,$ot->id_equipe_stt, $ot->id_entreprise);
                        //print_r(return_list_mail_vpi_par_nro_ot($db, $sousProjet->projet->id_nro));

                        $mailaction_cc = return_list_mail_cc_notif($db,null,3,$ot->id_equipe_stt);
                        $mailaction_cc[] = $connectedProfil->email_utilisateur;

                        if(count($mailaction_to)) {
                            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                             $message[] = "Mail envoyé !";
                            } else {
                                $message[] = "Mail non envoyé !";
                                $err++;
                            }
                        } else {
                            $message[] = "Aucun VPI associé à ce sous projet (OT) !";
                            $message[] = "Mail non envoyé !";
                            $err++;
                        }
                    } else {
                        $sousProjet->{$value[0]}->controle_demarrage_effectif = $status;
                    }
                    $sousProjet->{$value[0]}->save();

                }
            }

            /**
             * end maj etapes fields
             */
        }
    }
} else {
    $err++;
    $message[] = $stm->errorInfo();
}

echo json_encode(array("error" => $err , "message" => $message ));

