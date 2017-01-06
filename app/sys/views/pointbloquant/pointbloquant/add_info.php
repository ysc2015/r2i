
<button id="add_info_show" class='btn btn-info btn-sm' data-toggle="modal" data-target='#add-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter info (suivi)</button>
<script>
    $(document).ready(function() {
        $("#add_info_show").click(function() {
            $("#add_info_form")[0].reset();
            $("#zone").val(pblq_dt.row('.selected').data().zone);
        });
    } );
</script>
<?php

include_once __DIR__."/modals/add_info.php";

?>