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

        @$insertStm->execute(array(':id_nro' => $nro['id_nro'] , ':id_utilisateur' => $nro['id_utilisateur']));


        $insertStm2 = $db->prepare("insert into nro_utilisateur (id_nro,id_utilisateur) values (:id_nro,:id_utilisateur)");

        @$insertStm2->execute(array(':id_nro' => $nro['id_nro'] , ':id_utilisateur' => $nro['id_utilisateur2']));

    }

    echo "RAZ table nro (id_utilisateur)...<br><br>";
    $rasStm = $db->prepare("UPDATE nro SET id_utilisateur=NULL, id_utilisateur2=NULL WHERE 1");
    @$rasStm->execute();

    echo "table nro suppression cle FK...(id_utilisateur,id_utilisateur2)<br><br>";
    $dropFKStm = $db->prepare("ALTER TABLE nro DROP FOREIGN KEY FK_nro_utilisateur");
    @$dropFKStm->execute();

    echo "table nro suppression colonnes(id_utilisateur,id_utilisateur2)...<br><br>";
    $dropColsStm = $db->prepare("ALTER TABLE nro DROP id_utilisateur,DROP id_utilisateur2");
    @$dropColsStm->execute();

    echo "fin traitement";
}