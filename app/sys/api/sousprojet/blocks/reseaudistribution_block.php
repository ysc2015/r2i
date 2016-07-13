<?php
/**
 * file: reseaudistribution_block.php
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

foreach($connectedProfil->reseaudistribution() as $tab) {
    $html .='<li class="'.($connectedProfil->reseaudistribution()[0]==$tab?"active":"").'">';
    $html .='<a href="#'.$tab.'_dcontent'.'" data-toggle="tab">'.$tab.'</a>';//$lang["$tab"]
    $html .='</li>';
}

$html .='</ul>';

$html .='<div class="block-content tab-content">';
foreach($connectedProfil->reseaudistribution() as $tab) {
    $html .='<div class="tab-pane '.($connectedProfil->reseaudistribution()[0]==$tab?"active":"").'" id="'.$tab.'_dcontent">';

    switch($tab) {
        case "designcdi" :
            $objet = SousProjetDistributionDesign::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("distribution_design",$objet);
            break;
        case "aiguillage" :
            $objet = SousProjetDistributionAiguillage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("distribution_aiguillage",$objet);
            break;
        case "commandecdi" :
            $objet = SousProjetDistributionCommandeCDI::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("distribution_commande_cdi",$objet);
            break;
        case "tirage" :
            $objet = SousProjetDistributionTirage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("distribution_tirage",$objet);
            break;
        case "raccordements" :
            $objet = SousProjetDistributionRaccordement::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("distribution_raccordements",$objet);
            break;
        case "recette" :
            $objet = SousProjetDistributionRecette::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("distribution_recette",$objet);
            break;
    }
    $html .='</div>';
}

$html .='</div>';

echo $html;