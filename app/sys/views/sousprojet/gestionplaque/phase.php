<div class="tab-pane <?= ($value[0]=="phase"?"active":"")?>" id="phase_content">
    <form class="form-horizontal push-10-t push-10" id="gestionplaque_phase_form" name="gestionplaque_phase_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="gp_instigateur">Instigateur <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="gp_instigateur" name="gp_instigateur">
                        <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectPhaseInstigateur::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_phase_instigateur\" ". ($sousProjet->plaquephase!==NULL && $sousProjet->plaquephase->instigateur==$result->id_phase_instigateur ?"selected": "")." >$result->lib_phase_instigateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="gp_vague">Vague <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="gp_vague" name="gp_vague" disabled="">
                        <option value="" selected="" disabled="">Sélectionnez une phase</option>
                        <?php
                        $results = SelectPlaquePhase::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_plaque_phase\" ". ($sousProjet->infoplaque!==NULL && $sousProjet->infoplaque->phase==$result->id_plaque_phase ?"selected": "")." >$result->lib_plaque_phase</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="gp_date_lancement">Date Lancement <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="date" id="gp_date_lancement" name="gp_date_lancement" value="<?=($sousProjet->plaquephase !== NULL?$sousProjet->plaquephase->date_lancement:"")?>">
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_gestion_plaque_phase" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_plaque_phase_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button></div>
            </div>
        </div>
    </form>
</div>
<script>
    var phase_formdata = {};
    $(document).ready(function() {
        $('#gestionplaque_phase_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            phase_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_plaque_phase_btn").click(function () {
            $("#message_gestion_plaque_phase").fadeOut();
            $("#gestionplaque_block").toggleClass('block-opt-refresh');

            for (var key in phase_formdata) {
                phase_formdata[key] = $('#'+key).val();
            }
            phase_formdata['ids'] = get('idsousprojet');
            phase_formdata['gp_vague'] = $('#gp_vague').val();

            $.ajax({
                method: "POST",
                url: "api/sousprojet/gestionplaque/phase_save.php",
                data: phase_formdata
            }).done(function (msg) {
                $("#gestionplaque_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_gestion_plaque_phase');
            });
        });
    } );
</script>