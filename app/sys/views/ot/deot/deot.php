<label for="other-files">Fichiers DE </label>
<div id="other_files_uploader"></div>
<script>
    var other_files_uploader_options = {
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
                idot: ot_dt.row('.selected').data().id_ordre_de_travail,
                idsp: ot_dt.row('.selected').data().id_sous_projet,
                idtot: ot_dt.row('.selected').data().id_type_ordre_travail
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
        other_files_uploader_options = merge_options(defaultUploaderStrLocalisation,other_files_uploader_options);
        other_files_uploader_options.showDelete = false;
        other_files_uploader = $("#other_files_uploader").uploadFile(other_files_uploader_options);
    });
    $(document).ready(function() {
    } );
</script>