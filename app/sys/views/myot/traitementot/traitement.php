<div class="row">
    <div class="col-md-12">
        <button id="validate_start_ot" class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-check'>&nbsp;</span> Valider démarrage effectif des travaux</button>
    </div>
</div>
<div class='alert alert-success' id='message_ot_statut' role='alert' style="display: none;">
</div>
<div id="retour_uploads">
    <div class="row items-push">
        <div class="col-md-6">
            <label for="devis_bon_cmd_uploader" style="margin-top: 20px;">Upload retour terrain</label>
            <div id="stt_retour_uploader"></div>
        </div>
        <div class="col-md-6">
            <label for="comment_stt" style="margin-top: 20px;">Lien retour terrain <!--<span class="text-danger">*</span>--></label>
            <textarea class="form-control" id="comment_stt" name="comment_stt" rows="6"></textarea>
        </div>
    </div>
</div>
<br><br>
<button id="snk_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#snk-show' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-check'>&nbsp;</span> Compléter SNK</button>
<button id="foa_show" class='btn btn-info btn-sm' data-toggle="modal" data-target='#foa-show' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-check'>&nbsp;</span> Compléter FOA</button>
<!-- SNK Modal -->
<div class="modal fade" id="snk-show"  role="dialog" aria-hidden="true"><!--tabindex="-1"-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button id="close-project-add-form" data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Menu SNK</h3>
                </div>
                <div class="block-content">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SNK Modal -->
<!-- FOA Modal -->
<div class="modal fade" id="foa-show"  role="dialog" aria-hidden="true"><!--tabindex="-1"-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button id="close-project-add-form" data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Menu FOA</h3>
                </div>
                <div class="block-content">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END FOA Modal -->
<script>
    var uploader3_options = {
        url: "api/myot/traitement/myot_upload_retour.php",
        multiple:false,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "pdf",
        onLoad:function(obj)
        {
            if(ot_dt.row('.selected').data() !== undefined) {
                console.log(ot_dt.row('.selected').data().id_ordre_de_travail);
                $.ajax({
                    cache: false,
                    url: "api/myot/traitement/load_retour_stt.php",
                    method:"POST",
                    data: {idot:ot_dt.row('.selected').data().id_ordre_de_travail},
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
                idot: ot_dt.row('.selected').data().id_ordre_de_travail
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
        uploader3_options = merge_options(defaultUploaderStrLocalisation,uploader3_options);
        uploader3_options.showDelete = false;
        uploader3 = $("#stt_retour_uploader").uploadFile(uploader3_options);
    });
    $(document).ready(function() {

        $("#validate_start_ot").click(function() {
            if(ot_dt.row('.selected').data()!== undefined) {
                setOtStatus(ot_dt.row('.selected').data().id_ordre_de_travail,5,'#message_ot_statut',ot_dt);//statut 5 : En cours de Traitement
            }
        });

    } );
</script>