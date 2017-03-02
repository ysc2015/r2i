<?php

/*require_once '../../../sys/libs/vendor/autoload.php';
require_once '../../../sys/inc/config.php';
require_once '../../../sys/language/fr/default.php';
require_once "../../../sys/inc/ssp.class.php";
require_once "../../../sys/libs/vendor/EditableGrid/EditableGrid.php";*/

if(isset($_GET['filename']))
{
$fileName=$_GET['filename'];
$fileName=str_replace("..",".",$fileName); //required. if somebody is trying parent folder files
$file = "../uploads/wiki/".$fileName;
$file = str_replace("..","",$file);
if (file_exists($file)) {
	$fileName =str_replace(" ","",$fileName);
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename='.$fileName);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}
}
?>
