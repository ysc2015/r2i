<?php
extract($_GET);
$tctr = SousProjetTransportCommandeCTR::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("transport_commande_ctr",$tctr);
?>
<script>
    $(document).ready(function() {
        var tcmdctr_isnew = ($("#id_sous_projet_transport_commande_ctr").val()?false:true);

        $("#message_transport_commande_ctr").hide();
        $("#id_sous_projet_transport_commande_ctr_btn").click(function () {

            $("#message_transport_commande_ctr").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (tcmdctr_isnew?"api/sousprojet/tcmdctr_add.php":"api/sousprojet/tcmdctr_update.php"),
                data: {
                    ids: <?= $_GET['idsousprojet'] ?>,
                    cctr_intervenant_be: $('#cctr_intervenant_be').val(),
                    cctr_date_butoir: $('#cctr_date_butoir').val(),
                    cctr_traitement_retour_terrain: $('#cctr_traitement_retour_terrain').val(),
                    cctr_modification_carto: $('#cctr_modification_carto').val(),
                    cctr_commandes_acces: $('#cctr_commandes_acces').val(),
                    cctr_date_transmission_ca: $('#cctr_date_transmission_ca').val(),
                    cctr_ref_commande_acces: $('#cctr_ref_commande_acces').val(),
                    cctr_go_ft: $('#cctr_go_ft').val()

                }
            }).done(function (msg) {
                $("#rtransport_block").removeClass('block-opt-refresh');
                if(App.showMessage(msg, '#message_transport_commande_ctr')) {
                    $("#id_sous_projet_transport_commande_ctr_alert").hide();
                    tcmdctr_isnew = false;
                }
            });
        });
    } );
</script>