<?php
/**
 * file: inject_sousprojets.php
 * User: rabii
 */

$stm = $db->prepare("select * from projet");

$stm->execute();

$projets = $stm->fetchAll();

$i=0;

foreach($projets as $projet)
{
    $plaques = Abkp::first(
        array('conditions' =>
            array("Emprise = ?", $projet['trigramme_dept'])
        )
    );

    if(!$i) {
        var_dump($plaques);
        $i++;
    }

    $insert_stm = $db->prepare("insert into sous_projet(id_projet_osa,id_projet,dep,ville,plaque,zone) values (0,:id_projet,:dep,:ville,:plaque,:zone)");

}