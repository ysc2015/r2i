
<button id="add_pblq_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-pblq' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter point bloquant</button>
<script>
    $(document).ready(function() {

        $("#add_pblq_show").click(function() {
            $("#info_pblq_form1")[0].reset();
            $("#info_pblq_form2")[0].reset();
            $("#info_pblq_form3")[0].reset();
            $("#info_pblq_form4")[0].reset();
            App.activaTab('validation-step1');
        });

    } );
</script>
<?php

include_once __DIR__."/modals/add_pblq.php";

?>