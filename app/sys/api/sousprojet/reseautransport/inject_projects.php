<?php
/**
 * file: inject_projects.php
 * User: rabii
 */

$str = "";

$list_plq_statment = $db->prepare("SELECT DISTINCT  Emprise FROM  abkp WHERE 1");
$list_plq_statment->execute();
$plaques = $list_plq_statment->fetchAll(PDO::FETCH_ASSOC);

$i = 0;

foreach($plaques as $plaque) {
    $prj_infos = Abkp::first(
        array('conditions' =>
            array("Emprise = ?", $plaque)
        )
    );

    if(!$i) {
        var_dump($prj_infos);
        $i++;
    }
}
