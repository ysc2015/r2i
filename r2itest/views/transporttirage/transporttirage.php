<?php if($action == "add"): ?>
    <div class="content">
        <!-- Mega Form -->
        <h2 class="content-heading">Réseau de transport (Tirage)</h2>
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
                        <label class="col-md-4 control-label" for="IntervantBE_tirage">Intervenant BE
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="IntervantBE_tirage" name="IntervantBE_tirage">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Date_Previsionnelle">Date Previsionnelle
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="Date_Previsionnelle" name="Date_Previsionnelle">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Preparation_des_plans">Préparation des plans
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="Preparation_des_plans" name="Preparation_des_plans">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Controle_des_plans">Contrôle des plans
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="Controle_des_plans" name="Controle_des_plans">
                                <option value="">Séléctionnez un type</option>
                                <option value="NonControles">Non Contrôlés</option>
                                <option value="ControlesOk">Contrôlés OK</option>
                                <option value="ControlesNOk">Contrôlés NOK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="DateTransmissionPlans">Date Transmission Plans
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="DateTransmissionPlans" name="DateTransmissionPlans">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Entreprise">Entreprise
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="Entreprise" name="Entreprise">
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
                        <label class="col-md-4 control-label" for="DateTirage">Date Tirage
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="DateTirage" name="DateTirage">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="DateRetourPrev">Date Retour Prev
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="DateRetourPrev" name="DateRetourPrev">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="DureeTirage">Durée
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="DureeTirage" name="DureeTirage">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ControleDemarrageEffectif">Contrôle démarrage effectif
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="ControleDemarrageEffectif" name="ControleDemarrageEffectif">
                                <option value="">Séléctionnez un type</option>
                                <option value="OK">OK</option>
                                <option value="NOK">NOK</option>
                                <option value="Reporte">Reporté</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="avancement">Avancement
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="avancement" name="avancement">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ControleParallele">Contrôle parallèle
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="ControleParallele" name="ControleParallele">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-4 control-label" for="DateRetour">Date Retour
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="DateRetour" name="DateRetour">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="EtatRetour">Etat Retour
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="EtatRetour" name="EtatRetour">
                                <option value="">Séléctionnez un type</option>
                                <option value="nonRETOUR">PAS DE RETOUR</option>
                                <option value="OK">RETOUR OK</option>
                                <option value="NOK">RETOUR NOK</option>
                            </select>
                            <div class="col-md-7">
                                <p>Si retour nok :</p>
                                <input type="file" id="Fichiers" name="Fichiers" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" multiple="multiple">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ControleApresTravaux">Contrôle après travaux
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="ControleApresTravaux" name="ControleApresTravaux">
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