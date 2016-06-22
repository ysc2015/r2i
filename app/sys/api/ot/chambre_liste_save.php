<?php
/**
 * file: chambre_liste.php
 * User: rabii
 */

require_once __DIR__."/../../php-activerecord/ActiveRecord.php";
include_once __DIR__."/../../inc/config.php";

$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction

if (!$sidx) {
    $sidx = 1;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "errors";
    return ;
}

$count = Chambre::count(array('conditions' => 'id_ordre_de_travail=' . $_GET['id']));

if ($count > 0) {
    $total_pages = ceil($count / $limit);
} else {
    $total_pages = 0;
}

if ($page > $total_pages) {
    $page = $total_pages;
}

$start = $limit * $page - $limit; // do not put $limit*($page - 1)

$chambres = Chambre::all(array(
    'order' => "$sidx $sord",
    'limit' => $start . ',' . $limit,
    'conditions' => 'id_ordre_de_travail=' . $_GET['id']
));

$responce = array();

$responce['page'] = $page;
$responce['total'] = $total_pages;
$responce['records'] = $count;
foreach ($chambres as $k => $v) {
    $responce['rows'][$k]['chambre_id'] = $v->chambre_id;
    $responce['rows'][$k]['ref_chambre'] = $v->ref_chambre;
    $responce['rows'][$k]['villet'] = $v->villet;
    $responce['rows'][$k]['sous_projet'] = $v->sous_projet;
    $responce['rows'][$k]['ref_note'] = $v->ref_note;
    $responce['rows'][$k]['code_ch1'] = $v->code_ch1;
    $responce['rows'][$k]['code_ch2'] = $v->code_ch2;
    $responce['rows'][$k]['gps'] = $v->gps;
}

echo json_encode($responce);