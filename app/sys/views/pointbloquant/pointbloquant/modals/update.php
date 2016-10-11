<!-- modifier pblq Modal -->
<div class="modal fade" id="update-pblq" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Modifier point bloquant</h3>
                </div>
                <div class="block-content">
                    <div class="block">
                        <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">
                            <li class="active">
                                <a href="#pblq1_update_tab" data-toggle="tab">Point bloquant</a>
                            </li>
                            <li>
                                <a href="#pblq2_update_tab" data-toggle="tab">Type de point de blocage</a>
                            </li>
                            <li>
                                <a href="#pblq3_update_tab" data-toggle="tab">Moyens mis en oeuvre</a>
                            </li>
                            <li>
                                <a href="#pblq4_update_tab" data-toggle="tab">Solutions préconisées</a>
                            </li>
                        </ul>
                        <div class="block-content tab-content">
                            <div class="tab-pane active" id="pblq1_update_tab"><!--pblq1_update_tab-->
                                <form id="info_pblq_uform1" class="js-form1 form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                            <label for="pblq1_utilisateur">Effectué par <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="pblq1_utilisateur" name="pblq1_utilisateur">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                            <label for="pblq1_entreprise">Entreprise <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="pblq1_entreprise" name="pblq1_entreprise">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                            <label for="pblq1_responsable">Résponsable d'équipe <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="pblq1_responsable" name="pblq1_responsable">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                            <label for="pblq1_adresse">Adresse <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="pblq1_adresse" name="pblq1_adresse" rows="6" placeholder="Adresse.."></textarea>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                            <label for="pblq1_ref_chantier">Référence <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="pblq1_ref_chantier" name="pblq1_ref_chantier">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq1_nature_travaux">Nature des travaux <span class="text-danger">*</span></label>
                                            <select class="form-control" id="pblq1_nature_travaux" name="pblq1_nature_travaux" size="1">
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
                                            <label for="pblq1_environement">Environement <span class="text-danger">*</span></label>
                                            <select class="form-control" id="pblq1_environement" name="pblq1_environement" size="1">
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
                                            <label for="pblq1_synthese">Synthèse <!--<span class="text-danger">*</span>--></label>
                                            <textarea class="form-control" id="pblq1_synthese" name="pblq1_synthese" rows="6" placeholder="Synthèse.."></textarea>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_pblq1_update' role='alert'>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-mini block-content-full border-t">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <!--<button class="wizard-prev btn btn-warning" type="button"><i class="fa fa-arrow-circle-o-left"></i> Previous</button>-->
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <button class="btn btn-primary" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
                                                <button class="btn btn-success" id="update_pblq1" type="button">Valider <i class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="pblq2_update_tab">
                                <form id="info_pblq_uform2" class="js-form1 form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq2_reseau_en_aerien">Réseau en aérien</label>
                                            <select class="form-control" id="pblq2_reseau_en_aerien" name="pblq2_reseau_en_aerien" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq2_observation_reseau_en_aerien">Observation</label>
                                            <textarea class="form-control" id="pblq2_observation_reseau_en_aerien" name="pblq2_observation_reseau_en_aerien" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq2_conduites_saturees">Conduites saturées</label>
                                            <select class="form-control" id="pblq2_conduites_saturees" name="pblq2_conduites_saturees" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq2_observation_conduites_saturees">Observation</label>
                                            <textarea class="form-control" id="pblq2_observation_conduites_saturees" name="pblq2_observation_conduites_saturees" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq2_conduites_cassees_ou_ecrasees">Conduites cassées ou écrasées</label>
                                            <select class="form-control" id="pblq2_conduites_cassees_ou_ecrasees" name="pblq2_conduites_cassees_ou_ecrasees" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq2_observation_conduites_cassees_ou_ecrasees">Observation</label>
                                            <textarea class="form-control" id="pblq2_observation_conduites_cassees_ou_ecrasees" name="pblq2_observation_conduites_cassees_ou_ecrasees" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq2_tampon_de_chambre_impossible_a_ouvrir">Tampon de chambre impossible à ouvrir</label>
                                            <select class="form-control" id="pblq2_tampon_de_chambre_impossible_a_ouvrir" name="pblq2_tampon_de_chambre_impossible_a_ouvrir" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq2_observation_tampon_de_chambre_impossible_a_ouvrir">Observation</label>
                                            <textarea class="form-control" id="pblq2_observation_tampon_de_chambre_impossible_a_ouvrir" name="pblq2_observation_tampon_de_chambre_impossible_a_ouvrir" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq2_chambre_sous_enrobe_ou_recouverte">Chambre sous enrobée ou récouverte</label>
                                            <select class="form-control" id="pblq2_chambre_sous_enrobe_ou_recouverte" name="pblq2_chambre_sous_enrobe_ou_recouverte" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq2_observation_chambre_sous_enrobe_ou_recouverte">Observation</label>
                                            <textarea class="form-control" id="pblq2_observation_chambre_sous_enrobe_ou_recouverte" name="pblq2_observation_chambre_sous_enrobe_ou_recouverte" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq2_reseau_emprise_privee">Réseau entreprise privée</label>
                                            <select class="form-control" id="pblq2_reseau_emprise_privee" name="pblq2_reseau_emprise_privee" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq2_observation_reseau_emprise_privee">Observation</label>
                                            <textarea class="form-control" id="pblq2_observation_reseau_emprise_privee" name="pblq2_observation_reseau_emprise_privee" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq2_chambre_inexploitable">Chambre inexploitable</label>
                                            <div class="help-block text-left">(pleine de terre,boue ou autre,préciser)</div>
                                            <select class="form-control" id="pblq2_chambre_inexploitable" name="pblq2_chambre_inexploitable" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq2_observation_chambre_inexploitable">Observation</label>
                                            <textarea class="form-control" id="pblq2_observation_chambre_inexploitable" name="pblq2_observation_chambre_inexploitable" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq2_probleme_d_acces">Problème d'accès</label>
                                            <div class="help-block text-left">(chambre,site technique,immeuble...)</div>
                                            <select class="form-control" id="pblq2_probleme_d_acces" name="pblq2_probleme_d_acces" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq2_observation_probleme_d_acces">Observation</label>
                                            <textarea class="form-control" id="pblq2_observation_probleme_d_acces" name="pblq2_observation_probleme_d_acces" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq2_autre_point_de_blocage">Autre point de blocage(décrire au mieux le point)</label>
                                            <textarea class="form-control" id="pblq2_autre_point_de_blocage" name="pblq2_autre_point_de_blocage" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_pblq2_update' role='alert'>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-mini block-content-full border-t">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <!--<button class="wizard-prev btn btn-warning" type="button"><i class="fa fa-arrow-circle-o-left"></i> Previous</button>-->
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <button class="btn btn-primary" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
                                                <button class="btn btn-success" type="button" id="update_pblq2">Valider <i class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="pblq3_update_tab">
                                <form id="info_pblq_uform3" class="js-form1 form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq3_aiguillage_au_compresseur">Aiguillage au compresseur</label>
                                            <div class="help-block text-left">(Min 5000L)</div>
                                            <select class="form-control" id="pblq3_aiguillage_au_compresseur" name="pblq3_aiguillage_au_compresseur" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq3_observation_aiguillage_au_compresseur">Observation</label>
                                            <textarea class="form-control" id="pblq3_observation_aiguillage_au_compresseur" name="pblq3_observation_aiguillage_au_compresseur" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq3_aiguillage_avec_aiguille_de_11_13mm">Aiguillage avec aiguille de 11->13mm</label>
                                            <div class="help-block text-left">(Préciser le diamètre)</div>
                                            <select class="form-control" id="pblq3_aiguillage_avec_aiguille_de_11_13mm" name="pblq3_aiguillage_avec_aiguille_de_11_13mm" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq3_observation_aiguillage_avec_aiguille_de_11_13mm">Observation</label>
                                            <textarea class="form-control" id="pblq3_observation_aiguillage_avec_aiguille_de_11_13mm" name="pblq3_observation_aiguillage_avec_aiguille_de_11_13mm" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq3_aiguillage_aux_cannes">Aiguillage aux cannes</label>
                                            <select class="form-control" id="pblq3_aiguillage_aux_cannes" name="pblq3_aiguillage_aux_cannes" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq3_observation_aiguillage_aux_cannes">Observation</label>
                                            <textarea class="form-control" id="pblq3_observation_aiguillage_aux_cannes" name="pblq3_observation_aiguillage_aux_cannes" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq3_hydrocurage">Hydrocurage</label>
                                            <div class="help-block text-left">(Préciser le valideur)</div>
                                            <select class="form-control" id="pblq3_hydrocurage" name="pblq3_hydrocurage" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq3_observation_hydrocurage">Observation</label>
                                            <textarea class="form-control" id="pblq3_observation_hydrocurage" name="pblq3_observation_hydrocurage" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq3_identification_du_point_bloquant_au_metre">Identification du point bloquant au métré</label>
                                            <div class="help-block text-left">(En mesurant au sol la partie de l'aiguille dans l'alvéole)</div>
                                            <select class="form-control" id="pblq3_identification_du_point_bloquant_au_metre" name="pblq3_identification_du_point_bloquant_au_metre" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq3_observation_identification_du_point_bloquant_au_metre">Observation</label>
                                            <textarea class="form-control" id="pblq3_observation_identification_du_point_bloquant_au_metre" name="pblq3_observation_identification_du_point_bloquant_au_metre" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq3_identification_a_la_sonde">Identification à la sonde</label>
                                            <div class="help-block text-left">(Aiguille avec sonde et teledetecteur)</div>
                                            <select class="form-control" id="pblq3_identification_a_la_sonde" name="pblq3_identification_a_la_sonde" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq3_observation_identification_a_la_sonde">Observation</label>
                                            <textarea class="form-control" id="pblq3_observation_identification_a_la_sonde" name="pblq3_observation_identification_a_la_sonde" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq3_tentative_de_contact_du_proprietaire_ou_gestionnaire">Tentative de contact du propriétaire ou gestionnaire</label>
                                            <div class="help-block text-left">(Préciser un contact s'il y eu identification)</div>
                                            <select class="form-control" id="pblq3_tentative_de_contact_du_proprietaire_ou_gestionnaire" name="pblq3_tentative_de_contact_du_proprietaire_ou_gestionnaire" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefault::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_default\">$result->lib_pblq_default</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq3_observation_tentative_de_contact_du_proprietaire_ou_gestionnaire">Observation</label>
                                            <textarea class="form-control" id="pblq3_observation_tentative_de_contact_du_proprietaire_ou_gestionnaire" name="pblq3_observation_tentative_de_contact_du_proprietaire_ou_gestionnaire" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_pblq3_update' role='alert'>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-mini block-content-full border-t">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <!--<button class="wizard-prev btn btn-warning" type="button"><i class="fa fa-arrow-circle-o-left"></i> Previous</button>-->
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <button class="btn btn-primary" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
                                                <button class="btn btn-success" type="button" id="update_pblq3">Valider <i class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="pblq4_update_tab">
                                <form id="info_pblq_uform4" class="js-form1 form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq4_aiguillage_au_compresseur">Aiguillage au compresseur</label>
                                            <div class="help-block text-left">(Min 5000L)</div>
                                            <select class="form-control" id="pblq4_aiguillage_au_compresseur" name="pblq4_aiguillage_au_compresseur" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq4_observation_aiguillage_au_compresseur">Observation</label>
                                            <textarea class="form-control" id="pblq4_observation_aiguillage_au_compresseur" name="pblq4_observation_aiguillage_au_compresseur" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq4_aiguillage_avec_aiguille">Aiguillage avec aiguille de 13mm</label>
                                            <select class="form-control" id="pblq4_aiguillage_avec_aiguille" name="pblq4_aiguillage_avec_aiguille" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq4_observation_aiguillage_avec_aiguille_de_13mm">Observation</label>
                                            <textarea class="form-control" id="pblq4_observation_aiguillage_avec_aiguille_de_13mm" name="pblq4_observation_aiguillage_avec_aiguille_de_13mm" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq4_aiguillage_aux_cannes">Aiguillage aux cannes</label>
                                            <select class="form-control" id="pblq4_aiguillage_aux_cannes" name="pblq4_aiguillage_aux_cannes" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq4_observation_aiguillage_aux_cannes">Observation</label>
                                            <textarea class="form-control" id="pblq4_observation_aiguillage_aux_cannes" name="pblq4_observation_aiguillage_aux_cannes" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq4_hydrocurage">Hydrocurage</label>
                                            <select class="form-control" id="pblq4_hydrocurage" name="pblq4_hydrocurage" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq4_observation_hydrocurage">Observation</label>
                                            <textarea class="form-control" id="pblq4_observation_hydrocurage" name="pblq4_observation_hydrocurage" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq4_changement_de_parcourt">Changement de parcourt</label>
                                            <div class="help-block text-left">(Appui bureau d'étude non efficace)</div>
                                            <select class="form-control" id="pblq4_changement_de_parcourt" name="pblq4_changement_de_parcourt" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq4_observation_changement_de_parcourt">Observation</label>
                                            <textarea class="form-control" id="pblq4_observation_changement_de_parcourt" name="pblq4_observation_changement_de_parcourt" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq4_fouille_ponctuelle">Fouille ponctuelle</label>
                                            <div class="help-block text-left">(Dans le cas ou le point de blocage inférieur à 1ML)</div>
                                            <select class="form-control" id="pblq4_fouille_ponctuelle" name="pblq4_fouille_ponctuelle" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq4_observation_fouille_ponctuelle">Observation</label>
                                            <textarea class="form-control" id="pblq4_observation_fouille_ponctuelle" name="pblq4_observation_fouille_ponctuelle" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq4_genie_civil">Génie civil</label>
                                            <div class="help-block text-left">(Cas ou la fouille ponctuelle ne permet pas de palier au probléme)</div>
                                            <select class="form-control" id="pblq4_genie_civil" name="pblq4_genie_civil" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq4_observation_genie_civil">Observation</label>
                                            <textarea class="form-control" id="pblq4_observation_genie_civil" name="pblq4_observation_genie_civil" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq4_negociation_avec_le_gestionnaire_prive">Négociation avec le géstionnaire privé</label>
                                            <div class="help-block text-left">(Indiquer toutes les informations disponibles)</div>
                                            <select class="form-control" id="pblq4_negociation_avec_le_gestionnaire_prive" name="pblq4_negociation_avec_le_gestionnaire_prive" size="1">
                                                <option value="" selected>Séléctionnez une valeur</option>
                                                <?php
                                                $results = SelectPBLQDefaultN::all();
                                                foreach($results as $result) {
                                                    echo "<option value=\"$result->id_pblq_defaultn\">$result->lib_pblq_defaultn</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="pblq4_observation_negociation_avec_le_gestionnaire_prive">Observation</label>
                                            <textarea class="form-control" id="pblq4_observation_negociation_avec_le_gestionnaire_prive" name="pblq4_observation_negociation_avec_le_gestionnaire_prive" rows="6" placeholder="Observation.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <label for="pblq4_accompagnement_FREE">Accompagnement FREE</label>
                                            <select class="form-control" id="pblq4_accompagnement_FREE" name="pblq4_accompagnement_FREE" size="1">
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
                                            <label for="pblq4_commentaires_supplementaire">Commentaires supplémentaires <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="pblq4_commentaires_supplementaire" name="pblq4_commentaires_supplementaire" rows="6" placeholder="Commentaires.."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_pblq4_update' role='alert'>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-mini block-content-full border-t">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <!--<button class="wizard-prev btn btn-warning" type="button"><i class="fa fa-arrow-circle-o-left"></i> Previous</button>-->
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <button class="btn btn-primary" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
                                                <button class="btn btn-success" type="button" id="update_pblq4">Valider <i class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END modifier pblq Modal -->
<script>
    var upblq1_formdata = {};
    var upblq2_formdata = {};
    var upblq3_formdata = {};
    var upblq4_formdata = {};
    $(document).ready(function() {
        var msg_alerts_update = ["#message_pblq1_update",
            "#message_pblq2_update",
            "#message_pblq3_update",
            "#message_pblq4_update"];
        $('#info_pblq_uform1 *').filter('.form-control:enabled:not([readonly])').each(function(){
            upblq1_formdata[$( this ).attr('name')] = $( this).val();
        });
        $('#info_pblq_uform2 *').filter('.form-control:enabled:not([readonly])').each(function(){
            upblq2_formdata[$( this ).attr('name')] = $( this).val();
        });

        $('#info_pblq_uform3 *').filter('.form-control:enabled:not([readonly])').each(function(){
            upblq3_formdata[$( this ).attr('name')] = $( this).val();
        });

        $('#info_pblq_uform4 *').filter('.form-control:enabled:not([readonly])').each(function(){
            upblq4_formdata[$( this ).attr('name')] = $( this).val();
        });

        $(msg_alerts_update.join(',')).hide();

        $("#update_pblq1").click(function() {
            for (var key in upblq1_formdata) {
                upblq1_formdata[key] = $('#'+key).val();
            }

            upblq1_formdata['suffix'] = 'pblq1';
            upblq1_formdata['idp'] = pblq_dt.row('.selected').data().id_point_bloquant;

            $.ajax({
                method: "POST",
                url: "api/pointbloquant/pointbloquant/update_pblq1.php",
                data: upblq1_formdata
            }).done(function (message) {
                var obj = $.parseJSON(message);
                if(obj.error == 0) {
                    update = true;
                }

                App.showMessage(message,'#message_pblq1_update');
            });
        });

        $("#update_pblq2").click(function() {
            for (var key in upblq2_formdata) {
                upblq2_formdata[key] = $('#'+key).val();
            }

            upblq2_formdata['suffix'] = 'pblq2';
            upblq2_formdata['idp'] = pblq_dt.row('.selected').data().id_point_bloquant;

            $.ajax({
                method: "POST",
                url: "api/pointbloquant/pointbloquant/update_pblq2.php",
                data: upblq2_formdata
            }).done(function (message) {
                var obj = $.parseJSON(message);
                if(obj.error == 0) {
                    update =true;
                }

                App.showMessage(message,'#message_pblq2_update');
            });
        });

        $("#update_pblq3").click(function() {
            for (var key in upblq3_formdata) {
                upblq3_formdata[key] = $('#'+key).val();
            }

            upblq3_formdata['suffix'] = 'pblq3';
            upblq3_formdata['idp'] = pblq_dt.row('.selected').data().id_point_bloquant;

            $.ajax({
                method: "POST",
                url: "api/pointbloquant/pointbloquant/update_pblq3.php",
                data: upblq3_formdata
            }).done(function (message) {
                var obj = $.parseJSON(message);
                if(obj.error == 0) {
                    update = true;
                }

                App.showMessage(message,'#message_pblq3_update');
            });
        });

        $("#update_pblq4").click(function() {
            for (var key in upblq4_formdata) {
                upblq4_formdata[key] = $('#'+key).val();
            }

            upblq4_formdata['suffix'] = 'pblq4';
            upblq4_formdata['idp'] = pblq_dt.row('.selected').data().id_point_bloquant;

            $.ajax({
                method: "POST",
                url: "api/pointbloquant/pointbloquant/update_pblq4.php",
                data: upblq4_formdata
            }).done(function (message) {
                var obj = $.parseJSON(message);
                if(obj.error == 0) {
                    update = true;
                }

                App.showMessage(message,'#message_pblq4_update');
            });
        });
    } );

    /*
    * $(pblq_btns.join(',')).addClass("disabled");
     pblq_dt.draw(false);
    * */

    $('#update-pblq').on('hidden.bs.modal', function () {
        if(update) {
            $(pblq_btns.join(',')).addClass("disabled");
            pblq_dt.draw(false);
        }
    })
</script>