<?php
$tableName = 'point_bloquant_moyens_mis_en_oeuvre';
$response = array('err' => 0, 'msg' => array(), 'extra' => null);

switch ($action) {
    case 'listForSelect':
        $stmt = $pdo->query('SELECT id_point_bloquant_moyens_mis_en_oeuvre as id,id_point_bloquant as lib FROM ' . $tableName);
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
        $ret = DBHelper::delete($tableName, 'id_point_bloquant_moyens_mis_en_oeuvre IN (' . implode(',', $ids) . ')');

        if ($ret) {
            $response['msg'][] = $lang[$tableName . '_DELETE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = $stmt->errorInfo();
        }

        break;
    case 'add':
        $data = array(
          "id_point_bloquant" => $_POST["id_point_bloquant_id"],
          "aiguillage_au_compresseur" => $_POST["aiguillage_au_compresseur_id"],
          "observation_aiguillage_au_compresseur" => $_POST["observation_aiguillage_au_compresseur_id"],
          "aiguillage_avec_aiguille_de_11_13mm" => $_POST["aiguillage_avec_aiguille_de_11_13mm_id"],
          "observation_aiguillage_avec_aiguille_de_11_13mm" => $_POST["observation_aiguillage_avec_aiguille_de_11_13mm_id"],
          "aiguillage_aux_cannes" => $_POST["aiguillage_aux_cannes_id"],
          "observation_aiguillage_aux_cannes" => $_POST["observation_aiguillage_aux_cannes_id"],
          "hydrocurage" => $_POST["hydrocurage_id"],
          "observation_hydrocurage" => $_POST["observation_hydrocurage_id"],
          "identification_du_point_bloquant_au_metre" => $_POST["identification_du_point_bloquant_au_metre_id"],
          "observation_identification_du_point_bloquant_au_metre" => $_POST["observation_identification_du_point_bloquant_au_metre_id"],
          "identification_a_la_sonde" => $_POST["identification_a_la_sonde_id"],
          "observation_identification_a_la_sonde" => $_POST["observation_identification_a_la_sonde_id"],
          "tentative_de_contact_du_proprietaire_ou_gestionnaire" => $_POST["tentative_de_contact_du_proprietaire_ou_gestionnaire_id"],
          "observation_tentative_de_contact_du_proprietaire_ou_gestionnaire" => $_POST["observation_tentative_de_contact_du_proprietaire_ou_gestionnaire_id"],
          "date_insertion" => $_POST["date_insertion_id"],
          "date_last_modify" => $_POST["date_last_modify_id"],
          "id_createur" => $_POST["id_createur_id"],
          "id_modificateur" => $_POST["id_modificateur_id"]);
        $ret = DBHelper::insert($tableName, $data);
        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_ADD_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Adding ' . $tableName . ' Error';
        }
        break;
    case 'update':
        
        if(isset($_POST['id_point_bloquant'])) {
            $post_data["id_point_bloquant"] = $_POST["id_point_bloquant"];
        }
        if(isset($_POST['aiguillage_au_compresseur'])) {
            $post_data["aiguillage_au_compresseur"] = $_POST["aiguillage_au_compresseur"];
        }
        if(isset($_POST['observation_aiguillage_au_compresseur'])) {
            $post_data["observation_aiguillage_au_compresseur"] = $_POST["observation_aiguillage_au_compresseur"];
        }
        if(isset($_POST['aiguillage_avec_aiguille_de_11_13mm'])) {
            $post_data["aiguillage_avec_aiguille_de_11_13mm"] = $_POST["aiguillage_avec_aiguille_de_11_13mm"];
        }
        if(isset($_POST['observation_aiguillage_avec_aiguille_de_11_13mm'])) {
            $post_data["observation_aiguillage_avec_aiguille_de_11_13mm"] = $_POST["observation_aiguillage_avec_aiguille_de_11_13mm"];
        }
        if(isset($_POST['aiguillage_aux_cannes'])) {
            $post_data["aiguillage_aux_cannes"] = $_POST["aiguillage_aux_cannes"];
        }
        if(isset($_POST['observation_aiguillage_aux_cannes'])) {
            $post_data["observation_aiguillage_aux_cannes"] = $_POST["observation_aiguillage_aux_cannes"];
        }
        if(isset($_POST['hydrocurage'])) {
            $post_data["hydrocurage"] = $_POST["hydrocurage"];
        }
        if(isset($_POST['observation_hydrocurage'])) {
            $post_data["observation_hydrocurage"] = $_POST["observation_hydrocurage"];
        }
        if(isset($_POST['identification_du_point_bloquant_au_metre'])) {
            $post_data["identification_du_point_bloquant_au_metre"] = $_POST["identification_du_point_bloquant_au_metre"];
        }
        if(isset($_POST['observation_identification_du_point_bloquant_au_metre'])) {
            $post_data["observation_identification_du_point_bloquant_au_metre"] = $_POST["observation_identification_du_point_bloquant_au_metre"];
        }
        if(isset($_POST['identification_a_la_sonde'])) {
            $post_data["identification_a_la_sonde"] = $_POST["identification_a_la_sonde"];
        }
        if(isset($_POST['observation_identification_a_la_sonde'])) {
            $post_data["observation_identification_a_la_sonde"] = $_POST["observation_identification_a_la_sonde"];
        }
        if(isset($_POST['tentative_de_contact_du_proprietaire_ou_gestionnaire'])) {
            $post_data["tentative_de_contact_du_proprietaire_ou_gestionnaire"] = $_POST["tentative_de_contact_du_proprietaire_ou_gestionnaire"];
        }
        if(isset($_POST['observation_tentative_de_contact_du_proprietaire_ou_gestionnaire'])) {
            $post_data["observation_tentative_de_contact_du_proprietaire_ou_gestionnaire"] = $_POST["observation_tentative_de_contact_du_proprietaire_ou_gestionnaire"];
        }
        if(isset($_POST['date_insertion'])) {
            $post_data["date_insertion"] = $_POST["date_insertion"];
        }
        if(isset($_POST['date_last_modify'])) {
            $post_data["date_last_modify"] = $_POST["date_last_modify"];
        }
        if(isset($_POST['id_createur'])) {
            $post_data["id_createur"] = $_POST["id_createur"];
        }
        if(isset($_POST['id_modificateur'])) {
            $post_data["id_modificateur"] = $_POST["id_modificateur"];
        }
        
        if(!isset($_POST["id_point_bloquant_moyens_mis_en_oeuvre_update"])) {
            $response["msg"][] = "Le parametre id est invalide !";
            $response["err"] ++;
            break;
        }
		$post_data['id_point_bloquant_moyens_mis_en_oeuvre_update'] = $_POST["id_point_bloquant_moyens_mis_en_oeuvre_update"];
        
        $ret = DBHelper::update($tableName, 'id_point_bloquant_moyens_mis_en_oeuvre=:id_point_bloquant_moyens_mis_en_oeuvre_update', $post_data,array('id_point_bloquant_moyens_mis_en_oeuvre_update'));
        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_UPDATE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Updating ' . $tableName . ' Error';
        }
        break;
}
ResponseHelper::sendResponse(json_encode($response));
