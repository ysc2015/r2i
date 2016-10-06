<button id="add_ot_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-ot' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter ot</button>
<script>
    $(document).ready(function() {

        $("#add_ot_show").click(function() {
            $("#add_ot_form")[0].reset();
        });

    } );
</script>
<?php

include_once __DIR__."/modals/add.php";

?>