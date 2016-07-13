<div class="block block-themed" id="gestionplaque_block">
    <div class="block-header bg-info">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title"><?=$lang["GESTIONPLAQUE"]?></h3>
    </div>
    <div class="block-content">
        <div class="block" id="gestionplaque_block_content">
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log('gestionplaque_block');
        $("#gestionplaque_block").toggleClass('block-opt-refresh');
        $.ajax({
            method: "POST",
            data: {
                idsousprojet : <?= $_GET['idsousprojet']?>
            },
            url: "api/sousprojet/blocks/gestionplaque_block.php"
        }).done(function (msg) {
            $("#gestionplaque_block_content").html(msg);
            $("#gestionplaque_block").removeClass('block-opt-refresh');

            //TODO create js proto for this
            //phase
            var phase_isnew = ($("#id_sous_projet_plaque_phase").val()?false:true);
            $("#message_gestion_plaque_phase").hide();
            $("#id_sous_projet_plaque_phase_btn").click(function () {
                $("#message_gestion_plaque_phase").fadeOut();
                $("#gestionplaque_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (phase_isnew?"api/sousprojet/phase_add.php":"api/sousprojet/phase_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        instigateur: $('#instigateur').val(),
                        vague: $('#vague').val(),
                        date_lancement: $('#date_lancement').val()

                    }
                }).done(function (msg) {
                    $("#gestionplaque_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_gestion_plaque_phase')) {
                        $("#id_sous_projet_plaque_phase_alert").hide();
                        phase_isnew = false;
                    }
                });
            });
            //traitementetude
            var tetude_isnew = ($("#id_sous_projet_plaque_traitement_etude").val()?false:true);

            $("#message_gestion_plaque_traitement_etude").hide();
            $("#id_sous_projet_plaque_traitement_etude_btn").click(function () {

                $("#message_gestion_plaque_traitement_etude").fadeOut();
                $("#gestionplaque_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (tetude_isnew?"api/sousprojet/traitementetude_add.php":"api/sousprojet/traitementetude_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        tsite: $('#tsite').val(),
                        charge_etude: $('#charge_etude').val()

                    }
                }).done(function (msg) {
                    $("#gestionplaque_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_gestion_plaque_traitement_etude')) {
                        $("#id_sous_projet_plaque_traitement_etude_alert").hide();
                        tetude_isnew = false;
                    }
                });
            });

        });
    } );
</script>