<?php if($action == "add"): ?>
    <div class="content">
        <!-- Mega Form -->
        <h2 class="content-heading">Réseau de transport (Aguillage)</h2>
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
                        <label class="col-md-4 control-label" for="user_be">Intervenant BE <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="user_be" name="user_be">

                                <option value="<?php echo $zone['plate']?>"></option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="plans">Plans<span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="plans" name="plans">
                                <option value="">Séléctionnez un type</option>
                                <option value="NON_REALISES">NON REALISES</option>
                                <option value="EN_COURS">EN COURS</option>
                                <option value="OK">OK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="linear_net">Linéaire de réseau<span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control input-lg" type="number" id="linear_net" name="linear_net" placeholder="en ML chiffre">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="plans_control">Contrôle des plans<span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="plans_control" name="plans_control">
                                <option value="">Séléctionnez un type</option>
                                <option value="NonControlés">Non Contrôlés</option>
                                <option value="Contole_ok">Contrôlés OK</option>
                                <option value="Controles_NOK">Contrôlés NOK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="plans_transmission_date">Date Transmission Plans
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="plans_transmission_date" name="Date_Transmission_Plans">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="company">Entreprise
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="company" name="company">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Fichiers">Fichiers
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input type="file" id="Fichiers" name="Fichiers" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" multiple="multiple">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="switch_date">Date Aiguillage
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="switch_date" name="switch_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ret_date_prev">Date ret Prev
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="ret_date_prev" name="ret_date_prev">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="duration">Durée
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control input-lg" type="number" id="duration" name="duration" placeholder="nombre de jour">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="start_control">Contrôle démarrage effectif
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="start_control" name="start_control">
                                <option value="">Séléctionnez un type</option>
                                <option value="OK">OK</option>
                                <option value="NOK">NOK</option>
                                <option value="Reporté">Reporté</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="done">Avancement
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="done" name="done" >

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="parralel_control">Contrôle parallèle
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="parralel_control" name="parralel_control">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ret_date">Date Retour
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="ret_date" name="ret_date">

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ret_state">Etat Retour
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="ret_state" name="ret_state">
                                <option value="">Séléctionnez un type</option>
                                <option value="PAS_DE_RETOUR">PAS DE RETOUR</option>
                                <option value="RETOUR_OK">RETOUR OK</option>
                                <option value=""RETOUR_NOK">"RETOUR NOK</option>
                            </select>
                            <p>Si retour nok </p>
                            <input type="file" id="Fichiers" name="Fichiers" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" multiple="multiple">


                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="after_work_control">Contrôle après travaux
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="after_work_control" name="after_work_control">

                        </div>
                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-success submit-transportswitch" type="submit"> Enregistrer</button>
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