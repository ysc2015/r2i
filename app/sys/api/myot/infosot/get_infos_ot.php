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

        $stmpci = $db->prepare("SELECT * FROM `pci_in_nro` WHERE id_nro = ".$sousProjet->projet->nro->id_nro);

        $stmpci->execute();

        $pcis = $stmpci->fetchAll(PDO::FETCH_ASSOC);

        if($stmpci->rowCount() > 0) {

            $pci = $pcis[0]["pci"];
        }

    }
}

echo json_encode(array("pci" =>  $pci,"lien" => $link));

