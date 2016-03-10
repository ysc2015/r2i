
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
                    <label class="col-md-4 control-label" for="profil_id">Profil <span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <select class="form-control" id="type_profil" name="type_profil">
                            <option value="">Séléctionnez un type</option>
                            <option value="1">ADMIN</option>
                            <option value="1">User</option>

                        </select>
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

</div>
<!-- END Page Content -->