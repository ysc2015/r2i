<div class="row">
    <div class="col-md-12">
        <button id="download_devis" class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-download'>&nbsp;</span> Télécharger devis</button>
    </div>
</div>
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

        $("#download_devis").click(function() {
            if(ot_dt.row('.selected').data()!== undefined) {
                location.href="api/file/parserfile.php?id="+id_res+"&idsp="+ot_dt.row('.selected').data().id_sous_projet+"&idtot="+ot_dt.row('.selected').data().id_type_ordre_travail;
            }
        });

    } );
</script>