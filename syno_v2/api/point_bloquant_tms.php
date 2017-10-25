<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

include_once __DIR__ . '/ssp.class.php';

$result = array();

switch ($action) {
    case 'type':


        $stmt = $pdo->query("SELECT * FROM point_bloquant_type_de_blocage");
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

    break;

    case 'solutions':

        $stmt_s = $pdo->query("SELECT * FROM point_bloquant_solutions_preconisees");
        $result = $stmt_s->fetchAll(PDO::FETCH_OBJ);

    break;

    case 'moyens':

        $stmt_m = $pdo->query("SELECT * FROM point_bloquant_moyens_mis_en_oeuvre");
        $result = $stmt_m->fetchAll(PDO::FETCH_OBJ);

    break;

}

ResponseHelper::sendResponse(json_encode($result));
