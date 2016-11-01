<?php
/**
 * file: get_projet_id.php
 * User: rabii
 */

extract($_POST);

$id = 0;

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
}

echo json_encode(array("id" => $id));
?>