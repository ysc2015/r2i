<?php
/**
 * file: get_duree.php
 * User: rabii
 */

extract($_POST);


echo json_encode(array("duree" => getDuree($dd,$df)));