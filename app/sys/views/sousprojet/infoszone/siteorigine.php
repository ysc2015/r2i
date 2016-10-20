<div class="tab-pane <?= ($value[0]=="siteorigine"?"active":"")?>" id="siteorigine_content">
    <form class="form-horizontal push-10-t push-10" id="siteorigine_form" name="siteorigine_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="so_code_site">Code Site <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="text" id="so_code_site" name="so_code_site" readonly="" value="<?=($sousProjet->projet !== NULL?$sousProjet->projet->id_nro:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="so_type">Type <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="so_type" name="so_type" disabled="">
                        <option value="" selected="">Sélectionnez un type</option>
                        <?php
                        $results = SelectSiteOrigineType::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_site_origine_type\" ". ($sousProjet->projet!==NULL && $sousProjet->projet->type_site_origine==$result->id_site_origine_type ?"selected": "")." >$result->lib_site_origine_type</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="so_auto_adduction">Auto Adduction <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="so_auto_adduction" name="so_auto_adduction">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectSiteOrigineAutoAdduction::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_site_origine_auto_adduction\" ". ($sousProjet->siteorigine!==NULL && $sousProjet->siteorigine->auto_adduction==$result->id_site_origine_auto_adduction ?"selected": "")." >$result->lib_site_origine_auto_adduction</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="so_travaux_adduction">Travaux adduction <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="so_travaux_adduction" name="so_travaux_adduction">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectSiteOrigineTravauxAdduction::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_site_origine_travaux_adduction\" ". ($sousProjet->siteorigine!==NULL && $sousProjet->siteorigine->travaux_adduction==$result->id_site_origine_travaux_adduction ?"selected": "")." >$result->lib_site_origine_travaux_adduction</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="so_recette_adduction">Recette Adduction <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="so_recette_adduction" name="so_recette_adduction">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectSiteOrigineRecetteAdduction::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_site_origine_recette_adduction\" ". ($sousProjet->siteorigine!==NULL && $sousProjet->siteorigine->recette_adduction==$result->id_site_origine_recette_adduction ?"selected": "")." >$result->lib_site_origine_recette_adduction</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_infozone_site_origine" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-xs-12"><button id="id_sous_projet_site_origine_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button></div>
            </div>
        </div>
    </form>
</div>
<script>
    var siteorigine_formdata = {};
    $(document).ready(function() {
        $('#siteorigine_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            siteorigine_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_site_origine_btn").click(function () {
            $("#message_infozone_site_origine").fadeOut();
            $("#infozone_block").toggleClass('block-opt-refresh');

            for (var key in siteorigine_formdata) {
                siteorigine_formdata[key] = $('#'+key).val();
            }
            siteorigine_formdata['ids'] = get('idsousprojet');
            siteorigine_formdata['so_code_site'] = $('#so_code_site').val();
            siteorigine_formdata['so_type'] = $('#so_type').val();

            $.ajax({
                method: "POST",
                url: "api/sousprojet/infoszone/infositeorigine_save.php",
                data: siteorigine_formdata
            }).done(function (msg) {
                $("#infozone_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_infozone_site_origine');
            });
        });
    } );
</script>