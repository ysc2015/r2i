<button id="add_entreprise_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-entreprise' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter entreprise</button>
<script>
    $(document).ready(function() {
        $("#add_entreprise_show").click(function() {
            $("#entreprise_form")[0].reset();
        });
    } );
</script>
<?php

include_once __DIR__."/modals/add.php";

?>