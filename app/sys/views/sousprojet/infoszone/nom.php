<div class="tab-pane <?= ($value[0]=="nom"?"active":"")?>" id="nom_content">
    <form class="form-horizontal push-10-t push-10" id="sousprojet_form" name="sousprojet_form">
        <div class="row items-push">
            <input type="hidden" id="id_sous_projet" name="id_sous_projet" value="<?=$sousProjet->id_sous_projet?>">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="sp_dep">Département <span class="text-danger">*</span></label>
                    <input class="form-control " type="text" id="sp_dep" name="sp_dep" readonly value="<?=$sousProjet->dep?>">
                </div>
                <div class="col-md-3">
                    <label for="sp_ville">Ville <span class="text-danger">*</span></label>
                    <input class="form-control " type="text" id="sp_ville" name="sp_ville" readonly value="<?=$sousProjet->ville?>">
                </div>
                <div class="col-md-3">
                    <label for="sp_plaque">Plaque <span class="text-danger">*</span></label>
                    <input class="form-control " type="text" id="sp_plaque" name="sp_plaque" readonly value="<?=$sousProjet->plaque?>">
                </div>
                <div class="col-md-3">
                    <label for="sp_zone">Zone <span class="text-danger">*</span></label>
                    <input class="form-control " type="text" id="sp_zone" name="sp_zone" value="<?=$sousProjet->zone?>">
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_infozone_nom" role="alert" style="display: none;">
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var sousprojet_formdata = {};
    $(document).ready(function() {
        $('#sousprojet_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            sousprojet_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_btn").click(function() {
            $("#message_infozone_nom").fadeOut();
            for (var key in sousprojet_formdata) {
                sousprojet_formdata[key] = $('#'+key).val();
            }
            sousprojet_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/infoszone/sous_projet_update.php",
                data: sousprojet_formdata
            }).done(function (msg) {
                App.showMessage(msg, '#message_infozone_nom');
            });
        });
    } );
</script>