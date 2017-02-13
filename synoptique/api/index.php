<?php

require_once '../config.php';

function __autoload($className) {
    if(file_exists($className . '.php')) {
        include_once $className . '.php';
        return;
    }

    $className = strtolower($className);

    if(file_exists($className . '.php')) {
        include_once $className . '.php';
    }
}

$apis = [
    'chambre' => 'chambre',
    'troncon' => 'troncon',
    'upload' => 'upload',
    'photo' => 'photos',
    'photos' => 'photos',
];

$action = isset($_GET['action']) ? $_GET['action'] : '';
$api = $_GET['api'];

if(isset($apis[$api])) {
    include_once $apis[$api] . '.php';
}