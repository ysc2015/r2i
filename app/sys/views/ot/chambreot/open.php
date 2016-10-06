<button id="open_ch" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-open'>&nbsp;</span> Ouvrir chambre</button>
<script>
    $(document).ready(function() {
        $("#open_ch").click(function() {
            document.location.href = '?page=chambre&idsousprojet='+get('idsousprojet')+'&idchambre='+chambre_ot_dt.row('.selected').data().id_chambre;
        });
    } );
</script>