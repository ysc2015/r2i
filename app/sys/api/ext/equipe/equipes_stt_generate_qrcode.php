<?php
/**
 * file: equipes_stt_generate_qrcode.php
 * User: fadil
 */



$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'qrcode_equipe'.DIRECTORY_SEPARATOR;
$PNG_WEB_DIR = 'qrcode_equipe/';
require_once __DIR__."/../../../../sys/libs/vendor/qrcode/qrlib.php";

if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);

$filename = $PNG_TEMP_DIR.'test.png';

$matrixPointSize = 6;
$errorCorrectionLevel = 'L';

QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);



echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" />';


//echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_equipe_stt",$columns,$condition,""));