<?php
$tableName = 'chambre';
$response = array('err' => 0, 'msg' => array(), 'extra' => null);

switch ($action) {
    case 'listForSelect':
        $stmt = $pdo->query('SELECT id_chambre as id,id_ressource as lib FROM ' . $tableName);
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
        
        if(isset($_POST['search_value']) && !empty($_POST['search_value'])) {
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
        $ret = DBHelper::delete($tableName, 'id_chambre IN (' . implode(',', $ids) . ')');

        if ($ret) {
            $response['msg'][] = $lang[$tableName . '_DELETE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = $stmt->errorInfo();
        }

        break;
    case 'add':
        $data = array(
          "id_ressource" => $_POST[$lang["id_ressource_id"]],
          "id_sous_projet" => $_POST[$lang["id_sous_projet_id"]],
          "type_entree" => $_POST[$lang["type_entree_id"]],
          "ref_chambre" => $_POST[$lang["ref_chambre_id"]],
          "villet" => $_POST[$lang["villet_id"]],
          "sous_projet" => $_POST[$lang["sous_projet_id"]],
          "ref_note" => $_POST[$lang["ref_note_id"]],
          "code_ch1" => $_POST[$lang["code_ch1_id"]],
          "code_ch2" => $_POST[$lang["code_ch2_id"]],
          "gps" => $_POST[$lang["gps_id"]],
          "type_chambre" => $_POST[$lang["type_chambre_id"]],
          "traite" => $_POST[$lang["traite_id"]],
          "manchon_prevu" => $_POST[$lang["manchon_prevu_id"]],);
        $ret = DBHelper::insert($tableName, $data);
        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_ADD_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Adding ' . $tableName . ' Error';
        }
        break;
    case 'update':
        if(isset($_POST['id_ressource'])) {
            $post_data["id_ressource"] = $_POST["id_ressource"];
        }
		if(isset($_POST['id_sous_projet'])) {
            $post_data["id_sous_projet"] = $_POST["id_sous_projet"];
        }
		if(isset($_POST['type_entree'])) {
            $post_data["type_entree"] = $_POST["type_entree"];
        }
        if(isset($_POST['ref_chambre'])) {
            $post_data["ref_chambre"] = $_POST["ref_chambre"];
        }
        if(isset($_POST['villet'])) {
            $post_data["villet"] = $_POST["villet"];
        }
        if(isset($_POST['sous_projet'])) {
            $post_data["sous_projet"] = $_POST["sous_projet"];
        }
        if(isset($_POST['ref_note'])) {
            $post_data["ref_note"] = $_POST["ref_note"];
        }
        if(isset($_POST['code_ch1'])) {
            $post_data["code_ch1"] = $_POST["code_ch1"];
        }
        if(isset($_POST['code_ch2'])) {
            $post_data["code_ch2"] = $_POST["code_ch2"];
        }
        if(isset($_POST['gps'])) {
            $post_data["gps"] = $_POST["gps"];
        }
        if(isset($_POST['type_chambre'])) {
            $post_data["type_chambre"] = $_POST["type_chambre"];
        }
        if(isset($_POST['traite'])) {
            $post_data["traite"] = $_POST["traite"];
        }
        if(isset($_POST['manchon_prevu'])) {
            $post_data["manchon_prevu"] = $_POST["manchon_prevu"];
        }
		if(!isset($_POST["id_chambre_update"])) {
            $response["msg"][] = "Le parametre id est invalide !";
            $response["err"] ++;
            break;
        }
		$post_data['id_chambre_update'] = $_POST["id_chambre_update"];
        
        $ret = DBHelper::update($tableName, 'id_chambre=:id_chambre_update', $post_data,array('id_chambre_update'));
        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_UPDATE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Updating ' . $tableName . ' Error';
        }
		
        break;
    case 'update_on_change':
        $data = array(
            'id_chambre' => $_POST['id'],
            $_POST['f'] => $_POST['v']
        );
        
        $ret = DBHelper::update($tableName, 'id_chambre=:id_chambre', $data,array('id_chambre'));
        if ($ret !== false) {
            $response['msg'] = $lang[$tableName . '_UPDATE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'] = 'Updating ' . $tableName . ' Error';
        }
        break;
}
ResponseHelper::sendResponse(json_encode($response));
