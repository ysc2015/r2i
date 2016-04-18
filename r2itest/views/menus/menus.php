<div class="content">
    <h2 class="content-heading">Menu avancement</h2>
    <!-- Bootstrap Forms Validation -->
    <div class="block">
        <div class="block-header">
        </div>
        <div class="block-content block-content-narrow">
            <div class="row">
                <div class="col-md-6">
                    <!-- list Widget -->
                    <div class="list-group">
                        <a class="list-group-item active" href="javascript:void(0)">
                            <i class="fa fa-fw fa-steam-square push-5-r"></i> Gestion Plaque
                        </a>
                        <a class="list-group-item" href="?page=phase&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-map-marker push-5-r"></i> Phase
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item" href="?page=studytraitement&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-sitemap push-5-r"></i> Traitement Etude
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                    </div>
                    <!-- END list Widget -->
                </div>
                <div class="col-md-6">
                    <!-- list Widget -->
                    <div class="list-group">
                        <a class="list-group-item active" href="javascript:void(0)">
                            <i class="fa fa-fw fa-wrench push-5-r"></i> Préparation plaque
                        </a>
                        <a class="list-group-item" href="?page=prepcarto&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-map-marker push-5-r"></i> Préparation Carto
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item" href="?page=posadr&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-sitemap push-5-r"></i> Positionnement des Adresses
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item" href="?page=survadr&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-user-md push-5-r"></i> Survey Adresses Terrain
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                    </div>
                    <!-- END list Widget -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- list Widget -->
                    <div class="list-group">
                        <a class="list-group-item active" href="javascript:void(0)">
                            <i class="fa fa-fw fa-inbox push-5-r"></i> Réseau de Transport
                        </a>
                        <a class="list-group-item" href="?page=transportdesign&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-eye push-5-r"></i> Design
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item" href="?page=transportswitch&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-cogs push-5-r"></i> Aiguillage
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item" href="?page=transportcmdctr&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-code push-5-r"></i> Commande Structurante CTR
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item" href="?page=transporttirage&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-columns push-5-r"></i> Tirage
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item" href="?page=transportracco&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-compress push-5-r"></i> Raccordements
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item" href="?page=transportrecipe&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-coffee push-5-r"></i> Recette
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                    </div>
                    <!-- END list Widget -->
                </div>
                <div class="col-md-6">
                    <!-- list Widget -->
                    <div class="list-group">
                        <a class="list-group-item active" href="javascript:void(0)">
                            <i class="fa fa-fw fa-inbox push-5-r"></i> Réseau de Distribution
                        </a>
                        <a class="list-group-item" href="?page=distribdesign&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-eye push-5-r"></i> Design CDI/CAD
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item" href="?page=distribswitch&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-cogs push-5-r"></i> Aiguillage
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item"  href="?page=distribcmdctr&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-code push-5-r"></i> Commande Structurante CDI
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item"  href="?page=distribtirage&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-columns push-5-r"></i> Tirage
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item"  href="?page=distribracco&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-compress push-5-r"></i> Raccordements
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                        <a class="list-group-item"  href="?page=distribrecipe&zoneid=<?php echo $_GET['zoneid']?>&action=add">
                            <i class="fa fa-fw fa-coffee push-5-r"></i> Recette
                            <span class="label label-primary pull-right">créer</span>
                        </a>
                    </div>
                    <!-- END list Widget -->
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Forms Validation -->
</div>