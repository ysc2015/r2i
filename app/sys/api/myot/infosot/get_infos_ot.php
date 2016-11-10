<?php
/**
 * file: get_infos_ot.php
 * User: rabii
 */

extract($_POST);

$pci = "";

$link = "";

$stm = $db->prepare("select * from ordre_de_travail where id_ordre_de_travail=$idot");

$stm->execute();

$row = $stm->fetch(PDO::FETCH_OBJ);

$sousProjet = NULL;

if($row !== NULL) {
    $sousProjet = SousProjet::first(
        array('conditions' =>
            array("id_sous_projet = ?", $row->id_sous_projet)
        )
    );

    if($sousProjet !== NULL) {

    }
}

echo json_encode($row);

