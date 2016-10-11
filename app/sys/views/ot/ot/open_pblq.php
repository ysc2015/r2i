


<button id="open_pblq" class='btn btn-info btn-sm'><span class='glyphicon glyphicon-list'>&nbsp;</span> Points bloquants</button>
<script>
    $(document).ready(function() {
        $("#open_pblq").click(function() {
            document.location.href = '?page=pointbloquant&idot='+ot_dt.row('.selected').data().id_ordre_de_travail;
        });
    } );
</script>