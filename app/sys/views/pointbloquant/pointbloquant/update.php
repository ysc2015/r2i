
<button id="update_pblq_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#update-pblq' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier</button>
<script>
    var update;
    $(document).ready(function() {
        $("#update_pblq_show").click(function() {

            update = false;

            for (var key in upblq1_formdata) {
                $('#'+key).val(pblq_dt.row('.selected').data()[key]);
            }
            for (var key in upblq2_formdata) {
                $('#'+key).val(pblq_dt.row('.selected').data()[key]);
            }
            for (var key in upblq3_formdata) {
                $('#'+key).val(pblq_dt.row('.selected').data()[key]);
            }
            for (var key in upblq4_formdata) {
                $('#'+key).val(pblq_dt.row('.selected').data()[key]);
            }

            App.activaTab('pblq1_update_tab');
        });
    } );
</script>
<?php

include_once __DIR__."/modals/update.php";

?>