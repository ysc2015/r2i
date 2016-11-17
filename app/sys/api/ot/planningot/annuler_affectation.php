<?php
/**
 * file: annuler_affectation.php
 * User: rabii
 */

extract($_POST);

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

if($ot !== NULL) {
    $stm = $db->prepare("update ordre_de_travail set id_entreprise=NULL,id_equipe_stt=NULL,date_debut=NULL,date_fin=NULL where id_ordre_de_travail=:id_ordre_de_travail");

    if(isset($idot) && !empty($idot)){
        $stm->bindParam(':id_ordre_de_travail',$idot);
        $insert = true;
    } else {
        $err++;
        $message[] = "Référence OT invalide !";
    }

} else {
    $err++;
    $message[] = "OT non défini ou a été supprimé !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Affectation annulée avec succès";
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

                $sousProjet->{$value[0]}->id_entreprise	 = NULL;
                $sousProjet->{$value[0]}->{$value[1]} = NULL;
                $sousProjet->{$value[0]}->date_ret_prevue = NULL;
                $sousProjet->{$value[0]}->duree = getDuree(NULL,NULL);
                $sousProjet->{$value[0]}->save();
            }
        }
    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));