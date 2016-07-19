<?php
/**
 * file: infozone_block.php
 * User: rabii
 */
ini_set('display_errors',1);
include_once __DIR__."/../../../inc/user.roles.php";
include_once __DIR__."/../../../language/fr/default.php";

extract($_POST);


$views_folder = __DIR__."/../../../views/sousprojet/tabcontent/infozone/";

global $connectedProfil;

$sousprojet;
$projet;

//get projet & sous projet infos
$sousprojet = SousProjet::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));

if($sousprojet !== NULL) {
    $projet = Projet::first(array('conditions' => array("id_projet = ?", $sousprojet->id_projet)));
    $sousprojet_infoplaque = SousProjetInfoPlaque::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
}

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

foreach($connectedProfil->infozone() as $tab) {
    $html .='<li class="'.($connectedProfil->infozone()[0]==$tab?"active":"").'">';
    $html .='<a href="#'.$tab.'_content'.'" data-toggle="tab">'.$lang["$tab"].'</a>';//$lang["$tab"]
    $html .='</li>';
}

$html .='</ul>';

$html .='<div class="block-content tab-content">';
foreach($connectedProfil->infozone() as $tab) {
    $html .='<div class="tab-pane '.($connectedProfil->infozone()[0]==$tab?"active":"").'" id="'.$tab.'_content">';

    ob_start();
    switch($tab) {
        case "nom" :
            $sousprojet = SousProjet::find($idsousprojet);
            include $views_folder.'/nom.php';
            break;
        case "infoplaque" :
            $sousprojet_infoplaque = SousProjetInfoPlaque::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            include $views_folder.'/infoplaque.php';
            break;
        case "zone" :
            $sousprojet_zone = SousProjetZone::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            include $views_folder.'/zone.php';
            break;
        case "siteorigine" :
            $sousprojet_siteorigine = SousProjetSiteOrigine::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            include $views_folder.'/siteorigine.php';
            break;
    }
    $content = ob_get_contents();
    ob_end_clean();
    $html .= $content;
    $html .='</div>';
}

$html .='</div>';

echo $html;

/*var_dump($connectedProfil);*/