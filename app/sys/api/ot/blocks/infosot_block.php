<?php
/**
 * file: infosot_block.php
 * User: rabii
 */
//ini_set('display_errors',1);
//sleep(5);
include_once __DIR__."/../../../inc/user.roles.php";
include_once __DIR__."/../../../language/fr/default.php";

extract($_POST);


$views_folder = __DIR__."/../../../views/ot/content/";

ob_start();
include $views_folder.'/infosot.php';
$content = ob_get_contents();
ob_end_clean();


echo $content;