<?php
/**
 * file: get_user_nro_list.php
 * User: rabii
 */

$nros = array();

$message = array();

extract($_POST);

$ret= array();

$sql = "select n.* from nro_utilisateur as nu, nro as n,utilisateur as u";

$stm = $db->prepare("select * from nro as n where id_utilisateur IS NULL or id_utilisateur=:id_utilisateur");

if(isset($idu) && !empty($idu)){
    $stm->execute(array(':id_utilisateur' => $idu));
    $nros = $stm->fetchAll();

    foreach($nros as $nro)
    {
        $details = array();
        $details['id']=$nro['id_nro'];
        $details['nro']=$nro['lib_nro'];
        $details['idu']=$nro['id_utilisateur'];
        $ret[] = $details;

    }
}

echo json_encode($ret);