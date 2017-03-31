<?php

$tableName = 'syno_troncon';
$response = array('err' => 0, 'msg' => array(), 'extra' => null);

switch ($action) {
    case 'listForSelect':
        $stmt = $pdo->query('SELECT id_troncon as id,chambre_src as lib FROM ' . $tableName);
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
        if (strpos($_POST['ids'], ',') !== false) {
            $ids = explode(',', $_POST['ids']);
        } else {
            $ids[] = $_POST['ids'];
        }
        $ret = DBHelper::delete($tableName, 'id_troncon IN (' . implode(',', $ids) . ')');

        if ($ret) {
            $response['msg'][] = $lang[$tableName . '_DELETE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = $stmt->errorInfo();
        }

        break;
    case 'add':
        $data = array(
            "chambre_src" => $_POST[$lang["chambre_src_id"]],
            "chambre_dst" => $_POST[$lang["chambre_dst_id"]],
            "masque_src" => $_POST[$lang["masque_src_id"]],
            "masque_dst" => $_POST[$lang["masque_dst_id"]],
            "alveole_src" => $_POST[$lang["alveole_src_id"]],
            "alveole_dst" => $_POST[$lang["alveole_dst_id"]],
            "conduite_libre" => $_POST[$lang["conduite_libre_id"]],
            "type_reseau" => $_POST[$lang["type_reseau_id"]],
            "diametre" => $_POST[$lang["diametre_id"]],
            "etat_aveole" => $_POST[$lang["etat_aveole_id"]],
            "alveole_libre_4" => $_POST[$lang["alveole_libre_4_id"]],
            "passage" => $_POST[$lang["passage_id"]],
            "longueurGC" => $_POST[$lang["longueurGC_id"]],
            "alveole_diametre" => $_POST[$lang["alveole_diametre_id"]],
            "alveole_100_free" => $_POST[$lang["alveole_100_free_id"]],
            "autre" => $_POST[$lang["autre_id"]],);
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
            "id_troncon" => $_POST[$lang["id_troncon_id"]],
            "chambre_src" => $_POST[$lang["chambre_src_id"]],
            "chambre_dst" => $_POST[$lang["chambre_dst_id"]],
            "masque_src" => $_POST[$lang["masque_src_id"]],
            "masque_dst" => $_POST[$lang["masque_dst_id"]],
            "alveole_src" => $_POST[$lang["alveole_src_id"]],
            "alveole_dst" => $_POST[$lang["alveole_dst_id"]],
            "conduite_libre" => $_POST[$lang["conduite_libre_id"]],
            "type_reseau" => $_POST[$lang["type_reseau_id"]],
            "diametre" => $_POST[$lang["diametre_id"]],
            "etat_aveole" => $_POST[$lang["etat_aveole_id"]],
            "alveole_libre_4" => $_POST[$lang["alveole_libre_4_id"]],
            "passage" => $_POST[$lang["passage_id"]],
            "longueurGC" => $_POST[$lang["longueurGC_id"]],
            "alveole_diametre" => $_POST[$lang["alveole_diametre_id"]],
            "alveole_100_free" => $_POST[$lang["alveole_100_free_id"]],
            "autre" => $_POST[$lang["autre_id"]],);
        $ret = DBHelper::update($tableName, 'id_troncon=:id_troncon', $admin);
        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_UPDATE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Updating ' . $tableName . ' Error';
        }
        break;
    case 'update_on_change':
        $f = $_POST['f'];
        $v = $_POST['v'];

        header('Content-Type: application/json');
        $tr = new Troncon($pdo, 'syno_troncon');
        $tr->update(['id_troncon' => $_POST['id']], [$f => $v]);
        echo json_encode(['err' => 0, 'msg' => 'Mise à jour effectué avec succès', $_POST]);
        break;
}
ResponseHelper::sendResponse(json_encode($response));
