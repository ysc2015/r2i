<button id="add_project_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-project' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter projet</button>
<script>
    $(function () {
        // Init page plugins & helpers
        App.initHelpers(['select2']);
        uploader = $("#fileuploader").uploadFile({
            url: "api/projet/projet/projet_upload_files.php",
            multiple:true,
            dragDrop:true,
            dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
            fileName: "myfile",
            autoSubmit: true,
            showDelete:true,
            showAbort:false,
            allowedTypes: "xlsx",
            //Localization
            downloadStr:"Télécharger",
            abortStr: "Annuler",
            uploadStr:"Téléchargez",
            deletelStr:"Supprimer",
            cancelStr:"Annuler",
            multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers sont autorisés.",
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
                console.log(data);
                /*for(var i=0;i<data.length;i++)
                {
                    $.post("delete.php",{op:"delete",name:data[i]},
                        function(resp, textStatus, jqXHR)
                        {
                            //Show Message
                            alert("File Deleted");
                        });
                }
                pd.statusbar.hide(); //You choice to hide/not.*/

            }
        });
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