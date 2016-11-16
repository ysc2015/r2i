<?php
/**
 * file: load_de_ot.php
 * User: rabii
 */

extract($_POST);

$ret= array();

$stm = $db->prepare("select * from ressource where type_objet='de_ot_file' and id_ordre_de_travail=:id_ordre_de_travail");

if(isset($idot) && !empty($idot) ){
    $stm->execute(array(':id_ordre_de_travail' => $idot));
    $files = $stm->fetchAll();

    foreach($files as $file)
    {
        $filePath=__DIR__."/../../uploads/". $file['dossier'] . "/" .$file['nom_fichier_disque'];
        $details = array();
        $details['name']=$file['id_ressource']."_".$file['nom_fichier'];
        $details['path']=$filePath;
        $details['size']=filesize($filePath);
        $details['id']=$file['id_ressource'];
        $ret[] = $details;

    }
}

echo json_encode($ret);