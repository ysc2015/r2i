<?php
/**
 * Created by PhpStorm.
 * User: fadil
 * Date: 26/04/17
 * Time: 04:13 م
 */



require_once "mail.notifier.class.php";

if(@MailNotifier::sendMail("my object","du text",["fadelghani@gmail.com","fadelghani@rc2k.fr"],array(),array(),"fadelghani@hotmail.com")) {
    $message[] = "Mail envoyé !";
} else {
    $message[] = "Mail non envoyé !";
    $err++;
}

