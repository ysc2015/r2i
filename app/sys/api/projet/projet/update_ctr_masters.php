<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 13/04/2017
 * Time: 10:53
 */

$stm = $db->prepare("select * from sous_projet where is_master = 1");
$stm->execute();

$masters = $stm->fetchAll(PDO::FETCH_ASSOC);

foreach($masters as $master) {

    //var_dump($master);

    //echo $master['id_sous_projet'];


    $idspm = $master['id_sous_projet'];
    $idp = $master['id_projet'];

    $ustm = $db->prepare("update sous_projet set id_master_ctr = $idspm where id_projet = $idp");

    $ustm->execute();

}

echo "mise à jour réussite";

