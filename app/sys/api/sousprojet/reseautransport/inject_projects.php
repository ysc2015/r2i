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

    $stm = $db->prepare("insert into projet (ville_nom,ville,trigramme_dept,id_nro,type_site_origine,taille,etat_site_origine,date_mad_site_origine,date_creation) values (:ville_nom,:ville,:trigramme_dept,:id_nro,:type_site_origine,:taille,:etat_site_origine,:date_mad_site_origine,:date_creation)");

    /*$stm->bindParam(':ville_nom',$ville_nom);
    $stm->bindParam(':ville',$ville);
    $stm->bindParam(':trigramme_dept',$trigramme_dept);
    $stm->bindParam(':id_nro',$id_nro);
    $stm->bindParam(':type_site_origine',$type_site_origine);
    $stm->bindParam(':taille',$taille);
    $stm->bindParam(':etat_site_origine',$etat_site_origine);
    $stm->bindParam(':date_mad_site_origine',$date_mad_site_origine);
    $stm->bindParam(':date_creation',date('Y-m-d'));
    $project_name = "Etude Plaque PON FTTH ".$id_nro." ".$ville_nom;*/

    if(!$i) {

        //var_dump($prj_infos);

        echo "ville_nom -> ".$prj_infos->ville;
        echo "ville -> ".$prj_infos->dep;
        echo "trigramme_dept -> ".$prj_infos->emprise;


        echo "id_nro -> ".$prj_infos->dep;
        echo "type_site_origine -> ".$prj_infos->dep;
        echo "taille -> "."0";
        echo "etat_site_origine -> "."1";
        echo "date_mad_site_origine -> "."2016-07-01";
        echo "date_creation -> ".$prj_infos->date_Lancement;
        $i++;
    }

    $injected_prj_nbr++;
}

echo $injected_prj_nbr;
