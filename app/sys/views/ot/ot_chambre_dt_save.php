<div class="row">
    <div class="block block-themed">
        <div class="block-header bg-info">
            <ul class="block-options">
                <li>
                    <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                </li>
                <li>
                    <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                </li>
            </ul>
            <h3 class="block-title">Chambres de l'OT</h3>
        </div>
        <div class="block-content">
            <!-- Table projets -->
            <div class="block">
                <div class="block-content">
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                    <table id="chambre_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
                        <thead>
                        <tr>
                            <th>id_chambre</th>
                            <th>ref_chambre</th>
                            <th>villet</th>
                            <th>sous_projet</th>
                            <th>ref_note</th>
                            <th>code_ch1</th>
                            <th>code_ch2</th>
                            <th>gps</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>id_chambre</th>
                            <th>ref_chambre</th>
                            <th>villet</th>
                            <th>sous_projet</th>
                            <th>ref_note</th>
                            <th>code_ch1</th>
                            <th>code_ch2</th>
                            <th>gps</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- END Table projets -->
            <button style="margin: 10px 0px 10px 0px;" id="update_chambre_show" class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-circle-arrow-right'>&nbsp;</span> modifier chambre</button>
            <button style="margin: 10px 0px 10px 0px;" id="delete_chambre_show" class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-circle-arrow-right'>&nbsp;</span> supprimer chambre</button>
            <button style="margin: 10px 0px 10px 0px;" id="infos_terrain_show" class='btn btn-success btn-sm'><span class='glyphicon glyphicon-circle-arrow-right'>&nbsp;</span> remontées terrain</button>
            <button style="margin: 10px 0px 10px 0px;" id="inject_file_show" class='btn btn-warning btn-sm' data-toggle="modal" data-target='#inject-file' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-circle-arrow-right'>&nbsp;</span> injecter fichier</button>
        </div>
    </div>
</div>

<script>
    var btns = ["#infos_terrain_show",
        "#delete_chambre_show",
        "#update_chambre_show"];
    var uploader = null;
    var upload_ok = false;
    var response = undefined;
    var dt;
    var id_chambre = 0;
    $(document).ready(function() {
        //events
        $("#inject_file_show").click(function() {
            $("#message_inject_file").hide();
            $("#inject_progress_bar").hide();
            if(uploader != null) uploader.reset();
        });
        $("#inject_file_process").click(function() {
            if(uploader.selectedFiles > 0) {
                $("#inject_progress_bar").show();
                $("#close_injection_form1").addClass("disabled");
                $( this).addClass("disabled");
                uploader.startUpload();
            }
        });
        //init
        $(btns.join(',')).addClass("disabled");
        uploader = $("#fileuploader").uploadFile({
            url: "api/ot/ot_upload_chambre_files.php",
            multiple:false,
            dragDrop:true,
            dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
            fileName: "myfile",
            autoSubmit: false,
            maxFileCount : 1,
            dynamicFormData: function()
            {
                var data ={
                    idot: <?= $_GET['idot']?>
                };
                return data;
            },
            multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers sont autorisés.",

            uploadStr:"Téléchargez",
            allowedTypes: "xlsx",
            afterUploadAll:function(obj) {
                upload_ok = true;
                $("#inject_progress_bar").hide();
                $("#close_injection_form1").removeClass("disabled");
                $("#inject_file_process").removeClass("disabled");
                response = obj.getResponses();
                console.log(response[response.length - 1]);//get last response
                uploader.reset();
                App.showMessage(response,'#message_inject_file');
                dt.draw(false);
            }
        });

        dt = $('#chambre_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            /*"scrollX": true,*/
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            /*"ajax": {
             'type': 'POST',
             'url': "api/ot/chambre_liste.php",
             'data': {
             idot: <?= $_GET['idot']?>
             },
             },*/
            "ajax": 'api/ot/chambre_liste.php?idot=' + <?= $_GET['idot']?>,
            "columns": [
                { "data": "id_chambre" },
                { "data": "ref_chambre" },
                { "data": "villet" },
                { "data": "sous_projet" },
                { "data": "ref_note" },
                { "data": "code_ch1" },
                { "data": "code_ch2" },
                { "data": "gps" }
            ],
            "columnDefs": [
                { "targets": [ 0 ], "visible": false, "searchable": false } ],
            "order": [[0, 'desc']]
        } );
        $('#chambre_table tbody').on( 'click', 'tr', function (evt) {
            var $table=$(evt.target).closest('table');
            if($table.attr('id').indexOf('chambre_table') > -1) {
                var $cell=$(evt.target).closest('td');
                if( $cell.index()>0){
                    if ( $(this).hasClass('selected') ) {
                        $(this).removeClass('selected');
                        $('.linked').prop('disabled', true);
                        $(btns.join(',')).addClass("disabled");
                    }
                    else {
                        dt.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                        $(btns.join(',')).removeClass("disabled");
                        if(dt.row('.selected').data() != undefined)
                        {
                            $('.linked').prop('disabled', false);
                            id_chambre = dt.row('.selected').data().id_chambre;
                        }
                    }
                }
            }
        } );

        $("#infos_terrain_show").click(function() {
            window.location.href = '?page=chambre&idchambre=' + id_chambre;
        });
    } );
</script>

<!-- injecter fichier Modal -->
<div class="modal fade" id="inject-file" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Injection fichier</h3>
                </div>
                <div class="block-content" id="inject-file-container">
                    <div class='alert alert-danger' id='message_inject_file_warning' role='alert'>
                        <p>Le fichier excel doit comporter 7 colonnes</p>
                        <p>les champs à injecter sont :</p>
                        <p>REF_CHAMBR;VILLET;SOUS-PROJET;REF_NOTE;CODE_CH1;CODE_CH2;GPS
                        </p>
                    </div>
                    <div id="fileuploader"></div>
                    <div id="inject_progress_bar" class="progress active">
                        <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Injection de fichier en cours ...</div>
                    </div>
                    <div class='alert alert-success' id='message_inject_file' role='alert'>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="close_injection_form1" class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-warning" id="inject_file_process" type="button"><i class="fa fa-check"></i> Injecter</button>
            </div>
        </div>
    </div>
</div>
<!-- END injecter fichier Modal -->