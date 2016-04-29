<?php if($action == "add"): ?>
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading">
                    Réseau de Distribution <small>[Tirage]</small>
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
                            <label for="previs_date">Date Previsionnelle <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="previs_date" name="previs_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="plan_prep">Préparation des plans <span class="text-danger">*</span></label>
                            <select class="form-control" id="plan_prep" name="plan_prep">
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
                            <label for="plan_control">Contrôle des plans <span class="text-danger">*</span></label>
                            <select class="form-control" id="plan_control" name="plan_control">
                                <option value="">Séléctionnez un plan</option>
                                <option value="1">Non Contrôlés</option>
                                <option value="2">Contrôlés OK</option>
                                <option value="3">Contrôlés NOK</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="plan_control_motif">Motif <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="plan_control_motif" name="plan_control_motif" rows="3" placeholder="motif ..."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="plan_trans_date">Date Transmission Plans <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="plan_trans_date" name="plan_trans_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="company">Entreprise <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="company" name="company">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="print_date">Date Tirage <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="print_date" name="print_date">
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
                            <label for="start_control">Contrôle démarrage effectif <span class="text-danger">*</span></label>
                            <select class="form-control" id="start_control" name="start_control">
                                <option value="">Séléctionnez un plan</option>
                                <option value="1">OK</option>
                                <option value="2">NOK</option>
                                <option value="3">Reporté</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="start_control_date">Date <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="start_control_date" name="start_control_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="ret_date">Date Retour <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="ret_date" name="ret_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="ret_state">Etat Retour <span class="text-danger">*</span></label>
                            <select class="form-control" id="ret_state" name="ret_state">
                                <option value="">Séléctionnez un plan</option>
                                <option value="1">PAS DE RETOUR</option>
                                <option value="2">RETOUR OK</option>
                                <option value="3">RETOUR NOK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <button class="btn btn-primary add-distprint" type="button">Enregistrer</button>
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
                    Réseau de Distribution <small>[Tirage]</small>
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
                <div class="row">
                    <div class="col-md-7">
                        <form class="js-validation-bootstrap form-horizontal">
                            <input type="hidden" id="distprint_id" name="distprint_id" value="<?php echo $_GET[$activePage."id"]?>">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="user_be">Intervenant BE <span class="text-danger">*</span></label>
                                    <select class="form-control" id="user_be" name="user_be">
                                        <option value="">Séléctionnez une valeur</option>
                                        <?php
                                        $beiusers = UserPDO::getUsersByProfilId(4);
                                        foreach($beiusers as $key => $value) {
                                            echo '<option value="'.$value['user_id'].'" '.($distprint['user_be']==$value['user_id']?"selected":"").'>'.$value['user_firstname'].' '.$value['user_lastname'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="previs_date">Date Previsionnelle <span class="text-danger">*</span></label>
                                    <input class="js-datepicker form-control" type="text" id="previs_date" name="previs_date" value="<?php echo ($distprint['previs_date']!=""?DateTime::createFromFormat('Y-m-d', $distprint['previs_date'])->format('d/m/Y'):"")?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="plan_prep">Préparation des plans <span class="text-danger">*</span></label>
                                    <select class="form-control" id="user_be" name="user_be">
                                        <option value="">Séléctionnez une valeur</option>
                                        <?php
                                        $beiusers = UserPDO::getUsersByProfilId(4);
                                        foreach($beiusers as $key => $value) {
                                            echo '<option value="'.$value['user_id'].'" '.($distprint['plan_prep']==$value['user_id']?"selected":"").'>'.$value['user_firstname'].' '.$value['user_lastname'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="plan_control">Contrôle des plans <span class="text-danger">*</span></label>
                                    <select class="form-control" id="plan_control" name="plan_control">
                                        <option value="">Séléctionnez un plan</option>
                                        <option value="1" <?php echo ($distprint['plan_control'] == "1" ? "selected":"")?>>Non Contrôlés</option>
                                        <option value="2" <?php echo ($distprint['plan_control'] == "2" ? "selected":"")?>>Contrôlés OK</option>
                                        <option value="3" <?php echo ($distprint['plan_control'] == "3" ? "selected":"")?>>Contrôlés NOK</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="plan_control_motif">Motif <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="plan_control_motif" name="plan_control_motif" rows="3" placeholder="motif ..."><?php echo $distprint['plan_control_motif']?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="plan_trans_date">Date Transmission Plans <span class="text-danger">*</span></label>
                                    <input class="js-datepicker form-control" type="text" id="plan_trans_date" name="plan_trans_date" value="<?php echo ($distprint['plan_trans_date']!=""?DateTime::createFromFormat('Y-m-d', $distprint['plan_trans_date'])->format('d/m/Y'):"")?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="company">Entreprise <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="company" name="company" value="<?php echo $distprint['company']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="print_date">Date Tirage <span class="text-danger">*</span></label>
                                    <input class="js-datepicker form-control" type="text" id="print_date" name="print_date" value="<?php echo ($distprint['print_date']!=""?DateTime::createFromFormat('Y-m-d', $distprint['print_date'])->format('d/m/Y'):"")?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="duration">Durée <span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" id="duration" name="duration" value="<?php echo $distprint['duration']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="start_control">Contrôle démarrage effectif <span class="text-danger">*</span></label>
                                    <select class="form-control" id="start_control" name="start_control">
                                        <option value="">Séléctionnez un plan</option>
                                        <option value="1" <?php echo ($distprint['start_control'] == "1" ? "selected":"")?>>OK</option>
                                        <option value="2" <?php echo ($distprint['start_control'] == "2" ? "selected":"")?>>NOK</option>
                                        <option value="3" <?php echo ($distprint['start_control'] == "3" ? "selected":"")?>>Reporté</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label for="start_control_date">Date <span class="text-danger">*</span></label>
                                    <input class="js-datepicker form-control" type="text" id="start_control_date" name="start_control_date" value="<?php echo ($distprint['start_control_date']!=""?DateTime::createFromFormat('Y-m-d', $distprint['start_control_date'])->format('d/m/Y'):"")?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="ret_date">Date Retour <span class="text-danger">*</span></label>
                                    <input class="js-datepicker form-control" type="text" id="ret_date" name="ret_date" value="<?php echo ($distprint['ret_date']!=""?DateTime::createFromFormat('Y-m-d', $distprint['ret_date'])->format('d/m/Y'):"")?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label for="ret_state">Etat Retour <span class="text-danger">*</span></label>
                                    <select class="form-control" id="ret_state" name="ret_state">
                                        <option value="">Séléctionnez un plan</option>
                                        <option value="1" <?php echo ($distprint['ret_state'] == "1" ? "selected":"")?>>PAS DE RETOUR</option>
                                        <option value="2" <?php echo ($distprint['ret_state'] == "2" ? "selected":"")?>>RETOUR OK</option>
                                        <option value="3" <?php echo ($distprint['ret_state'] == "3" ? "selected":"")?>>RETOUR NOK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <button class="btn btn-primary update-distprint" type="button">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <!-- Notifications Widget -->
                        <div class="list-group">
                            <a class="list-group-item active" href="javascript:void(0)">
                                <i class="fa fa-fw fa-upload push-5-r"></i> Fichiers
                            </a>
                            <a class="list-group-item" href="javascript:void(0)">
                                <i class="fa fa-file-text-o push-5-r"></i> Chambres
                            </a>
                            <a class="list-group-item" href="?page=synops&objid=<?php echo $_GET['tswitch']?>&objtype=tswitch&action=edit">
                                <i class="si si-graph push-5-r"></i> Synoptique
                            </a>
                            <a class="list-group-item" href="?page=resources&objid=<?php echo $_GET['tswitch']?>&objtype=tswitch&action=list">
                                <i class="si si-folder push-5-r"></i> Autres
                            </a>
                        </div>
                        <!-- END Notifications Widget -->
                        <!-- Notifications Widget -->
                        <div class="block block-themed">
                            <div class="block-header bg-modern">
                                <h3 class="block-title">Avancement</h3>
                            </div>
                            <div class="block-content block-content-full text-center">
                                <!-- Pie Chart Container -->
                                <div class="js-pie-chart pie-chart" data-percent="75" data-line-width="2" data-size="150" data-bar-color="#14adc4" data-track-color="#eeeeee">
                                    <span class="h4"><i class="si si-check fa-3x text-modern"></i></span>
                                </div>
                            </div>
                            <div class="block-content bg-gray-lighter">
                                <div class="row items-push text-center">
                                    <div class="col-xs-6">
                                        <div class="push-5"><i class="si si-list fa-2x"></i></div>
                                        <div class="h5 font-w300 text-muted">100 Chambres</div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="push-5"><i class="si si-like fa-2x"></i></div>
                                        <div class="h5 font-w300 text-muted">75 Traitées</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Notifications Widget -->
                    </div>
                </div>
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