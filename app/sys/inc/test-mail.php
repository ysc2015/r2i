<?php
/**
 * Created by PhpStorm.
 * User: fadil
 * Date: 26/04/17
 * Time: 04:13 م
 */


require_once "../../MY_ROUTER.php";

if(MailNotifier::sendMail("my object","du text",["fadelghani@gmail.com","fadelghani@rc2k.fr"],array(),array(),"fadelghani@hotmail.com")) {
    //$message[] = "Mail envoyé !";
    echo "ENVOYé";
} else {
   // $message[] = "Mail non envoyé !";
   // $err++;
    echo "NON ENVOYE";
}

echo "alo";