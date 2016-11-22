<?php
/**
 * file: inject_sousprojets.php
 * User: rabii
 */

$stm = $db->prepare("select * from projet");

$stm->execute();

$projets = $stm->fetchAll();

$i=0;

$injected_sub_projects = 0;

foreach($projets as $projet)
{
    $plaques = Abkp::all(
        array('conditions' =>
            array("Emprise = ?", $projet['trigramme_dept'])
        )
    );

    if($plaques !== NULL) {
        foreach($plaques as $plaque) {
            $insert_stm = $db->prepare("insert into sous_projet(id_projet_osa,id_projet,dep,ville,plaque,zone) values (0,:id_projet,:dep,:ville,:plaque,:zone)");

            $insert_stm->bindParam(':id_projet',$projet['']);
            $insert_stm->bindParam(':dep',$projet['ville']);
            $insert_stm->bindParam(':ville',$projet['ville_nom']);
            $insert_stm->bindParam(':plaque',$projet['trigramme_dept']);
            $insert_stm->bindParam(':zone',explode('-',$plaque->zone)[1]);

            if($insert_stm->execute()) {
                $injected_sub_projects++;
            }
        }
    }

    /*if(!$i) {
        $i++;
    }*/

    echo $injected_sub_projects;

}