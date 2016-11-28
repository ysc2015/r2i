<?php
ini_set('display_errors',1);
/**
 * file: index.php
 * User: rabii
 */

include __DIR__."/app/sys/views/document/init.php";
?>

<!DOCTYPE html>
<!--[if IE 9]><html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->
<head>
    <?php
    if($connectedProfil){
        ?>
        <script>
            window.token = "<?=base64_encode(md5($connectedProfil->email_utilisateur)."::".md5($connectedProfil->pass_utilisateur))?>";
            window.OSA_SERVER = "<?=OSA_SERVER?>";
        </script>
        <?php
    }

    ?>
    <meta charset="utf-8">

    <title>R2I - Outils de gestion déploiement</title>
    <meta name="description" content="R2I - Outils de gestion déploiement">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
    <?php include "app/sys/views/document/assets.php"; ?>
</head>
<body>


<?php

extract($_GET);
if (!isset($page) || empty($page)) {
    $page = $connectedProfil->defaultpage();

}
$pageInfos = include("app/sys/pageinfos.php");
if($page == "dashboard") $section_header = "";
else {
    $section_header = <<<TOP
<!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                {$pageInfos->header} <small>{$pageInfos->subheader}</small>
                            </h1>
                        </div>
                        <div class="col-sm-5 text-right hidden-xs">
                            <ol class="breadcrumb push-10-t">
                                {$pageInfos->navigator}
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->
TOP;
}

//$pageInfo = include("app/sys/tab.php");
?>
<!-- Page Container -->
<!--
    Available Classes:

    'sidebar-l'                  Left Sidebar and right Side Overlay
    'sidebar-r'                  Right Sidebar and left Side Overlay
    'sidebar-mini'               Mini hoverable Sidebar (> 991px)
    'sidebar-o'                  Visible Sidebar by default (> 991px)
    'sidebar-o-xs'               Visible Sidebar by default (< 992px)

    'side-overlay-hover'         Hoverable Side Overlay (> 991px)
    'side-overlay-o'             Visible Side Overlay by default (> 991px)

    'side-scroll'                Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (> 991px)

    'header-navbar-fixed'        Enables fixed header
-->
<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
    <?php include "app/sys/views/document/side-overlay.php"; ?>
    <?php include "app/sys/views/document/sidebar.php"; ?>
    <?php include "app/sys/header.php"; ?>

    <!-- Main Container -->
    <main id="main-container">
        <?php echo $section_header;?>
        <!-- Page Content -->
        <div class="content">
            <?php include "app/sys/content.php"; ?>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <?php include "app/sys/footer.php"; ?>
</div>
<!-- END Page Container -->
</body>
</html>