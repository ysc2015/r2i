<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

include_once __DIR__ . '/ssp.class.php';

$result = array();

switch ($action) {
    case 'type':
    if(isset($_POST['tab_imei'])))
    {
        $stmt = $pdo->query("SELECT * FROM point_bloquant_type_de_blocage");
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    break;

    case 'solutions':
    if(isset($_POST['tab_imei'])))
    {
        $stmt_tmp = $pdo->query("SELECT * FROM point_bloquant_solutions_preconisees");
        $resul = $stmt_tmp->fetchAll(PDO::FETCH_OBJ);
    }
    break;

    case 'moyens':
    if(isset($_POST['tab_imei'])))
    {
        $stmt_tmp = $pdo->query("SELECT * FROM point_bloquant_moyens_mis_en_oeuvre");
        $result = $stmt_tmp->fetchAll(PDO::FETCH_OBJ);
    }
    break;

}

ResponseHelper::sendResponse(json_encode($result));
