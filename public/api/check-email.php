<?php
/**
 * mail check if exists
 **/

require_once 'autoLoader.php';

$user = new User();

if( isset($_POST['userid']) && isset($_POST['email']) ) {
    $usr = $user->getUserById($_POST['userid']);
    if($usr['email'] == $_POST['email']) echo 'true';
    else {
        echo $user->emailExists($_POST['email']);
    }
} else {
    if( isset($_POST['email']) ) {
        $email = $_POST['email'];
        echo $user->emailExists($email);
    } else echo 'false';
}

