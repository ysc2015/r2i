<!-- Table info pblq -->
<div class="block">
    <div class="block-content table-responsive">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="pblq_info_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>id</th>
                <th>id</th>
                <th>ville</th>
                <th>Inter. PCI</th>
                <th>Inter. BEI</th>
                <th>date création</th>
                <th>date rendu</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>id</th>
                <th>id</th>
                <th>ville</th>
                <th>Inter. PCI</th>
                <th>Inter. BEI</th>
                <th>date création</th>
                <th>date rendu</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table info pblq -->
<script>
    var pblq_info_dt;
    var pblq_info_btns = ["#update_pblq_info_show","#delete_pblq_info"];
    $(document).ready(function() {
        pblq_info_dt = $('#pblq_info_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/pointbloquant/pointbloquant/info_pblq_liste.php'
            },
            "columns": [
                { "data": "id_traitement_pbt" },
                { "data": "id_point_bloquant" },
                { "data": "ville" },
                { "data": "prenom_utilisateur" },
                { "data": "prenom_utilisateur2" },
                { "data": "date_creation" },
                { "data": "date_rendu" }
            ],
            "columnDefs": [
                { "targets": [ 0,1 ], "visible": false, "searchable": false },
                {
                    "targets": 3,
                    "render": function ( data, type, full, meta ) {
                        return  (full.prenom_utilisateur !== null ? full.prenom_utilisateur + ' ' + full.nom_utilisateur : 'n/d');
                    }
                },
                {
                    "targets": 4,
                    "render": function ( data, type, full, meta ) {
                        return  (full.prenom_utilisateur2 !== null ? full.prenom_utilisateur2 + ' ' + full.nom_utilisateur2 : 'n/d');
                    }
                },
                {
                    "targets": 6,
                    "render": function ( data, type, full, meta ) {
                        return  (full.date_rendu !== '0000-00-00' ? full.date_rendu : 'n/d');
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
                $(pblq_info_btns.join(',')).addClass("disabled");
            }
        } );

        $(pblq_info_btns.join(',')).addClass("disabled");

        $('#pblq_info_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(pblq_info_btns.join(',')).addClass("disabled");
            }
            else {
                pblq_info_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(pblq_info_btns.join(',')).removeClass("disabled");
            }

        } );
    } );
</script>