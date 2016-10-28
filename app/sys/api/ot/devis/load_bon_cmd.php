<?php
/**
 * file: load_bon_cmd.php
 * User: rabii
 */

extract($_POST);

$ret= array();

$stm = $db->prepare("select * from ressource where type_objet='devis_bon_cmd' and iddevis=:iddevis");

if(isset($iddevis) && !empty($iddevis) ){
    $stm->execute(array(':iddevis' => $iddevis));
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