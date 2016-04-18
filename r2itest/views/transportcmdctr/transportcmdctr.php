<?php if($action == "add"): ?>
    <div class="content">
        <!-- Mega Form -->
        <h2 class="content-heading">Réseau de transport (Commande Structurante CTR)</h2>
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
                        <label class="col-md-4 control-label" for="Date_but_trait_ret">Date butoire traitement retour Aig j+3
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="Date_but_trait_ret" name="Date_but_trait_ret">

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="trait_ret_terr">Traitement Retours terrain
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="trait_ret_terr" name="trait_ret_terr">

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="carto_modif">Modification Carto
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="carto_modif" name="carto_modif">
                                <option value="">Séléctionnez un type</option>
                                <option value="oui">Oui</option>
                                <option value="non">Non</option>

                            </select>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="cmnd_acces">Commande Accès
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="cmnd_acce" name="cmnd_acces">
                                <option value="">Séléctionnez un type</option>
                                <option value="EnCours">En Cours</option>
                                <option value="Realisee">Réalisée</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="date_trans_ca">Date Transmission CA
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="date_trans_ca" name="date_trans_ca">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ref_cmnd_acce">Référence Commande Accès
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="ref_cmnd_acce" name="ref_cmnd_acce">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="go_ft">GO FT
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="go_ft" name="go_ft">
                                <option value="">Séléctionnez un type</option>
                                <option value="ComndeEnCours">Commande En cours</option>
                                <option value="CommndeValide">Commande validée</option>
                                <option value="CommndeRefuse">Commande Refusée</option>
                            </select>
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
                                <button class="btn btn-success add-transport-cmdctr" type="button"><i class="fa fa-check push-5-r"></i> Enregistrer</button>
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