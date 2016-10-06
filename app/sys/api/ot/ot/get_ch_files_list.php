<?php
/**
 * file: get_ch_files_list.php
 * User: rabii
 */

$files = array();

$message = array();

extract($_POST);

$ret= array();

$stm = $db->prepare("select * from ressource where type_objet=:type_objet and (id_ordre_de_travail IS NULL or id_ordre_de_travail=:id_ordre_de_travail)");

if(isset($objtype) && !empty($objtype) && isset($idot) && !empty($idot)){
    $stm->execute(array(':type_objet' => $objtype , ':id_ordre_de_travail' => $idot));
    $files = $stm->fetchAll();

    foreach($files as $file)
    {
        $details = array();
        $details['id']=$file['id_ressource'];
        $details['nom']=$file['nom_fichier'];
        $details['idot']=$file['id_ordre_de_travail'];
        $ret[] = $details;

    }
}

echo json_encode($ret);