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
                        <label class="col-md-4 control-label" for="Intervenant_BE">Intervenant BE <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="js-datepicker form-control" type="text" id="Intervenant_BE" name="Intervenant_BE" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Plans">Plans<span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="Plans" name="Plans">
                                <option value="">Séléctionnez un type</option>
                                <option value="NON_REALISES">NON REALISES</option>
                                <option value="EN_COURS">EN COURS</option>
                                <option value="OK">OK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Linéaire_de_réseau">Linéaire de réseau<span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input type="text" id="Linéaire_de_réseau" name="Linéaire_de_réseau" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Contrôle_des_plans">Contrôle des plans<span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="Contrôle_des_plans" name="Contrôle_des_plans">
                                <option value="">Séléctionnez un type</option>
                                <option value="NonControlés">Non Contrôlés</option>
                                <option value="Contole_ok">Contrôlés OK</option>
                                <option value="Controles_NOK">Contrôlés NOK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Date_Transmission_Plans">Date Transmission Plans
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="Date_Transmission_Plans" name="Date_Transmission_Plans">
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
                        <label class="col-md-4 control-label" for="Date_Aiguillage">Date Aiguillage
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="Date_Aiguillage" name="Date_Aiguillage">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Date_ret_Prev">Date ret Prev
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="Date_ret_Prev" name="Date_ret_Prev">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Duree">Durée
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="Duree" name="Duree">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Contrôle_démarrage_effectif">Contrôle démarrage effectif
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="Contrôle_démarrage_effectif" name="Contrôle_démarrage_effectif">
                                <option value="">Séléctionnez un type</option>
                                <option value="OK">OK</option>
                                <option value="NOK">NOK</option>
                                <option value="Reporté">Reporté</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Avancement">Avancement
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="Avancement" name="Avancement">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Controle_parallele">Contrôle parallèle
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="Controle_parallele" name="Controle_parallele">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Date_Retour">Date Retour
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="Date_Retour" name="Date_Retour">

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Etat_Retour">Etat Retour
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="Etat_Retour" name="Etat_Retour">
                                <option value="">Séléctionnez un type</option>
                                <option value="PAS_DE_RETOUR">PAS DE RETOUR</option>
                                <option value="RETOUR_OK">RETOUR OK</option>
                                <option value=""RETOUR_NOK">"RETOUR NOK</option>
                            </select>
                            <input type="file" id="Fichiers" name="Fichiers" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" multiple="multiple">


                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Contrôle_après_travaux">Contrôle après travaux
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="Contrôle_après_travaux" name="Contrôle_après_travaux">

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