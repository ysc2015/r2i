<?php
/**
 * file: chambre_grid.php
 * User: rabii
 */

ini_set("display_errors","1");

include_once __DIR__."/../../inc/config.php";
include_once __DIR__."/../../inc/ssp.class.php";

$table = array("chambre as t1", "ordre_de_travail as t2");

$fields = array(
    "t1.id_chambre",
    "t1.id_ordre_de_travail",
    "t1.ref_chambre",
    "t1.villet",
    "t1.sous_projet",
    "t1.ref_note",
    "t1.code_ch1",
    "t1.code_ch2",
    "t1.gps");

if (isset($_GET['_search'])) {
    extract($_GET);

    $select = implode(',', $fields);
    $from = implode(',', $table);
    $where = "t1.id_ordre_de_travail=t2.id_ordre_de_travail AND t1.id_ordre_de_travail =".$idot;
    $limit = " limit " . (($page - 1) * $rows) . "," . $rows;
    $orderby = "";
    if (!empty($sidx)) {
        $orderby = "ORDER BY " . $sidx . " " . $sord;
    }


    $stm = $db->query("SELECT COUNT(*) AS count FROM $from WHERE " . $where);
    $stm->execute();
    $row = $stm->fetch();
    $count = $row[0];

    if ($count > 0 /*&& $limit > 0*/) {
        $total_pages = ceil($count / $rows);
    } else {
        $total_pages = 1;
    }

    $stm = $db->query("select $select from $from WHERE $where $orderby " . $limit);
    $stm->execute();


    $res['total'] = $total_pages;
    $res['rows'] = $stm->fetchAll(PDO::FETCH_ASSOC);
    $res['page'] = $_GET['page'];
    $res['records'] = $count;
    echo json_encode($res);
    //die();
}