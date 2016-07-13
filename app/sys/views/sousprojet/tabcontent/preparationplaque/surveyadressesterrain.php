<?php
extract($_GET);
$surveyadresse = SousProjetPlaqueSurveyAdresse::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("gestion_plaque_survey_adresse",$surveyadresse);
?>
<!--<script>
    $(document).ready(function() {
        var surveyadr_isnew = ($("#id_sous_projet_plaque_survey_adresse").val()?false:true);

        $("#message_gestion_plaque_survey_adresse").hide();
        $("#id_sous_projet_plaque_survey_adresse_btn").click(function () {

            $("#message_gestion_plaque_survey_adresse").fadeOut();
            $("#preparationplaque_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (surveyadr_isnew?"api/sousprojet/surveyadr_add.php":"api/sousprojet/surveyadr_update.php"),
                data: {
                    ids: <?/*= $_GET['idsousprojet'] */?>,
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
    } );
</script>-->