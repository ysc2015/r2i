<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
include_once '../config.php';

$apis = [
    'chambre' => 'chambre',
    'troncon' => 'troncon',
    'upload' => 'upload',
    'photo' => 'photos',
    'photos' => 'photos',
];
$allApis = array(
    'chambre' => 'chambre.php',
    'troncon' => 'troncon.php',
    'upload' => 'upload.php',
    'photo' => 'photos.php',
    'photos' => 'photos.php',
    'point_bloquant' => 'point_bloquant_api.php',
);

$action = isset($_GET['action']) ? $_GET['action'] : '';
$api = $_GET['api'];

if(isset($allApis[$api])) {
    require_once $allApis[$api];
} else {
    if(file_exists($api . '.php')) {
        require_once $api . '.php';
    }
}