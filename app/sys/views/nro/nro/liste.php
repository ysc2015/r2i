<script>
    var nro_dt;
    var nro_btns = ["#delete_nro"];
    $(document).ready(function() {
        nro_dt = $('#nro_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "api/nro/nro/nro_liste.php",
            "columns": [
                { "data": "id_nro" },
                { "data": "id_utilisateur" },
                { "data": "lib_nro" },
                { "data": "prenom_utilisateur" },
                { "data": "nom_utilisateur" },
                { "data": "email_utilisateur" },
                { "data": "lib_profil_utilisateur" }
            ],
            "order": [[0, 'desc']],
            "columnDefs": [
                { "targets": [ 0,1 ], "visible": false, "searchable": false } ]
        } );

        $(nro_btns.join(',')).addClass("disabled");

        $('#nro_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(nro_btns.join(',')).addClass("disabled");
            }
            else {
                nro_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(nro_btns.join(',')).removeClass("disabled");
            }

        } );
    } );
</script>
<!-- Table nro creation -->
<div class="block">
    <div class="block-content">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="nro_table" class="table table-bordered table-striped js-dataTable-full">
            <thead>
            <tr>
                <th>id</th>
                <th>idu</th>
                <th>nro</th>
                <th>prenom</th>
                <th>nom</th>
                <th>email</th>
                <th>profil</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>id</th>
                <th>idu</th>
                <th>nro</th>
                <th>prenom</th>
                <th>nom</th>
                <th>email</th>
                <th>profil</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table nro creation -->