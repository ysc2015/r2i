<div class="tab-pane <?= ($value[0]=="zone"?"active":"")?>" id="zone_content">
    <form class="form-horizontal push-10-t push-10" id="sousprojet_zone_form" name="sousprojet_zone_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="sz_nbr_zone">Nbe de Zones de la Plaque <span class="text-danger">*</span></label>
                    <input class="form-control" type="number" id="sz_nbr_zone" name="sz_nbr_zone" value="<?=($sousProjet->infozone !==NULL?$sousProjet->infozone->nbr_zone:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="sz_lr_sur_pm">LR sur PM existant <span class="text-danger">*</span></label>
                    <input class="form-control" type="number" id="sz_lr_sur_pm" name="sz_lr_sur_pm" value="<?=($sousProjet->infozone !==NULL?$sousProjet->infozone->lr_sur_pm:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="sz_lr">LR <span class="text-danger">*</span></label>
                    <input class="form-control" type="number" id="sz_lr" name="sz_lr" value="<?=($sousProjet->infozone !==NULL?$sousProjet->infozone->lr:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="sz_nbr_de_site">NB DE SITE <span class="text-danger">*</span></label>
                    <input class="form-control" type="number" id="sz_nbr_de_site" name="sz_nbr_de_site" value="<?=($sousProjet->infozone !==NULL?$sousProjet->infozone->nbr_de_site:"")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="sz_nb_fo_sur_pm">NB FO SUR PM <span class="text-danger">*</span></label>
                    <input class="form-control" type="number" id="sz_nb_fo_sur_pm" name="sz_nb_fo_sur_pm" value="<?=($sousProjet->infozone !==NULL?$sousProjet->infozone->nb_fo_sur_pm:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="sz_nb_fo_sur_pmz">NB FO SUR PMZ <span class="text-danger">*</span></label>
                    <input class="form-control" type="number" id="sz_nb_fo_sur_pmz" name="sz_nb_fo_sur_pmz" value="<?=($sousProjet->infozone !==NULL?$sousProjet->infozone->nb_fo_sur_pmz:"")?>">
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_infozone_zone" role="alert" style="display: none;">
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button id="id_sous_projet_zone_btn" class="btn btn-primary" type="button">Enregistrer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var zone_formdata = {};
    $(document).ready(function() {
        $('#sousprojet_zone_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            zone_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_zone_btn").click(function () {
            $("#message_infozone_zone").fadeOut();
            $("#infozone_block").toggleClass('block-opt-refresh');

            for (var key in zone_formdata) {
                console.log('#'+key);
                zone_formdata[key] = $('#'+key).val();
            }
            zone_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/infoszone/infozone_save.php",
                data: zone_formdata
            }).done(function (msg) {
                $("#infozone_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_infozone_zone');
            });
        });
    } );
</script>