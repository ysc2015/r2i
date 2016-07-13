<?php
extract($_GET);
$ctr = SousProjetDistributionCommandeCDI::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("distribution_commande_cdi",$ctr);
?>
<!--<script>
    $(document).ready(function() {
        var dcmdcdi_isnew = ($("#id_sous_projet_distribution_commande_cdi").val()?false:true);

        $("#message_distribution_commande_cdi").hide();
        $("#id_sous_projet_distribution_commande_cdi_btn").click(function () {

            $("#message_distribution_commande_cdi").fadeOut();
            $("#rdistribution_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (dcmdcdi_isnew?"api/sousprojet/dcmdcdi_add.php":"api/sousprojet/dcmdcdi_update.php"),
                data: {
                    ids: <?/*= $_GET['idsousprojet'] */?>,
                    dcc_intervenant_be: $('#dcc_intervenant_be').val(),
                    dcc_date_butoir: $('#dcc_date_butoir').val(),
                    dcc_traitement_retour_terrain: $('#dcc_traitement_retour_terrain').val(),
                    dcc_modification_carto: $('#dcc_modification_carto').val(),
                    dcc_commandes_acces: $('#dcc_commandes_acces').val(),
                    dcc_date_transmission_ca: $('#dcc_date_transmission_ca').val(),
                    dcc_ref_commande_acces: $('#dcc_ref_commande_acces').val(),
                    dcc_go_ft: $('#dcc_go_ft').val()

                }
            }).done(function (msg) {
                $("#rdistribution_block").removeClass('block-opt-refresh');
                if(App.showMessage(msg, '#message_distribution_commande_cdi')) {
                    $("#id_sous_projet_distribution_commande_cdi_alert").hide();
                    dcmdcdi_isnew = false;
                }
            });
        });
    } );
</script>-->