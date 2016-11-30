<?php
/**
 * file: get_ebm_id.php
 * User: rabii
 */
extract($_POST);
$idebm = 0;
$idres = 0;

$stm = NULL;

$detailsEBM = NULL;

switch($idtot) {
    case "1" :
    case "3" :
    case "4" :
    case "5" :
    case "7" :
    case "8" :
  /*case "9" :
    case "10" :
  */
        $stm = $db->prepare("select detail_EBM.id_detail_EBM,detail_EBM.id_ressource from detail_EBM,ressource where detail_EBM.id_ressource = ressource.id_ressource and ressource.id_ordre_de_travail=$idot LIMIT 1");

        if($stm->execute()) {
            if($stm->rowCount() > 0) {
                $row = $stm->fetch(PDO::FETCH_ASSOC);
                $idebm = $row['id_detail_EBM'];
                $idres = $row['id_ressource'];
            };
        }
        break;
    //tirage cdi/ctr
    case "2" :
    case "6" :
        $detailsEBM = DetailsEBM::first(
            array('conditions' =>
                array("id_ordre_de_travail = ?", $idot)
            )
        );
        if($detailsEBM !== NULL) {
            $idebm = $detailsEBM->id_detail_EBM;
        } else {
            $detailsEBM = new DetailsEBM(array(
                'id_ordre_de_travail' => $idot
            ));
            $detailsEBM->save();
            $idebm = $detailsEBM->id_detail_EBM;
        }
        break;
    default : break;
}


echo json_encode(array("idebm" => $idebm, "idres" => $idres));