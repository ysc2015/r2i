<?php
/**
 * file: inserts_sub_projects_details.php
 * User: rabii
 */

$stm1 = $db->prepare("select sp.*,n.lib_nro from sous_projet as sp,projet as p, nro as n where sp.id_projet = p.id_projet and p.id_nro = n.id_nro");

$stm1->execute();

$sousprojets = $stm1->fetchAll();

$i=0;

$injected_sub_projects_details = 0;

foreach($sousprojets as $sousprojet)
{
    $abkp_line = Abkp::find(
        array('conditions' =>
            array("Zone = ?", $sousprojet['lib_nro']."-".$sousprojet['zone'])
        )
    );

    if($abkp_line !== NULL) {

        $stm2 = $db->prepare("insert into  sous_projet_plaque (id_sous_projet,phase,type) values ()");
        $stm3 = $db->prepare("insert into  sous_projet_zone (id_sous_projet,nbr_zone,lr_sur_pm,lr,nbr_de_site,nb_fo_sur_pm,nb_fo_sur_pmz) values (");//
        $stm4 = $db->prepare("insert into  sous_projet_site_origine (id_sous_projet,auto_adduction,travaux_adduction,recette_adduction) values ()");
        $stm5 = $db->prepare("insert into  sous_projet_plaque_phase (id_sous_projet,instigateur) values ()");


        $injected_sub_projects_details++;
    }

}

echo $injected_sub_projects_details;