<?php
/**
 * file: affecter_ot_team.php
 * User: rabii
 */

extract($_POST);

$results = NULL;

$insert = false;
$err = 0;
$message = array();

$tentree = array();

$ot = OrdreDeTravail::first(
    array('conditions' =>
        array("id_ordre_de_travail = ?", $idot)
    )
);

$sousProjet = SousProjet::first(
    array('conditions' =>
        array("id_sous_projet = ?", $idsp)
    )
);

if($ot->date_debut == NULL || $ot->date_debut=="") {
    $stm = $db->prepare("update ordre_de_travail set id_entreprise=:id_entreprise,id_equipe_stt=:id_equipe_stt,date_debut=:date_debut,date_fin=:date_fin where id_ordre_de_travail=:id_ordre_de_travail");

    if(isset($idot) && !empty($idot)){
        $stm->bindParam(':id_ordre_de_travail',$idot);
        $insert = true;
    } else {
        $err++;
        $message[] = "Référence OT invalide !";
    }

    if(isset($ide) && !empty($ide)){
        $stm->bindParam(':id_entreprise',$ide);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs entreprise est obligatoire !";
    }

    if(isset($ideq) && !empty($ideq)){
        $stm->bindParam(':id_equipe_stt',$ideq);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs equipe est obligatoire !";
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
            $stm2 = $db->prepare("select * from ordre_de_travail where (date_debut <= :date_debut and date_fin >= :date_debut) or (date_debut <= :date_fin and date_fin >= :date_fin) or (date_debut >= :date_debut and date_fin <= :date_fin)");
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



} else {
    $err++;
    $message[] = "Cet OT est déjà affecté, supprimer son affectation pour le réaffecter !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Affectation faite avec succès";
        //update matching step(s)
        if($sousProjet !== NULL) {
            switch($idtot) {
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
                default :
                    break;
            }

            foreach($tentree as $key => $value) {
                if($sousProjet->{$value[0]} == NULL) {
                    switch($value[0]) {
                        case "transportaiguillage" :
                            $step = new SousProjetTransportAiguillage(array(
                                'id_sous_projet' => $idsp));
                            $step->save();
                            break;
                        case "transporttirage" :
                            $step = new SousProjetTransportTirage(array(
                                'id_sous_projet' => $idsp));
                            $step->save();
                            break;
                        case "transportraccordement" :
                            $step = new SousProjetTransportRaccordement(array(
                                'id_sous_projet' => $idsp));
                            $step->save();
                            break;
                        case "distributionaiguillage" :
                            $step = new SousProjetDistributionAiguillage(array(
                                'id_sous_projet' => $idsp));
                            $step->save();
                            break;
                        case "distributiontirage" :
                            $step = new SousProjetDistributionTirage(array(
                                'id_sous_projet' => $idsp));
                            $step->save();
                            break;
                        case "distributionraccordement" :
                            $step = new SousProjetDistributionRaccordement(array(
                                'id_sous_projet' => $idsp));
                            $step->save();
                            break;
                        default : break;
                    }
                }

                $sousProjet->{$value[0]}->id_entreprise	 = $ide;
                $sousProjet->{$value[0]}->{$value[1]} = $date1;
                $sousProjet->{$value[0]}->date_ret_prevue = $date2;
                $sousProjet->{$value[0]}->duree = getDuree($date1,$date2);
                $sousProjet->{$value[0]}->save();
            }
        }

    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message, "results" => $results));
