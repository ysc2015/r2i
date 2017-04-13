<?php
require_once '../config.php';

$stmt_get_chambre = $pdo->prepare('SELECT * FROM chambre WHERE id_chambre=:id');

$stmt_troncon = $pdo->prepare('SELECT * FROM syno_troncon WHERE chambre_src = :chambre_src ORDER By id_troncon');


class Chambre {
    public $ref;
    public $id;
    public $infra;
    public $type;
    public $gps;

    public $next;
    public $link;
}

function findChambre($id) {
    global $stmt_get_chambre;
    $stmt_get_chambre->execute([':id' => $id]);
    $line = $stmt_get_chambre->fetch(PDO::FETCH_ASSOC);
    $chambre = new Chambre();
    $chambre->id = $line['id_chambre'];
    $chambre->ref = $line['code_ch1'] . '-' . $line['code_ch2'];
    //$chambre->infra = $line['type_infra'];
    $chambre->type = $line['type_chambre'];
    $chambre->gps = $line['gps'];
    $chambre->next = [];
    return $chambre;
}

function getChambreGraph(Chambre $chambre_src,Chambre $chambre_dst) {
    global $stmt_troncon;

    //echo $chambre_src->id . ' -> ' . $chambre_dst->id . PHP_EOL;
    
    if($chambre_src->id == $chambre_dst->id) {
        return true;
    }

    $stmt_troncon->execute([':chambre_src' => $chambre_src->id]);
    $lines = $stmt_troncon->fetchAll(PDO::FETCH_ASSOC);

    foreach($lines as $line) {
        //echo $line['id_troncon'] . ' --> ';
        $dst = findChambre($line['chambre_dst']);
        if(getChambreGraph($dst,$chambre_dst)) {
            $chambre_src->next[] = $dst;
            $chambre_src->link[] = $line['id_troncon'];
            return true;
        }
    }
    return false;
}

$chambre_src = $_POST['chambre_src'];
$chambre_dst = $_POST['chambre_dst'];

$chambre_start = findChambre($chambre_src);
$chambre_end = findChambre($chambre_dst);

header('Content-Type: application/json');
if(getChambreGraph($chambre_start,$chambre_end)) {
    echo json_encode($chambre_start);
} else {
    echo json_encode([]);
}