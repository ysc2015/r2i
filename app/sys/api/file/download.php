<?php

extract($_GET);

if(isset($id)) {
    $stm = $db->prepare("SELECT * FROM ressource WHERE id_ressource=:id");
    $stm->bindParam(':id',$id);
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_OBJ);

    $fileName = $row->nom_fichier;
    $filePath = __DIR__."/../uploads/". $row->dossier . "/" .$row->nom_fichier_disque;

    if (file_exists($filePath)) {

        /*header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-type: Binary");
        header("Content-Disposition: attachment; filename=\"".$fileName."\"");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".filesize($filePath));
        ob_clean();
        flush();
        @readfile($filePath);*/

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . $fileName . "\"");
        ob_clean();
        flush();
        readfile($filePath);
    }


    exit(0);
}

?>
