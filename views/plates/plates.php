<?php if($action == "add"): ?>
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading">
                    Gestion Plaque <small>[Phase-Traitement Etude]<small>
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
                            <label for="instig">Instigateur <span class="text-danger">*</span></label>
                            <select class="form-control" id="instig" name="instig">
                                <option value="">Séléctionnez une valeur</option>
                                <option value="1">BMB</option>
                                <option value="2">RME</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="vague">Vague <span class="text-danger">*</span></label>
                            <select class="form-control" id="vague" name="vague">
                                <option value="">Séléctionnez une valeur</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="launch_date">Date Lancement <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="launch_date" name="launch_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="site">Site <span class="text-danger">*</span></label>
                            <select class="form-control" id="site" name="site">
                                <option value="">Séléctionnez une valeur</option>
                                <option value="1">MPL</option>
                                <option value="2">BZN</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="stud_user">Chargé d'étude <span class="text-danger">*</span></label>
                            <select class="form-control" id="stud_user" name="stud_user">
                                <option value="">Séléctionnez un BEI</option>
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
                            <button class="btn btn-primary add-plates" type="button">Enregistrer</button>
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
                    Gestion Plaque <small>[Phase-Traitement Etude]<small>
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
                    <input type="hidden" id="plate_id" name="plate_id" value="<?php echo $_GET[$activePage."id"]?>">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="instig">Instigateur <span class="text-danger">*</span></label>
                            <select class="form-control" id="instig" name="instig">
                                <option value="">Séléctionnez une valeur</option>
                                <option value="1" <?php echo ($plates['instig'] == "1" ? "selected":"")?>>BMB</option>
                                <option value="2" <?php echo ($plates['instig'] == "2" ? "selected":"")?>>RME</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="vague">Vague <span class="text-danger">*</span></label>
                            <select class="form-control" id="vague" name="vague">
                                <option value="">Séléctionnez une valeur</option>
                                <option value="1" <?php echo ($plates['vague'] == "1" ? "selected":"")?>>1</option>
                                <option value="2" <?php echo ($plates['vague'] == "2" ? "selected":"")?>>2</option>
                                <option value="3" <?php echo ($plates['vague'] == "3" ? "selected":"")?>>3</option>
                                <option value="4" <?php echo ($plates['vague'] == "4" ? "selected":"")?>>4</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="launch_date">Date Lancement <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="launch_date" name="launch_date" value="<?php echo ($plates['launch_date']!=""?DateTime::createFromFormat('Y-m-d', $plates['launch_date'])->format('d/m/Y'):"")?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="site">Site <span class="text-danger">*</span></label>
                            <select class="form-control" id="site" name="site">
                                <option value="">Séléctionnez une valeur</option>
                                <option value="1" <?php echo ($plates['site'] == "1" ? "selected":"")?>>MPL</option>
                                <option value="2" <?php echo ($plates['site'] == "2" ? "selected":"")?>>BZN</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="stud_user">Chargé d'étude <span class="text-danger">*</span></label>
                            <select class="form-control" id="stud_user" name="stud_user">
                                <option value="">Séléctionnez une valeur</option>
                                <?php
                                $beiusers = UserPDO::getUsersByProfilId(4);
                                foreach($beiusers as $key => $value) {
                                    echo '<option value="'.$value['user_id'].'" '.($plates['stud_user']==$value['user_id']?"selected":"").'>'.$value['user_firstname'].' '.$value['user_lastname'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <button class="btn btn-primary update-plates" type="button">Enregistrer</button>
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