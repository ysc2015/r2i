<?php
/**
 * file: inserts_sub_projects_details.php
 * User: rabii
 */

$stm = $db->prepare("select sp.*,n.lib_nro from sous_projet as sp,projet as p, nro as n where sp.id_projet = p.id_projet and p.id_nro = n.id_nro");

$stm->execute();

$sousprojets = $stm->fetchAll();

$i=0;

$injected_sub_projects_details = 0;

foreach($sousprojets as $sousprojet)
{
    $abkp_line = Abkp::find(
        array('conditions' =>
            array("Zone = ?", $sousprojet['plaque']."-".$sousprojet['zone'])
        )
    );

    if($abkp_line !== NULL) {
        $injected_sub_projects_details++;
    }

}

echo $injected_sub_projects_details;