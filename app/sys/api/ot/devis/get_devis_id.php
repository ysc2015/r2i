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
    case "6" :
        $detailsDevis = DetailsDevis::first(
            array('conditions' =>
                array("id_ordre_de_travail = ?", $idot)
            )
        );
        if($detailsDevis !== NULL) {
            $iddevis = $detailsDevis->iddevis;
        } else {
            $detailsDevis = new DetailsDevis(array(
                'id_ordre_de_travail' => $idot
            ));
            $detailsDevis->save();
            $iddevis = $detailsDevis->iddevis;
        }
        $ot = OrdreDeTravail::first(
            array('conditions' =>
                array("id_ordre_de_travail = ?", $idot)
            )
        );
        if($ot !== NULL) {
            $rem = $ot->commentaire2;
        }
        break;
    default : break;
}


echo json_encode(array("iddevis" => $iddevis, "idres" => $idres, "rem" => $rem));