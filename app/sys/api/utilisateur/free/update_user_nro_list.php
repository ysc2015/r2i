<?php
/**
 * file: update_user_nro_list.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$users = array();

if(isset($list) && !empty($list)) {
    $users = implode(",",$list);
}

foreach($nros as $nro) {
    $stm = $db->prepare("insert into nro_utilisateur (id_nro,id_utilisateur) values (:id_nro,:id_utilisateur)");
    $stm->execute(array(':id_nro' => $nro , ':id_utilisateur' => $idu));
}

$stm = $db->prepare("update nro set id_utilisateur=NULL where id_utilisateur=:id_utilisateur");

if(isset($idu) && !empty($idu)){
    if($stm->execute(array(':id_utilisateur' => $idu))) {
        $stm = $db->prepare("update nro set id_utilisateur=:id_utilisateur where id_nro IN ( ".$list." )");
        if($stm->execute(array(':id_utilisateur' => $idu))) {
            $message[] = "Nro(s) Affecté(s)";
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