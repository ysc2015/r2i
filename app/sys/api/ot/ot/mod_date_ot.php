<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 29/06/2017
 * Time: 09:04
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("update ordre_de_travail set date_debut=:date_debut,date_fin=:date_fin where id_ordre_de_travail=:id_ordre_de_travail");

$OT = NULL;



if(isset($idot) && !empty($idot)){

    $stm->bindParam(':id_ordre_de_travail',$idot);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence OT invalide !";
}

if(isset($date1) && !empty($date1)){
    $stm->bindParam(':date_debut',$date1);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs date début est obligatoire !";
}

if(isset($date2) && !empty($date2)){
    $stm->bindParam(':date_fin',$date2);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs date fin est obligatoire !";
}

if(isset($date1) && !empty($date1) && isset($date2) && !empty($date2)) {
    $dd = DateTime::createFromFormat('Y-m-d', $date1);
    $df = DateTime::createFromFormat('Y-m-d', $date2);

    if($dd > $df) {
        $err++;
        $message[] = "La date de fin doit étre supérieure ou égale à la date de début !";
    } else {
        $stm2 = $db->prepare("select * from ordre_de_travail where (id_entreprise=:id_entreprise and id_equipe_stt=:id_equipe_stt and date_debut <= :date_debut and date_fin >= :date_debut) or (id_entreprise=:id_entreprise and id_equipe_stt=:id_equipe_stt and date_debut <= :date_fin and date_fin >= :date_fin) or (id_entreprise=:id_entreprise and id_equipe_stt=:id_equipe_stt and date_debut >= :date_debut and date_fin <= :date_fin)");
        $stm2->bindParam(':id_entreprise',$ide);
        $stm2->bindParam(':id_equipe_stt',$ideq);
        $stm2->bindParam(':date_fin',$date2);
        $stm2->bindParam(':date_debut',$date1);
        $stm2->execute();
        $results = $stm2->fetchAll();

        if($stm2->rowCount() > 0) {
            $err++;
            $message[] = "Cette équipe a été déjà programée un ou plusieurs jours de la période choisie !";
        }
    }
}

if($insert == true && $err == 0){
    if($stm->execute()){

        $message [] = "Modification faite avec succès";

        /**
         * maj etapes fields
         */

        $OT = OrdreDeTravail::first(
            array('conditions' =>
                array("id_ordre_de_travail = ?", $idot)
            )
        );

        $tentree = array();

        $sousProjet = SousProjet::first(
            array('conditions' =>
                array("id_sous_projet = ?", $OT->id_sous_projet)
            )
        );


        /*if($ot->id_etat_ot == 1) {
            $ot->id_etat_ot = 2;
        } else {
            $ot->id_etat_ot = 8;
        }
        $ot->save();*/

        if($sousProjet !== NULL) {
            switch($OT->id_type_ordre_travail) {
                case "1" :
                    $tentree[] = array("transportaiguillage","date_aiguillage");//(step,begin step date field):end field is the same for all steps
                    break;
                case "2" :
                    $tentree[] = array("transporttirage","date_tirage");
                    break;
                case "3" :
                    $tentree[] = array("transportraccordement","date_racco");
                    break;
                case "4" :
                    $tentree[] = array("transporttirage","date_tirage");
                    $tentree[] = array("transportraccordement","date_racco");
                    break;
                case "5" :
                    $tentree[] = array("distributionaiguillage","date_aiguillage");
                    break;
                case "6" :
                    $tentree[] = array("distributiontirage","date_tirage");
                    break;
                case "7" :
                    $tentree[] = array("distributionraccordement","date_racco");
                    break;
                case "8" :
                    $tentree[] = array("distributiontirage","date_tirage");
                    $tentree[] = array("distributionraccordement","date_racco");
                    break;
                case "9" :
                    $tentree[] = array("transportrecette","date_recette");
                    break;
                case "10" :
                    $tentree[] = array("distributionrecette","date_recette");
                    break;
                default :
                    break;
            }

            foreach($tentree as $key => $value) {
                if($sousProjet->{$value[0]} == NULL) {
                    switch($value[0]) {
                        case "transportaiguillage" :
                            $step = new SousProjetTransportAiguillage(array(
                                'id_sous_projet' => $OT->id_sous_projet));
                            $step->save();
                            break;
                        case "transporttirage" :
                            $step = new SousProjetTransportTirage(array(
                                'id_sous_projet' => $OT->id_sous_projet));
                            $step->save();
                            break;
                        case "transportraccordement" :
                            $step = new SousProjetTransportRaccordement(array(
                                'id_sous_projet' => $OT->id_sous_projet));
                            $step->save();
                            break;
                        case "distributionaiguillage" :
                            $step = new SousProjetDistributionAiguillage(array(
                                'id_sous_projet' => $OT->id_sous_projet));
                            $step->save();
                            break;
                        case "distributiontirage" :
                            $step = new SousProjetDistributionTirage(array(
                                'id_sous_projet' => $OT->id_sous_projet));
                            $step->save();
                            break;
                        case "distributionraccordement" :
                            $step = new SousProjetDistributionRaccordement(array(
                                'id_sous_projet' => $OT->id_sous_projet));
                            $step->save();
                            break;
                        case "transportrecette" :
                            $step = new SousProjetTransportRecette(array(
                                'id_sous_projet' => $OT->id_sous_projet));
                            $step->save();
                            break;
                        case "distributionrecette" :
                            $step = new SousProjetDistributionRecette(array(
                                'id_sous_projet' => $OT->id_sous_projet));
                            $step->save();
                            break;
                        default : break;
                    }
                }

                /*$sousProjet->{$value[0]}->date_transmission_plans = NULL;
                $sousProjet->{$value[0]}->date_retour = NULL;
                $sousProjet->{$value[0]}->lien_plans = NULL;
                $sousProjet->{$value[0]}->retour_presta = NULL;*/
                $sousProjet->{$value[0]}->controle_demarrage_effectif = $OT->id_etat_ot;
                $sousProjet->{$value[0]}->id_entreprise	 = $OT->id_entreprise;
                $sousProjet->{$value[0]}->{$value[1]} = $OT->date_debut;
                $sousProjet->{$value[0]}->date_ret_prevue = $OT->date_fin;
                $sousProjet->{$value[0]}->duree = getDuree($OT->date_debut,$OT->date_fin);
                $sousProjet->{$value[0]}->save();

            }
        }

        /**
         * end maj etapes fields
         */

    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message, "results" => $results));