

<button id="update_project_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#update-project' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier</button>
<script>
    $(function () {
        var update;
        // Init page plugins & helpers
        uploader2 = $("#fileuploader2").uploadFile({
            //params
            url: "api/projet/projet/projet_upload_files.php",
            multiple:true,
            dragDrop:true,
            dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
            fileName: "myfile",
            autoSubmit: true,
            showDelete:true,
            showDownload:true,
            allowedTypes: "xlsx",
            //Localization
            downloadStr:"Télécharger",
            abortStr: "Annuler",
            uploadStr:"Téléchargez",
            deletelStr:"Supprimer",
            multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers sont autorisés.",
            onLoad:function(obj)
            {
                if(projet_dt.row('.selected').data() != undefined) {
                    $.ajax({
                        cache: false,
                        url: "api/file/load.php",
                        method:"POST",
                        data: {id_objet:projet_dt.row('.selected').data().id_projet,type_objet:'projet'},
                        dataType: "json",
                        success: function(data)
                        {
                            for(var i=0;i<data.length;i++)
                            {
                                obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"]);
                            }
                        }
                    });
                }
            },
            dynamicFormData: function()
            {
                var data ={
                    idp: projet_dt.row('.selected').data().id_chef_projet
                };
                return data;
            },
            afterUploadAll:function(obj) {
            },
            downloadCallback:function(filename,pd)
            {
                var arr = (filename + '').split("_");
                location.href="api/file/download.php?id="+arr[arr.length - 1];
            },
            deleteCallback: function (data, pd) {
                var arr = (data + '').split("_");
                $.ajax({
                    method: "POST",
                    url: "api/file/delete.php",
                    data: {
                        id: arr[arr.length - 1]
                    }
                }).done(function (message) {
                    console.log(message);
                });

            }
        });
    });
    $(document).ready(function() {
        $("#update_project_show").click(function() {
            update = false;
            App.activaTab('info_project_update_tab');

            uploader2.reset();
            uploader2 = $("#fileuploader2").uploadFile({
                //params
                url: "api/projet/projet/projet_upload_files.php",
                multiple:true,
                dragDrop:true,
                dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
                fileName: "myfile",
                autoSubmit: true,
                showDelete:true,
                showDownload:true,
                allowedTypes: "xlsx",
                //Localization
                downloadStr:"Télécharger",
                abortStr: "Annuler",
                uploadStr:"Téléchargez",
                deletelStr:"Supprimer",
                multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers sont autorisés.",
                onLoad:function(obj)
                {
                    if(projet_dt.row('.selected').data() != undefined) {
                        $.ajax({
                            cache: false,
                            url: "api/file/load.php",
                            method:"POST",
                            data: {id_objet:projet_dt.row('.selected').data().id_projet,type_objet:'projet'},
                            dataType: "json",
                            success: function(data)
                            {
                                for(var i=0;i<data.length;i++)
                                {
                                    obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"]);
                                }
                            }
                        });
                    }
                },
                dynamicFormData: function()
                {
                    var data ={
                        idp: projet_dt.row('.selected').data().id_chef_projet
                    };
                    return data;
                },
                afterUploadAll:function(obj) {
                },
                downloadCallback:function(filename,pd)
                {
                    var arr = (filename + '').split("_");
                    location.href="api/file/download.php?id="+arr[arr.length - 1];
                },
                deleteCallback: function (data, pd) {
                    var arr = (data + '').split("_");
                    $.ajax({
                        method: "POST",
                        url: "api/file/delete.php",
                        data: {
                            id: arr[arr.length - 1]
                        }
                    }).done(function (message) {
                        console.log(message);
                    });

                }
            });

            $("#projet_update_id_chef_projet").val(projet_dt.row('.selected').data().id_chef_projet);
            $("#projet_update_ville_nom").val(projet_dt.row('.selected').data().ville_nom);
            $("#projet_update_ville").val(projet_dt.row('.selected').data().ville).trigger("change");
            $("#projet_update_dept").val(projet_dt.row('.selected').data().trigramme_dept.split('_')[1]);
            $("#projet_update_code_site_origine").val(projet_dt.row('.selected').data().code_site_origine);
            $("#projet_update_type_site_origine").val(projet_dt.row('.selected').data().type_site_origine);
            $("#projet_update_taille").val(projet_dt.row('.selected').data().taille);
            $("#projet_update_etat_site_origine").val(projet_dt.row('.selected').data().etat_site_origine);
            $("#projet_update_date_mad_site_origine").val(projet_dt.row('.selected').data().date_mad_site_origine);
        });
    } );
</script>
<?php

include_once __DIR__."/modals/update.php";

?>