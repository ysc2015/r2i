<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 28/10/2017
 * Time: 09:04
 */

extract($_POST);
extract($_GET);

$result = "NOK";
$nro_count = 0;

$nu = NULL;
$USER = NULL;

if(isset($idu) && !empty($idu)) {

    $USER = Utilisateur::first(
        array('conditions' =>
            array("id_utilisateur = ?", $idu)
        )
    );

} else if(isset($emailu) && !empty($emailu)) {

    $USER = Utilisateur::first(
        array('conditions' =>
            array("email_utilisateur = ?", $emailu)
        )
    );

}


if($USER !== NULL) {

    $result = "OK";

    $sql = "select a.* from (
    select n.id_nro,n.lib_nro,u.id_utilisateur,u.email_utilisateur from nro n, utilisateur u
    where n.id_utilisateur = u.id_utilisateur
    union
    select nu.id_nro,n.lib_nro,nu.id_utilisateur,u.email_utilisateur from nro n, utilisateur u, nro_utilisateur nu
    where nu.id_nro = n.id_nro and nu.id_utilisateur = u.id_utilisateur
    ) a
";

    if(isset($idu) && !empty($idu)) {

        $sql .= "where a.id_utilisateur = $idu ";

        $stm = $db->prepare($sql);

        $stm->execute();

        $nu = $stm->fetchAll(PDO::FETCH_ASSOC);

        $nro_count = $stm->rowCount();

    } else if(isset($emailu) && !empty($emailu)) {

        $sql .= "where a.email_utilisateur = '$emailu' ";

        $stm = $db->prepare($sql);

        $stm->execute();

        $nu = $stm->fetchAll(PDO::FETCH_ASSOC);

        $nro_count = $stm->rowCount();
    }

}


echo json_encode(array("result" => $result, "nro_count" => $nro_count, "nro_list" => ($nu == NULL ? array() : $nu)));