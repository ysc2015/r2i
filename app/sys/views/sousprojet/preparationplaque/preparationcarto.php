<div class="tab-pane <?= ($value[0]=="preparationcarto"?"active":"")?>" id="preparationcarto_content">
    <form class="form-horizontal push-10-t push-10" id="prep_carto_form" name="prep_carto_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="pc_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
                    <select class="form-control" id="pc_intervenant_be" name="pc_intervenant_be">
                        <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->plaquecarto!==NULL && $sousProjet->plaquecarto->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="pc_date_debut">Date de Début <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" id="pc_date_debut" name="pc_date_debut" value="<?=($sousProjet->plaquecarto !== NULL?$sousProjet->plaquecarto->date_debut:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="pc_date_ret_prevue">Date ret Prev <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" id="pc_date_ret_prevue" name="pc_date_ret_prevue" value="<?=($sousProjet->plaquecarto !== NULL?$sousProjet->plaquecarto->date_ret_prevue:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="pc_duree">Durée(jours) <span class="text-danger">*</span></label>
                    <input readonly class="form-control" type="text" id="pc_duree" name="pc_duree" value="<?=($sousProjet->plaquecarto !== NULL?$sousProjet->plaquecarto->duree:"")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="pc_ok">OK <span class="text-danger">*</span></label>
                    <select class="form-control" id="pc_ok" name="pc_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->plaquecarto!==NULL && $sousProjet->plaquecarto->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_gestion_plaque_carto" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_plaque_carto_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button></div>
            </div>
        </div>
    </form>
</div>
<script>
    var carto_formdata = {};
    $(document).ready(function() {
        $('#prep_carto_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            carto_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_plaque_carto_btn").click(function () {

            $("#message_gestion_plaque_carto").fadeOut();
            $("#preparationplaque_block").toggleClass('block-opt-refresh');

            for (var key in carto_formdata) {
                carto_formdata[key] = $('#'+key).val();
            }
            carto_formdata['ids'] = get('idsousprojet');
            carto_formdata['pc_duree'] = $("#pc_duree").val();

            $.ajax({
                method: "POST",
                url: "api/sousprojet/preparationplaque/carto_save.php",
                data: carto_formdata
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                if(obj.error == 0) {
                    $("#pc_duree").val(obj.duree);
                }
                $("#preparationplaque_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_gestion_plaque_carto');
            });
        });
    } );
</script>