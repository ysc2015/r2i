<?php if($action == "list"): ?>
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header">
                <button type="button" class="btn btn-minw btn-default push-5-r push-10 open-add-form" id="add_project"><i class="fa fa-plus"></i> Ajouter projet</button>
                <h3 class="block-title">Liste des projets</h3>
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
<?php endif; ?>
<?php if($action == "add"): ?>
    <div class="content">
        <h2 class="content-heading">Ajout Projet</h2>
        <!-- Bootstrap Forms Validation -->
        <div class="block">
            <div class="block-header">
            </div>
            <div class="block-content block-content-narrow">
                <!-- jQuery Validation (.js-validation-bootstrap class is initialized in js/pages/base_forms_validation.js) -->
                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                <form class="js-validation-bootstrap form-horizontal"">
                <div class="form-group">
                    <label class="col-md-4 control-label" for="city">Ville <span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" id="city" name="city">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="plate_dept_code">Trigramme de la plaque + Dept <span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" id="plate_dept_code" name="plate_dept_code">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="site_code">Code site d’origine <span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" id="site_code" name="site_code">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="type_site_id">Type de Site d’origine <span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <select class="form-control" id="type_site_id" name="type_site_id">
                            <option value="">Séléctionnez un type</option>
                            <option value="1">POP</option>
                            <option value="1">NRO</option>
                            <option value="1">NRA</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="size">Taille approximative en LR <span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" id="size" name="size">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="orig_site_state_id">Etat Site Origine <span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <select class="form-control" id="orig_site_state_id" name="orig_site_state_id">
                            <option value="">Séléctionnez un type</option>
                            <option value="1">Promesse</option>
                            <option value="1">Acquis</option>
                            <option value="1">A Commander</option>
                            <option value="1">Prêt pour Travaux</option>
                            <option value="1">En Travaux</option>
                            <option value="1">Recette OK</option>
                            <option value="1">Prêt</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="orig_site_provision_date">Date Mise à disposition site Origine <span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <input class="js-datepicker form-control" type="text" id="orig_site_provision_date" name="orig_site_provision_date" data-date-format="yyyy-mm-dd">
                    </div>
                </div>
                </form>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="fileuploader">SD ou Contour de plaque relatif au projet <span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <div id="fileuploader">Ajouter fichiers</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button class="btn btn-sm btn-primary" id="update-project" type="button">Valider</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap Forms Validation -->
    </div>
<?php endif; ?>
<?php if($action == "mod"): ?>
    <script>
        var project_id = <?php echo "ID"+$_GET['id']; ?>

    </script>
    <div class="content">

        <div class="block">
            <div class="block-header">
            </div>
            <div class="block-content block-content-narrow">

                <form class="js-validation-bootstrap form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ceation_date">date de creation</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="ceation_date" name="ceation_date">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="attribution_date">date d'attribution </label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="attribution_date" name="attribution_date">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="project_name">Le nom du projet </label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="project_name" name="project_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="city">Ville</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="city" name="city">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="plate_dept_code">Trigramme de la plaque + Dept
                            </label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="plate_dept_code" name="plate_dept_code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="site_code">Code site d’origine
                            </label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="site_code" name="site_code">
                        </div>
                    </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="type_site_id">Type de Site d’origine
                            </label>

                            <div class="col-md-7">
                                <select class="form-control" id="type_site_id" name="type_site_id">
                                    <option value="">Séléctionnez un type</option>
                                    <option value="1">POP</option>
                                    <option value="2">NRO</option>
                                    <option value="3">NRA</option>
                                </select>

                        </div>
                            </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="size">Taille approximative en LR </label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="size" name="size">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="orig_site_state_id">Etat Site Origine </label>
                            <div class="col-md-7">
                                <select class="form-control" id="orig_site_state_id" name="orig_site_state_id">
                                    <option value="">Séléctionnez un type</option>
                                    <option value="1">Promesse</option>
                                    <option value="2">Acquis</option>
                                    <option value="3">A Commander</option>
                                    <option value="4">Prêt pour Travaux</option>
                                    <option value="5">En Travaux</option>
                                    <option value="6">Recette OK</option>
                                    <option value="7">Prêt</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="orig_site_provision_date">Date Mise à disposition site Origine </label>
                            <div class="col-md-7">
                                <input class="js-datepicker form-control" type="text" id="orig_site_provision_date" name="orig_site_provision_date" data-date-format="yyyy-mm-dd">
                            </div>
                        </div>
                </form>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="fileuploader">SD ou Contour de plaque relatif au projet </label>
                    <div class="col-md-7">
                        <div id="fileuploader">Ajouter fichiers</div>
                    </div>
                </div>
                </form>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button class="btn btn-sm btn-primary" id="update-project" type="button">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
