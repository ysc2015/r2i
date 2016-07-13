<?php
/**
 * file: reseautransport_block.php
 * User: rabii
 */

ini_set('display_errors',1);
include_once __DIR__."/../../../inc/user.roles.php";
include_once __DIR__."/../../../inc/forms.functions.inc.php";
include_once __DIR__."/../../../language/fr/default.php";

extract($_POST);


$views_folder = __DIR__."/../../../views/";

global $connectedProfil;
$objet = NULL;
//global $lang;

switch ($connectedProfil->profil->lib_profil_utilisateur) {
    case 'Administrateur':
        $connectedProfil = new Administrateur($connectedProfil);
        break;

    case 'Agent STT':
        $connectedProfil = new STTUser($connectedProfil);
        break;

    case 'Chef de projet':
        $connectedProfil = new CDPUser($connectedProfil);
        break;

    default:
        $connectedProfil = new baseUser($connectedProfil);
        break;
}

$html='<ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">';

foreach($connectedProfil->reseautransport() as $tab) {
    $html .='<li class="'.($connectedProfil->reseautransport()[0]==$tab?"active":"").'">';
    $html .='<a href="#'.$tab.'_content'.'" data-toggle="tab">'.$tab.'</a>';//$lang["$tab"]
    $html .='</li>';
}

$html .='</ul>';

$html .='<div class="block-content tab-content">';
foreach($connectedProfil->reseautransport() as $tab) {
    $html .='<div class="tab-pane '.($connectedProfil->reseautransport()[0]==$tab?"active":"").'" id="'.$tab.'_content">';

    switch($tab) {
        case "design" :
            $objet = SousProjetTransportDesign::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("transport_design",$objet);
            break;
        case "aiguillage" :
            $objet = SousProjetTransportAiguillage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("transport_aiguillage",$objet);
            break;
        case "commandectr" :
            $objet = SousProjetTransportCommandeCTR::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("transport_commande_ctr",$objet);
            break;
        case "tirage" :
            $objet = SousProjetTransportTirage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("transport_tirage",$objet);
            break;
        case "raccordements" :
            $objet = SousProjetTransportRaccordement::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("transport_raccordements",$objet);
            break;
        case "recette" :
            $objet = SousProjetTransportRecette::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("transport_recette",$objet);
            break;
    }
    $html .='</div>';
}

$html .='</div>';

echo $html;