<button id="add_user_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-user' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter Utilisateur</button>
<script>
    $(document).ready(function() {
        $("#add_user_show").click(function() {
            $("#add_user_form")[0].reset();
        });
    } );
</script>
<?php

include_once __DIR__."/modals/add.php";

?>