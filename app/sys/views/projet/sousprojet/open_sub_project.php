<div class="dropdown" style="display: inline-block;">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="open-sub-project" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        sous projet
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="open-sub-project">
        <li><a class="list-group-item" href="javascript:void(0)" id="open-sub-project-normal">ouvrir sous projet</a></li>
        <!--<li role="separator" class="divider"></li>-->
        <li><a class="list-group-item disabled" href="javascript:void(0)" disabled>Nro</a></li>
        <li><a class="list-group-item disabled" href="javascript:void(0)">Transport Raccordement</a></li>
        <li><a class="list-group-item disabled" href="javascript:void(0)">Distribution Raccordement</a></li>
    </ul>
</div>
<script>
    $(document).ready(function() {
        $("#open-sub-project-normal").click(function() {
            if(sousprojet_dt.row('.selected').data() !== undefined) {
                document.location.href = '?page=sousprojet&idsousprojet='+sousprojet_dt.row('.selected').data().id_sous_projet;
            }
        });
    } );
</script>