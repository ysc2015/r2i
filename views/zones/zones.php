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
                <form class="form-horizontal push-10-t push-10" action="base_forms_premade.php" method="post" onsubmit="return false;">
                    <div class="row">
                        <h5 class="push"><span class="label label-info">Nom</span></h5>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="mega-firstname">DEP</label>
                                <input class="form-control input-lg" type="number" id="mega-firstname" name="mega-firstname" placeholder="département..">
                            </div>
                            <div class="col-xs-3">
                                <label for="mega-lastname">Ville</label>
                                <input class="form-control input-lg" type="text" id="mega-lastname" name="mega-lastname" placeholder="Ville..">
                            </div>
                            <div class="col-xs-3">
                                <label for="mega-firstname">Plaque</label>
                                <input class="form-control input-lg" type="text" id="mega-firstname" name="mega-firstname" placeholder="Plaque..">
                            </div>
                            <div class="col-xs-3">
                                <label for="mega-lastname">Zone</label>
                                <input class="form-control input-lg" type="text" id="mega-lastname" name="mega-lastname" placeholder="Zone..">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="push"><span class="label label-info">Info Plaque</span></h5>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="mega-firstname">Phase</label>
                                <select class="form-control input-lg" id="mega-firstname" name="contact1-subject" size="1">
                                    <option value="">choisissez la phase</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label for="mega-lastname">Type</label>
                                <select class="form-control input-lg" id="mega-firstname" name="contact1-subject" size="1">
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
                                <label for="mega-firstname">Nbe de Zones</label>
                                <input class="form-control input-lg" type="number" id="mega-firstname" name="mega-firstname" placeholder="Nbe de Zones..">
                            </div>
                            <div class="col-xs-2">
                                <label for="mega-lastname">LR sur PM existant</label>
                                <input class="form-control input-lg" type="number" id="mega-lastname" name="mega-lastname" placeholder="LR sur PM existant..">
                            </div>
                            <div class="col-xs-2">
                                <label for="mega-firstname">LR</label>
                                <input class="form-control input-lg" type="number" id="mega-firstname" name="mega-firstname" placeholder="LR..">
                            </div>
                            <div class="col-xs-2">
                                <label for="mega-lastname">NB DE SITE</label>
                                <input class="form-control input-lg" type="number" id="mega-lastname" name="mega-lastname" placeholder="NB DE SITE..">
                            </div>
                            <div class="col-xs-2">
                                <label for="mega-firstname">NB FO SUR PM</label>
                                <input class="form-control input-lg" type="number" id="mega-firstname" name="mega-firstname" placeholder="NB FO SUR PM..">
                            </div>
                            <div class="col-xs-2">
                                <label for="mega-lastname">NB FO SUR PMZ</label>
                                <input class="form-control input-lg" type="number" id="mega-lastname" name="mega-lastname" placeholder="NB FO SUR PMZ..">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="push"><span class="label label-info">Site Origine</span></h5>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="mega-firstname">Code Site</label>
                                <input class="form-control input-lg" type="number" id="mega-firstname" name="mega-firstname" placeholder="Nbe de Zones..">
                            </div>
                            <div class="col-xs-2">
                                <label for="mega-lastname">Type</label>
                                <select class="form-control input-lg" id="mega-firstname" name="contact1-subject" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1">NRA</option>
                                    <option value="2">NRO</option>
                                    <option value="3">POP</option>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <label for="mega-firstname">Auto Adduction</label>
                                <select class="form-control input-lg" id="mega-firstname" name="contact1-subject" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1">Existante</option>
                                    <option value="2">Projet</option>
                                    <option value="3">En cours</option>
                                    <option value="3">Ok</option>
                                </select>
                                <label for="mega-firstname">Date</label>
                                <input class="form-control input-lg" type="datetime" id="mega-firstname" name="mega-firstname" placeholder="date..">
                            </div>
                            <div class="col-xs-2">
                                <label for="mega-lastname">Travaux adduction</label>
                                <select class="form-control input-lg" id="mega-firstname" name="contact1-subject" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1">Existant</option>
                                    <option value="2">Prévus</option>
                                    <option value="3">En cours</option>
                                    <option value="3">Terminés</option>
                                </select>
                                <label for="mega-firstname">Date Début</label>
                                <input class="form-control input-lg" type="datetime" id="mega-firstname" name="mega-firstname" placeholder="Date Début..">
                            </div>
                            <div class="col-xs-4">
                                <label for="mega-firstname">Recette Adduction</label>
                                <select class="form-control input-lg" id="mega-firstname" name="contact1-subject" size="1">
                                    <option value="">choisissez une valeur</option>
                                    <option value="1">Prévue</option>
                                    <option value="2">Plannifié</option>
                                </select>
                                <label for="mega-firstname">Date</label>
                                <input class="form-control input-lg" type="datetime" id="mega-firstname" name="mega-firstname" placeholder="date..">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button class="btn btn-success" type="submit"><i class="fa fa-check push-5-r"></i> Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Mega Form -->
    </div>
<?php endif; ?>
<?php if($action == "mod"): ?>
    <?php echo "mod zone"?>
<?php endif; ?>
<?php if($action == "nothing"): ?>
    <?php echo "page error request"?>
<?php endif; ?>
