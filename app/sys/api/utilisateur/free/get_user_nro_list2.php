<?php
/**
 * file: get_user_nro_list2.php
 * User: rabii
 */

$nros = array();

$message = array();

extract($_POST);

$ret= array();

$stm = $db->prepare("select * from nro where id_utilisateur2 IS NULL or id_utilisateur2=:id_utilisateur2");

if(isset($idu) && !empty($idu)){
    $stm->execute(array(':id_utilisateur2' => $idu));
    $nros = $stm->fetchAll();

    foreach($nros as $nro)
    {
        $details = array();
        $details['id']=$nro['id_nro'];
        $details['nro']=$nro['lib_nro'];
        $details['idu']=$nro['id_utilisateur2'];
        $ret[] = $details;

    }
}

echo json_encode($ret);