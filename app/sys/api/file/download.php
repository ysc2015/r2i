<?php

extract($_GET);

if(isset($id)) {
    $stm = $db->prepare("SELECT * FROM ressource WHERE id_ressource=:id");
    $stm->bindParam(':id',$id);
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_OBJ);

    $fileName = $row->nom_fichier;
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . $fileName . "\"");
    ob_clean();
    flush();
    readfile(__DIR__."/../uploads/". $row->dossier . "/" .$row->nom_fichier_disque);
    exit(0);
}

?>
