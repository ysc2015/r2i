<?php if($action == "add"): ?>
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading">
                    Réseau de Transport <small>[Aiguillage]</small>
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
                            <label for="plans">Plans <span class="text-danger">*</span></label>
                            <select class="form-control" id="plans" name="plans">
                                <option value="">Séléctionnez un plan</option>
                                <option value="1">NON REALISES</option>
                                <option value="2">EN COURS</option>
                                <option value="3">OK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="linear_net">Linéaire de réseau <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="linear_net" name="linear_net">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="plans_control">Contrôle des plans <span class="text-danger">*</span></label>
                            <select class="form-control" id="plans_control" name="plans_control">
                                <option value="">Séléctionnez un plan</option>
                                <option value="1">Non Contrôlés</option>
                                <option value="2">Contrôlés OK</option>
                                <option value="3">Contrôlés NOK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="plans_transmission_date">Date Transmission Plans <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="plans_transmission_date" name="plans_transmission_date">
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
                            <label for="switch_date">Date Aiguillage <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="switch_date" name="switch_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="ret_date_prev">Date ret Prev <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="ret_date_prev" name="ret_date_prev">
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
                            <label for="start_control_report_date">Reporté à <span class="text-danger">*</span></label>
                            <input class="js-datepicker form-control" type="text" id="start_control_report_date" name="start_control_report_date">
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
                            <button class="btn btn-primary add-transportswitch" type="button">Enregistrer</button>
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
                    Réseau de Transport <small>[Aiguillage]</small>
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
                            <input type="hidden" id="transportswitch_id" name="transportswitch_id" value="<?php echo $_GET[$activePage."id"]?>">
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label for="phase">Intervenant BE <span class="text-danger">*</span></label>
                                    <select class="form-control" id="user_be" name="user_be">
                                        <option value="">Séléctionnez un BEI</option>
                                        <?php
                                        $beiusers = UserPDO::getUsersByProfilId(4);
                                        foreach($beiusers as $key => $value) {
                                            echo '<option value="'.$value['user_id'].'" '.($transportswitch['user_be']==$value['user_id']?"selected":"").'>'.$value['user_firstname'].' '.$value['user_lastname'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label for="plans">Plans <span class="text-danger">*</span></label>
                                    <select class="form-control" id="plans" name="plans">
                                        <option value="">Séléctionnez un plan</option>
                                        <option value="1" <?php echo ($transportswitch['plans'] == "1" ? "selected":"")?>>NON REALISES</option>
                                        <option value="2" <?php echo ($transportswitch['plans'] == "2" ? "selected":"")?>>EN COURS</option>
                                        <option value="3" <?php echo ($transportswitch['plans'] == "3" ? "selected":"")?>>OK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label for="linear_net">Linéaire de réseau <span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" id="linear_net" name="linear_net" value="<?php echo $transportswitch['linear_net']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label for="plans_control">Contrôle des plans <span class="text-danger">*</span></label>
                                    <select class="form-control" id="plans_control" name="plans_control">
                                        <option value="">Séléctionnez un plan</option>
                                        <option value="1" <?php echo ($transportswitch['plans_control'] == "1" ? "selected":"")?>>Non Contrôlés</option>
                                        <option value="2" <?php echo ($transportswitch['plans_control'] == "2" ? "selected":"")?>>Contrôlés OK</option>
                                        <option value="3" <?php echo ($transportswitch['plans_control'] == "3" ? "selected":"")?>>Contrôlés NOK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label for="plans_transmission_date">Date Transmission Plans <span class="text-danger">*</span></label>
                                    <input class="js-datepicker form-control" type="text" id="plans_transmission_date" name="plans_transmission_date" value="<?php echo ($transportswitch['plans_transmission_date']!=""?DateTime::createFromFormat('Y-m-d', $transportswitch['plans_transmission_date'])->format('d/m/Y'):"")?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label for="company">Entreprise <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="company" name="company" value="<?php echo $transportswitch['company']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label for="switch_date">Date Aiguillage <span class="text-danger">*</span></label>
                                    <input class="js-datepicker form-control" type="text" id="switch_date" name="switch_date" value="<?php echo ($transportswitch['switch_date']!=""?DateTime::createFromFormat('Y-m-d', $transportswitch['switch_date'])->format('d/m/Y'):"")?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label for="ret_date_prev">Date ret Prev <span class="text-danger">*</span></label>
                                    <input class="js-datepicker form-control" type="text" id="ret_date_prev" name="ret_date_prev" value="<?php echo ($transportswitch['ret_date_prev']!=""?DateTime::createFromFormat('Y-m-d', $transportswitch['ret_date_prev'])->format('d/m/Y'):"")?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label for="duration">Durée <span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" id="duration" name="duration" value="<?php echo $transportswitch['duration']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label for="start_control">Contrôle démarrage effectif <span class="text-danger">*</span></label>
                                    <select class="form-control" id="start_control" name="start_control">
                                        <option value="">Séléctionnez un plan</option>
                                        <option value="1" <?php echo ($transportswitch['start_control'] == "1" ? "selected":"")?>>OK</option>
                                        <option value="2" <?php echo ($transportswitch['start_control'] == "2" ? "selected":"")?>>NOK</option>
                                        <option value="3" <?php echo ($transportswitch['start_control'] == "3" ? "selected":"")?>>Reporté</option>
                                    </select>
                                    <label for="start_control_report_date">Reporté à <span class="text-danger">*</span></label>
                                    <input class="js-datepicker form-control" type="text" id="start_control_report_date" name="start_control_report_date" value="<?php echo ($transportswitch['start_control_report_date']!=""?DateTime::createFromFormat('Y-m-d', $transportswitch['start_control_report_date'])->format('d/m/Y'):"")?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label for="ret_date">Date Retour <span class="text-danger">*</span></label>
                                    <input class="js-datepicker form-control" type="text" id="ret_date" name="ret_date" value="<?php echo ($transportswitch['ret_date']!=""?DateTime::createFromFormat('Y-m-d', $transportswitch['ret_date'])->format('d/m/Y'):"")?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label for="ret_state">Etat Retour <span class="text-danger">*</span></label>
                                    <select class="form-control" id="ret_state" name="ret_state">
                                        <option value="">Séléctionnez un plan</option>
                                        <option value="1" <?php echo ($transportswitch['ret_state'] == "1" ? "selected":"")?>>PAS DE RETOUR</option>
                                        <option value="2" <?php echo ($transportswitch['ret_state'] == "2" ? "selected":"")?>>RETOUR OK</option>
                                        <option value="3" <?php echo ($transportswitch['ret_state'] == "3" ? "selected":"")?>>RETOUR NOK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <button class="btn btn-primary update-transport-switch" type="button">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <?php if($transportswitch['job_order_id'] !== null): ?>
                            <div class="alert alert-info">
                                <p>L'ordre de travail n'est pas encore crée !</p>
                                <button class="btn btn-block btn-success push-10" data-toggle="modal" data-target="#modal-normal" type="button"><i class="fa fa-plus pull-left"></i> Créer OT</button>
                            </div>
                            <!-- Normal Modal -->
                            <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="block block-themed block-transparent remove-margin-b">
                                            <div class="block-header bg-primary-light">
                                                <ul class="block-options">
                                                    <li>
                                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                                    </li>
                                                </ul>
                                                <h3 class="block-title">Ajouter Ordre de travail</h3>
                                            </div>
                                            <div class="block-content">
                                                <form class="js-validation-bootstrap form-ot form-horizontal push-10-t push-10">
                                                    <input type="hidden" id="object_id" name="object_id" value="<?php echo $_GET[$activePage."id"]?>">
                                                    <input type="hidden" id="object_type" name="object_type" value="<?php echo $activePage?>">
                                                    <div class="form-group">
                                                        <label for="titre">Titre <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" id="titre" name="titre">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Motif <span class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="description ..."></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                                            <button class="btn btn-sm btn-primary add-ot" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Enregistrer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Normal Modal -->
                        <?php endif; ?>
                        <?php if($transportswitch['job_order_id'] === null):?>
                            <div class="alert alert-info">
                                <p>L'ordre de travail n'est pas encore crée !</p>
                                <button class="btn btn-block btn-success push-10" data-toggle="modal" data-target="#modal-normal" type="button"><i class="fa fa-plus pull-left"></i> Créer OT</button>
                            </div>
                            <!-- Normal Modal -->
                            <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="block block-themed block-transparent remove-margin-b">
                                            <div class="block-header bg-primary-light">
                                                <ul class="block-options">
                                                    <li>
                                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                                    </li>
                                                </ul>
                                                <h3 class="block-title">Ajouter Ordre de travail</h3>
                                            </div>
                                            <div class="block-content">
                                                <form class="js-validation-bootstrap form-ot form-horizontal push-10-t push-10">
                                                    <input type="hidden" id="object_id" name="object_id" value="<?php echo $_GET[$activePage."id"]?>">
                                                    <input type="hidden" id="object_type" name="object_type" value="<?php echo $activePage?>">
                                                    <div class="form-group">
                                                        <label for="titre">Titre <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" id="titre" name="titre">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Motif <span class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="description ..."></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                                            <button class="btn btn-sm btn-primary add-ot" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Enregistrer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Normal Modal -->

                        <?php endif; ?>
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