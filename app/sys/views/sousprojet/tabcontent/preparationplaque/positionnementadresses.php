<?php
extract($_GET);
$posadresse = SousProjetPlaquePosAdresse::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("gestion_plaque_pos_adresse",$posadresse);
?>
<!--<script>
    $(document).ready(function() {
        var posadr_isnew = ($("#id_sous_projet_plaque_pos_adresse").val()?false:true);

        $("#message_gestion_plaque_pos_adresse").hide();
        $("#id_sous_projet_plaque_pos_adresse_btn").click(function () {

            $("#message_gestion_plaque_pos_adresse").fadeOut();
            $("#preparationplaque_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (posadr_isnew?"api/sousprojet/posadr_add.php":"api/sousprojet/posadr_update.php"),
                data: {
                    ids: <?/*= $_GET['idsousprojet'] */?>,
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
    } );
</script>-->