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
                <th>nom</th>
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
    var rem = '';
    var selectedOT = 0;
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
                { "data": "type_ot" },
                { "data": "commentaire" },
                { "data": "commentaire" },
                { "data": "lib_etat_ot" }
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
            "drawCallback": function( settings ) {
                //console.log('drawCallback');
                displayDevis();
                $('#devis_block_title').html('Devis');
                $('#validate_start_ot').addClass("disabled");
                $('#snk_show').addClass("disabled");
                $('#foa_show').addClass("disabled");
                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot=-1' ).load();
                //blq_pbc_dt.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot=-1' ).load();
                //blq_pbc_dt2.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=2&idot=-1' ).load();

            },
            "initComplete": function( settings ) {
            },
            rowId: 'id_ordre_de_travail',
            "rowCallback": function( row, data ) {
                if ( data.id_ordre_de_travail == selectedOT) {
                    $(row).addClass('selected');
                }
            }
        } );

        $('#validate_start_ot').addClass("disabled");
        $('#snk_show').addClass("disabled");
        $('#foa_show').addClass("disabled");
        //$('#retour_uploads').hide();
        $('#link_lien_plans_wrapper1').hide();
        $('#link_lien_plans_wrapper2').hide();
        $('#other_files_uploader_wrapper').hide();

        $('#ot_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $('#validate_start_ot').addClass("disabled");
                $('#snk_show').addClass("disabled");
                $('#foa_show').addClass("disabled");
                $('#devis_block_title').html('Devis');

                //$('#retour_uploads').hide();
                $('#link_lien_plans_wrapper1').hide();
                $('#link_lien_plans_wrapper2').hide();

                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot=-1' ).load();

                selectedOT = 0;

                $('#other_files_uploader_wrapper').hide();
            }
            else {
                ot_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $('#other_files_uploader_wrapper').show();
                other_files_uploader.reset();
                other_files_uploader = $("#other_files_uploader").uploadFile(other_files_uploader_options);

                if(ot_dt.row('.selected').data().id_type_ordre_travail >=1 && ot_dt.row('.selected').data().id_type_ordre_travail <=10) {
                    /*uploader3.reset();
                    uploader3 = $("#stt_retour_uploader").uploadFile(uploader3_options);*/
                    getRetourTerrain(ot_dt.row('.selected').data().id_sous_projet,ot_dt.row('.selected').data().id_type_ordre_travail,'#link_retour_stt');
                    //$('#retour_uploads').show();
                } else {
                    //$('#retour_uploads').hide();
                    $('#link_lien_plans_wrapper1').hide();
                    $('#link_lien_plans_wrapper2').hide();
                }

                if(ot_dt.row('.selected').data().id_etat_ot != 5) {
                    $('#validate_start_ot').removeClass("disabled");
                } else {
                    $('#validate_start_ot').addClass("disabled");
                }
                $('#snk_show').removeClass("disabled");
                $('#foa_show').removeClass("disabled");
                $('#devis_block_title').html('Devis ' + ot_dt.row('.selected').data().type_ot);

                chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot='+ot_dt.row('.selected').data().id_ordre_de_travail ).load();
                //blq_pbc_dt.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot='+(ot_dt.row('.selected').data()!=undefined?ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
                //blq_pbc_dt2.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=2&idot='+(ot_dt.row('.selected').data()!=undefined?ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();

                selectedOT = ot_dt.row('.selected').data().id_ordre_de_travail;
            }

            calendar.refresh();
            displayDevis();

        } );

    } );
</script>