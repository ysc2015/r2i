<?php
extract($_GET);
$phase = SousProjetPlaquePhase::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("gestion_plaque_phase",$phase);
?>

<script>
    $(document).ready(function() {

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
    } );
</script>