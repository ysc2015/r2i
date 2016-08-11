<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title><?= $subject ?></title>
</head>
<body>
<?php
extract($_POST);
$sousprojet = SousProjet::first(array('conditions' => array("id_sous_projet = ?", $ids)));

if($sousprojet !== NULL) {
    $projet = Projet::first(array('conditions' => array("id_projet = ?", $sousprojet->id_projet)));
}
$inter_be = Utilisateur::first(array('conditions' => array("id_utilisateur = ?", $td_intervenant_be)));
$val_be = Utilisateur::first(array('conditions' => array("id_utilisateur = ?", $td_valideur_bei)));
?>
<div style="width: 640px;float: left;text-align: left">
    <p>un design CTR vient d'étre validé</p>
    <p>code site d'origine : <?= ($projet !== NULL ? $projet->code_site_origine : "n/a")?></p>
    <p>numéro de poche : </p>
    <p>intervenant be : <?=($inter_be !== NULL ? $inter_be->prenom_utilisateur. " ".$inter_be->nom_utilisateur : "n/a")?></p>
    <p>valideur be : <?=($val_be !== NULL ? $val_be->prenom_utilisateur. " ".$val_be->nom_utilisateur : "n/a")?></p>
    <p>lineaire de trans : <?=(isset($td_lineaire_transport) ? $td_lineaire_transport : "n/a")?></p>
    <p>nb zones : <?=(isset($td_nb_zones) ? $td_nb_zones : "n/a")?></p>
</div>
</body>
</html>