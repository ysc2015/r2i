<?php if($action == "add"): ?>
    <div class="content">
        <!-- Mega Form -->
        <h2 class="content-heading">Réseau de transport (Design)</h2>
        <div class="block block-bordered">
            <!--<div class="block-header bg-gray-lighter">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                </ul>
                <h3 class="block-title">Multiple Columns</h3>
            </div>-->
            <div class="block-content">
                <form class="js-validation-bootstrap form-horizontal push-10-t push-10">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="IntervenantBE">Intervenant BE
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="IntervenantBE" name="IntervenantBE">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="DOE">DOE
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="DOE" name="DOE">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Netgeo">Netgeo
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="Netgeo" name="Netgeo">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="IntervenantFREE">Intervenant FREE
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="IntervenantFREE" name="IntervenantFREE">
                                <option value="">Séléctionnez un type</option>
                                <option value="PCI">PCI</option>
                                <option value="CDT"> CDT</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="IntervenantEntreprise">Intervenant Entreprise
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="IntervenantEntreprise" name="IntervenantEntreprise">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="DatedeRecette">Date de Recette
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="DatedeRecette" name="DatedeRecette">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="EtatRecette">Etat Recette
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control"  id="EtatRecette" name="EtatRecette">
                                <option value="">Séléctionnez un type</option>
                                <option value="NonPrevue">Recette Non Prévue</option>
                                <option value="Prevue"> Recette Prévue</option>
                                <option value="ok">Recette OK</option>
                                <option value="ajournee"> Recette Ajournée</option>
                            </select>
                            <p> Si recette ajournée uploadez le fichier de recette </p>
                            <div class="col-md-7">
                                <input type="file" id="FichierRecette" name="FichierRecette" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" multiple="multiple">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Mega Form -->
    </div>
<?php endif; ?>
<?php if($action == "edit"): ?>
    <div class="content">
        <!-- Mega Form -->
        <h2 class="content-heading">Info Zone de Travaux(sous-projet)</h2>
        <div class="block block-bordered">
            <!--<div class="block-header bg-gray-lighter">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                </ul>
                <h3 class="block-title">Multiple Columns</h3>
            </div>-->
            <div class="block-content">
                <form class="js-validation-bootstrap form-horizontal push-10-t push-10">
                </form>
            </div>
        </div>
        <!-- END Mega Form -->
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