<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 05/04/2017
 * Time: 11:19
 */

$stm = $db->prepare("select n.id_nro, n.lib_nro from nro n where 1 order by id_nro asc");

$stm->execute();

$nros = $stm->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($nros);