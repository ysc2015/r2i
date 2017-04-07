<?php

$tableName = 'syno_masque';
$response = array('err' => 0, 'msg' => array(), 'extra' => null);

<?php
$tableName = 'syno_masque';
$response = array('err' => 0, 'msg' => array(), 'extra' => null);

switch ($action) {
    case 'listForSelect':
        $stmt = $pdo->query('SELECT id_masque as id,nom as lib FROM ' . $tableName);
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
        $ret = DBHelper::delete($tableName, 'id_masque IN (' . implode(',', $ids) . ')');

        if ($ret) {
            $response['msg'][] = $lang[$tableName . '_DELETE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = $stmt->errorInfo();
        }

        break;
    case 'add':
        $data = array(
            "nom" => $_POST[$lang["nom_id"]],
            "taille" => $_POST[$lang["taille_id"]],
            "etat" => $_POST[$lang["etat_id"]],
            "position" => $_POST[$lang["position_id"]],
            "couleur" => $_POST[$lang["couleur_id"]],
            "tubage" => $_POST[$lang["tubage_id"]],
            "tubage_taille" => $_POST[$lang["tubage_taille_id"]],
            "id_chambre_src" => $_POST[$lang["id_chambre_src_id"]],
            "id_chambre_dst" => $_POST[$lang["id_chambre_dst_id"]],);
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
            "id_masque" => $_POST[$lang["id_masque_id"]],
            "nom" => $_POST[$lang["nom_id"]],
            "taille" => $_POST[$lang["taille_id"]],
            "etat" => $_POST[$lang["etat_id"]],
            "position" => $_POST[$lang["position_id"]],
            "couleur" => $_POST[$lang["couleur_id"]],
            "tubage" => $_POST[$lang["tubage_id"]],
            "tubage_taille" => $_POST[$lang["tubage_taille_id"]],
            "id_chambre_src" => $_POST[$lang["id_chambre_src_id"]],
            "id_chambre_dst" => $_POST[$lang["id_chambre_dst_id"]],);
        $ret = DBHelper::update($tableName, 'id_masque=:id_masque', $admin);
        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_UPDATE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Updating ' . $tableName . ' Error';
        }
        break;
    case 'update_by_name':
        $admin = array(
            "id_masque" => $_POST[$lang["id_masque_id"]],
            "nom" => $_POST[$lang["nom_id"]],
            "taille" => $_POST[$lang["taille_id"]],
            "etat" => $_POST[$lang["etat_id"]],
            "position" => $_POST[$lang["position_id"]],
            "couleur" => $_POST[$lang["couleur_id"]],
            "tubage" => $_POST[$lang["tubage_id"]],
            "tubage_taille" => $_POST[$lang["tubage_taille_id"]],
            "id_chambre_src" => $_POST[$lang["id_chambre_src_id"]],
            "id_chambre_dst" => $_POST[$lang["id_chambre_dst_id"]]);
        
        $ret = DBHelper::update($tableName, 'nom=:nom', $admin);
        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_UPDATE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Updating ' . $tableName . ' Error';
        }
        break;
}
ResponseHelper::sendResponse(json_encode($response));
