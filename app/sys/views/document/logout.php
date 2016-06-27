<?php
ini_set('display_errors',1);
/**
 * file: logout.php
 * User: rabii
 */

include __DIR__."/../../inc/session.php";

SessionManager::init();

SessionManager::logout(function(){
    header("location: index.php");
});


?>