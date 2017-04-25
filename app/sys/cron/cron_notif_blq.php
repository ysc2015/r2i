<?php
/**
 * file: cron_notif_blq.php
 * User: fadil
 */
//include (__DIR__."/../../../inc/config.php");
ini_set('display_errors',1);
require_once __DIR__.'/../../sys/libs/vendor/autoload.php';
require_once __DIR__. "/../../sys/inc/config.php";
require_once __DIR__. "/../../sys/inc/utils.functions.php";
require_once __DIR__. "/../../sys/inc/mail.notifier.class.php";
require_once __DIR__. "/../../sys/inc/ssp.class.php";


$sql = "";
$stm = NULL;
$err =0;
$sql = "select * from blq_pbc where flag = 0";
$stm = $db->prepare($sql);
$chaine_pbc = "";
$mailaction_html = "";
if($stm->execute()){
    $message [] = "cron existe";
    $pbc_bloc = $stm->fetchAll();

    foreach($pbc_bloc as $pbc) {
        $chaine_pbc = "";
        if($pbc['id_ordre_de_travail']!=NULL){
            $sql_ot = "SELECT * FROM `blq_pbc` ,`ordre_de_travail`,`sous_projet` where ordre_de_travail.id_ordre_de_travail = blq_pbc.id_ordre_de_travail 
and blq_pbc.id_ordre_de_travail =:id_ordre_travail and ordre_de_travail.id_sous_projet = sous_projet.id_sous_projet";

            $stm_ot = $db->prepare($sql_ot);
            $stm_ot->bindParam(":id_ordre_travail",$pbc['id_ordre_de_travail']);
            $stm_ot->execute();

            if($stm_ot->rowCount()>0){
                $stm_ot = $stm_ot->fetch();
                 $sousProjet = SousProjet::first(
                    array('conditions' =>
                        array("id_sous_projet = ?", $stm_ot['id_sous_projet'])
                    )
                );
                $type = $pbc['type_question'];
                if($type=="1"){
                    $chaine_pbc .="<h2>Détail des questions</h2>";
                    $questionFieldName = "question";
                    $chaine_pbc .='<table>
                    <tr>
                    <td>Type</td><td><strong>'.$questionFieldName.'</strong></td>
                    </tr><tr>
                    <td>Snake</td><td>'.$pbc['snake'].'</td>
                    </tr><tr>
                    <td>Planche a3</td><td>'.$pbc['planche_a3'].'</td>
                    </tr><tr>
                    <td>chambre_amont</td><td>'.$pbc['chambre_amont'].'</td>
                    </tr><tr>
                    <td>Texte</td><td>'.$pbc['question_information'].'</td>
                    </tr><tr>
                    <td>Réponse</td><td>'.$pbc['reponse_ajustement'].'</td>
                    </tr><tr>
                    <td>Date</td><td>'.$pbc['date_action'].'</td>
                    </tr></table>';
                    $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'','',9,'');
                    $mailaction_object = $mailaction_html[1];
                    $mailaction_html =  $mailaction_html[0];
                    $mailaction_html .= $chaine_pbc;
                    $mailaction_to =return_list_entreprise_stt($db,NULL,$pbc['id_ordre_de_travail']);
                    $mailaction_cc =array_merge(return_list_mail_cc_notif($db,"",9),return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro),return_list_pci_du_nro($db,$sousProjet->projet->nro->id_nro),return_list_bei_du_nro($db,$sousProjet->projet->nro->id_nro)) ;
                    if($mailaction_html!="" and count($mailaction_to)>0){
                        if(MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)){
                        //if(true){
                            echo $mailaction_html.'<br />*****************<br />TO :';
                            print_r($mailaction_to) ;
                            echo '<br />*****************<br />CC :';
                            print_r($mailaction_cc) ;
                            echo '<br />*****************<br />';
                            $sql = "update blq_pbc set flag = 1";
                            $stm_maj_pbc = $db->prepare($sql);
                            $stm_maj_pbc->execute();
                        }
                    }else{
                        $message [] = "Liste mail entreprise est vide";
                        $err++;
                    }
                }
                elseif ($type=="2"){
                    $questionFieldName = "Réponse";
                    $chaine_pbc .="<h2>Détail des informations</h2>";
                    $chaine_pbc .='<table>
                    <tr>
                    <td>Type</td><td><strong>'.$questionFieldName.'</strong></td>
                    </tr><tr>
                    <td>Snake</td><td>'.$pbc['snake'].'</td>
                    </tr><tr>
                    <td>Planche a3</td><td>'.$pbc['planche_a3'].'</td>
                    </tr><tr>
                    <td>chambre_amont</td><td>'.$pbc['chambre_amont'].'</td>
                    </tr><tr>
                    <td>Texte</td><td>'.$pbc['question_information'].'</td>
                    </tr><tr>
                    <td>Réponse</td><td>'.$pbc['reponse_ajustement'].'</td>
                    </tr><tr>
                    <td>Date</td><td>'.$pbc['date_action'].'</td>
                    </tr></table>';
                    $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'','',10,'');
                    $mailaction_object = $mailaction_html[1];
                    $mailaction_html =  $mailaction_html[0];
                    $mailaction_html .= $chaine_pbc;
                    $mailaction_to = return_list_bei_du_nro($db,$sousProjet->projet->nro->id_nro);
                    $mailaction_cc = array_merge(return_list_mail_vpi_par_nro($db,$sousProjet->projet->nro->id_nro),return_list_pci_du_nro($db,$sousProjet->projet->nro->id_nro),return_list_entreprise_stt($db,NULL,$pbc['id_ordre_de_travail']),return_list_mail_cc_notif($db,"",10));
                    if($mailaction_html!="" and count($mailaction_to)>0){
                        if(MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)){
                        //if(true){


                            echo $mailaction_html.'<br />*****************<br />TO :';
                            print_r($mailaction_to) ;
                            echo '<br />*****************<br />CC :';
                            print_r($mailaction_cc) ;
                            echo '<br />*****************<br />';
                            $sql = "update blq_pbc set flag = 1";
                            $stm_maj_pbc = $db->prepare($sql);
                            $stm_maj_pbc->execute();
                        }
                    }else{
                        $message [] = "Liste BEI est vide";
                        $err++;
                    }
                }

            }
        }

    }





} else { echo "pas d'informations à envoyer ";
    $message [] = $stm->errorInfo();



}


echo json_encode(array("error" => $err , "message" => $message));