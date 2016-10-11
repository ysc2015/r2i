<button id="update_equipe_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#update-equipe' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier equipe</button>
<script>
    var update = false;
    $(document).ready(function() {
        $("#update_equipe_show").click(function() {

            update = false;

            $("#equipe_update_imei").val(equipe_dt.row('.selected').data().imei);
            $("#equipe_update_nom").val(equipe_dt.row('.selected').data().nom);
            $("#equipe_update_prenom").val(equipe_dt.row('.selected').data().prenom);
            $("#equipe_update_tel").val(equipe_dt.row('.selected').data().tel);
            $("#equipe_update_mail").val(equipe_dt.row('.selected').data().mail);
        });
    } );
</script>
<?php

include_once __DIR__."/modals/update.php";

?>