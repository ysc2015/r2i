<?php if($action == "add"): ?>
    <div class="content">
        <!-- Mega Form -->
        <h2 class="content-heading">Réseau de transport (raccordements)</h2>
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
                        <label class="col-md-4 control-label" for="IntervantBE_raccord">Intervenant BE
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="IntervantBE_raccord" name="IntervantBE_raccord">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="PreparationPDS">Préparation PDS
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="PreparationPDS" name="PreparationPDS">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ControledesPlans">Contrôle des plans
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="ControledesPlans" name="ControledesPlans">
                                <option value="">Séléctionnez un type</option>
                                <option value="non">Non Contrôlés</option>
                                <option value="ok">Contrôlés OK</option>
                                <option value="Nok">Contrôlés NOK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="DateTransmissionPDS">Date Transmission PDS
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="DateTransmissionPDS" name="DateTransmissionPDS">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="EntrepriseRaccord">Entreprise
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="EntrepriseRaccord" name="EntrepriseRaccord">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="FichiersRaccord">Fichiers
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input type="file" id="Fichiers" name="Fichiers" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" multiple="multiple">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="DateRacco">Date Racco
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="DateRacco" name="DateRacco">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="DureeRacco">Durée
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="DureeRacco" name="DureeRacco">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ControleDemarrageEffectif">Contrôle démarrage effectif
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="ControleDemarrageEffectif" name="ControleDemarrageEffectif">
                                <option value="">Séléctionnez un type</option>
                                <option value="OK">OK/option>
                                <option value="NOK"> NOK</option>
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
                        <label class="col-md-4 control-label" for="ControleParall">Contrôle parallèle
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="ControleParall" name="ControleParall">

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
                                <option value="NoRetour">PAS DE RETOUR</option>
                                <option value="ok"> RETOUR OK</option>
                                <option value="nok">RETOUR NOK</option>
                            </select>
                            <p> Si Retour NOK :</p>
                            <div class="col-md-7">
                                <input type="file" id="Fichiers" name="Fichiers" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" multiple="multiple">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ControleApres_travaux">Contrôle après travaux
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="ControleApres_travaux" name="ControleApres_travaux">

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