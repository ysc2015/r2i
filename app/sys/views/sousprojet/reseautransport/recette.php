<div class="tab-pane <?= ($value[0]=="recette"?"active":"")?>" id="recette_content">
    <form class="form-horizontal push-10-t push-10" id="transport_recette_form" name="transport_recette_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="trec_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="trec_intervenant_be" name="trec_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="trec_doe">DOE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="trec_doe" name="trec_doe">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->doe==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="trec_netgeo">Netgeo <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="trec_netgeo" name="trec_netgeo">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->netgeo==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="trec_intervenant_free">Intervenant FREE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="trec_intervenant_free" name="trec_intervenant_free">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->intervenant_free==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="trec_id_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="trec_id_entreprise" name="trec_id_entreprise">
                        <option value="" selected="">Sélectionnez une entreprise</option>
                        <?php
                        $results = EntrepriseSTT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="trec_date_recette">Date Recette <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="date" id="trec_date_recette" name="trec_date_recette" value="<?=($sousProjet->transportrecette !== NULL ? $sousProjet->transportrecette->date_recette : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="trec_etat_recette">Etat Recette <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="trec_etat_recette" name="trec_etat_recette">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatRecette::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_recette\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->etat_recette==$result->id_etat_recette ?"selected": "")." >$result->lib_etat_recette</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_transport_recette" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_transport_recette_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                <button id="id_sous_projet_transport_recette_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                </div>
            </div>
        </div>
    </form>

</div>
<script>
    var recette_formdata = {};
    $(document).ready(function() {
        var typeetape = "sous_projet_transport_recette";

        var variable_etape = "transportrecette";

        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"recette_href","Recette: ");


        $("#id_sous_projet_transport_recette_btn_osa").click(function () {
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape);//1 = ide
        });
        $('#transport_recette_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            recette_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_transport_recette_btn").click(function () {

            $("#message_transport_recette").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');

            for (var key in recette_formdata) {
                recette_formdata[key] = $('#'+key).val();
            }
            recette_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseautransport/recette_save.php",
                data: recette_formdata
            }).done(function (msg) {
                $("#rtransport_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_transport_recette');
            });
        });
    } );
</script>