<?php
/**
 * file: config.php
 * User: rabii
 */

$server = "localhost";
$db_name = "r2i";
$user = ($_SERVER['SERVER_NAME'] == "localhost") ? "root" : "r2i";;
$password = ($_SERVER['SERVER_NAME'] == "localhost") ? "" : "r2i";

try {
    $db = new PDO("mysql:host=$server;dbname=$db_name", $user, $password,array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch(Exception $e) {
    die($e->getMessage());
}

if(class_exists("ActiveRecord\Config")){

    ActiveRecord\Config::initialize(function($cfg) use ($server,$db_name,$user,$password)
    {
        $cfg->set_model_directory(__DIR__."/../models");
        $cfg->set_connections(array(
            'development' => "mysql://$user:$password@$server/$db_name?charset=utf8"));
    });

    ActiveRecord\DateTime::$DEFAULT_FORMAT = 'Y-m-d';

}

?>