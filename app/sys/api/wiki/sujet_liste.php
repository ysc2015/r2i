<?php
/**
 * file: sujet_liste.php
 * User: rabii
 */

extract($_POST);

$stm1 = $db->prepare("select ws.*,u.prenom_utilisateur,u.nom_utilisateur from wiki_sujet ws,utilisateur u where ws.id_utilisateur = u.id_utilisateur and id_categorie = $idcat order by date_creation desc");

$stm1->execute();

$stm2 = $db->prepare("select wc.* from wiki_categorie wc where wc.id_categorie_parent = $idcat order by nom asc");

$stm2->execute();

echo json_encode(array("wksubjects" => $stm1->fetchAll(PDO::FETCH_ASSOC), "wksubcats" => $stm2->fetchAll(PDO::FETCH_ASSOC)));
?>
