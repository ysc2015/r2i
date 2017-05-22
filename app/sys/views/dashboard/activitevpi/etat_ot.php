<div class="block block-themed" id="etatot_block">
    <div class="block-header bg-primary-light">
        <ul class="block-options">
            <li>
                <button id="activitevpi_etatot_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
        </ul>
        <h3 class="block-title">Etat des OT</h3>
    </div>
    <div class="block-content">
        <!-- Page Content -->
        <div class="content">
            <!-- Table ot -->
            <div class="block">
                <div class="block-content table-responsive">
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                    <table id="ot_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
                        <thead>
                        <tr>
                            <th>idot</th>
                            <th>idsp</th>
                            <th>tentree</th>
                            <th>type</th>
                            <th>commentaire</th>
                            <th>état</th>
                            <th>BKLOG</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>idot</th>
                            <th>idsp</th>
                            <th>tentree</th>
                            <th>type</th>
                            <th>commentaire</th>
                            <th>état</th>
                            <th>BKLOG</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- END Table ot -->
        </div>
        <!-- END Page Content -->
    </div>
</div>
<script>
    var etat_ot_dt;
    $(function () {
        // Init page plugins & helpers
    });

    $(document).ready(function() {

        etat_ot_dt = $('#ot_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/ot/ot/ot_liste_w_state.php'
            },
            "columns": [
                { "data": "id_ordre_de_travail" },
                { "data": "id_sous_projet" },
                { "data": "type_entree" },
                { "data": "type_ot" },
                { "data": "commentaire" },
                { "data": "lib_etat_ot" },
                { "data": "id_type_ordre_travail" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2,4,6 ], "visible": false, "searchable": false }
            ],
            "order": [[6, 'asc']]
            ,
            "drawCallback": function( /*settings*/ ) {
            }
        } );

    } );
</script>