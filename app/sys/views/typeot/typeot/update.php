
<button id="update_type_ot_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#update-type-ot' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier type ot</button>
<script>
    var update;
    $(document).ready(function() {
        $("#update_type_ot_show").click(function() {
            update = false;
            $('#update_type_ot').val(ot_dt.row('.selected').data().id_type_ordre_travail);
            $('#update_commentaire').val(ot_dt.row('.selected').data().commentaire);
        });
    } );
</script>
<?php

include_once __DIR__."/modals/update.php";

?>