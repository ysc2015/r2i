<?php
/**
 * file: synoptique_block.php
 * User: rabii
 */

include_once __DIR__."/../../../inc/user.roles.php";
include_once __DIR__."/../../../language/fr/default.php";

extract($_POST);


$views_folder = __DIR__."/../../../views/ot/content/";

ob_start();
include $views_folder.'/synoptique.php';
$content = ob_get_contents();
ob_end_clean();


echo $content;