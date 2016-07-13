<div class="block block-themed" id="preparationplaque_block">
    <div class="block-header bg-info">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title"><?=$lang["PREPARATIONPLAQUE"]?></h3>
    </div>
    <div class="block-content">
        <div class="block" id="preparationplaque_block_content">
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log('preparationplaque_block');
        $("#preparationplaque_block").toggleClass('block-opt-refresh');
        $.ajax({
            method: "POST",
            data: {
                idsousprojet : <?= $_GET['idsousprojet']?>
            },
            url: "api/sousprojet/blocks/preparationplaque_block.php"
        }).done(function (msg) {
            $("#preparationplaque_block_content").html(msg);
            $("#preparationplaque_block").removeClass('block-opt-refresh');

            //TODO create js proto for this
            //preparationcarto
            var pcarto_isnew = ($("#id_sous_projet_plaque_carto").val()?false:true);

            $("#message_gestion_plaque_carto").hide();
            $("#id_sous_projet_plaque_carto_btn").click(function () {

                $("#message_gestion_plaque_carto").fadeOut();
                $("#preparationplaque_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (pcarto_isnew?"api/sousprojet/pcarto_add.php":"api/sousprojet/pcarto_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        pc_intervenant_be: $('#pc_intervenant_be').val(),
                        pc_date_debut: $('#pc_date_debut').val(),
                        pc_date_ret_prevue: $('#pc_date_ret_prevue').val(),
                        pc_duree: $('#pc_duree').val()

                    }
                }).done(function (msg) {
                    $("#preparationplaque_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_gestion_plaque_carto')) {
                        $("#id_sous_projet_plaque_carto_alert").hide();
                        pcarto_isnew = false;
                    }
                });
            });
            //positionnementadresses
            var posadr_isnew = ($("#id_sous_projet_plaque_pos_adresse").val()?false:true);

            $("#message_gestion_plaque_pos_adresse").hide();
            $("#id_sous_projet_plaque_pos_adresse_btn").click(function () {

                $("#message_gestion_plaque_pos_adresse").fadeOut();
                $("#preparationplaque_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (posadr_isnew?"api/sousprojet/posadr_add.php":"api/sousprojet/posadr_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        pa_intervenant_be: $('#pa_intervenant_be').val(),
                        pa_date_debut: $('#pa_date_debut').val(),
                        pa_date_ret_prevue: $('#pa_date_ret_prevue').val(),
                        pa_duree: $('#pa_duree').val(),
                        pa_intervenant: $('#pa_intervenant').val(),
                        pa_bpe_sur_site: $('#pa_bpe_sur_site').val()

                    }
                }).done(function (msg) {
                    $("#preparationplaque_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_gestion_plaque_pos_adresse')) {
                        $("#id_sous_projet_plaque_pos_adresse_alert").hide();
                        posadr_isnew = false;
                    }
                });
            });
            //surveyadressesterrain
            var surveyadr_isnew = ($("#id_sous_projet_plaque_survey_adresse").val()?false:true);

            $("#message_gestion_plaque_survey_adresse").hide();
            $("#id_sous_projet_plaque_survey_adresse_btn").click(function () {

                $("#message_gestion_plaque_survey_adresse").fadeOut();
                $("#preparationplaque_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (surveyadr_isnew?"api/sousprojet/surveyadr_add.php":"api/sousprojet/surveyadr_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        sa_volume_adresse: $('#sa_volume_adresse').val(),
                        sa_date_debut: $('#sa_date_debut').val(),
                        sa_date_ret_prevue: $('#sa_date_ret_prevue').val(),
                        sa_intervenant: $('#sa_intervenant').val(),
                        sa_duree: $('#sa_duree').val()

                    }
                }).done(function (msg) {
                    $("#preparationplaque_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_gestion_plaque_survey_adresse')) {
                        $("#id_sous_projet_plaque_survey_adresse_alert").hide();
                        surveyadr_isnew = false;
                    }
                });
            });

        });
    } );
</script>