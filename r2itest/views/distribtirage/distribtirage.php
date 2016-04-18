<?php if($action == "add"): ?>
    <div class="content">
        <!-- Mega Form -->
        <h2 class="content-heading">Réseau de Distribution (Tirage)</h2>
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
                        <label class="col-md-4 control-label" for="user_be">Intervenant BE
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="user_be" name="user_be">
                                <optgroup label="BEI">
                                    <?php
                                    $profils = UserPDO::getAllUsers()["data"];
                                    foreach($profils as $key => $value) {
                                        echo '<option value="'.$value['user_id'].'">'.$value['user_lastname'].' '.$value['user_firstname'].'</option>';
                                    }
                                    ?>
                                </optgroup>
                                <optgroup label="BEX" >
                                    <option>BEX</option>

                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="prev_date">Date Previsionnelle
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="prev_date" name="prev_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="plan_prep">Préparation des plans
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">

                            <select class="form-control" id="plan_prep" name="plan_prep">
                                <option value="">Séléctionnez un type</option>

                                <?php
                                $profils = UserPDO::getAllUsers()["data"];
                                foreach($profils as $key => $value) {
                                    echo '<option value="'.$value['user_id'].'">'.$value['user_lastname'].' '.$value['user_firstname'].'</option>';
                                }
                                ?>
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="plan_cont">Contrôle des plans
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="plan_cont" name="plan_cont">
                                <option value="">Séléctionnez un type</option>
                                <option value="NonControles">Non Contrôlés</option>
                                <option value="ControlesOk">Contrôlés OK</option>
                                <option value="ControlesNOk">Contrôlés NOK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="plan_trans_date">Date Transmission Plans
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="plan_trans_date" name="plan_trans_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="comp">Entreprise
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="comp" name="comp">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="file">Fichiers
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input type="file" id="file" name="file" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" multiple="multiple">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="print_date">Date Tirage
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="print_date" name="print_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="duration">Durée
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="number" id="duration" name="duration" placeholder="Chiffre en jours">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="cont_dem_effec">Contrôle démarrage effectif
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="cont_dem_effec" name="cont_dem_effec">
                                <option value="">Séléctionnez un type</option>
                                <option value="OK">OK</option>
                                <option value="NOK">NOK</option>
                                <option value="Reporte">Reporté</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="advance">Avancement
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="advance" name="advance">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="cont_paral">Contrôle parallèle
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="cont_paral" name="cont_paral">
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
                                <option value="nonRETOUR">PAS DE RETOUR</option>
                                <option value="OK">RETOUR OK</option>
                                <option value="NOK">RETOUR NOK</option>
                            </select>
                            <div class="col-md-7">
                                <p></p>
                                <input type="file" id="Fichiers" name="Fichiers" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" multiple="multiple">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="cont_after_job">Contrôle après travaux
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="cont_after_job" name="cont_after_job">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
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
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button class="btn btn-success add-distrib-tirage" type="button"><i class="fa fa-check push-5-r"></i> Enregistrer</button>
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