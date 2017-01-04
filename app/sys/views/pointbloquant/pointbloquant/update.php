
<button id="update_pblq_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#update-pblq' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier</button>
<script>
    var update_pblq;
    $(document).ready(function() {
        $("#update_pblq_show").click(function() {

            update_pblq = false;

            for (var key in upblq1_formdata) {

                console.log('key => ' + key + ' value => ' + pblq_dt.row('.selected').data()[key]);
                $('#'+key).val(pblq_dt.row('.selected').data()[key]);

                $('#pblq1_id_utilisateur').val(pblq_dt.row('.selected').data().pblq1_utilisateur);
                $('#pblq1_id_entreprise').val(pblq_dt.row('.selected').data().pblq1_entreprise);
                $('#pblq1_id_equipe_stt').val(pblq_dt.row('.selected').data().pblq1_responsable);
                $('#pblq1_nature_travaux').val(pblq_dt.row('.selected').data().pblq1_nature_travaux);
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