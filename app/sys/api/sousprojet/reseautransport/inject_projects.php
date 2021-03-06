<?php
/**
 * file: inject_projects.php
 * User: rabii
 */

$str = "";

$list_plq_statment = $db->prepare("SELECT DISTINCT  Emprise FROM  abkp WHERE 1");
$list_plq_statment->execute();
$plaques = $list_plq_statment->fetchAll(PDO::FETCH_ASSOC);

$injected_prj_nbr = 0;

$i = 0;

foreach($plaques as $plaque) {
    $prj_infos = Abkp::first(
        array('conditions' =>
            array("Emprise = ?", $plaque)
        )
    );

    $stm = $db->prepare("insert into projet (ville_nom,ville,trigramme_dept,id_nro,type_site_origine,taille,etat_site_origine,date_mad_site_origine,date_creation) values (:ville_nom,:ville,:trigramme_dept,:id_nro,:type_site_origine,0,8,'2016-07-01',:date_creation)");

    $stm->bindParam(':ville_nom',$prj_infos->ville);
    $stm->bindParam(':ville',$prj_infos->dep);
    $stm->bindParam(':trigramme_dept',$prj_infos->emprise);

    $nro = Nro::first(
        array('conditions' =>
            array("lib_nro = ?", explode('-',$prj_infos->zone)[0])
        )
    );
    $idnro = ($nro!==NULL?$nro->id_nro:NULL);
    $stm->bindParam(':id_nro',$idnro);

    $typesite = SelectSiteOrigineType::first(
        array('conditions' =>
            array("lib_site_origine_type = ?", $prj_infos->type2)
        )
    );
    $idtype = ($typesite!==NULL?$typesite->id_site_origine_type:NULL);
    $stm->bindParam(':type_site_origine',$idtype);

    $stm->bindParam(':date_creation',$prj_infos->date_lancement);

    if($stm->execute()) {
        $injected_prj_nbr++;
    }

    /*if(!$i) {

        var_dump($prj_infos);

        echo "ville_nom -> ".$prj_infos->ville;
        echo "ville -> ".$prj_infos->dep;
        echo "trigramme_dept -> ".$prj_infos->emprise;

        $nro = Nro::first(
            array('conditions' =>
                array("lib_nro = ?", explode('-',$prj_infos->zone)[0])
            )
        );
        echo "id_nro -> ".($nro!==NULL?$nro->id_nro:NULL);

        $typesite = SelectSiteOrigineType::first(
            array('conditions' =>
                array("lib_site_origine_type = ?", $prj_infos->type2)
            )
        );
        echo "type_site_origine -> ".($typesite!==NULL?$typesite->id_site_origine_type:NULL);

        echo "taille -> "."0";
        echo "etat_site_origine -> "."1";
        echo "date_mad_site_origine -> "."2016-07-01";
        echo "date_creation -> ".$prj_infos->date_lancement;
        $i++;
    }*/
}

echo $injected_prj_nbr;
