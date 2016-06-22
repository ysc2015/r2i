<?php
extract($_GET);
$rac = SousProjetDistributionRaccordement::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("distribution_raccordements",$rac);
?>
<script>
    $(document).ready(function() {
        var draccord_isnew = ($("#id_sous_projet_distribution_raccordements").val()?false:true);

        $("#message_distribution_raccordements").hide();
        $("#id_sous_projet_distribution_raccordements_btn").click(function () {

            $("#message_distribution_raccordements").fadeOut();
            $("#rdistribution_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (draccord_isnew?"api/sousprojet/draccord_add.php":"api/sousprojet/draccord_update.php"),
                data: {
                    ids: <?= $_GET['idsousprojet'] ?>,
                    dr_intervenant_be: $('#dr_intervenant_be').val(),
                    dr_preparation_pds: $('#dr_preparation_pds').val(),
                    dr_controle_plans: $('#dr_controle_plans').val(),
                    dr_date_transmission_pds: $('#dr_date_transmission_pds').val(),
                    dr_entreprise: $('#dr_entreprise').val(),
                    dr_date_racco: $('#dr_date_racco').val(),
                    dr_duree: $('#dr_duree').val(),
                    dr_controle_demarrage_effectif: $('#dr_controle_demarrage_effectif').val(),
                    dr_date_retour: $('#dr_date_retour').val(),
                    dr_etat_retour: $('#dr_etat_retour').val()

                }
            }).done(function (msg) {
                $("#rdistribution_block").removeClass('block-opt-refresh');
                if(App.showMessage(msg, '#message_distribution_raccordements')) {
                    $("#id_sous_projet_distribution_raccordements_alert").hide();
                    draccord_isnew = false;
                }
            });
        });
    } );
</script>