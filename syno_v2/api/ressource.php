<?php
$tableName = 'ressource';
$response = array('err' => 0, 'msg' => array(), 'extra' => null);

define('DS', DIRECTORY_SEPARATOR);

array(
	'gif' => 'image/gif',
	'jpeg' => 'image/jpeg',
	'jpg' => 'image/jpeg',
	'svg' => 'image/svg+xml',
	'tif' => 'image/tiff',
	'tiff' => 'image/tiff',
	'webp' => 'image/webp',
	'png' => 'image/png',
	'bmp' => 'image/bmp'
);

function getFileExtension($fileName)
{
	$index = strrpos($fileName, '.');
	if($index === false)
	{
		return false;
	}
	$ext = substr($fileName, $index+1);
	return $ext;
}

function getFileMimeType($fileExtension) {
	$mimes = array(
		'gif' => 'image/gif',
		'jpeg' => 'image/jpeg',
		'jpg' => 'image/jpeg',
		'svg' => 'image/svg+xml',
		'tif' => 'image/tiff',
		'tiff' => 'image/tiff',
		'webp' => 'image/webp',
		'png' => 'image/png',
		'bmp' => 'image/bmp'
	);
	$fileExtension = strtolower($fileExtension);
	if(isset($mimes[$fileExtension]))
	{
		return $mimes[$fileExtension];
	}
	return 'application/octet-stream';
}

switch ($action) {
	case 'listImageChambre':
		if(!isset($_GET['tab_imei']) || !isset($_GET['id_chambre'])) 
			exit();
		$stmt = $pdo->query(
		'SELECT id_ressource as id,nom_fichier FROM ' . $tableName . ' WHERE id_chambre=' . $_GET['id_chambre']);
        $response['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
		break;
		
	case 'download':
		if(!isset($_GET['tab_imei']) || !isset($_GET['id'])) 
			exit();
		$id = $_GET['id'];
		$stm = $pdo->prepare("SELECT * FROM $tableName WHERE id_ressource=:id");
		$stm->bindParam(':id',$id);
		if(!$stm->execute()) {
			exit(0);
		}
		$row = $stm->fetch(PDO::FETCH_OBJ);
		if(!$row) {
			exit(0);
		}

		$fileName = $row->nom_fichier;
		$filePath = __DIR__ . DS . ".." . DS . ".." . DS . "app" . DS . "sys" . DS . "api" . DS . "uploads" . DS . $row->dossier . DS .$row->nom_fichier_disque;
		
		
		$ext = getFileExtension($row->nom_fichier_disque);
		
		if(!empty($ext))
		{
			$type = getFileMimeType($ext);
		}
		
		header('Content-Type: ' . $type);
		if($type == 'application/octet-stream')
		{
			header("Content-Transfer-Encoding: Binary");
			header("Content-disposition: attachment; filename=\"" . $fileName . "\"");
		}
			
		ob_clean();
		flush();
		readfile($filePath);
		exit(0);
		break;
	
    
    
    
}
ResponseHelper::sendResponse(json_encode($response));
