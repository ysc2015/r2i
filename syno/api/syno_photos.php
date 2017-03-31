<?php
if(!defined('PHOTOS_UPLOAD_FOLDER')) {
    define('PHOTOS_UPLOAD_FOLDER', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'photos' . DIRECTORY_SEPARATOR);
}

$tableName = 'syno_photos';
$response = array('err' => 0, 'msg' => array(), 'extra' => null);

switch ($action) {
    case 'listForSelect':
        $stmt = $pdo->query('SELECT id as id,org_name as lib FROM ' . $tableName);
        $response['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 'list':
        $where = '';
        $nbrPerPage = 10;
        if (isset($_POST['nbrPerPage'])) {
            $nbrPerPage = $_POST['nbrPerPage'];
        }

        if (isset($_POST['page'])) {
            $page = $_POST['page'];
        } else {
            $page = 1;
        }

        if (isset($_POST['search_value']) && !empty($_POST['search_value'])) {
            $search_for = '%' . $_POST['search_value'] . '%';
            $where = ' WHERE `' . $_POST['search_by'] . '` LIKE ' . $pdo->quote($search_for);
        }

        $nbr = DBHelper::count($tableName, $where);
        $nbrPages = ceil($nbr / $nbrPerPage);
        $from = ($page - 1) * $nbrPerPage;

        $stmt = $pdo->query('SELECT COUNT(*) AS NBR FROM ' . $tableName . $where);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $pdo->query('SELECT * FROM ' . $tableName . $where . ' LIMIT ' . $from . ',10');
        $response['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $response['extra'] = array(
            'NbrT' => $nbr,
            'Pages' => $nbrPages,
            'NbrQ' => $row['NBR']
        );
        break;
    case 'delete':
        $ids = array();
        $n = 0;
        if (strpos($_POST['ids'], ',') !== false) {
            $ids = explode(',', $_POST['ids']);
        } else {
            $ids[] = $_POST['ids'];
        }
        $where = ' WHERE id IN (' . implode(',', $ids) . ')';
        $stmt = $pdo->query('SELECT * FROM ' . $tableName . $where);

        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $photo) {
                if (file_exists(PHOTOS_UPLOAD_FOLDER . $photo['new_name'])) {
                    unlink(PHOTOS_UPLOAD_FOLDER . $photo['new_name']);
                    $n++;
                }
            }
        } else {
            echo json_encode(['err' => 1, 'msg' => 'Erreur lors de la suppression de la photo', 'extra' => $stmt->errorInfo()]);
            exit();
        }
        $stmt = $pdo->query('DELETE FROM ' . $tableName . $where);       

        header('Content-Type: application/json');
        if ($stmt->execute()) {
            if($n > 1) {
                echo json_encode(['err' => 0, 'msg' => 'La suppression des photos est effectuées avec succès']);
            } else {
                echo json_encode(['err' => 0, 'msg' => 'La suppression de la photo est effectuée avec succès']);
            }
        } else {
            echo json_encode(['err' => 1, 'msg' => 'Photo introuvable', 'extra' => $stmt->errorInfo()]);
        }
        exit();
        break;
    case 'add':
        $data = array(
            "org_name" => $_POST[$lang["org_name_id"]],
            "new_name" => $_POST[$lang["new_name_id"]],
            "id_chambre" => $_POST[$lang["id_chambre_id"]],
            "date_upload" => $_POST[$lang["date_upload_id"]],
            "id_user" => $_POST[$lang["id_user_id"]],);
        $ret = DBHelper::insert($tableName, $data);
        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_ADD_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Adding ' . $tableName . ' Error';
        }
        break;
    case 'update':
        $admin = array(
            "id" => $_POST[$lang["id_id"]],
            "org_name" => $_POST[$lang["org_name_id"]],
            "new_name" => $_POST[$lang["new_name_id"]],
            "id_chambre" => $_POST[$lang["id_chambre_id"]],
            "date_upload" => $_POST[$lang["date_upload_id"]],
            "id_user" => $_POST[$lang["id_user_id"]],);
        $ret = DBHelper::update($tableName, 'id=:id', $admin);
        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_UPDATE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Updating ' . $tableName . ' Error';
        }
        break;
}
ResponseHelper::sendResponse(json_encode($response));
