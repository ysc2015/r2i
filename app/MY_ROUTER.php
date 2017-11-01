<?php
/**
 * file: MY_ROUTER.php
 * User: rabii
 */

ini_set('display_errors',1);
set_time_limit(0);
include __DIR__ . "/sys/inc/session.php";

SessionManager::init();
$connectedProfil = array();

if(isset($_GET['tab_imei']) || isset($_GET['qgis'])){
    //SessionManager::login(array_map(function($a){ return ($a); }, explode('::',$_POST['r2i'])), false, function(){});
    require_once __DIR__ . '/sys/libs/vendor/autoload.php';
    require_once __DIR__ . "/sys/inc/config.php";
    require_once __DIR__."/sys/inc/user.roles.php";
    require_once __DIR__."/sys/language/fr/default.php";
    require_once __DIR__ . "/sys/inc/utils.functions.php";
    require_once __DIR__."/sys/inc/mail.notifier.class.php";
    require_once __DIR__."/sys/inc/ssp.class.php";
    require_once __DIR__."/sys/libs/vendor/EditableGrid/EditableGrid.php";
    require_once __DIR__."/sys/libs/vendor/qrcode/qrlib.php";

    include __DIR__ . "/sys/api/" . $_GET['script'];
    exit(0);
} else {
    SessionManager::check(function ($logged, $data) {
        global $connectedProfil;
        require_once __DIR__ . '/sys/libs/vendor/autoload.php';
        require_once __DIR__ . "/sys/inc/config.php";
        require_once __DIR__."/sys/inc/user.roles.php";
        require_once __DIR__."/sys/language/fr/default.php";
        require_once __DIR__ . "/sys/inc/utils.functions.php";
        require_once __DIR__."/sys/inc/mail.notifier.class.php";
        require_once __DIR__."/sys/inc/ssp.class.php";
        require_once __DIR__."/sys/libs/vendor/EditableGrid/EditableGrid.php";
        require_once __DIR__."/sys/libs/vendor/qrcode/qrlib.php";

        if ($logged) {

            $connectedProfil = Utilisateur::first(
                array('conditions' =>
                    array("MD5(email_utilisateur) = ? and MD5(pass_utilisateur) = ?", $data[0], $data[1])
                )
            );

            if ($connectedProfil) {
                $className = $connectedProfil->profil->shortlib;
                $connectedProfil = new $className($connectedProfil);
                include __DIR__ . "/sys/api/" . $_GET['script'];
                exit(0);
            }

        }

        echo json_encode(array(
            "data" => array()
        ));


    });
}


?>