<?php
/**
 * file: myot_upload_retour.php
 * User: rabii
 */

ini_set("display_errors",'1');
//sleep(2);

$output_dir = __DIR__."/../../uploads/sousprojets/";
extract($_POST);

$ret = array();

$ok = false;

$mailaction_new = false ;
$mailaction_object = "";
$mailaction_html = "";
$mailaction_html_message = "";
$mailaction_etape = "";
$mailaction_phase= "";
$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (id_sous_projet,id_ordre_de_travail,id_type_ordre_travail,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_sous_projet,:id_ordre_de_travail,:id_type_ordre_travail,'stt_retour_terrain',:nom_fichier,:nom_fichier_disque,'sousprojets',:date_creation)");

if(isset($idot) && !empty($idot)) {
    $stm->bindParam(':id_ordre_de_travail',$idot);
    $stm->bindParam(':id_sous_projet',$idsp);
    $stm->bindParam(':id_type_ordre_travail',$idtot);
    if (isset($_FILES["myfile"])) {
        $error = $_FILES["myfile"]["error"];
        if (!is_array($_FILES["myfile"]["name"])) {

            $fileName = time() . "_" . $_FILES["myfile"]["name"];

            $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
            $stm->bindParam(':nom_fichier_disque',$fileName);
            $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

            if($stm->execute()) {
                $ok = true;
                $details = array();
                $details['name'] = $db->lastInsertId()."_".time() . "_" . $_FILES["myfile"]["name"];
                $details['id'] = $db->lastInsertId();

                $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$details:[]);
            }

        } else  {
            $fileCount = count($_FILES["myfile"]["name"]);
            for ($i = 0; $i < $fileCount; $i++) {

                $fileName = time() . "_" . $_FILES["myfile"]["name"][$i];

                $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
                $stm->bindParam(':nom_fichier_disque',$fileName);
                $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

                if($stm->execute()) {
                    $ok = true;
                    $details = array();
                    $details['name'] = $db->lastInsertId()."_".time() . "_" . $_FILES["myfile"]["name"];
                    $details['id'] = $db->lastInsertId();

                    $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$details:[]);
                }
            }
        }

        if($ok) {
            /**
             * maj etapes fields
             */

            $tentree = array();

            $sousProjet = SousProjet::first(
                array('conditions' =>
                    array("id_sous_projet = ?", $idsp)
                )
            );

            if($sousProjet !== NULL) {
                switch($idtot) {
                    case "1" :
                        $tentree[] = array("transportaiguillage","date_aiguillage");//(step,begin step date field):end field is the same for all steps
                        $mailaction_new = true;
                        $mailaction_object = "[R2i] Retour OT Aiguillage Réalisé par le STT ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;
                        $mailaction_html_message = "<p>Le STT « ". $connectedProfil->profil->entreprise->nom." » vient de réaliser le retour aiguillage du CTR de : 
                        <h5> ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone." </h5></p>";
                        break;
                    case "2" :
                        $tentree[] = array("transporttirage","date_tirage");
                        $mailaction_new = true;
                        $mailaction_object = "[R2i] Retour OT Tirage Réalisé par le STT ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;
                        $mailaction_html_message = "<p>Le STT « ". $connectedProfil->profil->entreprise->nom." » vient de réaliser le retour tirage du CTR de : 
                        <h5> ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone." </h5></p>";
                        break;
                    case "3" :
                        $tentree[] = array("transportraccordement","date_racco");
                        $mailaction_new = true;
                        $mailaction_object = "[R2i] Retour OT Raccordement Réalisé par le STT ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;
                        $mailaction_html_message = "<p>Le STT « ". $connectedProfil->profil->entreprise->nom." » vient de réaliser le retour raccordement du CTR de : 
                        <h5> ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone." </h5></p>";
                        break;
                    case "4" :
                        $tentree[] = array("transporttirage","date_tirage");
                        $tentree[] = array("transportraccordement","date_racco");
                        break;
                    case "5" :
                        $tentree[] = array("distributionaiguillage","date_aiguillage");
                        $mailaction_new = true;
                        $mailaction_object = "[R2i] Retour OT Aiguillage Réalisé par le STT  ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;
                        $mailaction_html_message = "<p>Le STT « ". $connectedProfil->profil->entreprise->nom." » vient de réaliser le retour aiguillage du CDI de : 
                        <h5> ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone." </h5></p>";
                        break;
                    case "6" :
                        $tentree[] = array("distributiontirage","date_tirage");
                        $mailaction_new = true;
                        $mailaction_object = "[R2i] Retour OT Tirage Réalisé par le STT ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;
                        $mailaction_html_message = "<p>Le STT « ". $connectedProfil->profil->entreprise->nom." » vient de réaliser le retour tirage du CDI de : 
                        <h5> ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone." </h5></p>";
                        break;
                    case "7" :
                        $tentree[] = array("distributionraccordement","date_racco");
                        $mailaction_new = true;
                        $mailaction_object = "[R2i] Retour OT Raccordement Réalisé par le STT ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;
                        $mailaction_html_message = "<p>Le STT « ". $connectedProfil->profil->entreprise->nom." » vient de réaliser le retour raccordement du CDI de : 
                        <h5> ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone." </h5></p>";
                        break;
                    case "8" :
                        $tentree[] = array("distributiontirage","date_tirage");
                        $tentree[] = array("distributionraccordement","date_racco");
                        break;
                    case "9" :
                        $tentree[] = array("transportrecette","date_recette");
                        $mailaction_new = true;
                        $mailaction_object = "[R2i] Retour OT Recette Réalisé par le STT ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;
                        $mailaction_html_message = "<p>Le STT « ". $connectedProfil->profil->entreprise->nom." » vient de réaliser le retour recette du CTR de : 
                        <h5> ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone." </h5></p>";

                        break;
                    case "10" :
                        $tentree[] = array("distributionrecette","date_recette");
                        $mailaction_new = true;
                        $mailaction_object = "[R2i] Retour OT Recette Réalisé par le STT ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone;
                        $mailaction_html_message = "<p>Le STT « ". $connectedProfil->profil->entreprise->nom." » vient de réaliser le retour recette du CDI de  : 
                        <h5> ".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone." </h5></p>";
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
                                $mailaction_etape = "transportaiguillage";
                                $mailaction_phase = "CRT";
                                break;
                            case "transporttirage" :
                                $step = new SousProjetTransportTirage(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                $mailaction_etape = "transporttirage";
                                $mailaction_phase = "CRT";
                                break;
                            case "transportraccordement" :
                                $step = new SousProjetTransportRaccordement(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                $mailaction_etape = "transportraccordement";
                                $mailaction_phase = "CRT";
                                break;
                            case "distributionaiguillage" :
                                $step = new SousProjetDistributionAiguillage(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                $mailaction_etape = "distributionaiguillage";
                                $mailaction_phase = "CDI";
                                break;
                            case "distributiontirage" :
                                $step = new SousProjetDistributionTirage(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                $mailaction_etape = "distributiontirage";
                                $mailaction_phase = "CDI";
                                break;
                            case "distributionraccordement" :
                                $step = new SousProjetDistributionRaccordement(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                $mailaction_etape = "distributionraccordement";
                                $mailaction_phase = "CDI";
                                break;
                            case "transportrecette" :
                                $step = new SousProjetTransportRecette(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                $mailaction_etape= "transportrecette";
                                $mailaction_phase = "CRT";
                                break;
                            case "distributionrecette" :
                                $step = new SousProjetDistributionRecette(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                $mailaction_etape = "distributionrecette";
                                $mailaction_phase = "CDI";
                                break;
                            default : break;
                        }
                    }

                    $sousProjet->{$value[0]}->date_retour = date('Y-m-d');
                    $sousProjet->{$value[0]}->save();

                }
            }

            /**
             * end maj etapes fields
             */

             if($mailaction_new){
                 $mailaction_nom_entreprise = $connectedProfil->profil->entreprise->nom;
                 $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,$mailaction_phase,$mailaction_etape,5,$mailaction_nom_entreprise);
                 $mailaction_object = $mailaction_html[1];
                 $mailaction_html =  $mailaction_html[0];


                 $mailaction_cc =return_list_mail_cc_notif($db,"upload_retour",5);
                 $mailaction_to =return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro);
                 if(MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                     $message[] = "Mail envoyé !";
                 } else {
                     $message[] = "Mail non envoyé !";
                     $err++;
                 }
             }
        }
    }
}

echo json_encode($ret);//svn