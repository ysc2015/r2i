<?php
error_reporting(1);
require 'public/api/loginProcess.php';
$login = new loginProcess();
if ($login->login_check() == false)
    header("Location:login.php");

$activePage = ((!isset($_GET['page']) || (isset($_GET['page']) && !file_exists('views/'.$_GET['page'].'/'.$_GET['page'].'.php'))) ? "dashboard" : $_GET['page']);
?>
<?php require 'inc/config.php'; ?>
<?php require 'inc/views/template_head_start.php';
?>

<?php require 'views/'.$activePage.'/'.$activePage.'_header_inc.php'; ?>
<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>
<!-- Page Content -->
<?php require 'views/'.$activePage.'/'.$activePage.'.php'; ?>
<!-- END Page Content -->
<!-- All pages loader -->
<div id="loadingScreen"></div>
<!-- END All pages loader -->
<?php require 'inc/views/base_footer.php'; ?>
<?php require 'inc/views/template_footer_start.php'; ?>

<?php require 'views/'.$activePage.'/'.$activePage.'_footer_inc.php'; ?>

<?php require 'inc/views/template_footer_end.php'; ?>