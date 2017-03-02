<?php

/*require_once '../../../sys/libs/vendor/autoload.php';
require_once '../../../sys/inc/config.php';
require_once '../../../sys/language/fr/default.php';
require_once "../../../sys/inc/ssp.class.php";
require_once "../../../sys/libs/vendor/EditableGrid/EditableGrid.php";*/

$output_dir = __DIR__ . "/../uploads/wiki/";
if(isset($_REQUEST["op"]) && $_REQUEST["op"] == "delete" && isset($_REQUEST['name']))
{
	$fileName =$_REQUEST['name'];
	$fileName=str_replace("..",".",$fileName); //required. if somebody is trying parent folder files	
	$filePath = $output_dir. $fileName;
	if (file_exists($filePath)) 
	{
        unlink($filePath);
	$stm = $db->prepare("delete from wiki_piecejointe where url='app/sys/api/uploads/wiki/".$fileName."'");
  	$stm->execute();
    }
	echo "Deleted File app/sys/api/uploads/wiki/".$fileName."<br>";
}
?>
