<button id="add_project_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-project' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter projet</button>
<script>
    var uploader_options = {
        url: "api/projet/projet/projet_upload_files.php",
        multiple:true,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showAbort:false,
        allowedTypes: "xlsx",
        dynamicFormData: function()
        {
            var data ={
                idp: id
            };
            return data;
        },
        onSubmit:function(files)
        {
            $("#next-btn").attr('disabled','disabled');
            $("#close-project-add-form").attr('disabled','disabled');
        },
        afterUploadAll:function(obj) {
            $("#next-btn").removeAttr('disabled');
            $("#close-project-add-form").removeAttr('disabled');
        },
        deleteCallback: function(data,pd)
        {
            var obj = JSON.parse(data);
            $.ajax({
                method: "POST",
                url: "api/file/delete.php",
                data: {
                    id: obj[0].id
                }
            }).done(function (message) {
                //console.log(message);
            });
        }
    };
    $(function () {
        // Init page plugins & helpers
        jQuery('#ville').select2({
            autocomplete: true
        });
        uploader_options = merge_options(defaultUploaderStrLocalisation,uploader_options);
        uploader = $("#fileuploader").uploadFile(uploader_options);
    });
    $(document).ready(function() {

        $("#add_project_show").click(function() {
            $("#ville").select2('val', 'All');
            $("#trigramme").html('PLA00_');
            $("#info_project_form")[0].reset();
            App.activaTab('validation-step1');
            uploader.reset();
        });

    } );
</script>
<?php

include_once __DIR__."/modals/add.php";

?>