<?php
extract($_GET);
$carto = SousProjetPlaqueCarto::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("gestion_plaque_carto",$carto);
?>
<!--<script>
    $(document).ready(function() {
        var pcarto_isnew = ($("#id_sous_projet_plaque_carto").val()?false:true);

        $("#message_gestion_plaque_carto").hide();
        $("#id_sous_projet_plaque_carto_btn").click(function () {

            $("#message_gestion_plaque_carto").fadeOut();
            $("#preparationplaque_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (pcarto_isnew?"api/sousprojet/pcarto_add.php":"api/sousprojet/pcarto_update.php"),
                data: {
                    ids: <?/*= $_GET['idsousprojet'] */?>,
                    pc_intervenant_be: $('#pc_intervenant_be').val(),
                    pc_date_debut: $('#pc_date_debut').val(),
                    pc_date_ret_prevue: $('#pc_date_ret_prevue').val(),
                    pc_duree: $('#pc_duree').val()

                }
            }).done(function (msg) {
                $("#preparationplaque_block").removeClass('block-opt-refresh');
                if(App.showMessage(msg, '#message_gestion_plaque_carto')) {
                    $("#id_sous_projet_plaque_carto_alert").hide();
                    pcarto_isnew = false;
                }
            });
        });
    } );
</script>-->