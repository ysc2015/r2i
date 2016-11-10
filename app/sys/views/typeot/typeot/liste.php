<!-- Table type ot -->
<div class="block">
    <div class="block-content table-responsive">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="type_ot_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>idtot</th>
                <th>lib</th>
                <th>tentree</th>
                <th>system</th>
                <th>Etape</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>idtot</th>
                <th>lib</th>
                <th>tentree</th>
                <th>system</th>
                <th>Etape</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table type ot -->
<script>
    var type_ot_dt;
    var id_devis = 0;
    var id_res = 0;
    var type_ot_btns = ["#update_ot_show",
        "#link_ot_show",
        "#delete_ot","#open_pblq",
        "#linked-ch",
        "#link_ot","#linked-pb","#link_pb"];
    $(document).ready(function() {
        type_ot_dt = $('#type_ot_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/typeot/typeot/typeot_liste.php'
            },
            "columns": [
                { "data": "id_type_ordre_travail" },
                { "data": "lib_type_ordre_travail" },
                { "data": "type_entree" },
                { "data": "system" }
            ],
            "columnDefs": [
                { "targets": [ 0,2,3 ], "visible": false, "searchable": false },
                {
                    "targets": 4,
                    "data": "type_entree",
                    "render": function ( data, type, full, meta ) {
                        return getObjectNameForEntry(data);
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
                $(type_ot_btns.join(',')).addClass("disabled");
            }
        } );

        $(type_ot_btns.join(',')).addClass("disabled");

        $('#type_ot_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(type_ot_btns.join(',')).addClass("disabled");
            }
            else {
                type_ot_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(type_ot_btns.join(',')).removeClass("disabled");
            }

        } );

    } );
</script>