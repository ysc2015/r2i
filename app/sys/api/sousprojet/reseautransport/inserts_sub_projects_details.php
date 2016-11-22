<?php
/**
 * file: inserts_sub_projects_details.php
 * User: rabii
 */

$stm = $db->prepare("select * from sous_projet");

$stm->execute();

$sousprojets = $stm->fetchAll();

$i=0;

$injected_sub_projects_details = 0;

foreach($sousprojets as $sousprojet)
{
    $abkp_line = Abkp::all(
        array('conditions' =>
            array("Zone = ?", $sousprojet['plaque']."-".$sousprojet['zone'])
        )
    );

    /*if($abkp_lines !== NULL) {
        foreach($abkp_lines as $abkp_line) {
            $insert_stm = $db->prepare("insert into sous_projet(id_projet_osa,id_projet,dep,ville,plaque,zone) values (0,:id_projet,:dep,:ville,:plaque,:zone)");

            $insert_stm->bindParam(':id_projet',$projet['id_projet']);
            $insert_stm->bindParam(':dep',$projet['ville']);
            $insert_stm->bindParam(':ville',$projet['ville_nom']);
            $insert_stm->bindParam(':plaque',$projet['trigramme_dept']);
            $insert_stm->bindParam(':zone',explode('-',$abkp_line->zone)[1]);

            if($insert_stm->execute()) {
                $injected_sub_projects++;
            }
        }
    }*/

    if(!$i) {
        var_dump($abkp_line);
        $i++;
    }

    //echo $injected_sub_projects_details;

}