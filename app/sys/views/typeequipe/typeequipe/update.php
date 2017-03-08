
<button id="update_type_eq_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#mod-type-eq' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier type équipe</button>
<script>
    var update;
    $(document).ready(function() {
        $("#update_type_eq_show").click(function() {
            update = false;
            $('#update_lib_type_eq').val(type_eq_dt.row('.selected').data().lib_type);
            $('#update_visible_a2t').val(type_eq_dt.row('.selected').data().a2t);
        });
    } );
</script>
<?php

include_once __DIR__."/modals/update.php";

?>