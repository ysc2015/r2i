<div id="retour_uploads">
    <div class="row items-push">
        <div class="col-md-6">
            <div class="row retourpresta2">
                <label for="stt_retour_uploader" style="margin-top: 20px;">Retour terrain</label>
                <div id="stt_retour_uploader"></div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="link_retour_stt" style="margin-top: 20px;">Lien retour terrain <!--<span class="text-danger">*</span>--></label>
            <textarea class="form-control" id="link_retour_stt" name="link_retour_stt" rows="6"></textarea>
        </div>
    </div>
    <div class="row" id="etat_retour_wrapper">
        <div id="ret_etat_retour_wrapper" class="col-md-3">
            <label for="ret_etat_retour">Etat Retour <!--<span class="text-danger">*</span>--></label>
            <select class="form-control " id="ret_etat_retour" name="ret_etat_retour">
                <option value="" selected="">Sélectionnez une valeur</option>
                <?php
                $results = SelectEtatRetour::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_etat_retour\">$result->lib_etat_retour</option>";
                }
                ?>
            </select>
        </div>
        <div id="ret_etat_retour2_wrapper" class="col-md-3">
            <label for="ret_etat_retour2">Etat Recette <!--<span class="text-danger">*</span>--></label>
            <select class="form-control " id="ret_etat_retour2" name="ret_etat_retour2">
                <option value="" selected="">Sélectionnez une valeur</option>
                <?php
                $results = SelectEtatRecette::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_etat_recette\">$result->lib_etat_recette</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <br>
    <button id="save_etat_retour" class='btn btn-info btn-sm'><span class='glyphicon glyphicon-check'>&nbsp;</span> Enregistrer</button>
    <br>
    <br>
    <div class='alert alert-success' id='message_etat_retour_save' role='alert' style="display: none;"></div>
</div>
<script>
    var uploader3_options = {
        url: "api/myot/traitement/myot_upload_retour.php",
        multiple:false,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:false,
        showDownload:true,
        allowedTypes: "pdf,xls,xlsx",
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
        uploader3_options = merge_options(defaultUploaderStrLocalisation,uploader3_options);
        uploader3 = $("#stt_retour_uploader").uploadFile(uploader3_options);
    });
    $(document).ready(function() {

        $("#save_etat_retour").click(function() {
            console.log('save_etat_retour click');

            $.ajax({
                url: "api/ot/retourpresta/update_etat_retour.php",
                dataType: "json",
                method: "POST",
                data: {
                    idsp : get('idsousprojet',ot_dt),
                    typeot : ot_dt.row('.selected').data().type_ot,
                    idtot : ot_dt.row('.selected').data().id_type_ordre_travail,
                    val : etat_retour
                }
            }).done(function (msg) {
                console.log(msg.message);
                App.showMessage(msg,'#message_etat_retour_save');
            });
        });

        $("#ret_etat_retour").change(function() {
            etat_retour = $("#ret_etat_retour").val();

        });
        $("#ret_etat_retour2").change(function() {
            etat_retour = $("#ret_etat_retour2").val();
        });

    } );
</script>