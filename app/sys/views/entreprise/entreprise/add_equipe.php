
<button id="add_equipe_show" class='btn btn-info btn-sm' data-toggle="modal" data-target='#add-equipe' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter equipe</button>
<script>
    $(document).ready(function() {
        $("#add_equipe_show").click(function() {
        });
    } );
</script>
<?php

include_once __DIR__."/modals/add_equipe.php";

?>