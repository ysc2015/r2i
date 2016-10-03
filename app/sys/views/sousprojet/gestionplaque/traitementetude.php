<div class="tab-pane <?= ($value[0]=="traitementetude"?"active":"")?>" id="traitementetude_content">
    <form class="form-horizontal push-10-t push-10" id="gestionplaque_tetude_form" name="gestionplaque_tetude_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="te_site">Site <span class="text-danger">*</span></label>
                    <select class="form-control" id="te_site" name="te_site">
                        <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectTraitementEtudeSite::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_traitement_etude_site\" ". ($sousProjet->plaqueetude!==NULL && $sousProjet->plaqueetude->site==$result->id_traitement_etude_site ?"selected": "")." >$result->lib_traitement_etude_site</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="te_charge_etude">Chargé d'étude <span class="text-danger">*</span></label>
                    <select class="form-control" id="te_charge_etude" name="te_charge_etude">
                        <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->plaqueetude!==NULL && $sousProjet->plaqueetude->charge_etude==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_gestion_plaque_traitement_etude" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_plaque_traitement_etude_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button></div>
            </div>
        </div>
    </form>
</div>
<script>
    var tetude_formdata = {};
    $(document).ready(function() {
        $('#gestionplaque_tetude_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            tetude_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_plaque_traitement_etude_btn").click(function () {

            $("#message_gestion_plaque_traitement_etude").fadeOut();
            $("#gestionplaque_block").toggleClass('block-opt-refresh');

            for (var key in tetude_formdata) {
                tetude_formdata[key] = $('#'+key).val();
            }
            tetude_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/gestionplaque/traitementetude_save.php",
                data: tetude_formdata
            }).done(function (msg) {
                $("#gestionplaque_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_gestion_plaque_traitement_etude');
            });
        });
    } );
</script>