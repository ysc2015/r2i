<div class="tab-pane <?= ($value[0]=="infoplaque"?"active":"")?>" id="infoplaque_content">
    <form class="form-horizontal push-10-t push-10" id="infoplaque_form" name="infoplaque_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="ip_phase">Phase <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="ip_phase" name="ip_phase">
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
                    <label for="ip_type">Type <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="ip_type" name="ip_type">
                        <option value="" selected="" disabled="">Sélectionnez un type</option>
                        <?php
                        $results = SelectPlaqueType::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_plaque_type\" ". ($sousProjet->infoplaque!==NULL && $sousProjet->infoplaque->type==$result->id_plaque_type ?"selected": "")." >$result->lib_plaque_type</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_infozone_plaque" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_plaque_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var infoplaque_formdata = {};
    $(document).ready(function() {
        $('#infoplaque_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            infoplaque_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_plaque_btn").click(function () {
            $("#message_infozone_plaque").fadeOut();
            $("#infozone_block").toggleClass('block-opt-refresh');

            for (var key in infoplaque_formdata) {
                infoplaque_formdata[key] = $('#'+key).val();
            }
            infoplaque_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/infoszone/infoplaque_save.php",
                data: infoplaque_formdata
            }).done(function (msg) {
                $("#infozone_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_infozone_plaque')
            });
        });
    } );
</script>