
<button id="update_project_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#update-project' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier</button>
<script>
    var uploader2_options = {
        url: "api/projet/projet/projet_upload_files.php",
        multiple:true,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "xlsx",
        onLoad:function(obj)
        {
            if(projet_dt.row('.selected').data() != undefined) {
                $.ajax({
                    cache: false,
                    url: "api/projet/projet/projet_load_sd_files.php",
                    method:"POST",
                    data: {id_projet:projet_dt.row('.selected').data().id_projet,type_objet:'fichier_contour'},
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
                idp: projet_dt.row('.selected').data().id_projet
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
        jQuery('#projet_update_ville').select2({
            autocomplete: true
        });
        jQuery('#projet_update_code_site_origine').select2({
            autocomplete: true
        });
        var update;
        // Init page plugins & helpers
        uploader2_options = merge_options(defaultUploaderStrLocalisation,uploader2_options);
        uploader2 = $("#fileuploader2").uploadFile(uploader2_options);
    });
    $(document).ready(function() {
        $("#update_project_show").click(function() {
            update = false;
            App.activaTab('info_project_update_tab');

            uploader2.reset();
            uploader2 = $("#fileuploader2").uploadFile(uploader2_options);

            $("#projet_update_id_chef_projet").val(projet_dt.row('.selected').data().id_chef_projet);
            $("#projet_update_ville_nom").val(projet_dt.row('.selected').data().ville_nom);
            $("#projet_update_ville").val(projet_dt.row('.selected').data().ville).trigger("change");
            $("#projet_update_dept").val(projet_dt.row('.selected').data().trigramme_dept.split('_')[1]);
            $("#projet_update_code_site_origine").val(projet_dt.row('.selected').data().id_nro).trigger("change");
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