<script>
    var mails_dt;
    var mails_btns = ["#update_mail_show",
        "#delete_mail_show","#delete_user_from"];
    $(document).ready(function() {
        mails_dt = $('#mail_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "api/mail/projetcreation/projet_creation_liste.php",
            "columns": [
                { "data": "id_projet_mail_creation" },
                { "data": "id_utilisateur" },
                { "data": "prenom_utilisateur" },
                { "data": "nom_utilisateur" },
                { "data": "email_utilisateur" },
                { "data": "lib_profil_utilisateur" }
            ],
            "order": [[0, 'desc']],
            "columnDefs": [
                { "targets": [ 0,1 ], "visible": false, "searchable": false } ]
        } );

        $(mails_btns.join(',')).addClass("disabled");

        $('#mail_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(mails_btns.join(',')).addClass("disabled");
            }
            else {
                mails_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(mails_btns.join(',')).removeClass("disabled");
            }

        } );
    } );
</script>
<!-- Table mail creation -->
<div class="block">
    <div class="block-content">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="mail_table" class="table table-bordered table-striped js-dataTable-full">
            <thead>
            <tr>
                <th>id</th>
                <th>idu</th>
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
                <th>prenom</th>
                <th>nom</th>
                <th>email</th>
                <th>profil</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table mail creation -->