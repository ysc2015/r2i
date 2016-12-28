<!-- Table pblq -->
<div class="block">
    <div class="block-content table-responsive">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="pblq_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>id</th>
                <th>id</th>
                <th>réalisé par</th>
                <th>ref entreprise</th>
                <th>responsable</th>
                <th>ref chantier</th>
                <th>date controle</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>id</th>
                <th>id</th>
                <th>réalisé par</th>
                <th>ref entreprise</th>
                <th>responsable</th>
                <th>ref chantier</th>
                <th>date controle</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table pblq -->
<script>
    var pblq_dt;
    var pblq_btns = ["#update_pblq_show","#delete_pblq"];
    /*var qStringUrl;
    if(get('idchambre')!== undefined) {
        qStringUrl = 'idchambre='+get('idchambre');
    } else {
        if(get('idot')!== undefined) {
            qStringUrl = 'idot='+get('idot');
        }
    }*/
    $(document).ready(function() {
        pblq_dt = $('#pblq_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/pointbloquant/pointbloquant/pblq_liste2.php'
            },
            "columns": [
                { "data": "id_point_bloquant" },
                { "data": "pblq1_id_chambre" },
                { "data": "pblq1_utilisateur" },
                { "data": "pblq1_entreprise" },
                { "data": "pblq1_responsable" },
                { "data": "pblq1_ref_chantier" },
                { "data": "pblq1_date_controle" }
            ],
            "columnDefs": [
                { "targets": [ 0,1 ], "visible": false, "searchable": false }
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