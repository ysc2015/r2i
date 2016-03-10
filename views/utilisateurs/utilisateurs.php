
<?php if($action == "list"): ?>
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header">
                <button type="button" class="btn btn-minw btn-default push-5-r push-10 open-add-form" id="add_utilisateur">
                    <i class="fa fa-plus">

                    </i> Ajouter Utilisateur</button>
                <h3 class="block-title">Liste des Utilisateurs</h3>
            </div>
            <div class="block-content">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                <table class="table table-bordered table-striped js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th>profile</th>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>email</th>
                        <th class="text-center" style="width: 10%;">"3Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
<?php endif; ?>
<?php if($action == "add"): ?>
    <div class="content">
        <h2 class="content-heading">Ajout Utilsateur</h2>
        <!-- Bootstrap Forms Validation -->
        <div class="block">
            <div class="block-header">
            </div>
            <div class="block-content block-content-narrow">
                <!-- jQuery Validation (.js-validation-bootstrap class is initialized in js/pages/base_forms_validation.js) -->
                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                <form class="js-validation-bootstrap form-horizontal"">
                <div class="form-group">
                    <label class="col-md-4 control-label" for="profil_id">Profil Id <span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" id="profil_id" name="city">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="firstname">Firstname <span class="text-danger">
                            *</span></label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" id="firstname" name="firstname">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="lastname">Lastname<span class="text-danger">
                            *</span></label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" id="lastname" name="lastname">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email<span class="text-danger">
                            *</span></label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" id="email" name="email">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">Password <span class="text-danger">
                            *</span></label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" id="password" name="password" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="salt">Salt <span class="text-danger">
                            *</span></label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" id="salt" name="salt" >
                    </div>
                </div>
                </form>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button class="btn btn-sm btn-primary add-project" type="button">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap Forms Validation -->
    </div>
<?php endif; ?>
<?php if($action == "mod"): ?>
    <?php echo "mod"?>
<?php endif; ?>
<?php if($action == "sdfiles"): ?>
    <?php if(isset($_GET['idp']) && $_GET['idp'] !=""): ?>
        <div class="content">
            <div class="row items-push push-20-t nice-copy">
                <div class="col-md-6">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Liste des fichiers</h3>
                        </div>
                        <div class="block-content">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <table class="table table-bordered table-striped js-dataTable-full">
                                <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th>Name</th>
                                    <th class="hidden-xs">Email</th>
                                    <th class="hidden-xs">Access</th>
                                    <th class="hidden-xs">Access</th>
                                    <th class="text-center" style="width: 10%;">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->
                </div>
                <div class="col-md-6">
                    <div id="fileuploader">Ajouter fichiers</div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div>pas possible d'afficher sd</div>
    <?php endif; ?>
<?php endif; ?>







<div class="content">

    <div class="row">
        <div class="col-lg-8">
            <!-- News -->
            <div class="block">

                <div class="block-content bg-gray-lighter">
                    <!-- Slick slider (.js-slider class is initialized in App() -> uiHelperSlick()) -->
                    <!-- For more info and examples you can check out http://kenwheeler.github.io/slick/ -->
                    <div class="js-slider remove-margin-b" data-slider-autoplay="true" data-slider-autoplay-speed="4000">




                    </div>
                    <!-- END Slick slider -->
                </div>
                <div class="block-content">
                    <ul class="list list-timeline pull-t">
                        <!-- Twitter Notification -->
                        <li>
                            <div class="list-timeline-time">12 hrs ago</div>
                            <i class="fa fa-twitter list-timeline-icon bg-info"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">+ 1150 Followers</p>
                                <p class="font-s13">You’re getting more and more followers, keep it up!</p>
                            </div>
                        </li>
                        <!-- END Twitter Notification -->

                        <!-- Generic Notification -->
                        <li>
                            <div class="list-timeline-time">4 hrs ago</div>
                            <i class="fa fa-briefcase list-timeline-icon bg-city"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">+ 3 New Products were added!</p>
                                <p class="font-s13">Congratulations!</p>
                            </div>
                        </li>
                        <!-- END Generic Notification -->

                        <!-- System Notification -->
                        <li>
                            <div class="list-timeline-time">1 day ago</div>
                            <i class="fa fa-check list-timeline-icon bg-success"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">Database backup completed!</p>
                                <p class="font-s13">Download the <a href="javascript:void(0)">latest backup</a>.</p>
                            </div>
                        </li>
                        <!-- END System Notification -->



                        <!-- Social Notification -->
                        <li>
                            <div class="list-timeline-time">2 days ago</div>
                            <i class="fa fa-user-plus list-timeline-icon bg-modern"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">+ 3 Friend Requests</p>
                                <ul class="nav-users push-10-t push">
                                    <li>
                                        <a href="base_pages_profile.php">
                                            <?php $one->get_avatar('', 'male'); ?>
                                            <i class="fa fa-circle text-success"></i> <?php $one->get_name('male'); echo "\n"; ?>
                                            <div class="font-w400 text-muted"><small>Graphic Designer</small></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="base_pages_profile.php">
                                            <?php $one->get_avatar('', 'female'); ?>
                                            <i class="fa fa-circle text-warning"></i> <?php $one->get_name('female'); echo "\n"; ?>
                                            <div class="font-w400 text-muted"><small>Photographer</small></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="base_pages_profile.php">
                                            <?php $one->get_avatar('', 'male'); ?>
                                            <i class="fa fa-circle text-danger"></i> <?php $one->get_name('male'); echo "\n"; ?>
                                            <div class="font-w400 text-muted"><small>UI Designer</small></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- END Social Notification -->

                        <!-- System Notification -->
                        <li class="push-5">
                            <div class="list-timeline-time">1 week ago</div>
                            <i class="fa fa-cog list-timeline-icon bg-primary-dark"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">System updated to v2.02</p>
                                <p class="font-s13">Check the complete changelog at the
                                    <a href="javascript:void(0)">activity page</a>.</p>
                            </div>
                        </li>
                        <!-- END System Notification -->
                    </ul>
                </div>
            </div>
            <!-- END News -->
        </div>
        <div class="col-lg-4">
            <!-- Content Grid -->
            <div class="content-grid">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Author of the Month -->
                        <a class="block block-link-hover2" href="base_pages_profile.php">
                            <div class="block-header">
                                <h3 class="block-title text-center">Author of the Month</h3>
                            </div>
                            <div class="block-content block-content-full text-center bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/img/photos/photo2.jpg');">
                                <div>
                                    <?php $one->get_avatar(1, '', 96, true); ?>
                                </div>
                                <div class="h5 text-white push-15-t push-5"><?php $one->get_name('female'); ?></div>
                                <div class="h5 text-white-op">Web Developer</div>
                            </div>
                            <div class="block-content">
                                <div class="row items-push text-center">
                                    <div class="col-xs-6">
                                        <div class="push-5"><i class="si si-briefcase fa-2x"></i></div>
                                        <div class="h5 font-w300 text-muted">9 Projects</div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="push-5"><i class="si si-camera fa-2x"></i></div>
                                        <div class="h5 font-w300 text-muted">74 Photos</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- END Author of the Month -->

                        <!-- Mini Stats -->
                        <a class="block block-link-hover3" href="javascript:void(0)">
                            <table class="block-table text-center">
                                <tbody>
                                <tr>
                                    <td style="width: 50%;">
                                        <div class="push-30 push-30-t">
                                            <i class="si si-graph fa-3x text-primary"></i>
                                        </div>
                                    </td>
                                    <td class="bg-gray-lighter" style="width: 50%;">
                                        <div class="h1 font-w700"><span class="h2 text-muted">+</span> 78</div>
                                        <div class="h5 text-muted text-uppercase push-5-t">Sales</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </a>
                        <a class="block block-link-hover3" href="javascript:void(0)">
                            <table class="block-table text-center">
                                <tbody>
                                <tr>
                                    <td style="width: 50%;">
                                        <div class="push-30 push-30-t">
                                            <i class="si si-social-dribbble fa-3x text-smooth"></i>
                                        </div>
                                    </td>
                                    <td class="bg-gray-lighter" style="width: 50%;">
                                        <div class="h1 font-w700"><span class="h2 text-muted">+</span> 69</div>
                                        <div class="h5 text-muted text-uppercase push-5-t">Likes</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </a>
                        <a class="block block-link-hover3" href="javascript:void(0)">
                            <table class="block-table text-center">
                                <tbody>
                                <tr>
                                    <td style="width: 50%;">
                                        <div class="push-30 push-30-t">
                                            <i class="si si-social-youtube fa-3x text-city"></i>
                                        </div>
                                    </td>
                                    <td class="bg-gray-lighter" style="width: 50%;">
                                        <div class="h1 font-w700"><span class="h2 text-muted">+</span> 88</div>
                                        <div class="h5 text-muted text-uppercase push-5-t">Subs</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </a>
                        <a class="block block-link-hover3" href="javascript:void(0)">
                            <table class="block-table text-center">
                                <tbody>
                                <tr>
                                    <td style="width: 50%;">
                                        <div class="push-30 push-30-t">
                                            <i class="si si-users fa-3x text-primary-dark"></i>
                                        </div>
                                    </td>
                                    <td class="bg-gray-lighter" style="width: 50%;">
                                        <div class="h1 font-w700"><span class="h2 text-muted">+</span> 96</div>
                                        <div class="h5 text-muted text-uppercase push-5-t"> Followers</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </a>
                        <!-- END Mini Stats -->
                    </div>
                </div>
            </div>
            <!-- END Content Grid -->
        </div>
    </div>
</div>
<!-- END Page Content -->