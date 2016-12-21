<button id="add_mail_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-mail' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter Utilisateur</button>
<script>
    $(function () {
        // Init page plugins & helpers
        jQuery('#user').select2({
            autocomplete: true
        });
    });
    $(document).ready(function() {
        $("#add_mail_show").click(function() {
            $.ajax({
                method: "POST",
                url: "api/mail/projetcreation/get_users_liste.php",
                dataType: "json",
                data: {type_notif : $('#type_notif').val()}
            }).done(function (data) {
                $('#user').html('');
                for(var i = 0 ; i < data.length ; i++) {
                    html = '<option value="'+data[i]['id']+'">'+data[i]['prenom']+' '+data[i]['nom']+'</option>';
                    $('#user').append(html);
                }
                $("#user").select2('val', 'All');
            });
        });
    } );
</script>
<?php

include_once __DIR__."/modals/add.php";

?>