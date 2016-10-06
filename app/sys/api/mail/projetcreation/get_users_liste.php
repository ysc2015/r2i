<?php
/**
 * file: get_users_liste.php
 * User: rabii
 */

$users = array();

$message = array();

extract($_POST);

$ret= array();

$stm = $db->prepare("select u.* from utilisateur as u,profil_utilisateur as pu where u.id_profil_utilisateur = pu.id_profil_utilisateur and pu.id_profil_utilisateur != 9 and u.id_utilisateur not in (select id_utilisateur from projet_mail_creation where 1)");
$stm->execute();
$users = $stm->fetchAll();
foreach($users as $user)
{
    $details = array();
    $details['id']=$user['id_utilisateur'];
    $details['prenom']=$user['prenom_utilisateur'];
    $details['nom']=$user['nom_utilisateur'];
    $ret[] = $details;

}

echo json_encode($ret);