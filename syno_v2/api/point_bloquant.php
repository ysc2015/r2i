<?php
$tableName = 'point_bloquant';
$response = array('err' => 0, 'msg' => array(), 'extra' => null);

switch ($action) {
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
    case 'add': // to test
	/*
	sendPointBloquant(@Query("tab_imei") String imei,
                  @Field("id_point_bloquant") long id_point_bloquant,
                  @Field("date_controle") String date_controle,
                  @Field("id_utilisateur") String id_utilisateur,
                  @Field("id_entreprise") String id_entreprise,
                  @Field("id_equipe_stt") String id_equipe_stt,
                  @Field("adresse") String adresse,
                  @Field("ref_chantier") String ref_chantier,
                  @Field("nature_travaux") String nature_travaux,
                  @Field("environement") int environement,
                  @Field("synthese") String synthese);
	*/
		$date_insertion =  date('Y-m-d G:i:s');
        $data = array(
          "id_point_bloquant" => $_POST["id_point_bloquant"], // int(255) AUTOINC
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
			$point_bloquant_type_de_blocage_data = array(
				"id_point_bloquant" => $ret,
				"date_insertion" => $date_insertion,
				"id_createur" => $_POST["id_utilisateur"],
			);
			DBHelper::insert("point_bloquant_type_de_blocage", $point_bloquant_type_de_blocage_data);
			DBHelper::insert("point_bloquant_moyens_mis_en_oeuvre", $point_bloquant_type_de_blocage_data);
			DBHelper::insert("point_bloquant_solutions_preconisees", $point_bloquant_type_de_blocage_data);
		}
		
        if ($ret !== false) {
            $response['msg'][] = $lang[$tableName . '_ADD_MSG'];
        } else {
            $response['err'] ++;
            $response['msg'][] = 'Adding ' . $tableName . ' Error';
        }
        break;
    case 'update': // ---
        $post_data = array(
            'id_point_bloquant_update' => $_POST['id_point_bloquant_update'],

			"id_point_bloquant" => $_POST["id_point_bloquant"],
			"date_controle" => $_POST["date_controle"], // date_controle
			"id_utilisateur" => $_POST["id_utilisateur"], // id_utilisateur
			"id_entreprise" => $_POST["id_entreprise"],
			"id_equipe_stt" => $_POST["id_equipe_stt"],
			"adresse" => $_POST["adresse"],
			"ref_chantier" => $_POST["ref_chantier"],
			"nature_travaux" => $_POST["nature_travaux"],
			"environement" => $_POST["environement"],
			"synthese" => $_POST["synthese"]
          );
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
