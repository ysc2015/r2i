

<button id="open_ch" class='btn btn-info btn-sm'><span class='glyphicon glyphicon-list'>&nbsp;</span> Points bloquants</button>
<script>
    $(document).ready(function() {
        $("#open_ch").click(function() {
            document.location.href = '?page=pointbloquant&idchambre='+chambre_ot_dt.row('.selected').data().id_chambre;
        });
    } );
</script>