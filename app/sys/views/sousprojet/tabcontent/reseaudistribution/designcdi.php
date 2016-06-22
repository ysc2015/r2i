<?php
extract($_GET);
$design = SousProjetDistributionDesign::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("distribution_design",$design);
?>
<script>
    $(document).ready(function() {
        var ddesign_isnew = ($("#id_sous_projet_distribution_design").val()?false:true);

        $("#message_distribution_design").hide();
        $("#id_sous_projet_distribution_design_btn").click(function () {

            $("#message_distribution_design").fadeOut();
            $("#rdistribution_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (ddesign_isnew?"api/sousprojet/ddesign_add.php":"api/sousprojet/ddesign_update.php"),
                data: {
                    ids: <?= $_GET['idsousprojet'] ?>,
                    dd_intervenant_be: $('#dd_intervenant_be').val(),
                    dd_intervenant_bex: $('#dd_intervenant_bex').val(),
                    dd_date_debut: $('#dd_date_debut').val(),
                    dd_date_fin: $('#dd_date_fin').val(),
                    dd_duree: $('#dd_duree').val(),
                    dd_lineaire_distribution: $('#dd_lineaire_distribution').val(),
                    dd_etat: $('#dd_etat').val(),
                    dd_date_envoi: $('#dd_date_envoi').val()

                }
            }).done(function (msg) {
                $("#rdistribution_block").removeClass('block-opt-refresh');
                if(App.showMessage(msg, '#message_distribution_design')) {
                    $("#id_sous_projet_distribution_design_alert").hide();
                    ddesign_isnew = false;
                }
            });
        });
    } );
</script>