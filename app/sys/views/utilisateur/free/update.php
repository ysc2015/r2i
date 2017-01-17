
<button id="update_user_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#update-user' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier</button>
<script>
    $(document).ready(function() {
        $("#update_user_show").click(function() {
            $("#user_update_nom").val(users_dt.row('.selected').data().nom_utilisateur);
            $("#user_update_prenom").val(users_dt.row('.selected').data().prenom_utilisateur);
            $("#user_update_email").val(users_dt.row('.selected').data().email_utilisateur);
            $("#user_update_tel").val(users_dt.row('.selected').data().telephone_utilisateur);
            $("#user_update_pwd").val(users_dt.row('.selected').data().pass_utilisateur);
            $("#user_update_profil").val(users_dt.row('.selected').data().id_profil_utilisateur);
        });
    } );
</script>
<?php

include_once __DIR__."/modals/update.php";

?>