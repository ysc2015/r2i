<?php
extract($_GET);
$trecette = SousProjetTransportRecette::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("transport_recette",$trecette);
?>
<script>
    $(document).ready(function() {
        var trecette_isnew = ($("#id_sous_projet_transport_recette").val()?false:true);

        $("#message_transport_recette").hide();
        $("#id_sous_projet_transport_recette_btn").click(function () {

            $("#message_transport_recette").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (trecette_isnew?"api/sousprojet/trecette_add.php":"api/sousprojet/trecette_update.php"),
                data: {
                    ids: <?= $_GET['idsousprojet'] ?>,
                    trec_intervenant_be: $('#trec_intervenant_be').val(),
                    trec_doe: $('#trec_doe').val(),
                    trec_netgeo: $('#trec_netgeo').val(),
                    trec_intervenant_free: $('#trec_intervenant_free').val(),
                    trec_entreprise: $('#trec_entreprise').val(),
                    trec_date_recette: $('#trec_date_recette').val(),
                    trec_etat_recette: $('#trec_etat_recette').val()

                }
            }).done(function (msg) {
                $("#rtransport_block").removeClass('block-opt-refresh');
                if(App.showMessage(msg, '#message_transport_recette')) {
                    $("#id_sous_projet_transport_recette_alert").hide();
                    trecette_isnew = false;
                }
            });
        });
    } );
</script>