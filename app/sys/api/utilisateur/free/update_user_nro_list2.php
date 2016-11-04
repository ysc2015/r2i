<?php
/**
 * file: update_user_nro_list2.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("update nro set id_utilisateur2=NULL where id_utilisateur2=:id_utilisateur2");

if(isset($idu) && !empty($idu)){
    if($stm->execute(array(':id_utilisateur2' => $idu))) {
        $stm = $db->prepare("update nro set id_utilisateur2=:id_utilisateur2 where id_nro IN ( ".$list." )");
        if($stm->execute(array(':id_utilisateur2' => $idu))) {
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