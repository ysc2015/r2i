<?php
/**
 * file: config.php
 * User: rabii
 */

$server = "localhost";
$db_name = "r2i_dump_prod";
$user = ($_SERVER['SERVER_NAME'] == "localhost") ? "root" : "r2i";;
$password = ($_SERVER['SERVER_NAME'] == "localhost") ? "root" : "r2i";

define('OSA_SERVER',"https://osa.free-infra.vlq16.iliad.fr");
//https://gbts.free-infra.vlq16.iliad.fr/curl_dedibox/get_fci_data.php
define('CMD_STRUC_URL',"http://sd-83414.dedibox.fr/r2i/app/sys/api/todelete/curl_test.php");

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