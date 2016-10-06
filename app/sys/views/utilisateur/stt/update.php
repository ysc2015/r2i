
<button id="update_stt_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#update-stt' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier</button>
<script>
    $(document).ready(function() {
        $("#update_stt_show").click(function() {
            $("#stt_update_nom").val(susers_dt.row('.selected').data().nom_utilisateur);
            $("#stt_update_prenom").val(susers_dt.row('.selected').data().prenom_utilisateur);
            $("#stt_update_email").val(susers_dt.row('.selected').data().email_utilisateur);
            $("#stt_update_pwd").val(susers_dt.row('.selected').data().pass_utilisateur);
            $("#stt_update_company").val(susers_dt.row('.selected').data().id_entreprise);
        });
    } );
</script>
<?php

include_once __DIR__."/modals/update.php";

?>