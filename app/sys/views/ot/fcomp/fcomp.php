<div class="row items-push">
    <div class="form-group">
        <div class="col-md-6">
            <label for="other-files">Documents livrables complementaires </label>
            <div id="fcomp_uploader_wrapper">
                <div id="fcomp_uploader"></div>
            </div>
        </div>
    </div>
</div>

<script>
    var fcomp_uploader_options = {
        url: "api/ot/ot/upload_fcomp_file.php",
        multiple:false,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "pdf,zip,rar",
        onLoad:function(obj)
        {
            if(ot_dt.row('.selected').data() !== undefined) {
                $.ajax({
                    cache: false,
                    url: "api/ot/ot/load_fcomp.php",
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
                idot: ot_dt.row('.selected').data().id_ordre_de_travail,
                idsp:ot_dt.row('.selected').data().id_sous_projet
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
        fcomp_uploader_options = merge_options(defaultUploaderStrLocalisation,fcomp_uploader_options);
        fcomp_uploader_options.showDelete = true;
        fcomp_uploader = $("#fcomp_uploader").uploadFile(fcomp_uploader_options);
    });
    $(document).ready(function() {
    } );
</script>