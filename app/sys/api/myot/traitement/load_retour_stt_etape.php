<?php
/**
 * file: load_retour_stt_etape.php
 * User: rabii
 */
extract($_POST);

$ret= array();

$arr = array();

$exp = explode(',',$etapes);

foreach($exp as $ex) {
    $arr[] = "'".$ex."'";
}

$in = "(".implode(',',$arr).")";

$stm = $db->prepare("select * from ressource where type_objet='stt_retour_terrain' and id_sous_projet=:id_sous_projet and id_type_ordre_travail in $in");

if(isset($idsp) && !empty($idsp) ){
    $stm->execute(array(':id_sous_projet' => $idsp));
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
