<script>
    var susers_dt;
    var susers_btns = ["#update_stt_show",
        "#delete_stt"];
    $(document).ready(function() {
        susers_dt = $('#stt_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "api/utilisateur/stt/stt_users_liste.php",
            "columns": [
                { "data": "nom_utilisateur" },
                { "data": "prenom_utilisateur" },
                { "data": "email_utilisateur" },
                { "data": "lib_profil_utilisateur" },
                { "data": "nom" }
            ],
            "order": [[1, 'asc']]
        } );

        $(susers_btns.join(',')).addClass("disabled");

        $('#stt_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(susers_btns.join(',')).addClass("disabled");
            }
            else {
                susers_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(susers_btns.join(',')).removeClass("disabled");
            }

        } );
    } );
</script>
<!-- Table stt users -->
<div class="block">
    <div class="block-content">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="stt_table" class="table table-bordered table-striped js-dataTable-full">
            <thead>
            <tr>
                <th>nom</th>
                <th>prénom</th>
                <th>email</th>
                <th>profil</th>
                <th>entreprise</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>nom</th>
                <th>prénom</th>
                <th>email</th>
                <th>profil</th>
                <th>entreprise</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table stt users -->