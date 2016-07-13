<?php
/**
 * file: MY_ROUTER.php
 * User: rabii
 */

ini_set('display_errors',1);
include __DIR__ . "/sys/inc/session.php";

SessionManager::init();
$connectedProfil = array();
SessionManager::check(function ($logged, $data) {
    global $connectedProfil;
    require_once __DIR__ . '/sys/php-activerecord/ActiveRecord.php';
    require_once __DIR__ . "/sys/inc/config.php";
    if ($logged) {

        $connectedProfil = Utilisateur::first(
            array('conditions' =>
                array("MD5(email_utilisateur) = ? and MD5(pass_utilisateur) = ?", $data[0], $data[1])
            )
        );

        if ($connectedProfil) {
            include __DIR__ . "/sys/api/" . $_GET['script'];
            exit(0);
        }

    }

    echo json_encode(array(
        "data" => array()
    ));


});

?>