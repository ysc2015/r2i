<?php if($action == "list"): ?>
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header">
                <button type="button" class="btn btn-minw btn-default push-5-r push-10 open-add-form" id="add_project"><i class="fa fa-plus"></i> Ajouter fichier</button>
                <h3 class="block-title">Liste des fichiers</h3>
            </div>
            <div class="block-content">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                <table class="table table-bordered table-striped js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th>Nom fichier</th>
                        <th class="hidden-xs">Nom serveur</th>
                        <th class="hidden-xs">Date injection</th>
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
<?php if($action == "addroomfile"): ?>
    <div class="content">
        <h2 class="content-heading">Ajout Fichier</h2>
        <!-- Bootstrap Forms Validation -->
        <div class="block">
            <div class="block-header">
            </div>
            <div class="block-content block-content-narrow">
                <!-- jQuery Validation (.js-validation-bootstrap class is initialized in js/pages/base_forms_validation.js) -->
                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                <form class="js-validation-bootstrap form-horizontal"">
                    <div class="form-group">
                        <label class="col-xs-12" for="example-myfile">Séléctionner fichier à injecter</label>
                        <div class="col-xs-12">
                            <input type="file" id="myfile" name="myfile" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button class="btn btn-sm btn-primary add-file" type="submit">Injecter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Bootstrap Forms Validation -->
    </div>
<?php endif; ?>
<?php if($action == "mod"): ?>
    <?php echo "mod"?>
<?php endif; ?>

<!-- loader Modal -->
<div class="modal" id="loader" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="progress active">
                    <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Injection de fichier en cours ...</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END loader Modal -->
<!-- success Modal -->
<div class="modal" id="successalert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <!-- Success Alert -->
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="font-w300 push-15">R2I</h3>
                    <p id="successmsg"></p>
                </div>
                <!-- END Success Alert -->
            </div>
        </div>
    </div>
</div>
<!-- END success Modal -->

<!-- error Modal -->
<div class="modal" id="erroralert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <!-- Success Alert -->
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="font-w300 push-15">R2I</h3>
                    <p id="errormsg"></p>
                </div>
                <!-- END Success Alert -->
            </div>
        </div>
    </div>
</div>
<!-- END error Modal -->
