<button id="add_stt_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-stt' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter Utilisateur STT</button>
<script>
    $(document).ready(function() {
        $("#add_stt_show").click(function() {
            $("#add_stt_form")[0].reset();
        });
    } );
</script>
<?php

include_once __DIR__."/modals/add.php";

?>