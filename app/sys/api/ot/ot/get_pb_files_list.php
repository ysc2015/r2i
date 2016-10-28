<?php
/**
 * file: get_pb_files_list.php
 * User: rabii
 */

$files = array();

$message = array();

extract($_POST);

$ret= array();

$stm = $db->prepare("select * from ressource where type_objet=:type_objet and id_sous_projet=:id_sous_projet and (id_ordre_de_travail IS NULL or id_ordre_de_travail=:id_ordre_de_travail)");

if(isset($objtype) && !empty($objtype) && isset($idot) && !empty($idot) && isset($idsp) && !empty($idsp)){
    $stm->execute(array(':type_objet' => $objtype , ':id_ordre_de_travail' => $idot, ':id_sous_projet' => $idsp));
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