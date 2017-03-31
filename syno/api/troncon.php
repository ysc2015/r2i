<?php



if(!isset($action)) {
    $action = '';
}
switch($action) {
    case 'update_on_change':
        $f = $_POST['f'];
        $v = $_POST['v'];

        header('Content-Type: application/json');
        $tr = new Troncon($pdo,'syno_troncon');
        $tr->update(['id_troncon' => $_POST['id']],[$f => $v]);
        echo json_encode(['err' => 0, 'msg' => 'Mise à jour effectué avec succès',$_POST]);
        break;
    default:
        $troncon = new Troncon($pdo,'syno_troncon');
        header('Content-Type: application/json');
        echo json_encode($troncon->getTronconWithChambre($_POST['id']));
        break;
}

