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


$matrixPointSize = 6;
$errorCorrectionLevel = 'L';


$equipestt_stm = $db->prepare("SELECT t1.* from equipe_stt as t1
                        where t1.id_equipe_types IN (SELECT equipe_types.id_equipe_types FROM equipe_types WHERE a2t = 1 AND equipe_types.id_equipe_types IS NOT NULL)");
$equipestt_stm->execute();

$equipestt_list = $equipestt_stm->fetchAll();
foreach($equipestt_list as $equipestt){

    $filename = $PNG_TEMP_DIR.$equipestt_list['nom'].'.png';

    QRcode::png($equipestt_list['imei'].'|'.$equipestt_list['mail'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);


    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><br />'.$filename.'<hr />';
}

//echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_equipe_stt",$columns,$condition,""));