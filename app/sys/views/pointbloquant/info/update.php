
<button id="update_pblq_info_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#update-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier</button>
<script>
    var update_pblq_info;
    $(document).ready(function() {
        $("#update_pblq_info_show").click(function() {

            update_pblq_info = false;

            console.log(uinfo_pblq_formdata);

            for (var key in uinfo_pblq_formdata) {
                //console.log(key.replace('uinfo_',''));
                $('#'+key).val(pblq_info_dt.row('.selected').data()[key.replace('uinfo_','')]);
            }
        });
    } );
</script>
<?php

include_once __DIR__."/modals/update.php";

?>