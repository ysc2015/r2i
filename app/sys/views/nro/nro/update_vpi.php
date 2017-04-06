
<button id="update_nro_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#update-nro' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier</button>
<script>
    $(function () {
        // Init page plugins & helpers
        jQuery('#update_user').select2({
            autocomplete: true
        });
    });
    $(document).ready(function() {
        $("#update_nro_show").click(function() {
            $("#update_nro").val(nro_dt.row('.selected').data().lib_nro);
            $("#update_user").val(nro_dt.row('.selected').data().id_utilisateur).trigger("change");
        });
    } );
</script>
<?php

include_once __DIR__."/modals/update_vpi.php";

?>