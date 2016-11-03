<?php
/**
 * file: get_projet_id.php
 * User: rabii
 */

extract($_POST);

$id = 0;
$nom = "";
$idetape = 0;
$primary_key = "";

$sousProjet = NULL;

if(isset($idsp) && !empty($idsp)){
    $sousProjet = SousProjet::first(
        array('conditions' =>
            array("id_sous_projet = ?", $idsp)
        )
    );
}

if($sousProjet !== NULL) {
    $id = ($sousProjet->projet->id_projet_osa!==NULL?$sousProjet->projet->id_projet_osa:0);

    if(isset($tentree) && !empty($tentree)) {
        switch($tentree) {
            case "transportdesign" :
                $primary_key = "id_sous_projet_transport_design";
                break;
            default : break;
        }

        if($sousProjet->{$tentree} !== NULL) {
            $idetape = $sousProjet->{$tentree}->$primary_key;
        }
    }

}

echo json_encode(array("id" => $id, "nom" => $sousProjet->projet->projet_nom, "idetape" => $idetape));
?>