<?php
/**
 * file: gestionplaque_block.php
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

foreach($connectedProfil->gestionplaque() as $tab) {
    $html .='<li class="'.($connectedProfil->gestionplaque()[0]==$tab?"active":"").'">';
    $html .='<a href="#'.$tab.'_content'.'" data-toggle="tab">'.$tab.'</a>';//$lang["$tab"]
    $html .='</li>';
}

$html .='</ul>';

$html .='<div class="block-content tab-content">';
foreach($connectedProfil->gestionplaque() as $tab) {
    $html .='<div class="tab-pane '.($connectedProfil->gestionplaque()[0]==$tab?"active":"").'" id="'.$tab.'_content">';

    switch($tab) {
        case "phase" :
            $objet = SousProjetPlaquePhase::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("gestion_plaque_phase",$objet);
            break;
        case "traitementetude" :
            $objet = SousProjetPlaqueTraitementEtude::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            $html .= build_user_form("gestion_plaque_traitement_etude",$objet);
            break;
    }
    $html .='</div>';
}

$html .='</div>';

echo $html;