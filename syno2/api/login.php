<?php

//password_verify ( string $password , string $hash )
error_reporting(E_ALL);
ini_set('display_errors', true);
$response = array('err' => 0, 'msg' => array(), 'extra' => null);

if (!isset($_POST['userName']) || empty($_POST['userName'])) {
    $response['err'] ++;
    $response['msg'][] = 'Empty User Name!';
}

if (!isset($_POST['password']) || empty($_POST['password'])) {
    $response['err'] ++;
    $response['msg'][] = 'Empty Password!';
}

if ($response['err'] > 0) {
    ResponseHelper::sendResponse(json_encode($response));
}


$_SESSION['user'] = array('LOGIN_ADMIN' => 'sadik');
$_SESSION['user']['syno'] = true;

$response['msg'][] = 'Login OKey';
ResponseHelper::sendResponse(json_encode($response));


