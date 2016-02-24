<?php
/**
 * DB configuration variables
 */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "R2I");

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
mysqli_set_charset($db,'utf8');
?>
