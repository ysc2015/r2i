<?php
extract($_GET);
$recette = SousProjetDistributionRecette::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("distribution_recette",$recette);
?>
<!--<script>
    $(document).ready(function() {
        var drecette_isnew = ($("#id_sous_projet_distribution_recette").val()?false:true);

        $("#message_distribution_recette").hide();
        $("#id_sous_projet_distribution_recette_btn").click(function () {

            $("#message_distribution_recette").fadeOut();
            $("#rdistribution_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (drecette_isnew?"api/sousprojet/drecette_add.php":"api/sousprojet/drecette_update.php"),
                data: {
                    ids: <?/*= $_GET['idsousprojet'] */?>,
                    drec_intervenant_be: $('#drec_intervenant_be').val(),
                    drec_doe: $('#drec_doe').val(),
                    drec_netgeo: $('#drec_netgeo').val(),
                    drec_intervenant_free: $('#drec_intervenant_free').val(),
                    drec_entreprise: $('#drec_entreprise').val(),
                    drec_date_recette: $('#drec_date_recette').val(),
                    drec_etat_recette: $('#drec_etat_recette').val()

                }
            }).done(function (msg) {
                $("#rdistribution_block").removeClass('block-opt-refresh');
                if(App.showMessage(msg, '#message_distribution_recette')) {
                    $("#id_sous_projet_distribution_recette_alert").hide();
                    drecette_isnew = false;
                }
            });
        });
    } );
</script>-->