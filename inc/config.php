<?php
/**
 * config.php
 *
 * Author: RR
 *
 * Global configuration file
 *
 */

// Include Template class
require 'classes/Template.php';

// Create a new Template Object
$r2i                               = new Template('R2I', '1.0', 'assets'); // Name, version and assets folder's name

// Global Meta Data
$r2i->author                       = 'RR';
$r2i->robots                       = 'noindex, nofollow';
$r2i->title                        = 'R2I - Outil de gestion déploiement';
$r2i->description                  = 'R2I - Outil de gestion déploiement';

// Global Included Files (eg useful for adding different sidebars or headers per page)
$r2i->inc_side_overlay             = 'base_side_overlay.php';
$r2i->inc_sidebar                  = 'base_sidebar.php';
$r2i->inc_header                   = 'base_header.php';

// Global Color Theme
$r2i->theme                        = '';       // '' for default theme or 'amethyst', 'city', 'flat', 'modern', 'smooth'

// Global Body Background Image
$r2i->body_bg                      = '';       // eg 'assets/img/photos/photo10@2x.jpg' Useful for login/lockscreen pages

// Global Header Options
$r2i->l_header_fixed               = true;     // True: Fixed Header, False: Static Header

// Global Sidebar Options
$r2i->l_sidebar_position           = 'left';   // 'left': Left Sidebar and right Side Overlay, 'right;: Flipped position
$r2i->l_sidebar_mini               = false;    // True: Mini Sidebar Mode (> 991px), False: Disable mini mode
$r2i->l_sidebar_visible_desktop    = true;     // True: Visible Sidebar (> 991px), False: Hidden Sidebar (> 991px)
$r2i->l_sidebar_visible_mobile     = false;    // True: Visible Sidebar (< 992px), False: Hidden Sidebar (< 992px)

// Global Side Overlay Options
$r2i->l_side_overlay_hoverable     = false;    // True: Side Overlay hover mode (> 991px), False: Disable hover mode
$r2i->l_side_overlay_visible       = false;    // True: Visible Side Overlay, False: Hidden Side Overlay

// Global Sidebar and Side Overlay Custom Scrolling
$r2i->l_side_scroll                = true;     // True: Enable custom scrolling (> 991px), False: Disable it (native scrolling)

// Global Active Page (it will get compared with the url of each menu link to make the link active and set up main menu accordingly)
$r2i->main_nav_active              = basename($_SERVER['PHP_SELF']);

// Global Main Menu
$r2i->main_nav                     = array(
    array(
        'name'  => '<span class="sidebar-mini-hide">Dashboard</span>',
        'icon'  => 'si si-speedometer',
        'url'   => '?page=dashboard'
    ),
    array(
        'name'  => '<span class="sidebar-mini-hide">Projets</span>',
        'type'  => 'heading'
    ),
    array(
        'name'  => '<span class="sidebar-mini-hide">Liste des projets</span>',
        'icon'  => 'si si-list',
        'url'   => '?page=projects&action=list'
    ),
    array(
        'name'  => '<span class="sidebar-mini-hide">Profils / Utilisateurs</span>',
        'type'  => 'heading'
    ),
    array(
        'name'  => '<span class="sidebar-mini-hide">Utilisateurs</span>',
        'icon'  => 'si si-users',
        'url'   => '?page=users&action=list'
    ),
    array(
        'name'  => '<span class="sidebar-mini-hide">Tiers</span>',
        'type'  => 'heading'
    ),
    array(
        'name'  => '<span class="sidebar-mini-hide">Liste tiers (STT)</span>',
        'icon'  => 'si si-file',
        'url'   => '#'
    ),
);