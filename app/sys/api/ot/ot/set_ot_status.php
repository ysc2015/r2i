<?php
/**
 * file: set_ot_status.php
 * User: rabii
 */

extract($_POST);

$err=0;
$message = array();
$stm = NULL;

if(isset($status) && !empty($status) && isset($idot) && !empty($idot)) {
    $stm = $db->prepare("update ordre_de_travail set id_etat_ot = $status where id_ordre_de_travail=$idot");
} else {
    $err++;
    $message[] = "Paramétres de MAJ statut OT incorrects !";
}

if($err==0) {
    if($stm->execute()) {
        $message[] = "MAJ réussite !";

        if($status == 3 || $status == 5) {
            /**
             * maj etapes fields
             */

            $ot = OrdreDeTravail::first(
                array('conditions' =>
                    array("id_ordre_de_travail = ?", $idot)
                )
            );

            $tentree = array();

            $sousProjet = SousProjet::first(
                array('conditions' =>
                    array("id_sous_projet = ?", $ot->id_sous_projet)
                )
            );

            if($sousProjet !== NULL) {
                switch($ot->id_type_ordre_travail) {
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
                            case "transportrecette" :
                                $step = new SousProjetTransportRecette(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                break;
                            case "distributionrecette" :
                                $step = new SousProjetDistributionRecette(array(
                                    'id_sous_projet' => $idsp));
                                $step->save();
                                break;
                            default : break;
                        }
                    }

                    if($status == 3) {
                        $sousProjet->{$value[0]}->date_transmission_plans = date('Y-m-d');
                    } else {
                        $sousProjet->{$value[0]}->controle_demarrage_effectif = $status;
                    }
                    $sousProjet->{$value[0]}->save();

                }
            }

            /**
             * end maj etapes fields
             */
        }
    }
} else {
    $err++;
    $message[] = $stm->errorInfo();
}

echo json_encode(array("error" => $err , "message" => $message));

