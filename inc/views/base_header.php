<?php
/**
 * base_header.php
 *
 * Author: pixelcave
 *
 * The header of each page (Backend)
 *
 */
?>

<!-- Header -->
<header id="header-navbar" class="content-mini content-mini-full">
    <!-- Header Navigation Right -->
    <ul class="nav-header pull-right">
        <li>
            <div class="btn-group">
                <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button">
                    <img src="<?php echo $one->assets_folder; ?>/img/avatars/avatar10.jpg" alt="Avatar">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-header">Profile</li>
                    <li>
                        <a tabindex="-1" href="base_pages_inbox.php">
                            <i class="si si-envelope-open pull-right"></i>
                            <span class="badge badge-primary pull-right">3</span>Inbox
                        </a>
                    </li>
                    <li>
                        <a tabindex="-1" href="base_pages_profile.php">
                            <i class="si si-user pull-right"></i>
                            <span class="badge badge-success pull-right">1</span>Profile
                        </a>
                    </li>
                    <li>
                        <a tabindex="-1" href="javascript:void(0)">
                            <i class="si si-settings pull-right"></i>Settings
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Actions</li>
                    <li>
                        <a tabindex="-1" href="base_pages_lock.php">
                            <i class="si si-lock pull-right"></i>Lock Account
                        </a>
                    </li>
                    <li>
                        <a tabindex="-1" href="base_pages_login.php">
                            <i class="si si-logout pull-right"></i>Log out
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
            <button class="btn btn-default" data-toggle="layout" data-action="side_overlay_toggle" type="button">
                <i class="fa fa-tasks"></i>
            </button>
        </li>
    </ul>
    <!-- END Header Navigation Right -->
</header>
<!-- END Header -->
