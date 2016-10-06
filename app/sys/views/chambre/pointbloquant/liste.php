<!-- Table pblq -->
<div class="block">
    <div class="block-content table-responsive">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="pblq_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>date controle</th>
                <th>utilisateur</th>
                <th>ref entreprise</th>
                <th>responsable</th>
                <th>ref chantier</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>date controle</th>
                <th>utilisateur</th>
                <th>ref entreprise</th>
                <th>responsable</th>
                <th>ref chantier</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table pblq -->
<script>
    var pblq_dt;
    var pblq_btns = ["#open_ch"];
    $(document).ready(function() {
        pblq_dt = $('#pblq_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/chambre/pointbloquant/pblq_liste.php?idch='+get('idchambre')
            },
            "columns": [
                /*{ "data": "id_point_bloquant" },
                { "data": "id_chambre" },*/
                { "data": "date_controle" },
                { "data": "utilisateur" },
                { "data": "entreprise" },
                { "data": "responsable" },
                /*{ "data": "adresse" },*/
                { "data": "ref_chantier" },
                /*{ "data": "nature_travaux" },
                { "data": "environement" },
                { "data": "synthese" }*/
            ],
            "columnDefs": [
                /*{ "targets": [ 0,1,2,3 ], "visible": false, "searchable": false }*/
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {

            }
        } );

        $(pblq_btns.join(',')).addClass("disabled");

        $('#pblq_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(pblq_btns.join(',')).addClass("disabled");
            }
            else {
                pblq_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(pblq_btns.join(',')).removeClass("disabled");
            }

        } );
    } );
</script>