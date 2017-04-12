<?php
if(!defined('PHOTOS_UPLOAD_FOLDER')) {
    define('PHOTOS_UPLOAD_FOLDER', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'photos' . DIRECTORY_SEPARATOR);
}

if(!isset($action)) {
    $action = '';
}
switch($action) {
    case 'list':
        $id = $_GET['id'];
        $stmt = $pdo->prepare('SELECT * FROM syno_photos WHERE id_chambre=:id');
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            $ret['photos'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($ret);
            exit();
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $stmt = $pdo->prepare('SELECT * FROM syno_photos WHERE id=:id');
        $stmt->bindParam(':id', $id);
        header('Content-Type: application/json');
        if($stmt->execute()) {
            $photo = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo json_encode(['err' => 1, 'msg' => 'Photo introuvable','extra' => $stmt->errorInfo()]);
            exit();
        }

        $stmt = $pdo->prepare('DELETE FROM syno_photos WHERE id = :id');
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            if(file_exists(PHOTOS_UPLOAD_FOLDER . $photo['new_name'])) {
                unlink(PHOTOS_UPLOAD_FOLDER . $photo['new_name']);
            }
            echo json_encode(['err' => 0, 'msg' => 'La suppression de la photo est effectuée avec succès']);
            exit();
        } else {
            echo json_encode(['err' => 1, 'msg' => 'Erreur lors de la suppression de la photo','extra' => $stmt->errorInfo()]);
            exit();
        }
        break;
}