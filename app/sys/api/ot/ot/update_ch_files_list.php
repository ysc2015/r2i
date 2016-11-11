<?php
/**
 * file: update_ch_files_list.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("update ressource set id_ordre_de_travail=NULL where id_ordre_de_travail=:id_ordre_de_travail and type_objet=:type_objet");

if(isset($idot) && !empty($idot)){
    if($stm->execute(array(':id_ordre_de_travail' => $idot , ':type_objet' => $objtype))) {
        $stm = $db->prepare("update ressource set id_ordre_de_travail=:id_ordre_de_travail where id_ressource IN ( ".$list." )");
        if($stm->execute(array(':id_ordre_de_travail' => $idot))) {
            $message[] = "Fichier(s) Affecté(s)";
        } else {
            $err++;
            $message[] = $message [] = $stm->errorInfo();
        }
    } else {
        $err++;
        $message[] = $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message, "list" => $list));