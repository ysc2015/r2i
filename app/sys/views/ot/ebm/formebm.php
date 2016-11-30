<div class="row">
    <div class="col-md-12">
        <button id="download_ebm" class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-download'>&nbsp;</span> Télécharger EBM</button>
    </div>
</div>
<script>
    $(function () {
        // Init page plugins & helpers
    });
    $(document).ready(function() {

        $("#download_ebm").click(function() {
            console.log('download_ebm');
            /*if(ot_dt.row('.selected').data()!== undefined) {
                location.href="api/file/parserfile2.php?id="+id_devis+"&idsp="+ot_dt.row('.selected').data().id_sous_projet+"&idtot="+ot_dt.row('.selected').data().id_type_ordre_travail;
            }*/
        });

    } );
</script>