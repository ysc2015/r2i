<!-- Table ot -->
<div class="block">
    <div class="block-header">
        <h3 class="block-title">Liste OT</h3>
    </div>
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
                <th>nom</th>
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
                <th>nom</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table ot -->
<script>
    var ot_dt;
    var id_devis = 0;
    var id_res = 0;
    var rem = '';
    var ot_btns = [];
    function displayDevis() {
        if(ot_dt.row('.selected').data()!== undefined) {
            $.ajax({
                method: "POST",
                url: "api/ot/devis/get_devis_id.php",
                dataType: "json",
                data: {
                    idot : ot_dt.row('.selected').data().id_ordre_de_travail
                }
            }).done(function (msg) {
                if(msg.iddevis > 0) {
                    id_devis = msg.iddevis;
                    id_res = msg.idres;
                    rem = msg.rem;
                    $('#download_devis').removeClass('disabled');
                    $("#devis_uploads").show();
                    $('#comment_stt').val(rem);
                    uploader1.reset();
                    uploader1 = $("#devis_bon_cmd_uploader").uploadFile(uploader1_options);

                    uploader2.reset();
                    uploader2 = $("#devis_autre_uploader").uploadFile(uploader2_options);
                } else {
                    id_devis = 0;
                    id_res = 0;
                    rem = '';
                    $('#download_devis').addClass('disabled');
                    $("#devis_uploads").hide();
                }
            });
        } else {
            id_devis = 0;
            id_res = 0;
            $('#download_devis').addClass('disabled');
            $("#devis_uploads").hide();
        }
    }
    $(document).ready(function() {
        ot_dt = $('#ot_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/myot/ot/myot_liste.php'
            },
            "columns": [
                { "data": "id_ordre_de_travail" },
                { "data": "id_sous_projet" },
                { "data": "type_entree" },
                { "data": "type_ot" },/*lib_type_ordre_travail*/
                { "data": "commentaire" }/*,
                { "data": "ville_nom" }*/
            ],
            "columnDefs": [
                { "targets": [ 0,1,2,4 ], "visible": false, "searchable": false },
                {
                    "targets": 5,
                    "render": function ( data, type, full, meta ) {
                        return full.ville_nom + ' ' + full.lib_nro + ' ' + full.plaque + ' ' + full.zone;
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
                displayDevis();
                $('#devis_block_title').html('Devis');
                $(ot_btns.join(',')).addClass("disabled");
                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot=-1' ).load();
            }
        } );

        $(ot_btns.join(',')).addClass("disabled");

        $('#ot_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(ot_btns.join(',')).addClass("disabled");
                $('#devis_block_title').html('Devis');

                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot=-1' ).load();
            }
            else {
                ot_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(ot_btns.join(',')).removeClass("disabled");
                $('#devis_block_title').html('Devis ' + ot_dt.row('.selected').data().type_ot);

                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot='+ot_dt.row('.selected').data().id_ordre_de_travail ).load();
            }

            calendar.refresh();
            displayDevis();

        } );

    } );
</script>