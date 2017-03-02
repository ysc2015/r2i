<?php
/**
 * file: delete_blq.php
 * User: rabii
 */

/*require_once '../../../sys/libs/vendor/autoload.php';
require_once '../../../sys/inc/config.php';
require_once '../../../sys/language/fr/default.php';
require_once "../../../sys/inc/ssp.class.php";
require_once "../../../sys/libs/vendor/EditableGrid/EditableGrid.php";*/

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$stm = $db->prepare("delete from wiki_sujet where id=:id");

if(isset($id) && !empty($id)){
    $stm->bindParam(':id',$id);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence Sujet invalide !";
}

$pjs = PieceJointe::all(
	    array('conditions' =>
		array("id_sujet = ?", $id)
	    )
	);
	$file_ids ='{';
	$filePath='';
	foreach($pjs as $pj) 
	{
		$filePath=str_replace("app/sys/api/uploads/wiki/","../uploads/wiki/",$pj->url);
		if (file_exists($filePath)) 
        	unlink($filePath);
		$file_ids.= $pj->id.',';
	}
	if($file_ids!='{') $file_ids=substr($file_ids,0,(strlen($file_ids)-1));
	$file_ids.='}';

if($delete == true && $err == 0){
    if($stm->execute()){
	if($file_ids!=='{}'){
	$stm = $db->prepare("delete from wiki_piecejointe where id IN ".$file_ids);
  	$stm->execute();
	}
	$message [] = "Element supprimé avec succès";
    
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>
