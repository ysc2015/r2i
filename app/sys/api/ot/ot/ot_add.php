<?php
/**
 * file: ot_add.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("insert into ordre_de_travail (id_sous_projet,id_etat_ot,type_entree,id_type_ordre_travail,type_ot,commentaire) values (:id_sous_projet,1,:type_entree,:id_type_ordre_travail,:type_ot,:commentaire)");

if(isset($idsp) && !empty($idsp)){
    $stm->bindParam(':id_sous_projet',$idsp);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($tentree) && !empty($tentree)){
    if($tentree == "transportraccordement") $tentree = "transporttirage";
    if($tentree == "distributionraccordement") $tentree = "distributiontirage";
    $stm->bindParam(':type_entree',$tentree);
    $insert = true;
} else {
    $err++;
    $message[] = "Type entrée invalide  !";
}

if(isset($type_ot_text) && !empty($type_ot_text)){
    $stm->bindParam(':type_ot',$type_ot_text);
    $insert = true;
} else {
    $err++;
    $message[] = "Type entrée invalide  !";
}

if(isset($type_ot) && !empty($type_ot)){
    $stm->bindParam(':id_type_ordre_travail',$type_ot);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs type ot est obligatoire !";
}

if(isset($commentaire)){
    $stm->bindParam(':commentaire',$commentaire);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";

        /**
         * maj etapes fields
         */

        /*$ot = OrdreDeTravail::first(
            array('conditions' =>
                array("id_ordre_de_travail = ?", $db->lastInsertId())
            )
        );*/

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

                $sousProjet->{$value[0]}->controle_demarrage_effectif	 = 1;
                $sousProjet->{$value[0]}->date_transmission_plans = NULL;
                $sousProjet->{$value[0]}->date_retour = NULL;
                $sousProjet->{$value[0]}->lien_plans = NULL;
                $sousProjet->{$value[0]}->retour_presta = NULL;
                $sousProjet->{$value[0]}->id_entreprise	 = NULL;
                $sousProjet->{$value[0]}->{$value[1]} = NULL;
                $sousProjet->{$value[0]}->date_ret_prevue = NULL;
                $sousProjet->{$value[0]}->duree = NULL;
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
echo json_encode(array("error" => $err , "message" => $message));
?>