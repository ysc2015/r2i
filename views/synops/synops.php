<?php if($action == "list"): ?>
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading">
                    Buttons <small>Clickable areas that are easy to recognize but perfectly match the overall design.</small>
                </h1>
            </div>
            <div class="col-sm-4 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li>UI Elements</li>
                    <li><a class="link-effect" href="">Buttons</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->
    <div class="content">
        <!-- Projects Table -->
        <div class="block">
            <div class="block-content">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                <table id="masterTable" class="table table-bordered table-striped js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="hidden-xs">Date de création</th>
                        <th class="hidden-xs">Date d'attribution</th>
                        <th class="hidden-xs">Ville</th>
                        <th class="hidden-xs">Trigramme de la plaque</th>
                        <th class="hidden-xs">Code site</th>
                        <th class="hidden-xs">Type de Site</th>
                        <th class="hidden-xs">Taille(LR)</th>
                        <th class="hidden-xs">Etat Site</th>
                        <th class="hidden-xs">Date Mise à disposition</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Projects Table -->
        <!-- Sub Projects Table (Details)-->
        <div style="display:none">
            <table id="detailsTable" class="table table-striped dt-head-left">
                <thead style="display: none;">
                <tr>
                    <!--<th>DEP</th>
                    <th>Ville</th>
                    <th>Plaque</th>
                    <th>Zone</th>-->
                    <th>réf sous projet</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- END Sub Projects Table (Details)-->
        <div class="row" style="margin: 20px;">
            <button class="btn btn-minw btn-square btn-default open-add-form" type="button">ajouter projet</button>
            <button class="btn btn-minw btn-square btn-primary linked open-edit-form" type="button" disabled>ouvrir projet</button>
            <button class="btn btn-minw btn-square btn-danger open-delete-dialog linked" type="button" disabled>supprimer projet</button>
            <button class="btn btn-minw btn-square btn-info linked open-add-zone-form" type="button" disabled>ajouter sous projet</button>
        </div>
    </div>
    <div id="dialog-confirm" title="Supprimer projet?" style="display: none;">
        <p>Etes vous sur de vouloir supprimer le projet <span class="label label-default" id="project_name"></span> ?(tous les sous-projets et fichiers liés seront supprimés.</p>
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
                <form class="js-validation-bootstrap form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="cdp_user_id">Chef de projet <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="cdp_user_id" name="cdp_user_id">
                                <option value="">Séléctionnez un cdp</option>
                                <?php
                                $cdpusers = UserPDO::getUsersByProfilId(6);
                                foreach($cdpusers as $key => $value) {
                                    echo '<option value="'.$value['user_id'].'" '.($value['user_id']==$project['cdp_user_id'] ? "selected" : "").'>'.$value['user_firstname'].' '.$value['user_lastname'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
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
                        <div class="help-block text-right">(ex : XXX99)</div>
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
                                <option value="2">NRO</option>
                                <option value="3">NRA</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="size">Taille approximative en LR <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="number" id="size" name="size">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="orig_site_state_id">Etat Site Origine <span class="text-danger">*</span></label>
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
                        <label class="col-md-4 control-label" for="orig_site_provision_date">Date Mise à disposition site Origine <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="js-datepicker form-control" type="text" id="orig_site_provision_date" name="orig_site_provision_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="myfile">SD ou Contour de plaque relatif au projet <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input type="file" id="myfile" name="myfile" multiple="multiple"><!--accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"-->
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button class="btn btn-sm btn-primary add-project" type="submit">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Bootstrap Forms Validation -->
    </div>
<?php endif; ?>

<?php if($action == "edit"): ?>
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading">
                    Synoptiques <small>Clickable areas that are easy to recognize but perfectly match the overall design.</small>
                </h1>
            </div>
            <div class="col-sm-4 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li>UI Elements</li>
                    <li><a class="link-effect" href="">Buttons</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->
    <div class="content">
        <div class="row" style="margin-bottom: 20px;margin-left: 0px;">
            <button class="btn btn-minw btn-square btn-primary linked open-upload-syn" type="button">modifier synoptique</button>
            <button class="btn btn-minw btn-square btn-danger open-delete-dialog linked" type="button">supprimer synoptique</button>
        </div>
        <iframe src="<?php echo $r2i->synops_folder."PDB_NULL_02001-BPI_NULL_02022.html"?>"
                style="height:100%;width:100%;border:2px dashed #000">
        </iframe>
    </div>
<?php endif; ?>

<?php if($action == "nothing"): ?>
    <?php echo "page error request"?>
<?php endif; ?>

<!-- loader Modal -->
<div class="modal" id="loader" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="progress active" style="height: 100px;line-height: 90px;">
                    <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        <span id="progressbar" style="margin-top: 40px;display: inline-block;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END loader Modal -->

<div id="alertbox" title="info" style="display: none;">
    <p></p>
</div>
