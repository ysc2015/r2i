<?php if($action == "add"): ?>
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading">
                    Réseau de Distribution <small>[Design CDI/CAD]</small>
                </h1>
            </div>
            <div class="col-sm-4 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a class="link-effect" href="">Buttons</a></li>
                    <li>UI Elements</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->
    <div class="content">
        <!-- Form -->
        <div class="block block-bordered">
            <div class="block-content">
                <form class="js-validation-bootstrap form-horizontal push-10-t push-10">
                    <input type="hidden" id="zone_id" name="zone_id" value="<?php echo $_GET['zoneid']?>">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="user_be">Intervenant BE <span class="text-danger">*</span></label>
                            <select class="form-control" id="user_be" name="user_be">
                                <option value="">Séléctionnez une valeur</option>
                                <?php
                                $beiusers = UserPDO::getUsersByProfilId(4);
                                foreach($beiusers as $key => $value) {
                                    echo '<option value="'.$value['user_id'].'">'.$value['user_firstname'].' '.$value['user_lastname'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="user_bex">Intervenant BEX <span class="text-danger">*</span></label>
                            <select class="form-control" id="user_bex" name="user_bex">
                                <option value="">Séléctionnez une valeur</option>
                                <?php
                                $beiusers = UserPDO::getUsersByProfilId(4);
                                foreach($beiusers as $key => $value) {
                                    echo '<option value="'.$value['user_id'].'">'.$value['user_firstname'].' '.$value['user_lastname'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="start_date">Date Début <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="start_date" name="start_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="end_date">Date de Fin <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="end_date" name="end_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="duration">Durée <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="duration" name="duration">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="linear_dist">Linéaire Distribution <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="linear_dist" name="linear_dist">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="state">Etat <span class="text-danger">*</span></label>
                            <select class="form-control" id="state" name="state">
                                <option value="">Séléctionnez une valeur</option>
                                <option value="1">Prévu</option>
                                <option value="2">En Cours</option>
                                <option value="3">Réalisé</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="send_date">Date envoi <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="send_date" name="send_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <button class="btn btn-primary add-distdesign" type="button">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Form -->
    </div>
<?php endif; ?>
<?php if($action == "edit"): ?>
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading">
                    Buttons <small>[here desc]</small>
                </h1>
            </div>
            <div class="col-sm-4 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a class="link-effect" href="">Buttons</a></li>
                    <li>UI Elements</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->
    <div class="content">
        <!-- Mega Form -->
        <div class="block block-bordered">
            <div class="block-content">
                <form class="js-validation-bootstrap form-horizontal">
                    <input type="hidden" id="distdesign_id" name="distdesign_id" value="<?php echo $_GET[$activePage."id"]?>">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="user_be">Intervenant BE <span class="text-danger">*</span></label>
                            <select class="form-control" id="user_be" name="user_be">
                                <option value="">Séléctionnez une valeur</option>
                                <?php
                                $beiusers = UserPDO::getUsersByProfilId(4);
                                foreach($beiusers as $key => $value) {
                                    echo '<option value="'.$value['user_id'].'" '.($distdesign['user_be']==$value['user_id']?"selected":"").'>'.$value['user_firstname'].' '.$value['user_lastname'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="user_bex">Intervenant BEX <span class="text-danger">*</span></label>
                            <select class="form-control" id="user_be" name="user_be">
                                <option value="">Séléctionnez une valeur</option>
                                <?php
                                $beiusers = UserPDO::getUsersByProfilId(4);
                                foreach($beiusers as $key => $value) {
                                    echo '<option value="'.$value['user_id'].'" '.($distdesign['user_bex']==$value['user_id']?"selected":"").'>'.$value['user_firstname'].' '.$value['user_lastname'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="start_date">Date Début <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="start_date" name="start_date" value="<?php echo ($distdesign['start_date']!=""?DateTime::createFromFormat('Y-m-d', $distdesign['start_date'])->format('d/m/Y'):"")?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="end_date">Date de Fin <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="end_date" name="end_date" value="<?php echo ($distdesign['end_date']!=""?DateTime::createFromFormat('Y-m-d', $distdesign['end_date'])->format('d/m/Y'):"")?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="duration">Durée <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="duration" name="duration" value="<?php echo $distdesign['duration']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="linear_dist">Linéaire Distribution <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="linear_dist" name="linear_dist" value="<?php echo $distdesign['linear_dist']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="state">Etat <span class="text-danger">*</span></label>
                            <select class="form-control" id="state" name="state">
                                <option value="">Séléctionnez une valeur</option>
                                <option value="1" <?php echo ($distdesign['state'] == "1" ? "selected":"")?>>Prévu</option>
                                <option value="2" <?php echo ($distdesign['state'] == "2" ? "selected":"")?>>En Cours</option>
                                <option value="3" <?php echo ($distdesign['state'] == "3" ? "selected":"")?>>Réalisé</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="send_date">Date envoi <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="send_date" name="send_date" value="<?php echo ($distdesign['send_date']!=""?DateTime::createFromFormat('Y-m-d', $distdesign['send_date'])->format('d/m/Y'):"")?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <button class="btn btn-primary update-distdesign" type="button">Enregistrer</button>
                        </div>
                    </div>
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