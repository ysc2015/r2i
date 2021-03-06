<form class="form-horizontal push-10-t push-10" id="devis_detail_form" name="devis_detail_form">
    <div id="wrap" class="modal fade" role="dialog" aria-hidden="false" tabindex="-1">
        <div class="modal-dialog" style="width: 900px">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title">Edition Devis ID ()</h3>
                    </div>
                    <div class="block-content">
                        <div class="block">
                            <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">
                                <li class="">
                                    <a href="#devis_tab" data-toggle="tab" aria-expanded="false">Devis</a>
                                </li>
                                <li class="active">
                                    <a href="#LOT7_FO" data-toggle="tab" aria-expanded="true">LOT7_FO</a>
                                </li>
                                <li>
                                    <a href="#LOT2_GC" data-toggle="tab">LOT2_GC</a>
                                </li>
                            </ul>
                            <div class="block-content tab-content">
                                <div class="tab-pane" id="devis_tab">

                                </div>
                                <div class="tab-pane active" id="LOT7_FO">
                                    <h3 class="block-title block-title-edition-devis">Etudes</h3>
                                    <div id="tablecontentetude"></div>
                                    <h3 class="block-title block-title-edition-devis">Travaux en Réseau enterrés</h3>
                                    <div id="tablecontentTRE"></div>
                                    <h3 class="block-title block-title-edition-devis">Travaux de raccordement optique et
                                        mesures</h3>
                                    <div id="tablecontent"></div>
                                    <h3 class="block-title block-title-edition-devis ">Travaux en En Site Technique</h3>
                                    <div id="tablecontenttst"></div>
                                </div>
                                <div class="tab-pane" id="LOT2_GC">
                                    <h3 class="block-title block-title-edition-devis">Tranchées</h3>
                                    <div id="tablecontenttranche"></div>
                                    <h3 class="block-title block-title-edition-devis">Chambres</h3>
                                    <div id="tablecontentchambre"></div>
                                    <h3 class="block-title block-title-edition-devis">Travaux Divers GC</h3>
                                    <div id="tablecontenttdgc"></div>
                                </div>
                            </div>
                        </div>
                        <div id="message"></div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</form>
<div id="modale_liste_devis_supprime" class="modal fade" role="dialog" aria-hidden="false" tabindex="-1">
    <div class="modal-dialog" style="width: 900px">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Restaurer Un devis</h3>
                </div>
            </div>

            <div class="block-content">
                <div class="block">
                    <table id="devis_supprime_table" class="table table-bordered table-striped js-dataTable-full"
                           width="100%">
                        <thead>
                        <tr>
                            <th>iddevis</th>
                            <th>id_ressource</th>
                            <th>id_ordre_de_travail</th>
                            <th>ref_devis</th>
                            <th>etat_devis</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>iddevis</th>
                            <th>id_ressource</th>
                            <th>id_ordre_de_travail</th>
                            <th>ref_devis</th>
                            <th>etat_devis</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <button id="devis_restaure_action_btn" class="btn btn-success btn-sm  " type="button" data-backdrop="static" data-keyboard="false" data-dismiss="modal"><i id="hdf0454ff"
                                                                                                                   class="glyphicon glyphicon-check"></i>
                    Restauré devis supprimé
                </button>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
            </div></div>
        </div>
    </div>

<div class="row items-push">
    <!-- Table liste devis -->
    <div class="block">
        <div class="block-content table-responsive">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
            <table id="devis_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
                <thead>
                <tr>
                    <th>iddevis</th>
                    <th>id_ressource</th>
                    <th>id_ordre_de_travail</th>
                    <th>ref_devis</th>
                    <th>etat_devis</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>iddevis</th>
                    <th>id_ressource</th>
                    <th>id_ordre_de_travail</th>
                    <th>ref_devis</th>
                    <th>etat_devis</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- END Table devis -->
    <div class="col-md-12">
        <button id="download_devis" class='btn btn-primary btn-sm' type="button"><span
                class='glyphicon glyphicon-download'>&nbsp;</span> Télécharger devis
        </button>
        <button id="id_devis_edit_btn" class="btn btn-warning btn-sm" type="button" data-toggle="modal"
                data-target="#wrap" data-backdrop="static" data-keyboard="false"><i id="hdf0454ff"
                                                                                    class="fa fa-plus push-5-r"></i>
            Editer devis
        </button>
        <button id="devis_consult_btn" class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#wrap"
                data-backdrop="static" data-keyboard="false"><i id="hdf0454ff" class="fa fa-plus push-5-r"></i>
            Consulter devis
        </button>
        <button id="devis_supprime_btn" class="btn btn-danger btn-sm " type="button"><i id="hdf0454ff"
                                                                                        class="glyphicon glyphicon-remove"></i>
            Supprimer devis
        </button>
        <button id="devis_restaure_btn" class="btn btn-success btn-sm  " type="button" data-toggle="modal"
                data-target="#modale_liste_devis_supprime" data-backdrop="static" data-keyboard="false" ><i id="hdf0454ff"
                                                                                                            class="glyphicon glyphicon-check"></i>
            Afficher devis supprimés
        </button>
        <button id="devis_convert_bdc_btn" class="btn btn-success btn-sm  " type="button"
             ><i id="hdf0454ff"
                                                                                                            class="glyphicon glyphicon-check"></i>
            Convertir en BDC
        </button>
    </div>

</div>

<div class="alert alert-success" id="message_devis_detail" role="alert" style="display: none;"></div>
<div id="devis_uploads">
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-6">
            <label for="devis_bon_cmd_uploader">Bon(s) de commande(s)</label>
            <div id="devis_bon_cmd_uploader"></div>
        </div>
        <div class="col-md-6">
            <label for="devis_autre_uploader">Autre(s) attachement(s)</label>
            <div id="devis_autre_uploader"></div>
        </div>
    </div>
</div>
<script>

    var compteur = 1;
     var a_totaux =  {EFO:0,TFO:0,RFO:0,ITF:0,EGC:0,CGC:0,TGC:0};

    var devis_formdata = {};
    var uploader1_options = {
        url: "api/ot/devis/upload_devis_bon_cmd.php",
        multiple: true,
        dragDrop: true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete: true,
        showDownload: true,
        allowedTypes: "pdf",
        onLoad: function (obj) {
            if (id_devis > 0) {
                $.ajax({
                    cache: false,
                    url: "api/ot/devis/load_bon_cmd.php",
                    method: "POST",
                    data: {iddevis: id_devis},
                    dataType: "json",
                    success: function (data) {
                        for (var i = 0; i < data.length; i++) {
                            obj.createProgress(data[i]["name"], data[i]["path"], data[i]["size"], data[i]["id"]);
                        }
                    }
                });
            }
        },
        dynamicFormData: function () {
            var data = {
                iddevis: id_devis
            };
            return data;
        },
        afterUploadAll: function (obj) {
        },
        downloadCallback: function (data, pd) {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            location.href = "api/file/download.php?id=" + id;
        },
        deleteCallback: function (data, pd) {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            $.ajax({
                method: "POST",
                url: "api/file/delete.php",
                data: {
                    id: id
                }
            }).done(function (message) {
                console.log(message);
            });

        }
    }
    var uploader2_options = {
        url: "api/ot/devis/upload_devis_autre.php",
        multiple: true,
        dragDrop: true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete: true,
        showDownload: true,
        allowedTypes: "pdf",
        onLoad: function (obj) {
            if (id_devis > 0) {
                $.ajax({
                    cache: false,
                    url: "api/ot/devis/load_devis_autre.php",
                    method: "POST",
                    data: {iddevis: id_devis},
                    dataType: "json",
                    success: function (data) {
                        for (var i = 0; i < data.length; i++) {
                            obj.createProgress(data[i]["name"], data[i]["path"], data[i]["size"], data[i]["id"]);
                        }
                    }
                });
            }
        },
        dynamicFormData: function () {
            var data = {
                iddevis: id_devis
            };
            return data;
        },
        afterUploadAll: function (obj) {
        },
        downloadCallback: function (data, pd) {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            location.href = "api/file/download.php?id=" + id;
        },
        deleteCallback: function (data, pd) {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            $.ajax({
                method: "POST",
                url: "api/file/delete.php",
                data: {
                    id: id
                }
            }).done(function (message) {
                console.log(message);
            });

        }
    }

    $(function () {
        // Init page plugins & helpers
        uploader1_options = merge_options(defaultUploaderStrLocalisation, uploader1_options);
        uploader1 = $("#devis_bon_cmd_uploader").uploadFile(uploader1_options);

        uploader2_options = merge_options(defaultUploaderStrLocalisation, uploader2_options);
        uploader2 = $("#devis_autre_uploader").uploadFile(uploader2_options);
    });

function call_back(){

    if(compteur==8  ){
        $.ajax({
            cache: false,
            url: "api/ot/devis/get_details_devis_info.php",
            method: "GET",
            data: {iddevis: id_devis,"data": a_totaux},
            dataType: "json",
            async: false,
            success: function (data) {
                $('#devis_tab').html(data);
                var dcmd_formdata = {};
                $("#save_info_devis").click(function () {
                    dcmd_formdata['tablename'] = "detail_info";
                    dcmd_formdata['iddevis'] = id_devis;
                    dcmd_formdata['ref_devis'] = $('#refdevis').val();
                    dcmd_formdata['date_devis'] = $('#datedevis').val();
                    dcmd_formdata['date_livraison'] = $('#datelivraisondevis').val();
                    dcmd_formdata['etat_devis'] = $('#etat_devis').val();

                    $.ajax({
                        method: "POST",
                        url: "api/ot/devis/save_details_devis.php",
                        data: dcmd_formdata
                    }).done(function (msg) {

                        App.showMessage(msg, '#message_devis');
                    });

                });
            }
        });

    }
    return true;
}
    $(document).ready(function () {


        $("#id_devis_edit_btn").click(function (e) {

            e.preventDefault();

            compteur = 0;

            $('#devis_block').addClass('block-opt-refresh');

            $.ajax({

                method: "POST",
                url: "api/ot/devis/set_lineare_devis.php",
                dataType: "json",
                data: {
                    idsp : get('idsousprojet',ot_dt),
                    iddevis: id_devis,
                    idtot : ot_dt.row('.selected').data().id_type_ordre_travail
                }

            }).done(function (msg) {

                console.log(msg);

                $('#devis_block').removeClass('block-opt-refresh');

                editableGrid.onloadJSON("api/ot/devis/get_details_devis.php?iddevis=" + id_devis, "tablecontent", "testgrid trom", "tableid",call_back);
                editableGrid_travaux_reseau_entere.onloadJSON("api/ot/devis/get_details_devis_TRE.php?iddevis=" + id_devis, "tablecontentTRE", "testgrid tre", "tableidTRE",call_back);
                editableGrid_etude.onloadJSON("api/ot/devis/get_details_devis_etude.php?iddevis=" + id_devis, "tablecontentetude", "testgrid etude", "tableidetude",call_back);
                editableGrid_tst.onloadJSON("api/ot/devis/get_details_devis_tst.php?iddevis=" + id_devis, "tablecontenttst", "testgrid tst", "tableidtst",call_back);
                editableGrid_chambre.onloadJSON("api/ot/devis/get_details_devis_chambre.php?iddevis=" + id_devis, "tablecontentchambre", "testgrid chambre", "tableidchambre",call_back);
                editableGrid_tranche.onloadJSON("api/ot/devis/get_details_devis_tranche.php?iddevis=" + id_devis, "tablecontenttranche", "testgrid tranche", "tableidtranche",call_back);
                editableGrid_tdgc.onloadJSON("api/ot/devis/get_details_devis_tdgc.php?iddevis=" + id_devis, "tablecontenttdgc", "testgrid tdgc", "tableidtdgc",call_back);

                compteur++;
                setTimeout(function() { call_back() }, 1000);

            });


        });

        $("#devis_consult_btn").click(function (e) {

            e.preventDefault();

            compteur = 0;

            $('#devis_block').addClass('block-opt-refresh');

            $.ajax({

                method: "POST",
                url: "api/ot/devis/set_lineare_devis.php",
                dataType: "json",
                data: {
                    idsp : get('idsousprojet',ot_dt),
                    iddevis: id_devis,
                    idtot : ot_dt.row('.selected').data().id_type_ordre_travail
                }

            }).done(function (msg) {

                console.log(msg);

                $('#devis_block').removeClass('block-opt-refresh');

                editableGrid.onloadJSON("api/ot/devis/get_details_devis.php?iddevis=" + id_devis + "&editable=1", "tablecontent", "testgrid trom", "tableid",call_back);
                editableGrid_travaux_reseau_entere.onloadJSON("api/ot/devis/get_details_devis_TRE.php?iddevis=" + id_devis + "&editable=1", "tablecontentTRE", "testgrid tre", "tableidTRE",call_back);
                editableGrid_etude.onloadJSON("api/ot/devis/get_details_devis_etude.php?iddevis=" + id_devis + "&editable=1", "tablecontentetude", "testgrid etude", "tableidetude",call_back);
                editableGrid_tst.onloadJSON("api/ot/devis/get_details_devis_tst.php?iddevis=" + id_devis + "&editable=1", "tablecontenttst", "testgrid tst", "tableidtst",call_back);
                editableGrid_chambre.onloadJSON("api/ot/devis/get_details_devis_chambre.php?iddevis=" + id_devis + "&editable=1", "tablecontentchambre", "testgrid chambre", "tableidchambre",call_back);
                editableGrid_tranche.onloadJSON("api/ot/devis/get_details_devis_tranche.php?iddevis=" + id_devis + "&editable=1", "tablecontenttranche", "testgrid tranche", "tableidtranche",call_back);
                editableGrid_tdgc.onloadJSON("api/ot/devis/get_details_devis_tdgc.php?iddevis=" + id_devis + "&editable=1", "tablecontenttdgc", "testgrid tdgc", "tableidtdgc",call_back);

                compteur++;
                setTimeout(function() { call_back() }, 1000);

            });


        });


        $("#download_devis").click(function (e) {

            e.preventDefault();

            $('#devis_block').addClass('block-opt-refresh');

            $.ajax({

                method: "POST",
                url: "api/ot/devis/set_lineare_devis.php",
                dataType: "json",
                data: {
                    idsp : get('idsousprojet',ot_dt),
                    iddevis: id_devis,
                    idtot : ot_dt.row('.selected').data().id_type_ordre_travail
                }

            }).done(function (msg) {

                console.log(msg);

                $('#devis_block').removeClass('block-opt-refresh');

                if (devis_dt.row('.selected').data() !== undefined) {
                    location.href = "api/file/parserfile.php?id=" + id_devis + "&idsp=" + ot_dt.row('.selected').data().id_sous_projet + "&idtot=" + ot_dt.row('.selected').data().id_type_ordre_travail;
                }

            });

        });

        $('#devis_restaure_btn').click(function(){
            if ( ! $.fn.DataTable.isDataTable( '#devis_supprime_table' ) ) {
                devis_supprime_dt = $('#devis_supprime_table').DataTable( {
                    "language": {
                        "url": "assets/js/plugins/datatables/French.json"
                    },
                    "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": 'api/ot/devis/devis_liste.php?idot='+id_ot+'&supprime=1',
                        "cache":false
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
                devis_supprime_dt.ajax.url('api/ot/devis/devis_liste.php?idot='+id_ot+'&supprime=1').load();
            }

            $('#devis_supprime_table tbody').on('click','tr', function(){
                if($(this).hasClass('selected')){
                    $(this).removeClass('selected');
                    $('#devis_restaure_action_btn').addClass('disabled');

                } else{
                    devis_supprime_dt.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    id_devis = devis_supprime_dt.row('.selected').data().iddevis;
                    $('#devis_restaure_action_btn').removeClass('disabled');

                }
            });
            $('#devis_restaure_action_btn').click(function(){
                $.ajax({
                    cache: false,
                    url: "api/ot/devis/save_details_devis.php",
                    method: "POST",
                    data: {iddevis: id_devis,tablename:'restaure_devis'},
                    success: function (data) {
                        devis_dt.ajax.url('api/ot/devis/devis_liste.php?idot='+id_ot).load();
                        devis_supprime_dt.ajax.url('api/ot/devis/devis_liste.php?idot=0&supprime=1').load();
                        $(devis_btns.join(',')).addClass("disabled");
                    },
                    error:function(d){
                        console.log("error "+d.mes);
                    }
                });

            });

        })


    });

</script>