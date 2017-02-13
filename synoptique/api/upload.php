<?php

set_time_limit(0);
include_once '../config.php';
define('PHOTOS_UPLOAD_FOLDER', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'photos' . DIRECTORY_SEPARATOR);

if(!file_exists(PHOTOS_UPLOAD_FOLDER) || !is_dir(PHOTOS_UPLOAD_FOLDER)) {
    if(!mkdir(PHOTOS_UPLOAD_FOLDER)) {
        die(json_encode(['err' => 1, 'msg' => 'Can\'t Create the photos upload Folder, Contact the administrator']));
    }
}

$tableName = 'syno_photos';
$indexOfFile = 'pictures';
$number = 0;

function processUploadedFile($fileName, $chambre,$originalFileName = '') {
    global $pdo,$tableName;
    $values = [
        'org_name' => $originalFileName,
        'new_name' => $fileName,
        'id_chambre' => $chambre
    ];
    
    $photo = new Photos($pdo,$tableName);
    $photo->add($values);
}

if (isset($_FILES[$indexOfFile])) {
    $ret = array();
    $error = $_FILES[$indexOfFile]["error"];
    if (!is_array($_FILES[$indexOfFile]["name"])) {
        $fileName = $indexOfFile . "_" . time() . "_" . str_replace(" ", "_", $_FILES[$indexOfFile]["name"]);
        $mv = move_uploaded_file($_FILES[$indexOfFile]["tmp_name"], PHOTOS_UPLOAD_FOLDER . $fileName);
        if ($mv) {
            processUploadedFile($fileName, $_POST['chambre_id'], $_FILES[$indexOfFile]["name"]);
            $number++;
        }

    } else {
        $fileCount = count($_FILES[$indexOfFile]["name"]);
        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $indexOfFile . "_" . time() . "_" . $_FILES[$indexOfFile]["name"][$i];
            if (move_uploaded_file($_FILES[$indexOfFile]["tmp_name"][$i], PHOTOS_UPLOAD_FOLDER . $fileName)) {
                processUploadedFile($fileName, $_POST['chambre_id'] ,$_FILES[$indexOfFile]["name"]);
                $number++;
            }
        }
    }
}
header('Content-Type: application/json');
echo json_encode(array('err' => 0, 'msg' => $number . ' Fichier(s) ajouté avec succès'));
