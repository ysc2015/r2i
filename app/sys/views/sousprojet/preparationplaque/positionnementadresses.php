<div class="tab-pane <?= ($value[0]=="positionnementadresses"?"active":"")?>" id="positionnementadresses_content">
    <form class="form-horizontal push-10-t push-10" id="pos_adresse_form" name="pos_adresse_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="pa_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="pa_intervenant_be" name="pa_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->plaqueposadr!==NULL && $sousProjet->plaqueposadr->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="pa_date_debut">Date de Début <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="date" id="pa_date_debut" name="pa_date_debut" value="<?=($sousProjet->plaqueposadr !== NULL?$sousProjet->plaqueposadr->date_debut:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="pa_date_ret_prevue">Date ret Prev <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="date" id="pa_date_ret_prevue" name="pa_date_ret_prevue" value="<?=($sousProjet->plaqueposadr !== NULL?$sousProjet->plaqueposadr->date_ret_prevue:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="pa_duree">Durée(jours) <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control" type="text" id="pa_duree" name="pa_duree" value="<?=($sousProjet->plaqueposadr !== NULL?$sousProjet->plaqueposadr->duree:"")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="pa_intervenant">Intervenant <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="pa_intervenant" name="pa_intervenant">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->plaqueposadr!==NULL && $sousProjet->plaqueposadr->intervenant==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="pa_ok">OK <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="pa_ok" name="pa_ok">
                        <option value="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->plaqueposadr!==NULL && $sousProjet->plaqueposadr->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_gestion_plaque_pos_adresse" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_plaque_pos_adresse_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <button id="id_sous_projet_plaque_pos_adresse_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>

                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var posadr_formdata = {};
    $(document).ready(function() {
        var typeetape = "sous_projet_plaque_pos_adresse";
        var variable_etape = "SousProjetPlaquePosAdresse";

        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"positionnementadresses_href","Positionnement des Adresses: ");

        $("#id_sous_projet_plaque_carto_btn_osa").click(function () {
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape);
        });
        $('#pos_adresse_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            posadr_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_plaque_pos_adresse_btn").click(function () {

            $("#message_gestion_plaque_pos_adresse").fadeOut();
            $("#preparationplaque_block").toggleClass('block-opt-refresh');

            for (var key in posadr_formdata) {
                posadr_formdata[key] = $('#'+key).val();
            }
            posadr_formdata['ids'] = get('idsousprojet');
            posadr_formdata['pa_duree'] = $("#pa_duree").val();

            $.ajax({
                method: "POST",
                url: "api/sousprojet/preparationplaque/posadr_save.php",
                data: posadr_formdata
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                if(obj.error == 0) {
                    $("#pa_duree").val(obj.duree);
                }
                $("#preparationplaque_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_gestion_plaque_pos_adresse');
            });
        });
    } );
</script>