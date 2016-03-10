<?php
error_reporting(1);
require 'public/api/loginProcess.php';

$login = new loginProcess();
if ($login->login_check() == false)
    header("Location:login.php");
$pages = array('dashboard' => 'Tableau de bord',
    'projects' => 'projets',
    'rooms' => "chambres",
    'utilisateurs' => "utilisateurs");

$actions = array('list' => 'action pour lister',
    'add' => 'action pour ajouter',
    'mod' => 'action pour modifier',
    'sdfiles' => 'gestion des fichiers SD pour le projet',
    'addroomfile' => 'injection fichier chambres');

$activePage = ((!isset($_GET['page']) || (isset($_GET['page']) && !isset($pages[$_GET['page']]))) ? "dashboard" : $_GET['page']);
$action = ((!isset($_GET['action']) || (isset($_GET['action']) && !isset($actions[$_GET['action']]))) ? "list" : $_GET['action']);

?>
<?php require 'inc/config.php'; ?>
<?php require 'inc/views/template_head_start.php'; ?>

<?php require 'views/'.$activePage.'/'.$activePage.'_header_inc.php'; ?>


<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>
<!-- Page Content -->
<?php require 'views/'.$activePage.'/'.$activePage.'.php'?>
<!-- END Page Content -->
<!-- All pages loader -->
<div id="loadingScreen"></div>
<!-- END All pages loader -->
<?php require 'inc/views/base_footer.php'; ?>
<?php require 'inc/views/template_footer_start.php'; ?>

<?php require 'views/'.$activePage.'/'.$activePage.'_footer_inc.php'; ?>

<!-- Page JS Code -->
<script src="<?php echo $one->assets_folder; ?>/js/pages/r2i.
<?php echo ($activePage=="dashboard"?"dashboard":$activePage."_".$action); ?>.js.php"></script>

<?php require 'inc/views/template_footer_end.php'; ?>