<?php
extract($_GET);
$sous_projet = SousProjet::find($idsousprojet);
build_user_form("infozone_nom",$sous_projet);
?>

<script>
    $(document).ready(function() {
        $("#message_infozone_nom").hide();
        $("#id_sous_projet_btn").click(function() {
            console.log('dsdsq');
            $("#message_infozone_nom").fadeOut();
            $.ajax({
                method: "POST",
                url: "api/sousprojet/sous_projet_update.php",
                data: {
                    ids : <?= $_GET['idsousprojet'] ?>,
                    zone : $("#zone").val()
                }
            }).done(function (msg) {
                App.showMessage(msg, '#message_infozone_nom');
            });
        });
    } );
</script>
