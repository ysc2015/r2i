<?php

require_once '../../../sys/libs/vendor/autoload.php';
require_once '../../../sys/inc/config.php';
require_once '../../../sys/language/fr/default.php';
require_once "../../../sys/inc/ssp.class.php";
require_once "../../../sys/libs/vendor/EditableGrid/EditableGrid.php";

$uploaddir = '../uploads/wiki/'; 
extract($_GET);
if(isset($filename) && !empty($filename))
{
$file = $uploaddir . $filename; 

if (unlink($file)) { 
  echo "success".$file; 
  $stm = $db->prepare("delete from wiki_piecejointe where url='app/sys/api/uploads/wiki/".$filename."'");
  $stm->execute();
} else {
	echo "error".$file;
}
} else {
	echo "error".$file;
}
?>
