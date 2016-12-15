<?php
/**
 * file: get_user_nro_list.php
 * User: rabii
 */

$nros = array();

$message = array();

extract($_POST);

$ret= array();

$sql = "select n.id_nro,n.lib_nro,nu.id_utilisateur from nro as n ";
$sql .="left join nro_utilisateur as nu on n.id_nro = nu.id_nro and nu.id_utilisateur = :id_utilisateur";
//$sql .="where nu.id_utilisateur = :id_utilisateur";

$stm = $db->prepare($sql);

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