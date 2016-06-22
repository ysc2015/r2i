<?php
extract($_GET);
$site_origine = SousProjetSiteOrigine::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("infozone_site_origine",$site_origine);
?>
<script>
    $(document).ready(function() {
        var siteorigine_isnew = ($("#id_sous_projet_site_origine").val()?false:true);

        $("#message_infozone_site_origine").hide();
        $("#id_sous_projet_site_origine_btn").click(function () {

            $("#message_infozone_site_origine").fadeOut();
            $("#infozone_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (siteorigine_isnew?"api/sousprojet/site_origine_add.php":"api/sousprojet/site_origine_update.php"),
                data: {
                    ids: <?= $_GET['idsousprojet'] ?>,
                    code_site: $('#code_site').val(),
                    type_so: $('#type_so').val(),
                    auto_adduction: $('#auto_adduction').val(),
                    travaux_adduction: $('#travaux_adduction').val(),
                    recette_adduction: $('#recette_adduction').val()

                }
            }).done(function (msg) {
                $("#infozone_block").removeClass('block-opt-refresh');
                if(App.showMessage(msg, '#message_infozone_site_origine')) {
                    $("#id_sous_projet_site_origine_alert").hide();
                    siteorigine_isnew = false;
                }
            });
        });
    } );
</script>