<?php
/**
 * file: set_projet_id_osa.php
 * User: rabii
 */

extract($_POST);

$sousProjet = NULL;

$err = 0;
$message = array();

if(isset($idsp) && !empty($idsp)){
    $sousProjet = SousProjet::first(
        array('conditions' =>
            array("id_sous_projet = ?", $idsp)
        )
    );
}

if($sousProjet !== NULL) {
    $sousProjet->projet->id_projet_osa = $idosa;
    if($sousProjet->projet->save()) {
        $message[] = "référence projet osa ajoutée avec succées !";
    } else {
        $err++;
        $message[] = "Erreur mise à jour référence projet osa !";
    }
} else {
    $err++;
    $message[] = "Identifiant sous projet invalid ou introuvable !";
}

echo json_encode(array("error" => $err , "message" => $message));
?>