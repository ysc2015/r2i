<div class="tab-pane <?= ($value[0]=="surveyadressesterrain"?"active":"")?>" id="surveyadressesterrain_content">
    <form class="form-horizontal push-10-t push-10" id="surv_adresse_form" name="surv_adresse_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="sa_volume_adresse">Volumes Adresses <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="number" id="sa_volume_adresse" name="sa_volume_adresse" value="<?=($sousProjet->plaquesurvadr !== NULL?$sousProjet->plaquesurvadr->volume_adresse:"")?>">
                </div>
                <div class="col-md-4">
                    <label for="sa_date_debut">Date de Début <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="date" id="sa_date_debut" name="sa_date_debut" value="<?=($sousProjet->plaquesurvadr !== NULL?$sousProjet->plaquesurvadr->date_debut:"")?>">
                </div>
                <div class="col-md-4">
                    <label for="sa_date_ret_prevue">Date ret Prev <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="date" id="sa_date_ret_prevue" name="sa_date_ret_prevue" value="<?=($sousProjet->plaquesurvadr !== NULL?$sousProjet->plaquesurvadr->date_ret_prevue:"")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="sa_duree">Durée(jours) <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control" type="text" id="sa_duree" name="sa_duree" value="<?=($sousProjet->plaquesurvadr !== NULL?$sousProjet->plaquesurvadr->duree:"")?>">
                </div>
                <div class="col-md-4">
                    <label for="sa_intervenant">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="sa_intervenant" name="sa_intervenant">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->plaquesurvadr!==NULL && $sousProjet->plaquesurvadr->intervenant==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="sa_ok">OK <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="sa_ok" name="sa_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->plaquesurvadr!==NULL && $sousProjet->plaquesurvadr->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-6">
                    <div class="row" style="padding-left: 10px;">
                        <label for="fileuploader_survey_bei">Fichier(s) adresses terrain (bei)</label>
                        <div id="fileuploader_survey_bei"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row" style="padding-left: 10px;">
                        <label for="fileuploader_survey_vpi">Fichier(s) adresses terrain traité (retour vpi)</label>
                        <div id="fileuploader_survey_vpi"></div>
                    </div>
                    <div class="row" id="survey_vip_files" style="padding-left: 10px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_gestion_plaque_survey_adresse" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_plaque_survey_adresse_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <button id="id_sous_projet_plaque_survey_adresse_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_plaque_survey_adresse_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>

                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var survadr_formdata = {};
    var survey_bei_uploader_options = {
        url: "api/sousprojet/preparationplaque/upload_bei_survey_file.php",
        multiple:true,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "xlsx",
        onLoad:function(obj)
        {
            $.ajax({
                cache: false,
                url: "api/sousprojet/preparationplaque/load.php",
                method:"POST",
                data: {id_sous_projet:get('idsousprojet'),type_objet:'bei_survey'},
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
    var survey_vpi_uploader_options = {
        url: "api/sousprojet/preparationplaque/upload_vpi_survey_file.php",
        multiple:true,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "xlsx",
        onLoad:function(obj)
        {
            $.ajax({
                cache: false,
                url: "api/sousprojet/preparationplaque/load.php",
                method:"POST",
                data: {id_sous_projet:get('idsousprojet'),type_objet:'vpi_survey'},
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
        survey_bei_uploader_options = merge_options(defaultUploaderStrLocalisation,survey_bei_uploader_options);
        survey_bei_uploader = $("#fileuploader_survey_bei").uploadFile(survey_bei_uploader_options);

        survey_vpi_uploader_options = merge_options(defaultUploaderStrLocalisation,survey_vpi_uploader_options);
        survey_vpi_uploader = $("#fileuploader_survey_vpi").uploadFile(survey_vpi_uploader_options);
    });
    $(document).ready(function() {
        var typeetape = "sous_projet_plaque_survey_adresse";
        var variable_etape = "SousProjetPlaqueSurveyAdresse";

        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"surveyadressesterrain_href","Survey Adresses Terrain: ");

        $("#id_sous_projet_plaque_survey_adresse_btn_osa").click(function () {
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape);
        });
        $("#id_sous_projet_plaque_survey_adresse_list_tache").click(function () {
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);
        });


        $('#surv_adresse_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            survadr_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_plaque_survey_adresse_btn").click(function () {

            $("#message_gestion_plaque_survey_adresse").fadeOut();
            $("#preparationplaque_block").toggleClass('block-opt-refresh');

            for (var key in survadr_formdata) {
                survadr_formdata[key] = $('#'+key).val();
            }
            survadr_formdata['ids'] = get('idsousprojet');
            survadr_formdata['sa_duree'] = $("#sa_duree").val();

            $.ajax({
                method: "POST",
                url: "api/sousprojet/preparationplaque/survadr_save.php",
                data: survadr_formdata
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                if(obj.error == 0) {
                    $("#sa_duree").val(obj.duree);
                }
                $("#preparationplaque_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_gestion_plaque_survey_adresse');
            });
        });
    } );
</script>