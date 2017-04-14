<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 13/04/2017
 * Time: 11:36
 */

$smasters = array();

$sql = "select t1.id_sous_projet,";
$sql .= "if(t6.lineaire1 is not null and t6.lineaire1 <> '' and t6.lineaire1 <> '0',t6.lineaire1,t5.lineaire1) as t6_lineaire1,";
$sql .= "if(t6.lineaire2 is not null and t6.lineaire2 <> '' and t6.lineaire2 <> '0',t6.lineaire2,t5.lineaire2) as t6_lineaire2,";
$sql .= "if(t6.lineaire3 is not null and t6.lineaire3 <> '' and t6.lineaire3 <> '0',t6.lineaire3,t5.lineaire3) as t6_lineaire3,";
$sql .= "if(t6.lineaire4 is not null and t6.lineaire4 <> '' and t6.lineaire4 <> '0',t6.lineaire4,t5.lineaire4) as t6_lineaire4,";
$sql .= "t6.lineaire9 as t6_lineaire9,";
$sql .= "t6.lineaire10 as t6_lineaire10,";
$sql .= "t6.lineaire11 as t6_lineaire11,";
$sql .= "t6.lineaire12 as t6_lineaire12,";
$sql .= "if(t6.lineaire5 is not null and t6.lineaire5 <> '' and t6.lineaire5 <> '0',t6.lineaire5,t5.lineaire5) as t6_lineaire5,";
$sql .= "if(t6.lineaire6 is not null and t6.lineaire6 <> '' and t6.lineaire6 <> '0',t6.lineaire6,t5.lineaire6) as t6_lineaire6,";
$sql .= "if(t6.lineaire7 is not null and t6.lineaire7 <> '' and t6.lineaire7 <> '0',t6.lineaire7,t5.lineaire7) as t6_lineaire7,";
$sql .= "if(t6.lineaire8 is not null and t6.lineaire8 <> '' and t6.lineaire8 <> '0',t6.lineaire8,t5.lineaire8) as t6_lineaire8,";
$sql .= "if(t6.lineaire13>'0',t6.lineaire13,t5.lineaire9) as t6_lineaire13,";
$sql .= "if(t6.lineaire14>'0',t6.lineaire14,t5.lineaire10) as t6_lineaire14";
$sql .= " from sous_projet t1";
$sql .= " left join sous_projet_transport_aiguillage t5 on t1.id_sous_projet = t5.id_sous_projet";
$sql .= " left join sous_projet_transport_tirage t6 on t1.id_sous_projet = t6.id_sous_projet";
$sql .= " where is_master = 1";

//$stm = $db->prepare("select * from sous_projet where is_master = 1");
$stm = $db->prepare("$sql");

$stm->execute();

$masters = $stm->fetchAll(PDO::FETCH_ASSOC);

foreach($masters as $master) {

    $id = $master['id_sous_projet'];

    $smasters[$id] = $master;
}

echo json_encode(array("masters" => $smasters));