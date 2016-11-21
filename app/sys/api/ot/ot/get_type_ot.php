<?php
/**
 * file: get_type_ot.php
 * User: rabii
 */

extract($_POST);

extract($_GET);
$sousProjet = SousProjet::first(
    array('conditions' =>
        array("id_sous_projet = ?", $idsousprojet)
    )
);
$options = "<option value=\"\" selected disabled>Séléctionnez type ot</option>";
switch($tentree) {
    case "transportaiguillage" :
        //echo "select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 1";
        $stm = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 1");
        $stm->execute();
        if($stm->rowCount()==0) {
            $options .= "<option value=\"1\">Aiguillage CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
        }
        break;
    case "transporttirage" :
        $stm = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail in (2,3)");
        $stm->execute();
        if($stm->rowCount()> 0) {
            $stm2 = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 2");
            $stm2->execute();
            if($stm2->rowCount() == 0) {
                $options .= "<option value=\"2\">Tirage CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
            }
            $stm3 = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 3");
            $stm3->execute();
            if($stm3->rowCount() == 0) {
                $options .= "<option value=\"3\">Raccordement CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
            }
        } else {
            $stm4 = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 4");
            $stm4->execute();
            if($stm4->rowCount() == 0) {
                $options .= "<option value=\"2\">Tirage CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                $options .= "<option value=\"3\">Raccordement CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                $options .= "<option value=\"4\">Tirage et Raccordement CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
            }
        }
        break;
    case "transportrecette" :
        //echo "select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 1";
        $stm = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 9");
        $stm->execute();
        if($stm->rowCount()==0) {
            $options .= "<option value=\"9\">Recette Optique CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
        }
        break;
    case "distributionaiguillage" :
        $stm = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 5");
        $stm->execute();
        if($stm->rowCount()==0) {
            $options .= "<option value=\"5\">Aiguillage CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
        }
        break;
    case "distributiontirage" :
        $stm = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail in (6,7)");
        $stm->execute();
        if($stm->rowCount()> 0) {
            $stm2 = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 6");
            $stm2->execute();
            if($stm2->rowCount() == 0) {
                $options .= "<option value=\"6\">Tirage CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
            }
            $stm3 = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 7");
            $stm3->execute();
            if($stm3->rowCount() == 0) {
                $options .= "<option value=\"7\">Raccordement CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
            }
        } else {
            $stm4 = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 8");
            $stm4->execute();
            if($stm4->rowCount() == 0) {
                $options .= "<option value=\"6\">Tirage CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                $options .= "<option value=\"7\">Raccordement CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                $options .= "<option value=\"8\">Tirage et Raccordement CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
            }
        }
        break;
    case "distributionrecette" :
        //echo "select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 1";
        $stm = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 10");
        $stm->execute();
        if($stm->rowCount()==0) {
            $options .= "<option value=\"10\">Recette Optique CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
        }
        break;
    default : break;
}
$typesot = SelectOrdreTravailType::all(array('conditions' => array('type_entree = ? AND system IS NULL' , $tentree)));
foreach($typesot as $typeot) {
    $options .= "<option value=\"$typeot->id_type_ordre_travail\">".$typeot->lib_type_ordre_travail."</option>";
}

echo json_encode(array("html" => $options));
?>