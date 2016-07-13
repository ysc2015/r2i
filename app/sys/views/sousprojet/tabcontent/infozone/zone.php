<?php
extract($_GET);
$zone = SousProjetZone::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("infozone_zone",$zone);
?>
<!--<script>
    $(document).ready(function() {
        var zone_isnew = ($("#id_sous_projet_zone").val()?false:true);

        $("#message_infozone_zone").hide();
        $("#id_sous_projet_zone_btn").click(function () {

            $("#message_infozone_zone").fadeOut();
            $("#infozone_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (zone_isnew?"api/sousprojet/zone_add.php":"api/sousprojet/zone_update.php"),
                data: {
                    ids: <?/*= $_GET['idsousprojet'] */?>,
                    nbr_zone: $('#nbr_zone').val(),
                    lr_sur_pm: $('#lr_sur_pm').val(),
                    lr: $('#lr').val(),
                    nbr_de_site: $('#nbr_de_site').val(),
                    nb_fo_sur_pm: $('#nb_fo_sur_pm').val(),
                    nb_fo_sur_pmz: $('#nb_fo_sur_pmz').val()

                }
            }).done(function (msg) {
                $("#infozone_block").removeClass('block-opt-refresh');
                if(App.showMessage(msg, '#message_infozone_zone')) {
                    $("#id_sous_projet_zone_alert").hide();
                    zone_isnew = false;
                }
            });
        });
    } );
</script>-->