
<button id="add_sub_project_show" class='btn btn-info btn-sm' data-toggle="modal" data-target='#add-subproject' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter sous projet</button>
<script>
    $(document).ready(function() {
        $("#add_sub_project_show").click(function() {
            $("#sousprojet_dep").val(projet_dt.row('.selected').data().ville);//dt.row('.selected').data().trigramme_dept[3]
            $("#sousprojet_ville").val(projet_dt.row('.selected').data().ville_nom);
            $("#sousprojet_plaque").val(projet_dt.row('.selected').data().trigramme_dept);
        });
    } );
</script>
<?php

include_once __DIR__."/modals/sousprojet_add.php";

?>