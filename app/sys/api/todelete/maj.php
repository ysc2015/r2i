<?php
/**
 * file: maj.php
 * User: rabii
 */

$stm = $db->prepare("select * from nro");

if($stm->execute()) {

    echo "maj de la table nro_utilisateur...<br><br>";

    $nros = $stm->fetchAll();

    foreach($nros as $nro) {

        //silent insert , hide constraint viloation warnings '@

        $insertStm = $db->prepare("insert into nro_utilisateur (id_nro,id_utilisateur) values (:id_nro,:id_utilisateur)");

        @$insertStm->execute(array(':id_nro' => $nro['id_nro'] , ':id_utilisateur' => $nro['id_utilisateur2']));

    }

    echo "table nro suppression colonne(id_utilisateur2)...<br><br>";
    $dropColsStm = $db->prepare("ALTER TABLE nro DROP id_utilisateur2");
    @$dropColsStm->execute();

    echo "fin traitement";
}