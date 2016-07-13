<?php
extract($_GET);
$plaque = SousProjetInfoPlaque::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("infozone_plaque",$plaque);
?>

<!--<script>
    $(document).ready(function() {
            var infoplaque_isnew = ($("#id_sous_projet_plaque").val()?false:true);

            $("#message_infozone_plaque").hide();
            $("#id_sous_projet_plaque_btn").click(function () {

            $("#message_infozone_plaque").fadeOut();
            $("#infozone_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (infoplaque_isnew?"api/sousprojet/infoplaque_add.php":"api/sousprojet/infoplaque_update.php"),
                data: {
                    ids: <?/*= $_GET['idsousprojet'] */?>,
                    phase: $('#phase').val(),
                    type: $('#type').val()

                }
            }).done(function (msg) {
                $("#infozone_block").removeClass('block-opt-refresh');
                if(App.showMessage(msg, '#message_infozone_plaque')) {
                    $("#id_sous_projet_plaque_alert").hide();
                    infoplaque_isnew = false;
                }
            });
        });
    } );
</script>-->