<?php
/**
 * file: update_pb_files_list.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("update ressource set id_ordre_de_travail=NULL where id_ordre_de_travail=:id_ordre_de_travail and type_objet=:type_objet");

if(isset($idot) && !empty($idot)){
    if($stm->execute(array(':id_ordre_de_travail' => $idot , ':type_objet' => $objtype))) {
        if(isset($idf) && !empty($idf)) {
            $stm = $db->prepare("update ressource set id_ordre_de_travail=:id_ordre_de_travail where id_ressource = $idf");
            if($stm->execute(array(':id_ordre_de_travail' => $idot))) {
                $message[] = "Fichier Affecté !";
            } else {
                $err++;
                $message [] = $stm->errorInfo();
            }
        } else {
            $message[] = "Fichier Affecté !";
        }
    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));