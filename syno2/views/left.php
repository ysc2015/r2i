<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="assets/img/profile_small.jpg" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['user']['LOGIN_ADMIN'] ?></strong>
                            </span> <span class="text-muted text-xs block">Admin <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="index.php?view=profile">Profile</a></li>
                        <li><a href="index.php?view=contacts">Contacts</a></li>
                        <li><a href="index.php?view=mailbox">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    Synoptique
                </div>
            </li>
            
            <li class="<?php echo ($view ==  'dash' ? 'active' : ''); ?>">
                <a href="index.php?view=dash"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> </a>
            </li>
            <li class="<?php echo ($view ==  'syno_alveole_diametre' ? 'active' : ''); ?>">
                <a href="index.php?view=syno_alveole_diametre"><i class="fa fa-user-secret"></i> <span class="nav-label">alveole_diametre</span></a>
            </li>
            <li class="<?php echo $view ==  'syno_chambre' ? 'active' : ''; ?>">
                <a href="index.php?view=syno_chambre"><i class="fa fa-envelope"></i> <span class="nav-label">Chambre </span></a>
            </li>
            <li class="<?php echo $view ==  'syno_diametre' ? 'active' : ''; ?>">
                <a href="index.php?view=syno_diametre"><i class="fa fa-adn"></i> <span class="nav-label">Diametre </span></a>
            </li>
            <li class="<?php echo $view ==  'syno_masque' ? 'active' : ''; ?>">
                <a href="index.php?view=syno_masque"><i class="fa fa-server"></i> <span class="nav-label">Masque </span></a>
            </li>
            <li class="<?php echo $view ==  'syno_passage' ? 'active' : ''; ?>">
                <a href="index.php?view=syno_passage"><i class="fa fa-user"></i> <span class="nav-label">Passage </span></a>
            </li>
            <li class="<?php echo $view ==  'syno_photos' ? 'active' : ''; ?>">
                <a href="index.php?view=syno_photos"><i class="fa fa-users"></i> <span class="nav-label">Photo</span></a>
            </li>
            <li class="<?php echo $view ==  'syno_troncon' ? 'active' : ''; ?>">
                <a href="index.php?view=syno_troncon"><i class="fa fa-users"></i> <span class="nav-label">Troncon</span></a>
            </li>
            <li class="<?php echo $view ==  'syno_type_chambre' ? 'active' : ''; ?>">
                <a href="index.php?view=syno_type_chambre"><i class="fa fa-users"></i> 
                    <span class="nav-label">Type_chambre</span>
                </a>
            </li>
            <li class="<?php echo $view ==  'syno_type_infra' ? 'active' : ''; ?>">
                <a href="index.php?view=syno_type_infra"><i class="fa fa-users"></i> 
                    <span class="nav-label">Type_infra</span>
                </a>
            </li>
            <li class="<?php echo $view ==  'syno_type_reseau' ? 'active' : ''; ?>">
                <a href="index.php?view=syno_type_reseau"><i class="fa fa-users"></i> 
                    <span class="nav-label">Type_reseau</span>
                </a>
            </li>
        </ul>
    </div>
</nav>