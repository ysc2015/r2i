
<button id="update_type_ot_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#mod-type-ot' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier type ot</button>
<script>
    var update;
    $(document).ready(function() {
        $("#update_type_ot_show").click(function() {
            update = false;
            $('#update_lib_type_ot').val(type_ot_dt.row('.selected').data().lib_type_ordre_travail);
            $('#update_type_entree').val(type_ot_dt.row('.selected').data().type_entree);
        });
    } );
</script>
<?php

include_once __DIR__."/modals/update.php";

?>