<!-- ajouter pblq Modal -->
<div class="modal fade" id="add-pblq"  role="dialog" aria-hidden="true"><!--tabindex="-1"-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button id="close-project-add-form" data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter point bloquant</h3>
                </div>
                <div class="block-content">
                    <!-- Validation Wizard (.pblq-add-js-wizard-validation class is initialized in js/pages/base_forms_wizard.js) -->
                    <!-- For more examples you can check out http://vadimg.com/twitter-bootstrap-wizard-example/ -->
                    <div class="pblq-add-js-wizard-validation block">
                        <!-- Step Tabs -->
                        <ul class="nav nav-tabs nav-tabs-alt nav-justified">
                            <li class="active">
                                <a class="inactive" href="#validation-step1" data-toggle="tab">1. Point bloquant</a>
                            </li>
                            <li>
                                <a class="inactive" href="#validation-step2" data-toggle="tab">2. Type de point de blocage</a>
                            </li>
                            <li>
                                <a class="inactive" href="#validation-step3" data-toggle="tab">3. Moyens mis en oeuvre</a>
                            </li>
                            <li>
                                <a class="inactive" href="#validation-step4" data-toggle="tab">4. Solutions préconisées</a>
                            </li>
                        </ul>
                        <!-- END Step Tabs -->

                        <!-- Form -->
                        <!-- jQuery Validation (.js-form2 class is initialized in js/pages/base_forms_wizard.js) -->
                        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <!-- Steps Content -->
                        <div class="block-content tab-content">
                            <!-- Step 1 -->
                            <div class="tab-pane fade fade-right in push-30-t push-50 active" id="validation-step1">
                                <form id="info_pblq_form1" class="pblq-add-js-form1 form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                            <label for="apblq1_utilisateur">Effectué par <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="apblq1_utilisateur" name="apblq1_utilisateur">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                            <label for="apblq1_entreprise">Entreprise <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="apblq1_entreprise" name="apblq1_entreprise">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                            <label for="apblq1_responsable">Résponsable d'équipe <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="apblq1_responsable" name="apblq1_responsable">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                            <label for="apblq1_adresse">Adresse <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="apblq1_adresse" name="apblq1_adresse" rows="6" placeholder="Adresse.."></textarea>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                            <label for="apblq1_ref_chantier">Référence <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="apblq1_ref_chantier" name="apblq1_ref_chantier">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq1_nature_travaux">Nature des travaux <span class="text-danger">*</span></label>
                                            <select class="form-control" id="apblq1_nature_travaux" name="apblq1_nature_travaux" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectNatureTravaux::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_nature_travaux\">$result->lib_nature_travaux</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq1_environement">Environement <span class="text-danger">*</span></label>
                                            <select class="form-control" id="apblq1_environement" name="apblq1_environement" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectEnvironement::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_environement\">$result->lib_environement</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                            <label for="apblq1_synthese">Synthèse <!--<span class="text-danger">*</span>--></label>
                                            <textarea class="form-control" id="apblq1_synthese" name="apblq1_synthese" rows="6" placeholder="Adresse.."></textarea>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_pblq1_add' role='alert'>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- END Step 1 -->

                            <!-- Step 2 -->
                            <div class="tab-pane fade fade-right push-30-t push-50" id="validation-step2">
                                <form id="info_pblq_form2" class="pblq-add-js-form1 form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq2_reseau_en_aerien">Réseau en aérien</label>
                                            <select class="form-control" id="apblq2_reseau_en_aerien" name="apblq2_reseau_en_aerien" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq2_observation_reseau_en_aerien">Observation</label>
                                            <textarea class="form-control" id="apblq2_observation_reseau_en_aerien" name="apblq2_observation_reseau_en_aerien" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq2_conduites_saturees">Conduites saturées</label>
                                            <select class="form-control" id="apblq2_conduites_saturees" name="apblq2_conduites_saturees" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq2_observation_conduites_saturees">Observation</label>
                                            <textarea class="form-control" id="apblq2_observation_conduites_saturees" name="apblq2_observation_conduites_saturees" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq2_conduites_cassees_ou_ecrasees">Conduites cassées ou écrasées</label>
                                            <select class="form-control" id="apblq2_conduites_cassees_ou_ecrasees" name="apblq2_conduites_cassees_ou_ecrasees" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq2_observation_conduites_cassees_ou_ecrasees">Observation</label>
                                            <textarea class="form-control" id="apblq2_observation_conduites_cassees_ou_ecrasees" name="apblq2_observation_conduites_cassees_ou_ecrasees" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq2_tampon_de_chambre_impossible_a_ouvrir">Tampon de chambre impossible à ouvrir</label>
                                            <select class="form-control" id="apblq2_tampon_de_chambre_impossible_a_ouvrir" name="apblq2_tampon_de_chambre_impossible_a_ouvrir" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq2_observation_tampon_de_chambre_impossible_a_ouvrir">Observation</label>
                                            <textarea class="form-control" id="apblq2_observation_tampon_de_chambre_impossible_a_ouvrir" name="apblq2_observation_tampon_de_chambre_impossible_a_ouvrir" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq2_chambre_sous_enrobe_ou_recouverte">Chambre sous enrobée ou récouverte</label>
                                            <select class="form-control" id="apblq2_chambre_sous_enrobe_ou_recouverte" name="apblq2_chambre_sous_enrobe_ou_recouverte" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq2_observation_chambre_sous_enrobe_ou_recouverte">Observation</label>
                                            <textarea class="form-control" id="apblq2_observation_chambre_sous_enrobe_ou_recouverte" name="apblq2_observation_chambre_sous_enrobe_ou_recouverte" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq2_reseau_emprise_privee">Réseau entreprise privée</label>
                                            <select class="form-control" id="apblq2_reseau_emprise_privee" name="apblq2_reseau_emprise_privee" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq2_observation_reseau_emprise_privee">Observation</label>
                                            <textarea class="form-control" id="apblq2_observation_reseau_emprise_privee" name="apblq2_observation_reseau_emprise_privee" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq2_chambre_inexploitable">Chambre inexploitable</label>
                                            <div class="help-block text-left">(pleine de terre,boue ou autre,préciser)</div>
                                            <select class="form-control" id="apblq2_chambre_inexploitable" name="apblq2_chambre_inexploitable" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq2_observation_chambre_inexploitable">Observation</label>
                                            <textarea class="form-control" id="apblq2_observation_chambre_inexploitable" name="apblq2_observation_chambre_inexploitable" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq2_probleme_d_acces">Problème d'accès</label>
                                            <div class="help-block text-left">(chambre,site technique,immeuble...)</div>
                                            <select class="form-control" id="apblq2_probleme_d_acces" name="apblq2_probleme_d_acces" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq2_observation_probleme_d_acces">Observation</label>
                                            <textarea class="form-control" id="apblq2_observation_probleme_d_acces" name="apblq2_observation_probleme_d_acces" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq2_autre_point_de_blocage">Autre point de blocage(décrire au mieux le point)</label>
                                            <textarea class="form-control" id="apblq2_autre_point_de_blocage" name="apblq2_autre_point_de_blocage" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_pblq2_add' role='alert'>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- END Step 2 -->

                            <!-- Step 3 -->
                            <div class="tab-pane fade fade-right push-30-t push-50" id="validation-step3">
                                <form id="info_pblq_form3" class="pblq-add-js-form1 form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq3_aiguillage_au_compresseur">Aiguillage au compresseur</label>
                                            <div class="help-block text-left">(Min 5000L)</div>
                                            <select class="form-control" id="apblq3_aiguillage_au_compresseur" name="apblq3_aiguillage_au_compresseur" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq3_observation_aiguillage_au_compresseur">Observation</label>
                                            <textarea class="form-control" id="apblq3_observation_aiguillage_au_compresseur" name="apblq3_observation_aiguillage_au_compresseur" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq3_aiguillage_avec_aiguille_de_11_13mm">Aiguillage avec aiguille de 11->13mm</label>
                                            <div class="help-block text-left">(Préciser le diamètre)</div>
                                            <select class="form-control" id="apblq3_aiguillage_avec_aiguille_de_11_13mm" name="apblq3_aiguillage_avec_aiguille_de_11_13mm" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq3_observation_aiguillage_avec_aiguille_de_11_13mm">Observation</label>
                                            <textarea class="form-control" id="apblq3_observation_aiguillage_avec_aiguille_de_11_13mm" name="apblq3_observation_aiguillage_avec_aiguille_de_11_13mm" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq3_aiguillage_aux_cannes">Aiguillage aux cannes</label>
                                            <select class="form-control" id="apblq3_aiguillage_aux_cannes" name="apblq3_aiguillage_aux_cannes" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq3_observation_aiguillage_aux_cannes">Observation</label>
                                            <textarea class="form-control" id="apblq3_observation_aiguillage_aux_cannes" name="apblq3_observation_aiguillage_aux_cannes" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq3_hydrocurage">Hydrocurage</label>
                                            <div class="help-block text-left">(Préciser le valideur)</div>
                                            <select class="form-control" id="apblq3_hydrocurage" name="apblq3_hydrocurage" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq3_observation_hydrocurage">Observation</label>
                                            <textarea class="form-control" id="apblq3_observation_hydrocurage" name="apblq3_observation_hydrocurage" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq3_identification_du_point_bloquant_au_metre">Identification du point bloquant au métré</label>
                                            <div class="help-block text-left">(En mesurant au sol la partie de l'aiguille dans l'alvéole)</div>
                                            <select class="form-control" id="apblq3_identification_du_point_bloquant_au_metre" name="apblq3_identification_du_point_bloquant_au_metre" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq3_observation_identification_du_point_bloquant_au_metre">Observation</label>
                                            <textarea class="form-control" id="apblq3_observation_identification_du_point_bloquant_au_metre" name="apblq3_observation_identification_du_point_bloquant_au_metre" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq3_identification_a_la_sonde">Identification à la sonde</label>
                                            <div class="help-block text-left">(Aiguille avec sonde et teledetecteur)</div>
                                            <select class="form-control" id="apblq3_identification_a_la_sonde" name="apblq3_identification_a_la_sonde" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq3_observation_identification_a_la_sonde">Observation</label>
                                            <textarea class="form-control" id="apblq3_observation_identification_a_la_sonde" name="apblq3_observation_identification_a_la_sonde" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq3_tentative_de_contact_du_proprietaire_ou_gestionnaire">Tentative de contact du propriétaire ou gestionnaire</label>
                                            <div class="help-block text-left">(Préciser un contact s'il y eu identification)</div>
                                            <select class="form-control" id="apblq3_tentative_de_contact_du_proprietaire_ou_gestionnaire" name="apblq3_tentative_de_contact_du_proprietaire_ou_gestionnaire" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq3_observation_tentative_de_contact_du_proprietaire_ou_gestionnaire">Observation</label>
                                            <textarea class="form-control" id="apblq3_observation_tentative_de_contact_du_proprietaire_ou_gestionnaire" name="apblq3_observation_tentative_de_contact_du_proprietaire_ou_gestionnaire" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_pblq3_add' role='alert'>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- END Step 3 -->
                            <!-- Step 4 -->
                            <div class="tab-pane fade fade-right push-30-t push-50" id="validation-step4">
                                <form id="info_pblq_form4" class="pblq-add-js-form1 form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq4_aiguillage_au_compresseur">Aiguillage au compresseur</label>
                                            <div class="help-block text-left">(Min 5000L)</div>
                                            <select class="form-control" id="apblq4_aiguillage_au_compresseur" name="apblq4_aiguillage_au_compresseur" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq4_observation_aiguillage_au_compresseur">Observation</label>
                                            <textarea class="form-control" id="apblq4_observation_aiguillage_au_compresseur" name="apblq4_observation_aiguillage_au_compresseur" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq4_aiguillage_avec_aiguille">Aiguillage avec aiguille de 13mm</label>
                                            <select class="form-control" id="apblq4_aiguillage_avec_aiguille" name="apblq4_aiguillage_avec_aiguille" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq4_observation_aiguillage_avec_aiguille_de_13mm">Observation</label>
                                            <textarea class="form-control" id="apblq4_observation_aiguillage_avec_aiguille_de_13mm" name="apblq4_observation_aiguillage_avec_aiguille_de_13mm" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq4_aiguillage_aux_cannes">Aiguillage aux cannes</label>
                                            <select class="form-control" id="apblq4_aiguillage_aux_cannes" name="apblq4_aiguillage_aux_cannes" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq4_observation_aiguillage_aux_cannes">Observation</label>
                                            <textarea class="form-control" id="apblq4_observation_aiguillage_aux_cannes" name="apblq4_observation_aiguillage_aux_cannes" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq4_hydrocurage">Hydrocurage</label>
                                            <select class="form-control" id="apblq4_hydrocurage" name="apblq4_hydrocurage" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq4_observation_hydrocurage">Observation</label>
                                            <textarea class="form-control" id="apblq4_observation_hydrocurage" name="apblq4_observation_hydrocurage" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq4_changement_de_parcourt">Changement de parcourt</label>
                                            <div class="help-block text-left">(Appui bureau d'étude non efficace)</div>
                                            <select class="form-control" id="apblq4_changement_de_parcourt" name="apblq4_changement_de_parcourt" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq4_observation_changement_de_parcourt">Observation</label>
                                            <textarea class="form-control" id="apblq4_observation_changement_de_parcourt" name="apblq4_observation_changement_de_parcourt" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq4_fouille_ponctuelle">Fouille ponctuelle</label>
                                            <div class="help-block text-left">(Dans le cas ou le point de blocage inférieur à 1ML)</div>
                                            <select class="form-control" id="apblq4_fouille_ponctuelle" name="apblq4_fouille_ponctuelle" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq4_observation_fouille_ponctuelle">Observation</label>
                                            <textarea class="form-control" id="apblq4_observation_fouille_ponctuelle" name="apblq4_observation_fouille_ponctuelle" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq4_genie_civil">Génie civil</label>
                                            <div class="help-block text-left">(Cas ou la fouille ponctuelle ne permet pas de palier au probléme)</div>
                                            <select class="form-control" id="apblq4_genie_civil" name="apblq4_genie_civil" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq4_observation_genie_civil">Observation</label>
                                            <textarea class="form-control" id="apblq4_observation_genie_civil" name="apblq4_observation_genie_civil" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq4_negociation_avec_le_gestionnaire_prive">Négociation avec le géstionnaire privé</label>
                                            <div class="help-block text-left">(Indiquer toutes les informations disponibles)</div>
                                            <select class="form-control" id="apblq4_negociation_avec_le_gestionnaire_prive" name="apblq4_negociation_avec_le_gestionnaire_prive" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="apblq4_observation_negociation_avec_le_gestionnaire_prive">Observation</label>
                                            <textarea class="form-control" id="apblq4_observation_negociation_avec_le_gestionnaire_prive" name="apblq4_observation_negociation_avec_le_gestionnaire_prive" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq4_accompagnement_FREE">Accompagnement FREE</label>
                                            <select class="form-control" id="apblq4_accompagnement_FREE" name="apblq4_accompagnement_FREE" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectOk::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_ok\">$result->lib_ok</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="apblq4_commentaires_supplementaire">Commentaires supplémentaires <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="apblq4_commentaires_supplementaire" name="apblq4_commentaires_supplementaire" rows="6" placeholder="Commentaires.."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_pblq4_add' role='alert'>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- END Step 4 -->
                        </div>
                        <!-- END Steps Content -->

                        <!-- Steps Navigation -->
                        <div class="block-content block-content-mini block-content-full border-t">
                            <div class="row">
                                <div class="col-xs-6">
                                    <!--<button class="wizard-prev btn btn-warning" type="button"><i class="fa fa-arrow-circle-o-left"></i> Previous</button>-->
                                </div>
                                <div class="col-xs-6 text-right">
                                    <button id="next-btn2" class="btn btn-success" type="button">Valider <i class="fa fa-arrow-circle-o-right"></i></button>
                                    <button id="next-btn" class="wizard-next btn btn-success" type="button">Valider <i class="fa fa-arrow-circle-o-right"></i></button>
                                    <button id="close-btn" class="wizard-finish btn btn-primary" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
                                </div>
                            </div>
                        </div>
                        <!-- END Steps Navigation -->
                        <!-- END Form -->
                    </div>
                    <!-- END Validation Wizard Wizard -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter pblq Modal -->
<script>
    var pblq1_formdata = {};
    var pblq2_formdata = {};
    var pblq3_formdata = {};
    var pblq4_formdata = {};
    var redraw_pblq = false;
    var id;
    var last_msg;
    // Init wizards with validation, for more examples you can check out http://vadimg.com/twitter-bootstrap-wizard-example/
    var initWizardValidation = function(){
        // Get forms
        var $form = jQuery('.pblq-add-js-form1');

        // Prevent forms from submitting on enter key press
        $form.on('keyup keypress', function (e) {
            var code = e.keyCode || e.which;

            if (code === 13) {
                e.preventDefault();
                return false;
            }
        });

        // Init wizard with validation
        jQuery('.pblq-add-js-wizard-validation').bootstrapWizard({
            'tabClass': '',
            /*'previousSelector': '.wizard-prev',*/
            'nextSelector': '.wizard-next',
            'onTabShow': function($tab, $nav, $index) {
                var $total      = $nav.find('li').length;
                var $current    = $index + 1;

                // Get vital wizard elements
                var $wizard     = $nav.parents('.block');
                var $btnNext    = $wizard.find('.wizard-next');
                var $btnFinish  = $wizard.find('.wizard-finish');
                var $btnNext2    = $wizard.find('#next-btn2');

                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $btnNext.hide();
                    $btnNext2.show();
                    $btnFinish.show();
                } else {
                    $btnNext.show();
                    $btnNext2.hide();
                    $btnFinish.hide();
                }

                switch ($index) {
                    case 1 : {
                        App.showMessage(last_msg,'#message_pblq2_add');
                        break;
                    }
                    case 2 : {
                        App.showMessage(last_msg,'#message_pblq3_add');
                        break;
                    }
                    case 3 : {
                        App.showMessage(last_msg,'#message_pblq4_add');
                        break;
                    }
                }
            },
            'onNext': function($tab, $navigation, $index) {
                var ret = false;
                switch ($index) {
                    case 1 : {
                        for (var key in pblq1_formdata) {
                            pblq1_formdata[key] = $('#'+key).val();
                        }

                        pblq1_formdata['suffix'] = 'apblq1';
                        pblq1_formdata['apblq1_date_controle'] = '';
                        pblq1_formdata['apblq1_id_chambre'] = chambre_ot_dt.row('.selected').data().id_chambre;

                        $.ajax({
                            method: "POST",
                            url: "api/pointbloquant/pointbloquant/add_pblq1.php",
                            async: false,
                            data: pblq1_formdata
                        }).done(function (message) {
                            var obj = $.parseJSON(message);
                            if(obj.error > 0) {
                                ret = App.showMessage(message,'#message_pblq1_add');
                            } else {
                                id = obj.id;
                                //pblq_dt.draw(false);
                                last_msg = message;
                                ret = true;
                                redraw_pblq = true;
                            }
                        });
                        break;
                    }
                    case 2 : {
                        for (var key in pblq2_formdata) {
                            pblq2_formdata[key] = $('#'+key).val();
                        }

                        pblq2_formdata['suffix'] = 'apblq2';//TODO add letter here to let update auto kool data().key
                        pblq2_formdata['idp'] = id;

                        $.ajax({
                            method: "POST",
                            url: "api/pointbloquant/pointbloquant/update_pblq2.php",
                            async: false,
                            data: pblq2_formdata
                        }).done(function (message) {
                            var obj = $.parseJSON(message);
                            if(obj.error > 0) {
                                ret = App.showMessage(message,'#message_pblq2_add');
                            } else {
                                //pblq_dt.draw(false);
                                last_msg = message;
                                ret = true;
                            }
                        });
                        break;
                    }
                    case 3 : {
                        for (var key in pblq3_formdata) {
                            pblq3_formdata[key] = $('#'+key).val();
                        }

                        pblq3_formdata['suffix'] = 'apblq3';//TODO add letter here to let update auto kool data().key
                        pblq3_formdata['idp'] = id;

                        $.ajax({
                            method: "POST",
                            url: "api/pointbloquant/pointbloquant/update_pblq3.php",
                            async: false,
                            data: pblq3_formdata
                        }).done(function (message) {
                            var obj = $.parseJSON(message);
                            if(obj.error > 0) {
                                ret = App.showMessage(message,'#message_pblq3_add');
                            } else {
                                //pblq_dt.draw(false);
                                last_msg = message;
                                ret = true;
                            }
                        });
                        break;
                    }
                    case 4 : {
                        break;
                    }
                }

                return ret;
            },
            onTabClick: function($tab, $navigation, $index) {
                return false;
            }
        });
    };
    $(document).ready(function() {
        var msg_alerts = ["#message_pblq1_add",
            "#message_pblq2_add",
            "#message_pblq3_add",
            "#message_pblq4_add"];

        $('#info_pblq_form1 *').filter('.form-control:enabled:not([readonly])').each(function(){
            pblq1_formdata[$( this ).attr('name')] = $( this).val();
        });
        $('#info_pblq_form2 *').filter('.form-control:enabled:not([readonly])').each(function(){
            pblq2_formdata[$( this ).attr('name')] = $( this).val();
        });

        $('#info_pblq_form3 *').filter('.form-control:enabled:not([readonly])').each(function(){
            pblq3_formdata[$( this ).attr('name')] = $( this).val();
        });

        $('#info_pblq_form4 *').filter('.form-control:enabled:not([readonly])').each(function(){
            pblq4_formdata[$( this ).attr('name')] = $( this).val();
        });


        $(msg_alerts.join(',')).hide();

        initWizardValidation();

        $("#next-btn2").click(function() {
            for (var key in pblq4_formdata) {
                pblq4_formdata[key] = $('#'+key).val();
            }

            pblq4_formdata['suffix'] = 'apblq4';//TODO add letter here to let update auto kool data().key
            pblq4_formdata['idp'] = id;

            $.ajax({
                method: "POST",
                url: "api/pointbloquant/pointbloquant/update_pblq4.php",
                async: false,
                data: pblq4_formdata
            }).done(function (message) {
                var obj = $.parseJSON(message);
                /*if(obj.error == 0) {
                    pblq_dt.draw(false);
                }*/

                App.showMessage(message,'#message_pblq4_add');
            });
        });

        $('#add-pblq').on('hidden.bs.modal', function () {
            console.log('hidden.bs.modal');
            $('body').addClass('modal-open');
            if(redraw_pblq) {
                console.log('hidden.bs.modal redraw');
                pblq_dt.ajax.url( 'api/pointbloquant/pointbloquant/pblq_liste.php?idchambre='+(chambre_ot_dt.row('.selected').data()!==undefined?chambre_ot_dt.row('.selected').data().id_chambre:0) ).load();
            }
        })
    } );
</script>