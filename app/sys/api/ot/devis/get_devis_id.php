<?php
/**
 * file: get_devis_id.php
 * User: rabii
 */
extract($_POST);
$iddevis = 0;
$idres = 0;
$stm = $db->prepare("select detaildevis.iddevis,detaildevis.id_ressource from detaildevis,ressource where detaildevis.id_ressource = ressource.id_ressource and ressource.id_ordre_de_travail=$idot LIMIT 1");

if($stm->execute()) {
    if($stm->rowCount() > 0) {
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $iddevis = $row['iddevis'];
        $idres = $row['id_ressource'];
    };
}

echo json_encode(array("iddevis" => $iddevis, "idres" => $idres));