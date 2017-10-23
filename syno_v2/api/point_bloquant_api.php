<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

$tableName = 'point_bloquant';
$response = array('err' => 0, 'msg' => array(), 'extra' => null);

switch ($action) {
    case 'listForeign':
        $stmt = $pdo->query("SELECT * FROM point_bloquant");
        $results = [];
        while($line = $stmt->fetch(PDO::FETCH_OBJ))
        {
            $stmt_tmp = $pdo->query("SELECT * FROM point_bloquant_type_de_blocage WHERE id_point_bloquant=" . $line->id_point_bloquant); 
            $line->typeBlocage = $stmt_tmp->fetchAll(PDO::FETCH_OBJ);
            
            $stmt_tmp = $pdo->query("SELECT * FROM point_bloquant_solutions_preconisees WHERE id_point_bloquant=" . $line->id_point_bloquant); 
            $line->solutionsPreconisees = $stmt_tmp->fetchAll(PDO::FETCH_OBJ);
            
            $stmt_tmp = $pdo->query("SELECT * FROM point_bloquant_moyens_mis_en_oeuvre WHERE id_point_bloquant=" . $line->id_point_bloquant); 
            $line->moyensOeuvre = $stmt_tmp->fetchAll(PDO::FETCH_OBJ);
            $results[] = $line;
        }
        ResponseHelper::sendResponse(json_encode(array('data' => $results)));
        exit();
        break;
    case 'listForSelect':
        $stmt = $pdo->query('SELECT id_point_bloquant as id,id_point_bloquant as lib FROM ' . $tableName);
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
        $ret = DBHelper::delete($tableName, 'id_point_bloquant IN (' . implode(',', $ids) . ')');

        if ($ret) {
            $response['msg'][] = $lang[$tableName . '_DELETE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = $stmt->errorInfo();
        }

        break;
    case 'add':
        $response = array();
        $date_insertion =  date('Y-m-d G:i:s');
        $data = array(
          //"id_point_bloquant" => $_POST["id_point_bloquant"], // int(255) AUTOINC
          "id_chambre" => $_POST["id_chambre"],         // id_chambre
          "date_controle" => $_POST["date_controle"], // date_controle
          "id_utilisateur" => $_POST["id_utilisateur"], // id_utilisateur
          "id_entreprise" => $_POST["id_entreprise"],
          "id_equipe_stt" => $_POST["id_equipe_stt"],
          "adresse" => $_POST["adresse"],
          "ref_chantier" => $_POST["ref_chantier"],
          "nature_travaux" => $_POST["nature_travaux"],
          "environement" => $_POST["environement"],
          "id_createur" => $_POST["id_utilisateur"],
          "synthese" => $_POST["synthese"],
          "date_insertion" => $date_insertion,
          );
        $ret = DBHelper::insert($tableName, $data);
        if($ret !== false)
        {
            $response['info']['id_point_bloquant'] = $ret;

            $point_bloquant_type_de_blocage_data = array(
                "id_point_bloquant" => $ret,
                "date_insertion" => $date_insertion,
                "id_createur" => $_POST["id_utilisateur"]
            );
            $id = DBHelper::insert("point_bloquant_type_de_blocage", $point_bloquant_type_de_blocage_data);
            if($id !== false)
                $response['info']['point_bloquant_type_de_blocage_id'] = $id;
            else{
                $response['info']['point_bloquant_type_de_blocage_id'] = Configuration::$db->errorInfo();
            }

            $id = DBHelper::insert("point_bloquant_moyens_mis_en_oeuvre", $point_bloquant_type_de_blocage_data);

            if($id !== false)
                $response['info']['point_bloquant_moyens_mis_en_oeuvre_id'] = $id;
            else{
                $response['info']['point_bloquant_moyens_mis_en_oeuvre_id'] = Configuration::$db->errorInfo();
            }
            $id = DBHelper::insert("point_bloquant_solutions_preconisees", $point_bloquant_type_de_blocage_data);
            if($id !== false)
                $response['info']['point_bloquant_solutions_preconisees_id'] = $id;
            else{
                $response['info']['point_bloquant_solutions_preconisees_id'] = Configuration::$db->errorInfo();
            }
        }
        else
        {
            $response['info']['point_bloquant_solutions_preconisees_id'] = Configuration::$db->errorInfo();
        }

        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_ADD_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Adding ' . $tableName . ' Error';
        }
        break;
    case 'update': // ---
        if(!isset($_POST['id_point_bloquant_update']))
        {
            $response['msg'][] = 'Le parametre id n\est pas présent !';
            $response['err'] ++;
            break;
        }

        $post_data['id_point_bloquant_update'] = $_POST['id_point_bloquant_update'];

        if(isset($_POST['date_controle']))
        {
            $post_data["date_controle"] = $_POST['date_controle'];
        }
        if(isset($_POST['id_utilisateur']))
        {
            $post_data["id_utilisateur"] = $_POST['id_utilisateur'];
        }
        if(isset($_POST['id_entreprise']))
        {
            $post_data["id_entreprise"] = $_POST['id_entreprise'];
        }
        if(isset($_POST['id_equipe_stt']))
        {
            $post_data["id_equipe_stt"] = $_POST['id_equipe_stt'];
        }
        if(isset($_POST['adresse']))
        {
            $post_data["adresse"] = $_POST['adresse'];
        }
        if(isset($_POST['ref_chantier']))
        {
            $post_data["ref_chantier"] = $_POST['ref_chantier'];
        }
        if(isset($_POST['nature_travaux']))
        {
            $post_data["nature_travaux"] = $_POST['nature_travaux'];
        }
        if(isset($_POST['environement']))
        {
            $post_data["environement"] = $_POST['environement'];
        }
        if(isset($_POST['synthese']))
        {
            $post_data["synthese"] = $_POST['synthese'];
        }

        $ret = DBHelper::update($tableName, 'id_point_bloquant=:id_point_bloquant_update', $post_data,array('id_point_bloquant_update'));
        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_UPDATE_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Updating ' . $tableName . ' Error';
        }
        break;
}
ResponseHelper::sendResponse(json_encode($response));
