<?php
extract($_POST);

$ret= array();

$stm = $db->prepare("select * from ressource where type_objet=:type_objet and id_sous_projet=:id_sous_projet");

if((isset($id_sous_projet) && !empty($id_sous_projet) && (isset($type_objet) && !empty($type_objet)))){
    $stm->execute(array(':id_sous_projet' => $id_sous_projet,':type_objet' => $type_objet));
    $files = $stm->fetchAll();

    foreach($files as $file)
    {
        $filePath=__DIR__."/../../uploads/". $file['dossier'] . "/" .$file['nom_fichier_disque'];
        $details = array();
        $details['name']=$file['id_ressource']."_".$file['nom_fichier'];
        $details['path']=$filePath;
        $details['size']=filesize($filePath);
        $details['id']=$file['id_ressource'];

        //TODO to delete
        $details['id_sous_projet']=$file['id_sous_projet'];
        $details['id_ordre_de_travail']=$file['id_ordre_de_travail'];
        $details['id_type_ordre_travail']=$file['id_type_ordre_travail'];
        $details['id_chambre']=$file['id_chambre'];
        $details['type_objet']=$file['type_objet'];
        //end todelete
        $ret[] = $details;

    }
}

echo json_encode($ret);
?>