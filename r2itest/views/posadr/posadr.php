<?php if($action == "add"): ?>
    <div class="content">
        <!-- Mega Form -->
        <h2 class="content-heading">Préparation plaque (Positionnement des Adresses)</h2>
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
                        <label class="col-md-4 control-label" for="user_be">Intervant BE
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
                        <label class="col-md-4 control-label" for="date_deb">Date de Début
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="date_deb" name="date_deb" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ret_date_prev">Date ret Prev
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="date" id="ret_date_prev" name="ret_date_prev" >
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
                        <label class="col-md-4 control-label" for="user">Intervenant
                            <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="user" name="user">
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
                            <label class="col-md-4 control-label" for="bpe_site">BPE sur SITE
                                <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <select class="form-control" id="bpe_site" name="bpe_site">
                                    <option value="">Séléctionnez un type</option>
                                    <option value="A_PLACER"">A PLACER </option>
                                    <option value="PLACES">PLACES</option>
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
                                <button class="btn btn-success add-pos-adr" type="button"><i class="fa fa-check push-5-r"></i> Enregistrer</button>
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