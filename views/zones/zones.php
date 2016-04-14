<?php if($action == "add"): ?>
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
                    <div class="row">
                        <input type="hidden" id="project_id" name="project_id" value="<?php echo $_GET['projectid']?>">
                        <h5 class="push"><span class="label label-info">Nom</span></h5>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="dep">DEP</label>
                                <input class="form-control input-lg" type="number" id="dep" name="dep" placeholder="département.." value="<?php echo substr($project['plate_dept_code'],-2)?>" readonly>
                            </div>
                            <div class="col-xs-3">
                                <label for="city">Ville</label>
                                <input class="form-control input-lg" type="text" id="city" name="city" placeholder="Ville.." value="<?php echo $project['city']?>" readonly>
                            </div>
                            <div class="col-xs-3">
                                <label for="plate">Plaque</label>
                                <input class="form-control input-lg" type="text" id="plate" name="plate" placeholder="Plaque.." value="<?php echo $project['plate_dept_code']?>" readonly>
                            </div>
                            <div class="col-xs-3">
                                <label for="zone">Zone</label>
                                <input class="form-control input-lg" type="text" id="zone" name="zone" placeholder="Zone.." value="<?php echo $project['plate_dept_code']."-"?>">
                            </div>
                            <div class="help-block text-right">(ex : XXX99-99)</div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="push"><span class="label label-info">Info Plaque</span></h5>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="phase">Phase</label>
                                <select class="form-control input-lg" id="phase" name="phase" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label for="type">Type</label>
                                <select class="form-control input-lg" id="type" name="type" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1">ZTD</option>
                                    <option value="2">ZSP</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="push"><span class="label label-info">Info Zone</span></h5>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="zones_nbr">Nbe de Zones</label>
                                <input class="form-control input-lg" type="number" id="zones_nbr" name="zones_nbr" placeholder="Nbe de Zones..">
                            </div>
                            <div class="col-xs-2">
                                <label for="lr_lpm_exist">LR sur PM existant</label>
                                <input class="form-control input-lg" type="number" id="lr_lpm_exist" name="lr_lpm_exist" placeholder="LR sur PM existant..">
                            </div>
                            <div class="col-xs-2">
                                <label for="lr">LR</label>
                                <input class="form-control input-lg" type="number" id="lr" name="lr" placeholder="LR..">
                            </div>
                            <div class="col-xs-2">
                                <label for="sites_nbr">NB DE SITE</label>
                                <input class="form-control input-lg" type="number" id="sites_nbr" name="sites_nbr" placeholder="NB DE SITE..">
                            </div>
                            <div class="col-xs-2">
                                <label for="fo_pm">NB FO SUR PM</label>
                                <input class="form-control input-lg" type="number" id="fo_pm" name="fo_pm" placeholder="NB FO SUR PM..">
                            </div>
                            <div class="col-xs-2">
                                <label for="fo_pmz">NB FO SUR PMZ</label>
                                <input class="form-control input-lg" type="number" id="fo_pmz" name="fo_pmz" placeholder="NB FO SUR PMZ..">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="push"><span class="label label-info">Site Origine</span></h5>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="site_code">Code Site</label>
                                <input class="form-control input-lg" type="text" id="site_code" name="site_code" value="<?php echo $project['site_code']?>" readonly>
                            </div>
                            <div class="col-xs-2">
                                <label for="site_type">Type</label>
                                <select class="form-control input-lg" id="site_type" name="site_type" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1">NRA</option>
                                    <option value="2">NRO</option>
                                    <option value="3">POP</option>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <label for="auto_adduction">Auto Adduction</label>
                                <select class="form-control input-lg" id="auto_adduction" name="auto_adduction" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1">Existante</option>
                                    <option value="2">Projet</option>
                                    <option value="3">En cours</option>
                                    <option value="3">Ok</option>
                                </select>
                                <label for="auto_adduction_date">Date</label>
                                <input class="js-datepicker form-control input-lg" type="text" id="auto_adduction_date" name="auto_adduction_date" placeholder="date..">
                            </div>
                            <div class="col-xs-2">
                                <label for="works_adduction">Travaux adduction</label>
                                <select class="form-control input-lg" id="works_adduction" name="works_adduction" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1">Existant</option>
                                    <option value="2">Prévus</option>
                                    <option value="3">En cours</option>
                                    <option value="3">Terminés</option>
                                </select>
                                <label for="works_adduction_date">Date Début</label>
                                <input class="js-datepicker form-control input-lg" type="text" id="works_adduction_date" name="works_adduction_date" placeholder="Date Début..">
                            </div>
                            <div class="col-xs-4">
                                <label for="adduction_recipe">Recette Adduction</label>
                                <select class="form-control input-lg" id="adduction_recipe" name="adduction_recipe" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1">Prévue</option>
                                    <option value="2">Plannifié</option>
                                </select>
                                <label for="adduction_recipe_date">Date</label>
                                <input class="js-datepicker form-control input-lg" type="text" id="adduction_recipe_date" name="adduction_recipe_date" placeholder="date..">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-success add-sub-project" type="button"><i class="fa fa-check push-5-r"></i> Valider</button>
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
                    <div class="row">
                        <input type="hidden" id="sub_project_id" name="sub_project_id" value="<?php echo $_GET['zoneid']?>">
                        <h5 class="push"><span class="label label-info">Nom</span></h5>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="dep">DEP</label>
                                <input class="form-control input-lg" type="number" id="dep" name="dep" placeholder="département.." value="<?php echo $zone['dep']?>" readonly>
                            </div>
                            <div class="col-xs-3">
                                <label for="city">Ville</label>
                                <input class="form-control input-lg" type="text" id="city" name="city" placeholder="Ville.." value="<?php echo $zone['city']?>" readonly>
                            </div>
                            <div class="col-xs-3">
                                <label for="plate">Plaque</label>
                                <input class="form-control input-lg" type="text" id="plate" name="plate" placeholder="Plaque.." value="<?php echo $zone['plate']?>" readonly>
                            </div>
                            <div class="col-xs-3">
                                <label for="zone">Zone</label>
                                <input class="form-control input-lg" type="text" id="zone" name="zone" placeholder="Zone.." value="<?php echo $zone['zone']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="push"><span class="label label-info">Info Plaque</span></h5>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="phase">Phase</label>
                                <select class="form-control input-lg" id="phase" name="phase" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1" <?php echo ($zone['phase'] == "1" ? "selected":"")?>>1</option>
                                    <option value="2" <?php echo ($zone['phase'] == "2" ? "selected":"")?>>2</option>
                                    <option value="3" <?php echo ($zone['phase'] == "3" ? "selected":"")?>>3</option>
                                    <option value="4" <?php echo ($zone['phase'] == "4" ? "selected":"")?>>4</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label for="type">Type</label>
                                <select class="form-control input-lg" id="type" name="type" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1" <?php echo ($zone['type'] == "1" ? "selected":"")?>>ZTD</option>
                                    <option value="2" <?php echo ($zone['type'] == "2" ? "selected":"")?>>ZSP</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="push"><span class="label label-info">Info Zone</span></h5>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="zones_nbr">Nbe de Zones</label>
                                <input class="form-control input-lg" type="number" id="zones_nbr" name="zones_nbr" placeholder="Nbe de Zones.." value="<?php echo $zone['zones_nbr']?>">
                            </div>
                            <div class="col-xs-2">
                                <label for="lr_lpm_exist">LR sur PM existant</label>
                                <input class="form-control input-lg" type="number" id="lr_lpm_exist" name="lr_lpm_exist" placeholder="LR sur PM existant.." value="<?php echo $zone['lr_lpm_exist']?>">
                            </div>
                            <div class="col-xs-2">
                                <label for="lr">LR</label>
                                <input class="form-control input-lg" type="number" id="lr" name="lr" placeholder="LR.." value="<?php echo $zone['lr']?>">
                            </div>
                            <div class="col-xs-2">
                                <label for="sites_nbr">NB DE SITE</label>
                                <input class="form-control input-lg" type="number" id="sites_nbr" name="sites_nbr" placeholder="NB DE SITE.." value="<?php echo $zone['sites_nbr']?>">
                            </div>
                            <div class="col-xs-2">
                                <label for="fo_pm">NB FO SUR PM</label>
                                <input class="form-control input-lg" type="number" id="fo_pm" name="fo_pm" placeholder="NB FO SUR PM.." value="<?php echo $zone['fo_pm']?>">
                            </div>
                            <div class="col-xs-2">
                                <label for="fo_pmz">NB FO SUR PMZ</label>
                                <input class="form-control input-lg" type="number" id="fo_pmz" name="fo_pmz" placeholder="NB FO SUR PMZ.." value="<?php echo $zone['fo_pmz']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="push"><span class="label label-info">Site Origine</span></h5>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="site_code">Code Site</label>
                                <input class="form-control input-lg" type="text" id="site_code" name="site_code" placeholder="Nbe de Zones.." value="<?php echo $zone['site_code']?>" readonly>
                            </div>
                            <div class="col-xs-2">
                                <label for="site_type">Type</label>
                                <select class="form-control input-lg" id="site_type" name="site_type" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1" <?php echo ($zone['site_type'] == "1" ? "selected":"")?>>NRA</option>
                                    <option value="2" <?php echo ($zone['site_type'] == "2" ? "selected":"")?>>NRO</option>
                                    <option value="3" <?php echo ($zone['site_type'] == "3" ? "selected":"")?>>POP</option>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <label for="auto_adduction">Auto Adduction</label>
                                <select class="form-control input-lg" id="auto_adduction" name="auto_adduction" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1" <?php echo ($zone['auto_adduction'] == "1" ? "selected":"")?>>Existante</option>
                                    <option value="2" <?php echo ($zone['auto_adduction'] == "2" ? "selected":"")?>>Projet</option>
                                    <option value="3" <?php echo ($zone['auto_adduction'] == "3" ? "selected":"")?>>En cours</option>
                                    <option value="3" <?php echo ($zone['auto_adduction'] == "4" ? "selected":"")?>>Ok</option>
                                </select>
                                <label for="auto_adduction_date">Date</label>
                                <input class="js-datepicker form-control input-lg" type="text" id="auto_adduction_date" name="auto_adduction_date" placeholder="date.." value="<?php echo ($zone['auto_adduction_date']!=""?DateTime::createFromFormat('Y-m-d', $zone['auto_adduction_date'])->format('d/m/Y'):"")?>">
                            </div>
                            <div class="col-xs-2">
                                <label for="works_adduction">Travaux adduction</label>
                                <select class="form-control input-lg" id="works_adduction" name="works_adduction" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1" <?php echo ($zone['works_adduction'] == "1" ? "selected":"")?>>Existant</option>
                                    <option value="2" <?php echo ($zone['works_adduction'] == "2" ? "selected":"")?>>Prévus</option>
                                    <option value="3" <?php echo ($zone['works_adduction'] == "3" ? "selected":"")?>>En cours</option>
                                    <option value="3" <?php echo ($zone['works_adduction'] == "4" ? "selected":"")?>>Terminés</option>
                                </select>
                                <label for="works_adduction_date">Date Début</label>
                                <input class="js-datepicker form-control input-lg" type="text" id="works_adduction_date" name="works_adduction_date" placeholder="Date Début.." value="<?php echo ($zone['works_adduction_date']!=""?DateTime::createFromFormat('Y-m-d', $zone['works_adduction_date'])->format('d/m/Y'):"")?>">
                            </div>
                            <div class="col-xs-4">
                                <label for="adduction_recipe">Recette Adduction</label>
                                <select class="form-control input-lg" id="adduction_recipe" name="adduction_recipe" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1" <?php echo ($zone['adduction_recipe'] == "1" ? "selected":"")?>>Prévue</option>
                                    <option value="2" <?php echo ($zone['adduction_recipe'] == "2" ? "selected":"")?>>Plannifié</option>
                                </select>
                                <label for="adduction_recipe_date">Date</label>
                                <input class="js-datepicker form-control input-lg" type="text" id="adduction_recipe_date" name="adduction_recipe_date" placeholder="date.." value="<?php echo ($zone['adduction_recipe_date']!=""?DateTime::createFromFormat('Y-m-d', $zone['adduction_recipe_date'])->format('d/m/Y'):"")?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-success update-sub-project" type="button"><i class="fa fa-check push-5-r"></i> Enregistrer</button>
                                <button class="btn btn-danger back-to-projects" type="button"><i class="fa fa-list-alt push-5-r"></i> Retour à la liste des projets</button>
                                <button class="btn btn-danger go-to-advancement-menu" type="button"><i class="fa fa-connectdevelop push-5-r"></i> Menu avancement ></button>
                            </div>
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