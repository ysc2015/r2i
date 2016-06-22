<div class="row">
    <div class="block block-themed">
        <div class="block-header bg-primary">
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
            <table id="chambre_table"></table>
            <div id="chambre_tablePager"></div>
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
                var id_chambre = 0;
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
    }
    });
    $("#chambre_table").jqGrid({
                //height: 100,
                width: null,
                shrinkToFit: false,
                responsive: true,
                //autoidth: true,
                url: 'api/ot/chambre_liste.php?id=' + <?=$_GET['idot']?>,
            datatype: "json",

            colNames: ['chambre_id', 'ref_chambre', 'villet', 'sous_projet', 'ref_note', 'code_ch1', 'code_ch2', 'gps'],
            colModel: [
        {name: 'chambre_id', index: 'chambre_id'},
        {name: 'ref_chambre', index: 'ref_chambre'},
        {name: 'villet', index: 'villet'},
        {name: 'sous_projet', index: 'sous_projet'},
        {name: 'ref_note', index: 'ref_note'},
        {name: 'code_ch1', index: 'code_ch1'},
        {name: 'code_ch2', index: 'code_ch2'},
        {name: 'gps', index: 'gps'},
    ],
            rowNum: 5,
            rowList: [50, 100, 200, 300, 400],
            pager: '#chambre_tablePager',
            sortname: 'chambre_id',
            viewrecords: true,
            sortorder: "asc",
            multiselect: false,
//            caption: "Chambre OT",
            onSelectRow: function (id) {
        $(btns.join(',')).removeClass("disabled");
        var ligne = $("#chambre_table").jqGrid('getRowData', id);
        id_chambre = ligne.chambre_id;
        console.log(id_chambre);
    },
    onUnSelectRow: function () {
        $(btns.join(',')).addClass("disabled");
        id_chambre = 0;
        console.log(id_chambre);
    },
    beforeSelectRow: function (rowid, e) {
        var $self = $(this), selectedRowid = $self.jqGrid("getGridParam", "selrow");

        if (selectedRowid === rowid) {
            $self.jqGrid("resetSelection");
        } else {
            $self.jqGrid("setSelection", rowid, true, e);
        }

        return false; // don't process the standard selection
    }
    }).navGrid('#pager_grid_o', {add: true, edit: true, del: true});

    $("#infos_terrain_show").click(function() {
        window.location.href = '?page=chambre&idchambre=' + id_chambre;
    });
    } );
</script>

<!-- ajouter projet Modal -->
<div class="modal fade" id="inject-file" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Ajouter sous projet</h3>
                </div>
                <div class="block-content" id="inject-file-container">
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
<!-- END ajouter projet Modal -->