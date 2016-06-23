<?php
/**
 * file: init.php
 * User: rabii
 *
 */

ini_set("display_errors","1");

require_once __DIR__."/../../php-activerecord/ActiveRecord.php";

include __DIR__."/../../inc/config.php";

include __DIR__."/../../inc/session.php";

include __DIR__."/../../inc/user.roles.php";

SessionManager::init();

$connectedProfil = NULL;

SessionManager::check(function($logged, $data) {
    if($logged){

        global $connectedProfil;

        $connectedProfil = Utilisateur::first(
            array('conditions' =>
                array("MD5(email_utilisateur) = ? and MD5(pass_utilisateur) = ?", $data[0], $data[1])
            )
        );

        //var_dump($connectedProfil);

        if(!($connectedProfil)){

            SessionManager::logout(function(){});
            header("location: login.php");
            exit();
        }

    } else {

        header("location: login.php");
        exit(0);

    }
});

switch ($connectedProfil->profil->lib_profil_utilisateur) {
    case 'Administrateur':
        $connectedProfil = new Administrateur($connectedProfil);
        break;

    case 'Agent STT':
        $connectedProfil = new STTUser($connectedProfil);
        break;

    case 'Chef de projet':
        $connectedProfil = new CDPUser($connectedProfil);
        break;

    default:
        $connectedProfil = new baseUser($connectedProfil);
        break;
}

