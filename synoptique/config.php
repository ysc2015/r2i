<?php
$local = true;
if($local) {
    $server = 'localhost';
    $db_name = 'r2i';
    $user_name = 'root';
    $user_password = '';
} else {
    $server = 'localhost';
    $db_name = 'r2i';
    $user_name = 'r2i';
    $user_password = 'r2i';
}



$user_name = ($_SERVER['SERVER_NAME'] == "localhost") ? "root" : "r2i";
$user_password = ($_SERVER['SERVER_NAME'] == "localhost") ? (stripos($_SERVER['SERVER_SOFTWARE'],"ubuntu") !== false ? "freefree" : "") : "r2i";

$table_prefix = "syno_";
$pdo = null;
try {
    $pdo = new PDO("mysql:host=$server;dbname=$db_name", $user_name, $user_password,array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch(Exception $e) {
    die($e->getMessage());
}

function fetchAll(PDO $pdo,$query) {
    $stm = $pdo->prepare($query);
    $stm->execute();
    return $stm->fetchAll();
}

/*$conx = mysqli_connect($server,$user_name, $user_password, $db_name);

function fetchAll($rs) {
    $ret = [];

    while($row = mysqli_fetch_array($rs)) {
        $ret[] = $row;
    }
    return $ret;
}*/


