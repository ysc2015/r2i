<!-- sous projet liste Modal -->
<div class="modal fade" id="liste-subproject" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Détails</h3>
                </div>
                <div class="block-content">
                    <table id="sous_projet_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
                        <thead>
                        <tr>
                            <th>id_sous_projet</th>
                            <th>id_projet</th>
                            <th>projet</th>
                            <th>libnro</th>
                            <th>zone</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>id_sous_projet</th>
                            <th>id_projet</th>
                            <th>projet</th>
                            <th>libnro</th>
                            <th>zone</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!-- END sous projet liste Modal -->
<script>
    var sousprojet_dt;
    var sousprojet_dt_btns = ["#open-sub-project",
        "#delete_sub_project"];
    $(document).ready(function() {

        $(sousprojet_dt_btns.join(',')).addClass("disabled");
        sousprojet_dt = $('#sous_projet_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitevpi/sousprojet_liste.php?ide='
            },
            "columns": [
                { "data": "id_sous_projet" },
                { "data": "id_projet" },
                { "data": "projet_nom" },
                { "data": "lib_nro" },
                { "data": "zone" }
            ],
            "columnDefs": [
                { "targets": [ 0,1 ], "visible": false, "searchable": false },
                { "targets": [ 3,4 ], "visible": false, "searchable": true },
                {
                    "targets": 2,
                    "render": function ( data, type, full, meta ) {
                        return  '<a href="?page=sousprojet&idsousprojet='+full.id_sous_projet+'">'+'Plaque PON FTTH ' + full.lib_nro + ' Poche ' + full.zone+'</a>';
                    }
                }
            ],
            "order": [[1, 'desc']]
            ,
            "drawCallback": function( settings ) {
            }
        } );
    } );
</script>