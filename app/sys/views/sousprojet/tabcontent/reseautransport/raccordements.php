<?php
extract($_GET);
$trac = SousProjetTransportRaccordement::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("transport_raccordements",$trac);
?>
<script>
    $(document).ready(function() {
        var traccord_isnew = ($("#id_sous_projet_transport_raccordements").val()?false:true);

        $("#message_transport_raccordements").hide();
        $("#id_sous_projet_transport_raccordements_btn").click(function () {

            $("#message_transport_raccordements").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (traccord_isnew?"api/sousprojet/traccord_add.php":"api/sousprojet/traccord_update.php"),
                data: {
                    ids: <?= $_GET['idsousprojet'] ?>,
                    tr_intervenant_be: $('#tr_intervenant_be').val(),
                    tr_preparation_pds: $('#tr_preparation_pds').val(),
                    tr_controle_plans: $('#tr_controle_plans').val(),
                    tr_date_transmission_pds: $('#tr_date_transmission_pds').val(),
                    tr_entreprise: $('#tr_entreprise').val(),
                    tr_date_racco: $('#tr_date_racco').val(),
                    tr_duree: $('#tr_duree').val(),
                    tr_controle_demarrage_effectif: $('#tr_controle_demarrage_effectif').val(),
                    tr_date_retour: $('#tr_date_retour').val(),
                    tr_etat_retour: $('#tr_etat_retour').val()

                }
            }).done(function (msg) {console.log(msg);
                $("#rtransport_block").removeClass('block-opt-refresh');
                if(App.showMessage(msg, '#message_transport_raccordements')) {
                    $("#id_sous_projet_transport_raccordements_alert").hide();
                    traccord_isnew = false;
                }
            });
        });
    } );
</script>