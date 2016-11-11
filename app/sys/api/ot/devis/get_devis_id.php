<?php
/**
 * file: get_devis_id.php
 * User: rabii
 */
extract($_POST);
$iddevis = 0;
$idres = 0;
$rem = '';
$stm = $db->prepare("select detaildevis.iddevis,detaildevis.id_ressource,ordre_de_travail.commentaire2 from detaildevis,ressource,ordre_de_travail where detaildevis.id_ressource = ressource.id_ressource and ressource.id_ordre_de_travail=ordre_de_travail.id_ordre_de_travail and ressource.id_ordre_de_travail=$idot LIMIT 1");

if($stm->execute()) {
    if($stm->rowCount() > 0) {
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $iddevis = $row['iddevis'];
        $idres = $row['id_ressource'];
        $rem = $row['commentaire2'];
    };
}

echo json_encode(array("iddevis" => $iddevis, "idres" => $idres, "rem" => $rem));