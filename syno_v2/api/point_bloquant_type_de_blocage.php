<?php
$tableName = 'point_bloquant_type_de_blocage';
$response = array('err' => 0, 'msg' => array(), 'extra' => null);

switch ($action) {
    case 'listForSelect':
        $stmt = $pdo->query('SELECT id_point_bloquant_type_de_blocage as id,id_point_bloquant as lib FROM ' . $tableName);
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
        $ret = DBHelper::delete($tableName, 'id_point_bloquant_type_de_blocage IN (' . implode(',', $ids) . ')');

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
          "reseau_en_aerien" => $_POST["reseau_en_aerien_id"],
          "observation_reseau_en_aerien" => $_POST["observation_reseau_en_aerien_id"],
          "conduites_saturees" => $_POST["conduites_saturees_id"],
          "observation_conduites_saturees" => $_POST["observation_conduites_saturees_id"],
          "conduites_cassees_ou_ecrasees" => $_POST["conduites_cassees_ou_ecrasees_id"],
          "observation_conduites_cassees_ou_ecrasees" => $_POST["observation_conduites_cassees_ou_ecrasees_id"],
          "tampon_de_chambre_impossible_a_ouvrir" => $_POST["tampon_de_chambre_impossible_a_ouvrir_id"],
          "observation_tampon_de_chambre_impossible_a_ouvrir" => $_POST["observation_tampon_de_chambre_impossible_a_ouvrir_id"],
          "chambre_sous_enrobe_ou_recouverte" => $_POST["chambre_sous_enrobe_ou_recouverte_id"],
          "observation_chambre_sous_enrobe_ou_recouverte" => $_POST["observation_chambre_sous_enrobe_ou_recouverte_id"],
          "reseau_emprise_privee" => $_POST["reseau_emprise_privee_id"],
          "observation_reseau_emprise_privee" => $_POST["observation_reseau_emprise_privee_id"],
          "chambre_inexploitable" => $_POST["chambre_inexploitable_id"],
          "observation_chambre_inexploitable" => $_POST["observation_chambre_inexploitable_id"],
          "probleme_d_acces" => $_POST["probleme_d_acces_id"],
          "observation_probleme_d_acces" => $_POST["observation_probleme_d_acces_id"],
          "autre_point_de_blocage" => $_POST["autre_point_de_blocage_id"],
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
        
        if(isset($_POST['reseau_en_aerien'])) {
            $post_data["reseau_en_aerien"] = $_POST["reseau_en_aerien"];
        }
        if(isset($_POST['observation_reseau_en_aerien'])) {
            $post_data["observation_reseau_en_aerien"] = $_POST["observation_reseau_en_aerien"];
        }
        if(isset($_POST['conduites_saturees'])) {
            $post_data["conduites_saturees"] = $_POST["conduites_saturees"];
        }
        if(isset($_POST['observation_conduites_saturees'])) {
            $post_data["observation_conduites_saturees"] = $_POST["observation_conduites_saturees"];
        }
        if(isset($_POST['conduites_cassees_ou_ecrasees'])) {
            $post_data["conduites_cassees_ou_ecrasees"] = $_POST["conduites_cassees_ou_ecrasees"];
        }
        if(isset($_POST['observation_conduites_cassees_ou_ecrasees'])) {
            $post_data["observation_conduites_cassees_ou_ecrasees"] = $_POST["observation_conduites_cassees_ou_ecrasees"];
        }
        if(isset($_POST['tampon_de_chambre_impossible_a_ouvrir'])) {
            $post_data["tampon_de_chambre_impossible_a_ouvrir"] = $_POST["tampon_de_chambre_impossible_a_ouvrir"];
        }
        if(isset($_POST['observation_tampon_de_chambre_impossible_a_ouvrir'])) {
            $post_data["observation_tampon_de_chambre_impossible_a_ouvrir"] = $_POST["observation_tampon_de_chambre_impossible_a_ouvrir"];
        }
        if(isset($_POST['chambre_sous_enrobe_ou_recouverte'])) {
            $post_data["chambre_sous_enrobe_ou_recouverte"] = $_POST["chambre_sous_enrobe_ou_recouverte"];
        }
        if(isset($_POST['observation_chambre_sous_enrobe_ou_recouverte'])) {
            $post_data["observation_chambre_sous_enrobe_ou_recouverte"] = $_POST["observation_chambre_sous_enrobe_ou_recouverte"];
        }
        if(isset($_POST['reseau_emprise_privee'])) {
            $post_data["reseau_emprise_privee"] = $_POST["reseau_emprise_privee"];
        }
        if(isset($_POST['observation_reseau_emprise_privee'])) {
            $post_data["observation_reseau_emprise_privee"] = $_POST["observation_reseau_emprise_privee"];
        }
        if(isset($_POST['chambre_inexploitable'])) {
            $post_data["chambre_inexploitable"] = $_POST["chambre_inexploitable"];
        }
        if(isset($_POST['observation_chambre_inexploitable'])) {
            $post_data["observation_chambre_inexploitable"] = $_POST["observation_chambre_inexploitable"];
        }
        if(isset($_POST['probleme_d_acces'])) {
            $post_data["probleme_d_acces"] = $_POST["probleme_d_acces"];
        }
        if(isset($_POST['observation_probleme_d_acces'])) {
            $post_data["observation_probleme_d_acces"] = $_POST["observation_probleme_d_acces"];
        }
        if(isset($_POST['autre_point_de_blocage'])) {
            $post_data["autre_point_de_blocage"] = $_POST["autre_point_de_blocage"];
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
        
        if(!isset($_POST["id_point_bloquant_type_de_blocage_update"])) {
            $response["msg"][] = "Le parametre id est invalide !";
            $response["err"] ++;
            break;
        }
        $post_data['id_point_bloquant_type_de_blocage_update'] = $_POST["id_point_bloquant_type_de_blocage_update"];
        
        $ret = DBHelper::update($tableName, 'id_point_bloquant_type_de_blocage=:id_point_bloquant_type_de_blocage_update', $post_data,array('id_point_bloquant_type_de_blocage_update'));
        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_UPDATE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Updating ' . $tableName . ' Error';
        }
        break;
}
ResponseHelper::sendResponse(json_encode($response));
