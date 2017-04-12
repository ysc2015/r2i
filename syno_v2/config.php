<?php
session_start();
error_reporting(E_ALL);
if(!isset($gen)) {
    include_once 'lang/en.php';
}

$local = false;
if ($local) {
    $server = "localhost";
    $db_name = "r2i";
    $user_name = "root";
    $user_password = "";
} else {
    $server = 'localhost';
    $db_name = 'r2i';
    $user_name = 'r2i';
    $user_password = 'r2i';
}

$table_prefix = "syno_";

define('CLASS_FOLDER', __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('ASSETS', ROOT . 'assets' . DIRECTORY_SEPARATOR);
define('API_FOLDER', ROOT . 'api' . DIRECTORY_SEPARATOR);

$pdo = new PDO("mysql:host=$server;dbname=$db_name", $user_name, $user_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

function __autoload($className) {    
    if (file_exists(CLASS_FOLDER . $className . '.php')) {
        require_once CLASS_FOLDER . $className . '.php';
    }
}

include_once 'functions.php';
Configuration::$db = $pdo;


