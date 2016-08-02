<?php
/**
 * file: reseaudistribution_block.php
 * User: rabii
 */

ini_set('display_errors',1);

extract($_POST);


$views_folder = __DIR__."/../../../views/sousprojet/tabcontent/reseaudistribution/";

global $connectedProfil;

$sousprojet;
$projet;
$sousprojet_infoplaque;

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

foreach($connectedProfil->reseaudistribution() as $tab) {
    $html .='<li class="'.($connectedProfil->reseaudistribution()[0]==$tab?"active":"").'">';
    $html .='<a href="#'.$tab.'_dcontent'.'" data-toggle="tab">'.$lang["$tab"].'</a>';//$lang["$tab"]
    $html .='</li>';
}

$html .='</ul>';

$html .='<div class="block-content tab-content">';
foreach($connectedProfil->reseaudistribution() as $tab) {
    $html .='<div class="tab-pane '.($connectedProfil->reseaudistribution()[0]==$tab?"active":"").'" id="'.$tab.'_dcontent">';

    ob_start();
    switch($tab) {
        case "designcdi" :
            include $views_folder.'/designcdi.php';
            break;
        case "aiguillage" :
            include $views_folder.'/aiguillage.php';
            break;
        case "commandecdi" :
            include $views_folder.'/commandecdi.php';
            break;
        case "tirage" :
            include $views_folder.'/tirage.php';
            break;
        case "raccordements" :
            include $views_folder.'/raccordements.php';
            break;
        case "recette" :
            include $views_folder.'/recette.php';
            break;
    }
    $content = ob_get_contents();
    ob_end_clean();
    $html .= $content;
    $html .='</div>';
}

$html .='</div>';

echo $html;