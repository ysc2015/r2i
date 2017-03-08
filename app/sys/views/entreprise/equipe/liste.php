<!-- Table equipe -->
<div class="block">
    <div class="block-content table-responsive">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="equipe_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>id</th>
                <th>id</th>
                <th>imei</th>
                <th>nom</th>
                <th>prénom</th>
                <th>tel</th>
                <th>mail</th>
                <th>type équipe</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>id</th>
                <th>id</th>
                <th>imei</th>
                <th>nom</th>
                <th>prénom</th>
                <th>tel</th>
                <th>mail</th>
                <th>type équipe</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table equipe -->
<script>
    var equipe_dt;
    var equipe_dt_btns = ["#update_equipe_show",
        "#delete_equipe"];
    $(document).ready(function() {

        $(equipe_dt_btns.join(',')).addClass("disabled");
        equipe_dt = $('#equipe_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/entreprise/equipe/equipe_liste.php?ide='+(entreprise_dt.row('.selected').data()!=undefined?entreprise_dt.row('.selected').data().id_entreprise:0)
            },
            "columns": [
                { "data": "id_equipe_stt" },
                { "data": "id_entreprise" },
                { "data": "imei" },
                { "data": "nom" },
                { "data": "prenom" },
                { "data": "tel" },
                { "data": "mail" },
                { "data": "lib_type" }
            ],
            "columnDefs": [
                { "targets": [ 0,1 ], "visible": false, "searchable": false }
            ],
            "order": [[1, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $(equipe_dt_btns.join(',')).addClass("disabled");
                if(typeof entreprise_dt !== 'undefined') {
                    if(entreprise_dt.row('.selected').data()!=undefined) {
                        $("#equipe_block_title").html('Equipes ('+entreprise_dt.row('.selected').data().nom+')');
                    } else {
                        $("#equipe_block_title").html('Equipes');
                    }
                } else {
                    $("#equipe_block_title").html('Equipes');
                }
            }
        } );

        $('#equipe_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(equipe_dt_btns.join(',')).addClass("disabled");
            }
            else {
                equipe_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(equipe_dt_btns.join(',')).removeClass("disabled");
            }

        } );
    } );
</script>