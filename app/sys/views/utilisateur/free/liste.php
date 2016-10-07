<!-- Table fusers -->
<div class="block">
    <div class="block-content">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="user_table" class="table table-bordered table-striped js-dataTable-full">
            <thead>
            <tr>
                <th>id</th>
                <th>nom</th>
                <th>prénom</th>
                <th>email</th>
                <th>profil</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>id</th>
                <th>nom</th>
                <th>prénom</th>
                <th>email</th>
                <th>profil</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table fusers -->
<script>
    var users_dt;
    var users_btns = ["#update_user_show",
        "#delete_user","#link_nro"];
    $(document).ready(function() {
        users_dt = $('#user_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "api/utilisateur/free/free_users_liste.php",
            "columns": [
                { "data": "id_utilisateur" },
                { "data": "nom_utilisateur" },
                { "data": "prenom_utilisateur" },
                { "data": "email_utilisateur" },
                { "data": "lib_profil_utilisateur" }
            ],
            "order": [[0, 'desc']],
            "columnDefs": [
                { "targets": [ 0 ], "visible": false, "searchable": false } ],
            "drawCallback": function( /*settings*/ ) {
                $('#linked-nro').html('<option value="">&nbsp;</option>');
            }
        } );

        $(users_btns.join(',')).addClass("disabled");
        $('#link_nro_wrp').hide();

        $('#user_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(users_btns.join(',')).addClass("disabled");

                $('#linked-nro').html('<option value="">&nbsp;</option>');
            }
            else {
                users_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(users_btns.join(',')).removeClass("disabled");

                if(users_dt.row('.selected').data().id_profil_utilisateur == 7) {
                    $('#link_nro_wrp').show();
                    $.ajax({
                     method: "POST",
                     url: "api/utilisateur/free/get_user_nro_list.php",
                     dataType: "json",
                     data: {
                     idu : users_dt.row('.selected').data().id_utilisateur
                     }
                     })
                     .done(function (data) {
                         var values = [];
                         $('#linked-nro').html('<option value="">&nbsp;</option>');
                         for(var i = 0 ; i < data.length ; i++) {
                             if(users_dt.row('.selected').data().id_utilisateur == data[i]['idu']) {
                                values.push(data[i]['id']);
                             }
                             html = '<option value="'+data[i]['id']+'">'+data[i]['nro']+'</option>';
                             $('#linked-nro').append(html);
                         }
                         $('#linked-nro').val(values);
                     });
                } else {
                    $('#link_nro_wrp').hide();
                }
            }

        } );
    } );
</script>