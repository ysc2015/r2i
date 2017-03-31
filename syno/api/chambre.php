<?php



switch($action) {
    case 'update_on_change':
        $f = $_POST['f'];
        $v = $_POST['v'];

        header('Content-Type: application/json');
        $ch = new Chambre($pdo,'syno_chambre');
        $ch->update(['id_chambre' => $_POST['id']],[$f => $v]);
        echo json_encode(['err' => 0, 'msg' => 'Mise à jour effectué avec succès',$_POST]);
        break;
}