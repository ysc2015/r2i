<?php

set_time_limit(0);
include_once '../config.php';
define('PHOTOS_UPLOAD_FOLDER', __DIR__ .
        DIRECTORY_SEPARATOR . '..' .
        DIRECTORY_SEPARATOR . 'assets' .
        DIRECTORY_SEPARATOR . 'photos' .
        DIRECTORY_SEPARATOR);

if (!file_exists(PHOTOS_UPLOAD_FOLDER) || !is_dir(PHOTOS_UPLOAD_FOLDER)) {
    if (!mkdir(PHOTOS_UPLOAD_FOLDER)) {
        die(json_encode(['err' => 1, 'msg' => 'Can\'t Create the photos upload Folder, Contact the administrator']));
    }
}

$tableName = 'syno_photos';
$indexOfFile = 'pictures';
$prefFileName = 'ph';
$number = 0;

function processUploadedFile($fileName, $chambre, $originalFileName = '', $fileId = null) {
    global $pdo, $tableName;
    $values = [
        'org_name' => $originalFileName,
        'new_name' => $fileName,
        'id_chambre' => $chambre
    ];
    $photo = new Photos($pdo, $tableName);
    if ($fileId != null) {
        $row = $photo->select('id=:id', array('id' => $fileId));
        if (file_exists(PHOTOS_UPLOAD_FOLDER . $row['new_name'])) {
            unlink(PHOTOS_UPLOAD_FOLDER . $row['new_name']);
        }
        $values['id'] = $fileId;
        $photo->update(array('id' => $fileId), $values);
    } else {
        $photo->add($values);
    }
}

$id = null;
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
}

if (isset($_FILES[$indexOfFile])) {

    $ret = array();
    $error = $_FILES[$indexOfFile]["error"];
    if (!is_array($_FILES[$indexOfFile]["name"])) {
        $fileName = $prefFileName . "_" . microtime() . "_" . rand(1, 100) . '_' . $_POST['chambre_id'] . substr($_FILES[$indexOfFile]["name"], strrpos($_FILES[$indexOfFile]["name"], '.'));
        $mv = move_uploaded_file($_FILES[$indexOfFile]["tmp_name"], PHOTOS_UPLOAD_FOLDER . $fileName);
        if ($mv) {
            processUploadedFile($fileName, $_POST['chambre_id'], $_FILES[$indexOfFile]["name"], $id);
            $number++;
        }
    } else {
        $fileCount = count($_FILES[$indexOfFile]["name"]);
        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $prefFileName . "_" . microtime() . "_" . rand(1, 100) . '_' . $_POST['chambre_id'] . substr($_FILES[$indexOfFile]["name"][$i], strrpos($_FILES[$indexOfFile]["name"][$i], '.'));
            if (move_uploaded_file($_FILES[$indexOfFile]["tmp_name"][$i], PHOTOS_UPLOAD_FOLDER . $fileName)) {
                processUploadedFile($fileName, $_POST['chambre_id'], $_FILES[$indexOfFile]["name"], $id);
                $number++;
            }
        }
    }
}
header('Content-Type: application/json');
echo json_encode(array('err' => 0, 'msg' => $number . ' Fichier(s) ajouté avec succès'));
