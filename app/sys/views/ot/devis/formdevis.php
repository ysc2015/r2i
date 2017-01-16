<script src="../../../../../r2i/editablegrid-master/editablegrid.js"></script>
<!-- [DO NOT DEPLOY] --> <script src="../../../../../r2i/editablegrid-master/editablegrid_renderers.js" ></script>
<!-- [DO NOT DEPLOY] --> <script src="../../../../../r2i/editablegrid-master/editablegrid_editors.js" ></script>
<!-- [DO NOT DEPLOY] --> <script src="../../../../../r2i/editablegrid-master/editablegrid_validators.js" ></script>
<!-- [DO NOT DEPLOY] --> <script src="../../../../../r2i/editablegrid-master/editablegrid_utils.js" ></script>

<script src="../../r2i/assets/js/edit_devis_js.js" ></script>
<link rel="stylesheet" type="text/css" href="../../../../r2i/editablegrid-master/examples/full/css/edit_devis_css.css" media="screen"/>

<div class="row">
    <div class="col-md-12">
        <button id="download_devis" class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-download'>&nbsp;</span> Télécharger devis</button>
    </div>
</div>
<br>
<form class="form-horizontal push-10-t push-10" id="devis_detail_form" name="devis_detail_form">
    <div id="wrap"  class="modal fade" role="dialog" aria-hidden="false" tabindex="-1"  >
<div class="modal-dialog">
    <div class="modal-content">
        <div class="block block-themed block-transparent remove-margin-b">
            <div class="block-header bg-primary">
                <ul class="block-options">
                    <li>
                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">modifier ordre de travail</h3>
            </div>
            <div class="block-content">
                <div id="message"></div>

                <div id="tablecontent"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
            </div>
        </div>

    </div>
</div>

    </div>
<div class="row items-push">
    <div class="col-md-12">
        <button id="id_devis_edit_btn" class="btn btn-info btn-sm" type="button"  data-toggle="modal" data-target="#wrap" data-backdrop="static" data-keyboard="false"><i id="hdf0454ff" class="fa fa-plus push-5-r"></i> Editer devis</button>
     </div>

</div>
    </form>
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
    var devis_formdata = {};
    var uploader1_options = {
        url: "api/ot/devis/upload_devis_bon_cmd.php",
        multiple:true,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "pdf",
        onLoad:function(obj)
        {
            if(id_devis > 0) {
                $.ajax({
                    cache: false,
                    url: "api/ot/devis/load_bon_cmd.php",
                    method:"POST",
                    data: {iddevis:id_devis},
                    dataType: "json",
                    success: function(data)
                    {
                        for(var i=0;i<data.length;i++)
                        {
                            obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"],data[i]["id"]);
                        }
                    }
                });
            }
        },
        dynamicFormData: function()
        {
            var data ={
                iddevis: id_devis
            };
            return data;
        },
        afterUploadAll:function(obj) {
        },
        downloadCallback:function(data,pd)
        {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            location.href="api/file/download.php?id="+id;
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
        multiple:true,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "pdf",
        onLoad:function(obj)
        {
            if(id_devis > 0) {
                $.ajax({
                    cache: false,
                    url: "api/ot/devis/load_devis_autre.php",
                    method:"POST",
                    data: {iddevis:id_devis},
                    dataType: "json",
                    success: function(data)
                    {
                        for(var i=0;i<data.length;i++)
                        {
                            obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"],data[i]["id"]);
                        }
                    }
                });
            }
        },
        dynamicFormData: function()
        {
            var data ={
                iddevis: id_devis
            };
            return data;
        },
        afterUploadAll:function(obj) {
        },
        downloadCallback:function(data,pd)
        {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            location.href="api/file/download.php?id="+id;
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
        uploader1_options = merge_options(defaultUploaderStrLocalisation,uploader1_options);
        uploader1 = $("#devis_bon_cmd_uploader").uploadFile(uploader1_options);

        uploader2_options = merge_options(defaultUploaderStrLocalisation,uploader2_options);
        uploader2 = $("#devis_autre_uploader").uploadFile(uploader2_options);
    });
    $(document).ready(function() {
        id_devis_edit_btn
        $("#id_devis_edit_btn").click(function() {
            console.log(id_devis);
            editableGrid.onloadJSON("api/ot/devis/get_details_devis.php?iddevis="+id_devis);
        });
        $("#download_devis").click(function() {
            if(ot_dt.row('.selected').data()!== undefined) {
                location.href="api/file/parserfile.php?id="+id_devis+"&idsp="+ot_dt.row('.selected').data().id_sous_projet+"&idtot="+ot_dt.row('.selected').data().id_type_ordre_travail;
            }
        });


    } );
</script>