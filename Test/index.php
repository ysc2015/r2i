<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>

    <script src="jQuery-2.1.4.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <script src="icheck-1.x/icheck.min.js"></script>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="icheck-1.x/skins/all.css">


    <style type="text/css">
        #redBorder {
            border-right-color: red;
            border-right-width: medium;
        }
    </style>

</head>
<body>


<div class="row items-push">
    <div class="form-group">
        <div class="col-md-6">
            <div class="row" style="padding-left: 10px;">
                <label for="ta_fileuploader_chambre">Fichier(s) bkp</label>
                <div id="ta_fileuploader_chambre"></div>
            </div>
        </div>
    </div>
</div>

<script>
    var taiguillage_chambre_uploader_options = {
        url: "api/sousprojet/reseautransport/upload_aiguillage_chambre.php",
        multiple:false,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        showAbort:true,
        allowedTypes: "xlsx,xls",
        /*maxFileCount: 1,*/
        onLoad:function(obj)
        {
            $.ajax({
                cache: false,
                url: "api/sousprojet/reseautransport/load.php",
                method:"POST",
                data: {id_sous_projet:get('idsousprojet'),type_objet:'transport_aiguillage_chambre'},
                dataType: "json",
                success: function(data)
                {
                    for(var i=0;i<data.length;i++)
                    {
                        obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"],data[i]["id"]);
                    }
                }
            });
        },
        dynamicFormData: function()
        {
            var data ={
                idsp: get('idsousprojet')
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
    };
    $(function () {
        taiguillage_chambre_uploader_options = merge_options(defaultUploaderStrLocalisation,taiguillage_chambre_uploader_options);
        taiguillage_chambre_uploader_options.abortStr = 'Injection en cours ...';
        taiguillage_chambre_uploader = $("#ta_fileuploader_chambre").uploadFile(taiguillage_chambre_uploader_options);
    });
    $(document).ready(function () {
        $('#addNewTracon').click(function (){
        });
    });
</script>


</body>
</html>
