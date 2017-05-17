<?php
/**
 * file: load_question_pbc.php
 * User: rabii
 */

extract($_POST);

$ret= array();

$stm = $db->prepare("select * from ressource where type_objet='pbc_question' and id_blq_pbc=:id_blq_pbc");

if(isset($idpbc) && !empty($idpbc) ){
    $stm->execute(array(':id_blq_pbc' => $idpbc));
    $files = $stm->fetchAll();

    foreach($files as $file)
    {
        $filePath=__DIR__."/../../uploads/". $file['dossier'] . "/" .$file['nom_fichier_disque'];

        if(@filesize($filePath)) {

            $details = array();
            $details['name']=$file['id_ressource']."_".$file['nom_fichier'];
            $details['path']=$filePath;
            $details['size']=@filesize($filePath);
            $details['id']=$file['id_ressource'];
            $ret[] = $details;
        }

    }
}

echo json_encode($ret);