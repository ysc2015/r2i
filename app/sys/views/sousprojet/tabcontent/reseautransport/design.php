<?php
extract($_GET);
$tdesign = SousProjetTransportDesign::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("transport_design",$tdesign);
?>
<!--<script>
    $(document).ready(function() {
        var tdesign_isnew = ($("#id_sous_projet_transport_design").val()?false:true);

        $("#message_transport_design").hide();
        $("#id_sous_projet_transport_design_btn").click(function () {

            $("#message_transport_design").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (tdesign_isnew?"api/sousprojet/tdesign_add.php":"api/sousprojet/tdesign_update.php"),
                data: {
                    ids: <?/*= $_GET['idsousprojet'] */?>,
                    td_intervenant_be: $('#td_intervenant_be').val(),
                    td_date_debut: $('#td_date_debut').val(),
                    td_date_ret_prevue: $('#td_date_ret_prevue').val(),
                    td_duree: $('#td_duree').val(),
                    td_lineaire_transport: $('#td_lineaire_transport').val(),
                    td_nb_zones: $('#td_nb_zones').val()

                }
            }).done(function (msg) {
                $("#rtransport_block").removeClass('block-opt-refresh');
                if(App.showMessage(msg, '#message_transport_design')) {
                    $("#id_sous_projet_transport_design_alert").hide();
                    tdesign_isnew = false;
                }
            });
        });
    } );
</script>-->