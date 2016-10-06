<button id="add_nro_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-nro' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter Nro</button>
<script>
    $(function () {
        // Init page plugins & helpers
        jQuery('#user').select2({
            autocomplete: true
        });
    });
    $(document).ready(function() {
        $("#add_nro_show").click(function() {
            $("#user").select2('val', 'All');
            $("#add_nro_form")[0].reset();
        });
    } );
</script>
<?php

include_once __DIR__."/modals/add.php";

?>