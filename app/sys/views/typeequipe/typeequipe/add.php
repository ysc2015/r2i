<button id="add_type_eq_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-type-eq' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter type équipe</button>
<script>
    $(document).ready(function() {

        $("#add_type_eq_show").click(function() {
            $("#add_type_eq_form")[0].reset();
        });

    } );
</script>
<?php

include_once __DIR__."/modals/add.php";

?>