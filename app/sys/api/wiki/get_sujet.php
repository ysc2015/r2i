<?php
/**
 * file: get_type_ot.php
 * User: rabii
 */
/*require_once '../../../sys/libs/vendor/autoload.php';
require_once '../../../sys/inc/config.php';
require_once '../../../sys/language/fr/default.php';
require_once "../../../sys/inc/ssp.class.php";
require_once "../../../sys/libs/vendor/EditableGrid/EditableGrid.php";*/

extract($_POST);

extract($_GET);
$sujet = Sujet::first(
    array('conditions' =>
        array("id = ?", $id)
    )
);

$piecesjointe = PieceJointe::all(
    array('conditions' =>
        array("id_sujet = ?", $id)
    )
);
$str_pj='';
foreach($piecesjointe as $pj)
{
$str_pj.=$pj->url.';';
}

$user = Utilisateur::first(
			array('conditions' =>
					array("id_utilisateur = ?", $sujet->id_utilisateur)
			)
			);


echo json_encode(array("id" => $sujet->id,"titre" => $sujet->titre,"contenu" => $sujet->contenu,"date_creation" => date_format($sujet->date_creation,'Y-m-d H:i:s'),"date_dernier_modification" => date_format($sujet->date_dernier_mod,'Y-m-d H:i:s'),"piecesjointe" => $str_pj,"id_categorie" => $sujet->id_categorie, "auteur" => $user->nom_utilisateur." ".$user->prenom_utilisateur));
?>
