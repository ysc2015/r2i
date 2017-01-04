
<button id="add_pblq_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-pblq' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter point bloquant</button>
<script>
    $(document).ready(function() {

        $("#add_pblq_show").click(function() {
            $("#info_pblq_form1")[0].reset();
            $("#info_pblq_form2")[0].reset();
            $("#info_pblq_form3")[0].reset();
            $("#info_pblq_form4")[0].reset();

            $('#apblq1_id_entreprise').val(ot_dt.row('.selected').data().id_entreprise);
            $('#apblq1_id_equipe_stt').val(ot_dt.row('.selected').data().id_equipe_stt);
            $('#apblq1_nature_travaux').val(ot_dt.row('.selected').data().type_ot);

            App.activaTab('validation-step1');
        });

    } );
</script>
<?php

include_once __DIR__."/modals/add_pblq.php";

?>