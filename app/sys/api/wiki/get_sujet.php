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

$datec = new DateTime($sujet->date_creation);
$datem = new DateTime($sujet->date_dernier_mod);
echo json_encode(array("id" => $sujet->id,"titre" => $sujet->titre,"contenu" => $sujet->contenu,"date_creation" => $datec->format('Y-m-d H:i:s'),"date_dernier_modification" => $datem->format('Y-m-d H:i:s'),"piecesjointe" => $str_pj,"id_categorie" => $sujet->id_categorie));
?>
