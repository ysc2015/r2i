<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 05/04/2017
 * Time: 11:20
 */

extract($_POST);
extract($_GET);

$sql = "select a.* from (
    select n.id_nro,n.lib_nro,u.id_utilisateur,u.email_utilisateur from nro n, utilisateur u
    where n.id_utilisateur = u.id_utilisateur
    union
    select nu.id_nro,n.lib_nro,nu.id_utilisateur,u.email_utilisateur from nro n, utilisateur u, nro_utilisateur nu
    where nu.id_nro = n.id_nro and nu.id_utilisateur = u.id_utilisateur
    ) a
";

if(isset($idn) && !empty($idn)) $sql .= "where a.lib_nro IN ($idn)";

$stm = $db->prepare($sql);

$stm->execute();

$nu = $stm->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($nu);