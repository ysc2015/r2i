<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 10/04/2017
 * Time: 16:23
 */

extract($_POST);

extract($_GET);

$stm = $db->prepare("select * from wiki_categorie where id = $idcat");

$stm->execute();

$cat = $stm->fetchAll(PDO::FETCH_ASSOC) [0];

echo json_encode(array("cat" => $cat));