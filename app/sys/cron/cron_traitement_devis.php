<?php
/**
 * file: cron_traitement_devis.php
 * User: fadil
 */
//include (__DIR__."/../../../inc/config.php");
set_time_limit(0);
ini_set('display_errors',1);

require_once __DIR__ . '/../../sys/libs/vendor/autoload.php';
require_once __DIR__ . "/../../sys/inc/config.php";
require_once __DIR__."/../../sys/inc/user.roles.php";
require_once __DIR__."/../../sys/language/fr/default.php";
require_once __DIR__ . "/../../sys/inc/utils.functions.php";
require_once __DIR__."/../../sys/inc/mail.notifier.class.php";
require_once __DIR__."/../../sys/inc/ssp.class.php";


$sql = "";
$stm = NULL;
$err =0;
$sql = "select * from etat_traitement_devis where etat = 1  order by date_action DESC ";
$stm = $db->prepare($sql);


if($stm->execute()){
    $message [] = "cron existe";
    $devis_traiter = $stm->fetchAll();
    $Profil_execute = null;
    foreach($devis_traiter as $traitement) {

        $Profil_execute = Utilisateur::first(
            array('conditions' =>
                array("id_utilisateur = ?", $traitement['id_user'])
            )
        );

        

        $connectedProfil = new $Profil_execute->profil->shortlib($Profil_execute);

        //var_dump($connectedProfil);
        
        //echo $Profil_execute->nom_utilisateur."##".$Profil_execute->prenom_utilisateur;
         loadExcelDEF_CABLE($db,$traitement['nom_fichier'],$traitement['id_ressource'],$traitement['id_ordre_traivail'],$connectedProfil);
        loadExcelDEF_BPE_EBM($db,$traitement['nom_fichier'],$traitement['id_ressource']);
    }





} else { echo "pas d'informations à envoyer ";
    $message [] = $stm->errorInfo();



}


echo json_encode(array("error" => $err , "message" => $message));