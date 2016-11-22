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

        $stm2 = $db->prepare("insert into  sous_projet_plaque (id_sous_projet,phase,type) values (:id_sous_projet,:phase,:type)");
        $stm3 = $db->prepare("insert into  sous_projet_zone (id_sous_projet,nbr_zone,lr_sur_pm,lr,nbr_de_site,nb_fo_sur_pm,nb_fo_sur_pmz) values (:id_sous_projet,:nbr_zone,:lr_sur_pm,:lr,:nbr_de_site,:nb_fo_sur_pm,:nb_fo_sur_pmz)");//
        $stm4 = $db->prepare("insert into  sous_projet_site_origine (id_sous_projet,auto_adduction,travaux_adduction,recette_adduction) values (:id_sous_projet,:auto_adduction,:travaux_adduction,:recette_adduction)");
        $stm5 = $db->prepare("insert into  sous_projet_plaque_phase (id_sous_projet,instigateur) values (:id_sous_projet,:instigateur)");

        if(!$i) {

            echo $sousprojet['lib_nro']."-".$sousprojet['zone']." ***********";

            $stm2->bindParam(':id_sous_projet',$sousprojet['id_sous_projet']);
            $stm3->bindParam(':id_sous_projet',$sousprojet['id_sous_projet']);
            $stm4->bindParam(':id_sous_projet',$sousprojet['id_sous_projet']);
            $stm5->bindParam(':id_sous_projet',$sousprojet['id_sous_projet']);

            /**
             * stm2 sous_projet_plaque
             */

            $stm2->bindParam(':phase',$abkp_line->phase);
            echo "phase -> ".$abkp_line->phase;


            $type = SelectPlaqueType::first(
                array('conditions' =>
                    array("lib_plaque_type = ?", $abkp_line->type1)
                )
            );
            $idtype = ($type!==NULL?$type->id_plaque_type:NULL);
            $stm2->bindParam(':type',$idtype);
            echo "type -> ".$idtype;

            /**
             * stm3 sous_projet_zone
             */

            $stm3->bindParam(':nbr_zone',$abkp_line->nb_zone_plaque);
            echo "nbr_zone -> ".$abkp_line->nb_zone_plaque;

            $stm3->bindParam(':lr_sur_pm',$abkp_line->lr_pm_exist);
            echo "lr_sur_pm -> ".$abkp_line->lr_pm_exist;

            $stm3->bindParam(':lr',$abkp_line->lr);
            echo "lr -> ".$abkp_line->lr;

            $stm3->bindParam(':nbr_de_site',$abkp_line->nbr_site);
            echo "nbr_de_site -> ".$abkp_line->nbr_site;

            $stm3->bindParam(':nb_fo_sur_pm',$abkp_line->nb_fo_pm);
            echo "nb_fo_sur_pm -> ".$abkp_line->nb_fo_pm;

            $stm3->bindParam(':nb_fo_sur_pmz',$abkp_line->nb_fo_pmz);
            echo "nb_fo_sur_pmz -> ".$abkp_line->nb_fo_pmz;

            $auto1 = SelectSiteOrigineAutoAdduction::first(
                array('conditions' =>
                    array("lib_site_origine_auto_adduction = ?", $abkp_line->auto_adduction)
                )
            );
            $idauto1 = ($auto1!==NULL?$auto1->id_site_origine_auto_adduction:NULL);
            $stm3->bindParam(':auto_adduction',$idauto1);
            echo "auto_adduction -> ".$idauto1;


            $auto2 = SelectSiteOrigineTravauxAdduction::first(
                array('conditions' =>
                    array("lib_site_origine_travaux_adduction = ?", $abkp_line->travaux_adduction)
                )
            );
            $idauto2 = ($auto2!==NULL?$auto2->id_site_origine_travaux_adduction:NULL);
            $stm3->bindParam(':travaux_adduction',$idauto2);
            echo "travaux_adduction -> ".$idauto2;


            $auto3 = SelectSiteOrigineRecetteAdduction::first(
                array('conditions' =>
                    array("lib_site_origine_recette_adduction = ?", $abkp_line->recette_adduction)
                )
            );
            $idauto3 = ($auto3!==NULL?$auto3->id_site_origine_recette_adduction:NULL);
            $stm3->bindParam(':recette_adduction',$idauto3);
            echo "recette_adduction -> ".$idauto3;


            $instigateur = SelectPhaseInstigateur::first(
                array('conditions' =>
                    array("lib_phase_instigateur = ?", $abkp_line->instigateur)
                )
            );
            $idinstigateur = ($instigateur!==NULL?$instigateur->id_phase_instigateur:NULL);
            $stm3->bindParam(':instigateur',$idinstigateur);
            echo "instigateur -> ".$idinstigateur;

            $i++;
        }

        $injected_sub_projects_details++;
    }

}

echo $injected_sub_projects_details;