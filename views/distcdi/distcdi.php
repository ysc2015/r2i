<?php if($action == "add"): ?>
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading">
                    Réseau de Distribution <small>[Commande Structurante CDI]</small>
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
                            <label for="but_ret_date">Date butoire traitement retour Aig j+3 <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="but_ret_date" name="but_ret_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="ret_ter_date">Traitement Retours terrain <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="ret_ter_date" name="ret_ter_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="mod_carto">Modification Carto <span class="text-danger">*</span></label>
                            <select class="form-control" id="mod_carto" name="mod_carto">
                                <option value="">Séléctionnez une valeur</option>
                                <option value="1">Oui</option>
                                <option value="2">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="access_cmd">Commande Accès <span class="text-danger">*</span></label>
                            <select class="form-control" id="access_cmd" name="access_cmd">
                                <option value="">Séléctionnez une valeur</option>
                                <option value="1">En Cours</option>
                                <option value="2">Réalisée</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="trans_date">Date Transmission CA <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="trans_date" name="trans_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="cmd_access_cmd">Référence Commande Accès <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="cmd_access_cmd" name="cmd_access_cmd">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="go_ft">GO FT <span class="text-danger">*</span></label>
                            <select class="form-control" id="go_ft" name="go_ft">
                                <option value="">Séléctionnez un plan</option>
                                <option value="1">Commande En cours</option>
                                <option value="2">Commande validée</option>
                                <option value="3">Commande Refusée</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <button class="btn btn-primary add-distcdi" type="button">Enregistrer</button>
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
                    Réseau de Distribution <small>[Commande Structurante CDI]</small>
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
                    <input type="hidden" id="distcdi_id" name="distcdi_id" value="<?php echo $_GET[$activePage."id"]?>">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="user_be">Intervenant BE <span class="text-danger">*</span></label>
                            <select class="form-control" id="user_be" name="user_be">
                                <option value="">Séléctionnez une valeur</option>
                                <?php
                                $beiusers = UserPDO::getUsersByProfilId(4);
                                foreach($beiusers as $key => $value) {
                                    echo '<option value="'.$value['user_id'].'" '.($distcdi['user_be']==$value['user_id']?"selected":"").'>'.$value['user_firstname'].' '.$value['user_lastname'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="but_ret_date">Date butoire traitement retour Aig j+3 <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="but_ret_date" name="but_ret_date" value="<?php echo ($distcdi['but_ret_date']!=""?DateTime::createFromFormat('Y-m-d', $distcdi['but_ret_date'])->format('d/m/Y'):"")?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="ret_ter_date">Traitement Retours terrain <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="ret_ter_date" name="ret_ter_date" value="<?php echo ($distcdi['ret_ter_date']!=""?DateTime::createFromFormat('Y-m-d', $distcdi['ret_ter_date'])->format('d/m/Y'):"")?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="mod_carto">Modification Carto <span class="text-danger">*</span></label>
                            <select class="form-control" id="mod_carto" name="mod_carto">
                                <option value="">Séléctionnez une valeur</option>
                                <option value="1" <?php echo ($distcdi['mod_carto'] == "1" ? "selected":"")?>>Oui</option>
                                <option value="2" <?php echo ($distcdi['mod_carto'] == "2" ? "selected":"")?>>Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="access_cmd">Commande Accès <span class="text-danger">*</span></label>
                            <select class="form-control" id="access_cmd" name="access_cmd">
                                <option value="">Séléctionnez une valeur</option>
                                <option value="1" <?php echo ($distcdi['access_cmd'] == "1" ? "selected":"")?>>En Cours</option>
                                <option value="2" <?php echo ($distcdi['access_cmd'] == "2" ? "selected":"")?>>Réalisée</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="trans_date">Date Transmission CA <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="trans_date" name="trans_date" value="<?php echo ($distcdi['trans_date']!=""?DateTime::createFromFormat('Y-m-d', $distcdi['trans_date'])->format('d/m/Y'):"")?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="cmd_access_cmd">Référence Commande Accès <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="cmd_access_cmd" name="cmd_access_cmd" value="<?php echo $distcdi['cmd_access_cmd']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="go_ft">GO FT <span class="text-danger">*</span></label>
                            <select class="form-control" id="go_ft" name="go_ft">
                                <option value="">Séléctionnez un plan</option>
                                <option value="1" <?php echo ($distcdi['go_ft'] == "1" ? "selected":"")?>>Commande En cours</option>
                                <option value="2" <?php echo ($distcdi['go_ft'] == "2" ? "selected":"")?>>Commande validée</option>
                                <option value="3" <?php echo ($distcdi['go_ft'] == "3" ? "selected":"")?>>Commande Refusée</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <button class="btn btn-primary update-distcdi" type="button">Enregistrer</button>
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