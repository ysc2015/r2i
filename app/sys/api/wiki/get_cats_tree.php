<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 03/05/2017
 * Time: 12:09
 */

$html = "";
$err = 0;
$errormsg ="";


//think ob_start
try {

    $html = getWikiCategoriesMenu();

} catch (Exception $e) {
    $err++;
    $errormsg = $e->getMessage();
}

echo json_encode(array("error" => $err, "html" => $html, "errormsg" => $errormsg));