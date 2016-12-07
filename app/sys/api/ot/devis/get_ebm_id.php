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

$sql = "";

$sousProjet = SousProjet::find($idsp);

$display_ebm = true;

if($sousProjet !== NULL) {

    switch($idtot) {
        case "1" : $display_ebm = checkLinearsForEntry($sousProjet,"transportaiguillage",10);break;
        case "2" : $display_ebm = checkLinearsForEntry($sousProjet,"transporttirage",14);break;
        case "3" : $display_ebm = false;break;
        case "4" : $display_ebm = checkLinearsForEntry($sousProjet,"transporttirage",14);break;
        default : break;
    }

    if($display_ebm) {
        switch($idtot) {
            case "5" :
            case "7" :
            case "8" :
                /*case "9" :
                  case "10" :
                */
                $sql = "select detail_EBM.id_detail_EBM,detail_EBM.id_ressource from detail_EBM,ressource where detail_EBM.id_ressource = ressource.id_ressource and ressource.id_ordre_de_travail=$idot LIMIT 1";
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
            case "1" :
            case "3" :
            case "4" :
            case "2" :
            case "6" :
                $detailsEBM = DetailsEBM::first(
                    array('conditions' =>
                        array("id_ordre_de_travail = ?", $idot)
                    )
                );
                if($detailsEBM !== NULL) {
                    //echo "1111";
                    $idebm = $detailsEBM->id_detail_ebm;
                } else {
                    //echo "2222";
                    $detailsEBM = new DetailsEBM(array(
                        'id_ordre_de_travail' => $idot
                    ));
                    $detailsEBM->save();
                    $idebm = $detailsEBM->id_detail_ebm;
                }
                break;
            default : break;
        }
    }
}


echo json_encode(array("idebm" => $idebm, "idres" => $idres, "sql" => $sql));