<?php
/**
 * file: cron_traitement_devis.php
 * User: fadil
 * traiter les pds valider avec leur OT il check si un cron est deja demarré avant de commencer la tache
 */
set_time_limit(0);
ini_set('display_errors',1);

require_once __DIR__ . '/../../sys/libs/vendor/autoload.php';
require_once __DIR__ . "/../../sys/inc/config.php";
require_once __DIR__."/../../sys/inc/user.roles.php";
require_once __DIR__."/../../sys/language/fr/default.php";
require_once __DIR__ . "/../../sys/inc/utils.functions.php";
require_once __DIR__."/../../sys/inc/mail.notifier.class.php";
require_once __DIR__."/../../sys/inc/ssp.class.php";

$message =[];
$err =0;
$sql_commence_traitement = "SELECT * FROM `cron_etat_traitement_devis` where id = 1";

$stm_commence_traitement = $db->prepare($sql_commence_traitement);
$stm_commence_traitement->execute();
$commence_traitement = $stm_commence_traitement->fetch();
if($commence_traitement['etat']=='OFF'){
    $sql = "";
    $stm = NULL;
    $sql = "select * from etat_traitement_devis where etat = 1  order by date_action DESC ";
    $stm = $db->prepare($sql);

    if($stm->execute()){
        $message [] = "cron existe";
        $devis_traiter = $stm->fetchAll();
        $Profil_execute = null;
        $stm_change_statut_cron = $db->prepare("update cron_etat_traitement_devis set etat = 'ON' where id = 1");
        $stm_change_statut_cron->execute();
        foreach($devis_traiter as $traitement) {

            $Profil_execute = Utilisateur::first(
                array('conditions' =>
                    array("id_utilisateur = ?", $traitement['id_user'])
                )
            );
            $connectedProfil = new $Profil_execute->profil->shortlib($Profil_execute);
            loadExcelDEF_CABLE($db,$traitement['nom_fichier'],$traitement['id_ressource'],$traitement['id_ordre_traivail'],$connectedProfil);
            loadExcelDEF_BPE_EBM($db,$traitement['nom_fichier'],$traitement['id_ressource']);
        }
        $stm_change_statut_cron = $db->prepare("update cron_etat_traitement_devis set etat = 'OFF' where id = 1");
        $stm_change_statut_cron->execute();

    } else { echo "pas d'informations à envoyer ";
        $message [] = $stm->errorInfo();



    }

}


echo json_encode(array("error" => $err , "message" => $message));