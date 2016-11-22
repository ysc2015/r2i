<?php
/**
 * file: inject_sousprojets.php
 * User: rabii
 */

$stm = $db->prepare("select * from projet");

$projets = $stm->fetchAll();

foreach($projets as $projet)
{
    echo $projet['id_projet'];

}