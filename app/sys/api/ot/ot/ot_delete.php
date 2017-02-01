<?php
/**
 * file: ot_delete.php
 * User: rabii
 */

extract($_POST);

$delete = false;
$err = 0;
$message = array();

$ot = OrdreDeTravail::first(
            array('conditions' =>
                array("id_ordre_de_travail = ?", $idot)
            )
        );

$idsp = $ot->id_sous_projet;
$type_ot = $ot->id_type_ordre_travail;


$stm = $db->prepare("delete from ordre_de_travail where id_ordre_de_travail=:id_ordre_de_travail");

if(isset($idot) && !empty($idot)){
    $stm->bindParam(':id_ordre_de_travail',$idot);
    $delete = true;
} else {
    $err++;
    $message[] = "Référence OT invalide !";
}

if($delete == true && $err == 0){
    if($stm->execute()){
        $message [] = "OT supprimé avec succès";

        /**
         * maj etapes fields
         */

        $tentree = array();

        $sousProjet = SousProjet::first(
            array('conditions' =>
                array("id_sous_projet = ?", $idsp)
            )
        );

        if($sousProjet !== NULL) {
            switch($type_ot) {
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
                if($sousProjet->{$value[0]} !== NULL) {
                    /*switch($value[0]) {
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
                    }*///

                    $sousProjet->{$value[0]}->controle_demarrage_effectif = NULL;
                    $sousProjet->{$value[0]}->date_transmission_plans = NULL;
                    $sousProjet->{$value[0]}->date_retour = NULL;
                    //$sousProjet->{$value[0]}->lien_plans = NULL;
                    $sousProjet->{$value[0]}->retour_presta = NULL;
                    $sousProjet->{$value[0]}->id_entreprise	 = NULL;
                    $sousProjet->{$value[0]}->{$value[1]} = NULL;
                    $sousProjet->{$value[0]}->date_ret_prevue = NULL;
                    $sousProjet->{$value[0]}->duree = NULL;
                    $sousProjet->{$value[0]}->save();
                }

            }
        }

        /**
         * end maj etapes fields
         */
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>