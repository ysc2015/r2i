<!-- Table chambre -->
<div class="block">
    <div class="block-content table-responsive">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="ot_chambre_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>id</th>
                <th>id_res</th>
                <th>ids</th>
                <th>tentree</th>
                <th>ref chambre</th>
                <th>villet</th>
                <th>sous projet</th>
                <th>ref note</th>
                <th>code ch1</th>
                <th>code ch2</th>
                <th>gps</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>id</th>
                <th>id_res</th>
                <th>ids</th>
                <th>tentree</th>
                <th>ref chambre</th>
                <th>villet</th>
                <th>sous projet</th>
                <th>ref note</th>
                <th>code ch1</th>
                <th>code ch2</th>
                <th>gps</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table chambre -->
<script>
    var chambre_ot_dt;
    var ch_btns = ["#open_ch","#update_ch","#add_pblq_show","#open_list_pblq"];
    $(document).ready(function() {
        chambre_ot_dt = $('#ot_chambre_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/ot/chambreot/chambre_liste.php?idot='+(ot_dt.row('.selected').data()!=undefined?ot_dt.row('.selected').data().id_ordre_de_travail:-1)
            },
            "columns": [
                { "data": "id_chambre" },
                { "data": "id_ressource" },
                { "data": "id_sous_projet" },
                { "data": "type_entree" },
                { "data": "ref_chambre" },
                { "data": "villet" },
                { "data": "sous_projet" },
                { "data": "ref_note" },
                { "data": "code_ch1" },
                { "data": "code_ch2" },
                { "data": "gps" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2,3 ], "visible": false, "searchable": false }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {

            }
        } );

        $(ch_btns.join(',')).addClass("disabled");

        $('#ot_chambre_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(ch_btns.join(',')).addClass("disabled");
            }
            else {
                chambre_ot_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(ch_btns.join(',')).removeClass("disabled");
            }

        } );
    } );
</script>