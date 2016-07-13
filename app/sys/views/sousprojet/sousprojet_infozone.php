<div class="block block-themed" id="infozone_block">
    <div class="block-header bg-info">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title"><?= $lang["INFOZONE"]?></h3>
    </div>
    <div class="block-content">
        <div class="block" id="infozone_block_content">

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log('infozone_block');
        $("#infozone_block").toggleClass('block-opt-refresh');
        $.ajax({
            method: "POST",
            data: {
                idsousprojet : <?= $_GET['idsousprojet']?>
            },
            url: "api/sousprojet/blocks/infozone_block.php"
        }).done(function (msg) {
            //console.log(msg);
            $("#infozone_block_content").html(msg);
            $("#infozone_block").removeClass('block-opt-refresh');

            //TODO create js proto for this
            //nom
            $("#message_infozone_nom").hide();
            $("#id_sous_projet_btn").click(function() {
                console.log('dsdsq');
                $("#message_infozone_nom").fadeOut();
                $.ajax({
                    method: "POST",
                    url: "api/sousprojet/sous_projet_update.php",
                    data: {
                        ids : 6,
                        zone : $("#zone").val()
                    }
                }).done(function (msg) {
                    console.log(msg);
                    App.showMessage(msg, '#message_infozone_nom');
                });
            });
            //infoplaque
            var infoplaque_isnew = ($("#id_sous_projet_plaque").val()?false:true);

            $("#message_infozone_plaque").hide();
            $("#id_sous_projet_plaque_btn").click(function () {

                $("#message_infozone_plaque").fadeOut();
                $("#infozone_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (infoplaque_isnew?"api/sousprojet/infoplaque_add.php":"api/sousprojet/infoplaque_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        phase: $('#phase').val(),
                        type: $('#type').val()

                    }
                }).done(function (msg) {
                    $("#infozone_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_infozone_plaque')) {
                        $("#id_sous_projet_plaque_alert").hide();
                        infoplaque_isnew = false;
                    }
                });
            });
            //zone
            var zone_isnew = ($("#id_sous_projet_zone").val()?false:true);

            $("#message_infozone_zone").hide();
            $("#id_sous_projet_zone_btn").click(function () {

                $("#message_infozone_zone").fadeOut();
                $("#infozone_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (zone_isnew?"api/sousprojet/zone_add.php":"api/sousprojet/zone_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        nbr_zone: $('#nbr_zone').val(),
                        lr_sur_pm: $('#lr_sur_pm').val(),
                        lr: $('#lr').val(),
                        nbr_de_site: $('#nbr_de_site').val(),
                        nb_fo_sur_pm: $('#nb_fo_sur_pm').val(),
                        nb_fo_sur_pmz: $('#nb_fo_sur_pmz').val()

                    }
                }).done(function (msg) {
                    $("#infozone_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_infozone_zone')) {
                        $("#id_sous_projet_zone_alert").hide();
                        zone_isnew = false;
                    }
                });
            });
            //siteorigine
            var siteorigine_isnew = ($("#id_sous_projet_site_origine").val()?false:true);

            $("#message_infozone_site_origine").hide();
            $("#id_sous_projet_site_origine_btn").click(function () {

                $("#message_infozone_site_origine").fadeOut();
                $("#infozone_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (siteorigine_isnew?"api/sousprojet/site_origine_add.php":"api/sousprojet/site_origine_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        code_site: $('#code_site').val(),
                        type_so: $('#type_so').val(),
                        auto_adduction: $('#auto_adduction').val(),
                        travaux_adduction: $('#travaux_adduction').val(),
                        recette_adduction: $('#recette_adduction').val()

                    }
                }).done(function (msg) {
                    $("#infozone_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_infozone_site_origine')) {
                        $("#id_sous_projet_site_origine_alert").hide();
                        siteorigine_isnew = false;
                    }
                });
            });
        });
    } );
</script>