<?php
/**
 * file: myot_upload_retour.php
 * User: rabii
 */

ini_set("display_errors",'1');
//sleep(2);

$output_dir = __DIR__."/../../uploads/sousprojets/";
extract($_POST);

$ret = array();

$ok = false;

$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (id_sous_projet,id_ordre_de_travail,id_type_ordre_travail,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_sous_projet,:id_ordre_de_travail,:id_type_ordre_travail,'stt_retour_terrain',:nom_fichier,:nom_fichier_disque,'sousprojets',:date_creation)");

if(isset($idot) && !empty($idot)) {
    $stm->bindParam(':id_ordre_de_travail',$idot);
    $stm->bindParam(':id_sous_projet',$idsp);
    $stm->bindParam(':id_type_ordre_travail',$idtot);
    if (isset($_FILES["myfile"])) {
        $error = $_FILES["myfile"]["error"];
        if (!is_array($_FILES["myfile"]["name"])) {

            $fileName = time() . "_" . $_FILES["myfile"]["name"];

            $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
            $stm->bindParam(':nom_fichier_disque',$fileName);
            $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

            if($stm->execute()) {
                $ok = true;
                $details = array();
                $details['name'] = $db->lastInsertId()."_".time() . "_" . $_FILES["myfile"]["name"];
                $details['id'] = $db->lastInsertId();

                $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$details:[]);
            }

        } else  {
            $fileCount = count($_FILES["myfile"]["name"]);
            for ($i = 0; $i < $fileCount; $i++) {

                $fileName = time() . "_" . $_FILES["myfile"]["name"][$i];

                $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
                $stm->bindParam(':nom_fichier_disque',$fileName);
                $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

                if($stm->execute()) {
                    $ok = true;
                    $details = array();
                    $details['name'] = $db->lastInsertId()."_".time() . "_" . $_FILES["myfile"]["name"];
                    $details['id'] = $db->lastInsertId();

                    $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$details:[]);
                }
            }
        }

        if($ok) {
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

                    $sousProjet->{$value[0]}->date_retour = date('Y-m-d');
                    $sousProjet->{$value[0]}->save();

                }
            }

            /**
             * end maj etapes fields
             */
        }
    }
}

echo json_encode($ret);