<div class="tab-pane <?= ($value[0]=="drecette"?"active":"")?>" id="drecette_content">
    <form class="form-horizontal push-10-t push-10" id="dist_recette_form" name="dist_recette_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="drec_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="drec_intervenant_be" name="drec_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="drec_doe">DOE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="drec_doe" name="drec_doe">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->doe==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="drec_netgeo">Netgeo <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="drec_netgeo" name="drec_netgeo">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->netgeo==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="drec_intervenant_free">Intervenant FREE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="drec_intervenant_free" name="drec_intervenant_free">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->intervenant_free==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="drec_id_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="drec_id_entreprise" name="drec_id_entreprise">
                        <option value="" selected="">Sélectionnez une entreprise</option>
                        <?php
                        $results = EntrepriseSTT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="drec_date_recette">Date de Recette <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="drec_date_recette" name="drec_date_recette" value="<?=($sousProjet->distributionrecette !== NULL ? $sousProjet->distributionrecette->date_recette : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="drec_etat_recette">Etat Recette <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="drec_etat_recette" name="drec_etat_recette">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatRecette::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_recette\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->etat_recette==$result->id_etat_recette ?"selected": "")." >$result->lib_etat_recette</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_distribution_recette" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_distribution_recette_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button></div>
            </div>
        </div>
    </form>
</div>
<script>
    var drecette_formdata = {};
    $(document).ready(function() {
        $('#dist_recette_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            drecette_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_distribution_recette_btn").click(function () {

            $("#message_distribution_recette").fadeOut();
            $("#rdistribution_block").toggleClass('block-opt-refresh');

            for (var key in drecette_formdata) {
                drecette_formdata[key] = $('#'+key).val();
            }
            drecette_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseaudistribution/recette_save.php",
                data: drecette_formdata
            }).done(function (msg) {
                $("#rdistribution_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_distribution_recette');
            });
        });
    } );
</script>