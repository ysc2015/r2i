<?php
extract($_GET);
$traitement_etude = SousProjetPlaqueTraitementEtude::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("gestion_plaque_traitement_etude",$traitement_etude);
?>
<script>
    $(document).ready(function() {
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
    } );
</script>