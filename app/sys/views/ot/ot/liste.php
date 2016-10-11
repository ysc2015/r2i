<!-- Table ot -->
<div class="block">
    <div class="block-content table-responsive">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="ot_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>idot</th>
                <th>idsp</th>
                <th>tentree</th>
                <th>type</th>
                <th>commentaire</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>idot</th>
                <th>idsp</th>
                <th>tentree</th>
                <th>type</th>
                <th>commentaire</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table ot -->
<script>
    var ot_dt;
    var ot_btns = ["#update_ot_show",
        "#link_ot_show",
        "#delete_ot","#open_pblq",
        "#linked-ch",
        "#link_ot"];
    $(document).ready(function() {
        ot_dt = $('#ot_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/ot/ot/ot_liste.php?idsp='+get('idsousprojet')+'&tentree='+get('tentree')
            },
            "columns": [
                { "data": "id_ordre_de_travail" },
                { "data": "id_sous_projet" },
                { "data": "type_entree" },
                { "data": "lib_type_ordre_travail" },
                { "data": "commentaire" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2,4 ], "visible": false, "searchable": false }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
                $(ot_btns.join(',')).addClass("disabled");
                $('#linked-ch').html('<option value="">&nbsp;</option>');
                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot=-1' ).load();
            }
        } );

        $(ot_btns.join(',')).addClass("disabled");

        $('#ot_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(ot_btns.join(',')).addClass("disabled");

                $('#linked-ch').html('<option value="">&nbsp;</option>');
            }
            else {
                ot_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(ot_btns.join(',')).removeClass("disabled");

                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot='+ot_dt.row('.selected').data().id_ordre_de_travail ).load();

                $.ajax({
                    method: "POST",
                    url: "api/ot/ot/get_ch_files_list.php",
                    dataType: "json",
                    data: {
                        objtype: getObjectTypeForEntry(get('tentree')),
                        idot : ot_dt.row('.selected').data().id_ordre_de_travail
                    }
                })
                    .done(function (data) {
                    var values = [];
                    $('#linked-ch').html('<option value="">&nbsp;</option>');
                    for(var i = 0 ; i < data.length ; i++) {
                        if(ot_dt.row('.selected').data().id_ordre_de_travail == data[i]['idot']) {
                            values.push(data[i]['id']);
                        }
                        html = '<option value="'+data[i]['id']+'">'+data[i]['nom']+'</option>';
                        $('#linked-ch').append(html);
                    }
                    $('#linked-ch').val(values);
                });
            }

        } );
    } );
</script>