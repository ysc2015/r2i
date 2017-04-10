<?php
/**
 * file: get_devis_id.php
 * User: rabii
 */
extract($_POST);
$iddevis = 0;
$idres = 0;
$rem = '';

$ot = NULL;

$stm = NULL;

$detailsDevis = NULL;


$sousProjet = NULL;

switch($idtot) {
    case "1" :
    case "3" :
    case "4" :
    case "5" :
    case "7" :
    case "8" :
/*    case "9" :
    case "10" :*/
        $stm = $db->prepare("select detaildevis.iddevis,detaildevis.id_ressource,ordre_de_travail.commentaire2 from detaildevis,ressource,ordre_de_travail where detaildevis.id_ressource = ressource.id_ressource and ressource.id_ordre_de_travail=ordre_de_travail.id_ordre_de_travail and ressource.id_ordre_de_travail=$idot LIMIT 1");

        if($stm->execute()) {
            if($stm->rowCount() > 0) {
                $row = $stm->fetch(PDO::FETCH_ASSOC);
                $iddevis = $row['iddevis'];
                $idres = $row['id_ressource'];
                $rem = $row['commentaire2'];
            };
        }
        break;
    //tirage cdi/ctr
    case "2" :
        $ot = OrdreDeTravail::first(
            array('conditions' =>
                array("id_ordre_de_travail = ?", $idot)
            )
        );
        if($ot !== NULL) {
            $sousProjet = SousProjet::find($ot->id_sous_projet);

            //var_dump($sousProjet->transporttirage);

            $rem = $ot->commentaire2;

            $detailsDevis = DetailsDevis::first(
                array('conditions' =>
                    array("id_ordre_de_travail = ?", $idot)
                )
            );
            if($detailsDevis !== NULL) {
                $iddevis = $detailsDevis->iddevis;

                if($sousProjet->transporttirage !== NULL) {

                    $detailsDevis->efo_06_06_qt = $sousProjet->transporttirage->lineaire12 / 2;
                    $detailsDevis->tfo_02_01_qt = $sousProjet->transporttirage->lineaire9 + $sousProjet->transporttirage->lineaire10 + $sousProjet->transporttirage->lineaire11;
                    $detailsDevis->tfo_02_03_qt = $sousProjet->transporttirage->lineaire12;
                    $detailsDevis->tfo_03_01_qt = $sousProjet->transporttirage->lineaire4;//cables
                    $detailsDevis->tfo_03_02_qt = $sousProjet->transporttirage->lineaire1 + $sousProjet->transporttirage->lineaire2 + $sousProjet->transporttirage->lineaire3;
                    $detailsDevis->tfo_04_01_qt = "";//nbrchambre * 3

                    $detailsDevis->save();
                }

            } else {
                $detailsDevis = new DetailsDevis(array(
                    'id_ordre_de_travail' => $idot
                ));

                if($sousProjet->transporttirage !== NULL) {

                    $detailsDevis->efo_06_06_qt = $sousProjet->transporttirage->lineaire12 / 2;
                    $detailsDevis->tfo_02_01_qt = $sousProjet->transporttirage->lineaire9 + $sousProjet->transporttirage->lineaire10 + $sousProjet->transporttirage->lineaire11;
                    $detailsDevis->tfo_02_03_qt = $sousProjet->transporttirage->lineaire12;
                    $detailsDevis->tfo_03_01_qt = $sousProjet->transporttirage->lineaire4;//cables
                    $detailsDevis->tfo_03_02_qt = $sousProjet->transporttirage->lineaire1 + $sousProjet->transporttirage->lineaire2 + $sousProjet->transporttirage->lineaire3;
                    $detailsDevis->tfo_04_01_qt = "";//nbrchambre * 3

                }

                $detailsDevis->save();
                $iddevis = $detailsDevis->iddevis;
            }
        }

        //var_dump($detailsDevis);

        break;
    case "6" :
        $ot = OrdreDeTravail::first(
            array('conditions' =>
                array("id_ordre_de_travail = ?", $idot)
            )
        );
        if($ot !== NULL) {
            $sousProjet = SousProjet::find($ot->id_sous_projet);

            //var_dump($sousProjet->distributiontirage);

            $rem = $ot->commentaire2;

            $detailsDevis = DetailsDevis::first(
                array('conditions' =>
                    array("id_ordre_de_travail = ?", $idot)
                )
            );
            if($detailsDevis !== NULL) {

                $iddevis = $detailsDevis->iddevis;

                if($sousProjet->distributiontirage !== NULL) {

                    $detailsDevis->efo_06_06_qt = $sousProjet->distributiontirage->lineaire12 / 2;
                    $detailsDevis->tfo_02_01_qt = $sousProjet->distributiontirage->lineaire9 + $sousProjet->distributiontirage->lineaire10;
                    $detailsDevis->tfo_02_02_qt = $sousProjet->distributiontirage->lineaire11;
                    $detailsDevis->tfo_02_03_qt = $sousProjet->distributiontirage->lineaire12;
                    $detailsDevis->tfo_03_01_qt = $sousProjet->distributiontirage->lineaire2 + $sousProjet->distributiontirage->lineaire3 + $sousProjet->distributiontirage->lineaire4;
                    $detailsDevis->tfo_03_02_qt = $sousProjet->distributiontirage->lineaire1;
                    $detailsDevis->tfo_04_01_qt = "";//nbr chambre * 2

                    $detailsDevis->save();
                }

            } else {
                $detailsDevis = new DetailsDevis(array(
                    'id_ordre_de_travail' => $idot
                ));

                if($sousProjet->distributiontirage !== NULL) {

                    $detailsDevis->efo_06_06_qt = $sousProjet->distributiontirage->lineaire12 / 2;
                    $detailsDevis->tfo_02_01_qt = $sousProjet->distributiontirage->lineaire9 + $sousProjet->distributiontirage->lineaire10;
                    $detailsDevis->tfo_02_02_qt = $sousProjet->distributiontirage->lineaire11;
                    $detailsDevis->tfo_02_03_qt = $sousProjet->distributiontirage->lineaire12;
                    $detailsDevis->tfo_03_01_qt = $sousProjet->distributiontirage->lineaire2 + $sousProjet->distributiontirage->lineaire3 + $sousProjet->distributiontirage->lineaire4;
                    $detailsDevis->tfo_03_02_qt = $sousProjet->distributiontirage->lineaire1;
                    $detailsDevis->tfo_04_01_qt = "";//nbr chambre * 2

                }

                $detailsDevis->save();
                $iddevis = $detailsDevis->iddevis;
            }
        }

        //var_dump($detailsDevis);

        break;
    default : break;
}


echo json_encode(array("iddevis" => $iddevis, "idres" => $idres, "rem" => $rem));