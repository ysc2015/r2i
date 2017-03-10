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
    var id_ot = 0;
    var id_ebm = 0;
    var devis_dt = $('#devis_table').DataTable();
    var devis_supprime_dt = $('#devis_supprime_table').DataTable();
    var id_res = 0;
    var etat_retour = 0;
    var etat_devis = 0;
    var devis_btns = ["#download_devis","#id_devis_edit_btn","#devis_consult_btn","#devis_supprime_btn"];
    var ot_btns = ["#update_ot_show",
        "#link_ot_show",
        "#delete_ot","#open_pblq",
        "#linked-ch",
        "#link_ot","#linked-pb","#link_pb"];
    function displayDevis() {
        console.log("displayDevis");
        if(ot_dt.row('.selected').data()!== undefined) {

            id_ot = ot_dt.row('.selected').data().id_ordre_de_travail;

            $.ajax({
                method: "POST",
                async:false,
                url: "api/ot/devis/get_devis_id.php",
                dataType: "json",
                data: {
                    idot : ot_dt.row('.selected').data().id_ordre_de_travail,
                    idtot : ot_dt.row('.selected').data().id_type_ordre_travail
                }
            }).done(function (msg) {

                if(msg.iddevis > 0) {
                    if ( ! $.fn.DataTable.isDataTable( '#devis_table' ) ) {
                        devis_dt = $('#devis_table').DataTable( {
                            "language": {
                                "url": "assets/js/plugins/datatables/French.json"
                            },
                            "autoWidth": false,
                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": 'api/ot/devis/devis_liste.php?idot='+id_ot,
                                "cache": false
                            },
                            "columns": [
                                { "data": "iddevis" },
                                { "data": "id_ressource" },
                                { "data": "id_ordre_de_travail" },
                                { "data": "ref_devis" },
                                { "data": "lib_etat_devis" }
                            ],
                            "columnDefs": [
                                { "targets": [ 0,1 ], "visible": false, "searchable": false }
                            ],
                            "order": [[0, 'asc']]
                            ,
                            "drawCallback": function( /*settings*/ ) {

                            }
                        } );
                    }else{
                        devis_dt.ajax.url('api/ot/devis/devis_liste.php?idot='+id_ot).load();
                    }



                    uploader1.reset();
                    uploader1 = $("#devis_bon_cmd_uploader").uploadFile(uploader1_options);

                    uploader2.reset();
                    uploader2 = $("#devis_autre_uploader").uploadFile(uploader2_options);
                } else {
                    id_devis = 0;
                    id_res = 0;
                    $('#download_devis').addClass('disabled');
                    $('#id_devis_edit_btn').addClass('disabled');
                    $('#devis_consult_btn').addClass('disabled');
                    $('#devis_supprime_btn').addClass('disabled');
                    $('#devis_restaure_btn').addClass('disabled');

                }
            });
        } else {
            id_devis = 0;
            id_res = 0;
            id_ot = 0;
            $('#download_devis').addClass('disabled');
            $('#id_devis_edit_btn').addClass('disabled');
            $('#devis_consult_btn').addClass('disabled');
            $('#devis_supprime_btn').addClass('disabled');
            $('#devis_restaure_btn').addClass('disabled');
            devis_dt.ajax.url('api/ot/devis/devis_liste.php?idot=-1').load();



        }
    }
    function displayEBM() {
        if(ot_dt.row('.selected').data()!== undefined) {
            $.ajax({
                method: "POST",
                url: "api/ot/devis/get_ebm_id.php",
                dataType: "json",
                data: {
                    idot : ot_dt.row('.selected').data().id_ordre_de_travail,
                    idtot : ot_dt.row('.selected').data().id_type_ordre_travail,
                    idsp : ot_dt.row('.selected').data().id_sous_projet
                }
            }).done(function (msg) {
                console.log(msg);
                if(msg.idebm > 0) {
                    id_ebm = msg.idebm;
                    $('#download_ebm').removeClass('disabled');
                } else {
                    id_ebm = 0;
                    $('#download_ebm').addClass('disabled');
                }
            });
        } else {
            id_ebm = 0;
            $('#download_ebm').addClass('disabled');
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
                tentree : (get('tentree')=="transportraccordement"?"transporttirage":(get('tentree')=="distributionraccordement"?"distributiontirage":get('tentree')))
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
                { "data": "lib_etat_ot" },
                { "data": "id_type_ordre_travail" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2,4,6 ], "visible": false, "searchable": false }
            ],
            "order": [[6, 'asc']]
            ,
            "drawCallback": function( /*settings*/ ) {

                $('#other_files_uploader_wrapper').hide();
                $("#devis_uploads").hide();
                displayDevis();
                displayEBM();
                $('#devis_block_title').html('Suivi Facturation');
                $(ot_btns.join(',')).addClass("disabled");
                $('#linked-ch').html('<option value="">&nbsp;</option>');
                $('#linked-pb').html('<option value="">&nbsp;</option>');
                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot=-1' ).load();
                devis_dt.ajax.url('api/ot/devis/devis_liste.php?idot=-1').load();
                ot_affect_dt.draw(false);

                blq_pbc_dt.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot=-1' ).load();
                blq_pbc_dt2.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=2&idot=-1' ).load();
            }
        } );

        $(ot_btns.join(',')).addClass("disabled");
        $('#other_files_uploader_wrapper').hide();
        $('#linked-pb-wrapper').hide();
        $('#linked-ch-wrapper').hide();
        $('#retour_uploads').hide();

        $('#link_lien_plans_wrapper1').hide();
        $('#link_lien_plans_wrapper2').hide();
        $('#other_files_uploader_wrapper').hide();

        $('#ot_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(ot_btns.join(',')).addClass("disabled");
                $('#devis_block_title').html('Suivi Facturation');

                $('#linked-ch').html('<option value="">&nbsp;</option>');
                $('#linked-pb').html('<option value="">&nbsp;</option>');

                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot=-1' ).load();
                blq_pbc_dt.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot=-1' ).load();
                blq_pbc_dt2.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=2&idot=-1' ).load();

                $('#linked-pb-wrapper').hide();
                $('#linked-ch-wrapper').hide();
                $("#devis_uploads").hide();

                $('#retour_uploads').hide();
                $('#link_lien_plans_wrapper1').hide();
                $('#link_lien_plans_wrapper2').hide();
                $('#other_files_uploader_wrapper').hide();
            }
            else {
                ot_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $('#other_files_uploader_wrapper').show();
                other_files_uploader.reset();
                other_files_uploader = $("#other_files_uploader").uploadFile(other_files_uploader_options);



                $(ot_btns.join(',')).removeClass("disabled");
                $('#linked-ch-wrapper').show();
                $("#devis_uploads").show();
                $.ajax({
                    method: "POST",
                    url: "api/ot/devis/get_devis_ot_able_to_restaure.php",
                    dataType: "json",
                    data: {
                        iddevis : id_devis,
                        id_ordre_de_travail : ot_dt.row('.selected').data().id_ordre_de_travail
                    }
                }).done(function (msg) {
                    console.log(msg);

                    if(msg.restaure == 1){
                        $('#devis_restaure_btn').removeClass('disabled');
                    }else{
                        $('#devis_restaure_btn').addClass('disabled');
                    }
                    console.log(" msg.add_new_devis :"+msg.add_new_devis);
                    if(msg.add_new_devis == 1){

                        $("#linked-pb-wrapper").show();
                    }else{
                        $("#linked-pb-wrapper").hide();
                    }



                });
                if(ot_dt.row('.selected').data().id_type_ordre_travail >=1 && ot_dt.row('.selected').data().id_type_ordre_travail <=10) {
                    uploader3.reset();
                    uploader3 = $("#stt_retour_uploader").uploadFile(uploader3_options);
                    getRetourTerrain(ot_dt.row('.selected').data().id_sous_projet,ot_dt.row('.selected').data().id_type_ordre_travail,'#link_retour_stt');
                    $('#retour_uploads').show();

                    if(ot_dt.row('.selected').data().id_type_ordre_travail == 9 || ot_dt.row('.selected').data().id_type_ordre_travail == 10) {
                        $('#ret_etat_retour_wrapper').hide();
                        $('#ret_etat_retour2_wrapper').show();
                        $("#ret_etat_retour2").val(etat_retour);
                    } else {
                        $('#ret_etat_retour_wrapper').show();
                        $('#ret_etat_retour2_wrapper').hide();
                        $("#ret_etat_retour").val(etat_retour);
                    }
                } else {
                    $('#retour_uploads').hide();
                    $('#link_lien_plans_wrapper1').hide();
                    $('#link_lien_plans_wrapper2').hide();
                }

                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot='+ot_dt.row('.selected').data().id_ordre_de_travail ).load();
                blq_pbc_dt.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot=-1' ).load();
                blq_pbc_dt2.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=2&idot=-1' ).load();

                $.ajax({
                    method: "POST",
                    url: "api/ot/ot/get_ch_files_list.php",
                    dataType: "json",
                    data: {
                        objtype: getObjectTypeForEntry(get('tentree')),
                        idot : ot_dt.row('.selected').data().id_ordre_de_travail,
                        idsp : ot_dt.row('.selected').data().id_sous_projet
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
                    if(ot_dt.row('.selected').data().id_type_ordre_travail != 2 && ot_dt.row('.selected').data().id_type_ordre_travail != 6) {
                        $('#linked-pb-wrapper').show();
                        $('#devis_block_title').html('Suivi Facturation ' + ot_dt.row('.selected').data().type_ot);
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
                    } else {
                        $('#linked-pb-wrapper').hide();
                    }

                } else {
                    $('#linked-pb-wrapper').hide();
                }
            }


            displayDevis();
            displayEBM();

        } );
        $('#devis_table tbody').on('click','tr', function(){
           if($(this).hasClass('selected')){
               $(this).removeClass('selected');
               $('#download_devis').addClass('disabled');
               $('#id_devis_edit_btn').addClass('disabled');
               $('#devis_consult_btn').addClass('disabled');
               $('#devis_supprime_btn').addClass('disabled');

           } else{
               devis_dt.$('tr.selected').removeClass('selected');
               $(this).addClass('selected');
               id_devis = devis_dt.row('.selected').data().iddevis;


               $.ajax({
                   method: "POST",
                   url: "api/ot/devis/get_ids_to_supprime.php",
                   dataType: "json",
                   data: {
                       iddevis : id_devis
                   }
               }).done(function (msg) {
                   etat_devis = msg.etat_devis;
               if(etat_devis == 1){
                   $('#devis_supprime_btn').removeClass('disabled');
                   $('#id_devis_edit_btn').removeClass('disabled');
                   $('#devis_convert_bdc_btn').removeClass('disabled');
               }else{
                   $('#devis_supprime_btn').addClass('disabled');
                   $('#id_devis_edit_btn').addClass('disabled');
                   $('#devis_convert_bdc_btn').addClass('disabled');
               }

               $('#devis_consult_btn').removeClass('disabled');
               $('#download_devis').removeClass('disabled');
               });
           }
        });
    } );
</script>