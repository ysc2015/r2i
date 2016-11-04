<?php
/**
 * file: side-overlay.php
 * User: rabii
 */
?>
<?php if($connectedProfil->profil->profil->shortlib == "adm") {?>
    <!-- Side Overlay-->
    <aside id="side-overlay">
        <!-- Side Overlay Scroll Container -->
        <div id="side-overlay-scroll">
            <!-- Side Header -->
            <div class="side-header side-content">
                <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                <button class="btn btn-default pull-right" type="button" data-toggle="layout" data-action="side_overlay_close">
                    <i class="fa fa-times"></i>
                </button>
                        <span>
                            <img class="img-avatar img-avatar32" src="assets/img/avatars/avatar10.jpg" alt="">
                            <span class="font-w600 push-10-l"><?= $connectedProfil->prenom_utilisateur." ".$connectedProfil->nom_utilisateur?> (Administrateur)</span>
                        </span>
            </div>
            <!-- END Side Header -->

            <!-- Side Content -->
            <div class="side-content remove-padding-t">
                <!-- gestion -->
                <div class="block pull-r-l">
                    <div class="block-header bg-gray-lighter">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                            </li>
                        </ul>
                        <h3 class="block-title">Gestion</h3>
                    </div>
                    <div class="block-content">
                        <!-- gestion List -->
                        <div class="list-group">
                            <a class="list-group-item" href="?page=utilisateur">
                                <i class="fa fa-users push-5-r"></i> Utilisateurs
                            </a>
                            <a class="list-group-item" href="?page=nro">
                                <i class="fa fa-link push-5-r"></i> Nro
                            </a>
                            <a class="list-group-item" href="?page=nropci">
                                <i class="fa fa-link push-5-r"></i> Nro/PCI
                            </a>
                            <a class="list-group-item" href="?page=mailcreation">
                                <i class="fa fa-fw fa-list-alt push-5-r"></i> Mails création projet
                            </a>
                        </div>
                        <!-- END gestion List -->
                    </div>
                </div>
                <!-- END gestion -->
            </div>
            <!-- END Side Content -->
        </div>
        <!-- END Side Overlay Scroll Container -->
    </aside>
    <!-- END Side Overlay -->
<?php } ?>
