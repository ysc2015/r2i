<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 04/05/2017
 * Time: 12:03
 */

extract($_POST);

$ret= array();

$stm = NULL;

if(isset($idsp) && isset($types)) {

    $stm = $db->prepare("select r.* from ressource r inner join ordre_de_travail ot on r.id_ordre_de_travail = ot.id_ordre_de_travail where r.type_objet='fcomp_file' and r.id_sous_projet=:id_sous_projet and ot.id_type_ordre_travail IN ($types)");

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

} else {

    if(isset($idot) && !empty($idot) ){

        $stm = $db->prepare("select * from ressource where type_objet='fcomp_file' and id_ordre_de_travail=:id_ordre_de_travail");

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
}

echo json_encode($ret);