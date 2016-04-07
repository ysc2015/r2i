<?php
/**
 * frontend_head.php
 *
 * Author: RR
 *
 * The head of each page (Frontend)
 *
 */
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
    'header-navbar-transparent'  Enables a transparent header (if also fixed, it will get a solid dark background color on scrolling)
-->
<div id="page-container"<?php $r2i->page_classes(); ?>>
    <?php if(isset($r2i->inc_side_overlay) && $r2i->inc_side_overlay) { include($r2i->inc_side_overlay); } ?>
    <?php if(isset($r2i->inc_sidebar) && $r2i->inc_sidebar) { include($r2i->inc_sidebar); } ?>
    <?php if(isset($r2i->inc_header) && $r2i->inc_header) { include($r2i->inc_header); } ?>

    <!-- Main Container -->
    <main id="main-container">