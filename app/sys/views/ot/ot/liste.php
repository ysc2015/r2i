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
                <th>état</th>
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
                <th>état</th>
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
    var ot_btns = ["#update_ot_show",
        "#link_ot_show",
        "#delete_ot","#open_pblq",
        "#linked-ch",
        "#link_ot","#linked-pb","#link_pb"];
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
                console.log(msg);
                if(msg.iddevis > 0) {
                    id_devis = msg.iddevis;
                    id_res = msg.idres;
                    $('#download_devis').removeClass('disabled');
                    $("#devis_uploads").show();
                    uploader1.reset();
                    uploader1 = $("#devis_bon_cmd_uploader").uploadFile(uploader1_options);

                    uploader2.reset();
                    uploader2 = $("#devis_autre_uploader").uploadFile(uploader2_options);
                } else {
                    id_devis = 0;
                    id_res = 0;
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
    function getTypeOT(selector) {
        console.log('getTypeOT');
        $.ajax({
            method: "POST",
            url: "api/ot/ot/get_type_ot.php",
            dataType: "json",
            data: {
                idsousprojet : get('idsousprojet'),
                tentree : get('tentree')
            }
        }).done(function (msg) {
            //console.log(msg.html);
            $(selector).html(msg.html);

        });
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
                "url": 'api/ot/ot/ot_liste.php?idsp='+get('idsousprojet')+'&tentree='+get('tentree')
            },
            "columns": [
                { "data": "id_ordre_de_travail" },
                { "data": "id_sous_projet" },
                { "data": "type_entree" },
                { "data": "type_ot" },/*lib_type_ordre_travail*/
                { "data": "commentaire" },
                { "data": "lib_etat_ot" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2,4 ], "visible": false, "searchable": false }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
                displayDevis();
                $('#devis_block_title').html('Devis');
                $(ot_btns.join(',')).addClass("disabled");
                $('#linked-ch').html('<option value="">&nbsp;</option>');
                $('#linked-pb').html('<option value="">&nbsp;</option>');
                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot=-1' ).load();
                ot_affect_dt.draw(false);
            }
        } );

        $(ot_btns.join(',')).addClass("disabled");
        $('#other_files_uploader_wrapper').hide();
        $('#linked-pb-wrapper').hide();
        $('#linked-ch-wrapper').hide();

        $('#ot_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(ot_btns.join(',')).addClass("disabled");
                $('#devis_block_title').html('Devis');

                $('#linked-ch').html('<option value="">&nbsp;</option>');
                $('#linked-pb').html('<option value="">&nbsp;</option>');

                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot=-1' ).load();

                $('#other_files_uploader_wrapper').hide();
                $('#linked-pb-wrapper').hide();
                $('#linked-ch-wrapper').hide();
            }
            else {
                ot_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $('#other_files_uploader_wrapper').show();
                other_files_uploader.reset();
                other_files_uploader = $("#other_files_uploader").uploadFile(other_files_uploader_options);

                //console.log('iddevis' + ot_dt.row('.selected').data().iddevis);

                $(ot_btns.join(',')).removeClass("disabled");
                $('#linked-ch-wrapper').show();

                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot='+ot_dt.row('.selected').data().id_ordre_de_travail ).load();

                $.ajax({
                    method: "POST",
                    url: "api/ot/ot/get_ch_files_list.php",
                    dataType: "json",
                    data: {
                        objtype: getObjectTypeForEntry(get('tentree')),
                        idot : ot_dt.row('.selected').data().id_ordre_de_travail
                    }
                }).done(function (data) {
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

                if(ot_dt.row('.selected').data().id_type_ordre_travail >=1 && ot_dt.row('.selected').data().id_type_ordre_travail <=8) {
                    $('#linked-pb-wrapper').show();
                    $('#devis_block_title').html('Devis ' + ot_dt.row('.selected').data().type_ot);
                    $.ajax({
                        method: "POST",
                        url: "api/ot/ot/get_pb_files_list.php",
                        dataType: "json",
                        data: {
                            objtype: getObjectTypeForEntryPB(get('tentree')),
                            idot : ot_dt.row('.selected').data().id_ordre_de_travail,
                            idsp : get('idsousprojet')
                        }
                    }).done(function (data) {
                        var values = [];
                        $('#linked-pb').html('<option value="">&nbsp;</option>');
                        for(var i = 0 ; i < data.length ; i++) {
                            if(ot_dt.row('.selected').data().id_ordre_de_travail == data[i]['idot']) {
                                values.push(data[i]['id']);
                            }
                            html = '<option value="'+data[i]['id']+'">'+data[i]['nom']+'</option>';
                            $('#linked-pb').append(html);
                        }
                        $('#linked-pb').val(values);
                    });
                    displayDevis();
                } else {
                    $('#linked-pb-wrapper').hide();
                }
            }

        } );

    } );
</script>