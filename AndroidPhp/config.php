<?php
/**
 * DB configuration variables
 */
define("DB_HOST", "localhost");
define("DB_USER", "r2i");
define("DB_PASSWORD", "r2i");
define("DB_DATABASE", "r2i");

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
mysqli_set_charset($db,'utf8');
?>
