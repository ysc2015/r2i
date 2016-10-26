<div class="tab-pane <?= ($value[0]=="daiguillage"?"active":"")?>" id="daiguillage_content">
    <form class="form-horizontal push-10-t push-10" id="dist_aiguillage_form" name="dist_aiguillage_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="da_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="da_intervenant_be" name="da_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributionaiguillage!==NULL && $sousProjet->distributionaiguillage->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="da_plans">Plans <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="da_plans" name="da_plans">
                        <option value="" selected="">Sélectionnez état plans</option>
                        <?php
                        $results = SelectEtatPlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_plan\" ". ($sousProjet->distributionaiguillage!==NULL && $sousProjet->distributionaiguillage->plans==$result->id_etat_plan ?"selected": "")." >$result->lib_etat_plan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="da_controle_plans">Contrôle des plans <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="da_controle_plans" name="da_controle_plans">
                        <option value="" selected="">Sélectionnez type controle</option>
                        <?php
                        $results = SelectControlePlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_plan\" ". ($sousProjet->distributionaiguillage!==NULL && $sousProjet->distributionaiguillage->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="da_date_transmission_plans">Date Transmission Plans <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="da_date_transmission_plans" name="da_date_transmission_plans" value="<?=($sousProjet->distributionaiguillage !== NULL?$sousProjet->distributionaiguillage->date_transmission_plans:"")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <button id="id_lineaire_distribution_aiguillage_btn" class="btn btn-danger" type="button"><i id="hdfd0454ff" class="fa fa-plus push-5-r"></i> Linéaire de réseau</button>
            <div id="da_lineare_groupe" style="border-left: dashed 1px #000;border-right: dashed 1px #000;border-bottom: dashed 1px #000;margin-top: 5px;padding: 5px;display: none">
                <label><span class="label label-info">Câbles </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="da_lineaire1">câble 288FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput3" type="number" id="da_lineaire1" name="da_lineaire1" value="<?=($sousProjet->distributionaiguillage !== NULL?$sousProjet->distributionaiguillage->lineaire1:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="ta_lineaire_reseau">câble 144FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput3" type="number" id="da_lineaire2" name="da_lineaire2" value="<?=($sousProjet->distributionaiguillage !== NULL?$sousProjet->distributionaiguillage->lineaire2:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                        <label for="ta_lineaire_reseau">câble 72FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput3" type="number" id="da_lineaire3" name="da_lineaire3" value="<?=($sousProjet->distributionaiguillage !== NULL?$sousProjet->distributionaiguillage->lineaire3:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                        <label for="ta_lineaire_reseau">câble 48FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput3" type="number" id="da_lineaire4" name="da_lineaire4" value="<?=($sousProjet->distributionaiguillage !== NULL?$sousProjet->distributionaiguillage->lineaire4:"")?>">
                    </div>
                </div>
                <label><span class="label label-warning">Boites </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="ta_lineaire_reseau">BPE 288FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput3" type="number" id="da_lineaire5" name="da_lineaire5" value="<?=($sousProjet->distributionaiguillage !== NULL?$sousProjet->distributionaiguillage->lineaire5:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="ta_lineaire_reseau">BPE 144FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput3" type="number" id="da_lineaire6" name="da_lineaire6" value="<?=($sousProjet->distributionaiguillage !== NULL?$sousProjet->distributionaiguillage->lineaire6:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                        <label for="ta_lineaire_reseau">BPE 72FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput3" type="number" id="da_lineaire7" name="da_lineaire7" value="<?=($sousProjet->distributionaiguillage !== NULL?$sousProjet->distributionaiguillage->lineaire7:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                        <label for="ta_lineaire_reseau">BPE 48FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput3" type="number" id="da_lineaire8" name="da_lineaire8" value="<?=($sousProjet->distributionaiguillage !== NULL?$sousProjet->distributionaiguillage->lineaire8:"")?>">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="da_id_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="da_id_entreprise" name="da_id_entreprise">
                        <option value="" selected="">Sélectionnez une entreprise</option>
                        <?php
                        $results = EntrepriseSTT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->distributionaiguillage!==NULL && $sousProjet->distributionaiguillage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="da_date_aiguillage">Date de début d’aiguillage <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="da_date_aiguillage" name="da_date_aiguillage" value="<?=($sousProjet->distributionaiguillage !== NULL?$sousProjet->distributionaiguillage->date_aiguillage:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="da_duree">Durée(jours) <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="number" id="da_duree" name="da_duree" value="<?=($sousProjet->distributionaiguillage !== NULL?$sousProjet->distributionaiguillage->duree:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="da_controle_demarrage_effectif">Contrôle démarrage effectif <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="da_controle_demarrage_effectif" name="da_controle_demarrage_effectif">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectControleDemarrageEffectif::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_demarrage_effectif\" ". ($sousProjet->distributionaiguillage!==NULL && $sousProjet->distributionaiguillage->controle_demarrage_effectif==$result->id_controle_demarrage_effectif ?"selected": "")." >$result->lib_controle_demarrage_effectif</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="da_date_retour">Date Retour <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="da_date_retour" name="da_date_retour" value="<?=($sousProjet->distributionaiguillage !== NULL?$sousProjet->distributionaiguillage->date_retour:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="da_etat_retour">Etat Retour <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="da_etat_retour" name="da_etat_retour">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatRetour::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_retour\" ". ($sousProjet->distributionaiguillage!==NULL && $sousProjet->distributionaiguillage->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="da_ok">OK <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="da_ok" name="da_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->distributionaiguillage!==NULL && $sousProjet->distributionaiguillage->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
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
                        <label for="da_fileuploader_chambre">Fichier(s) chambres</label>
                        <div id="da_fileuploader_chambre"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_distribution_aiguillage" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-12">
                    <button id="id_sous_projet_distribution_aiguillage_btn" class="btn btn-primary btn-sm" type="button"><i class="fa fa-check push-5-r"></i> Enregistrer</button>
                    <button id="id_sous_projet_distribution_aiguillage_ot_btn" class="btn btn-info btn-sm" type="button"><i class="fa fa-calendar-o push-5-r"></i> Ordre de travail</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var daiguillage_formdata = {};
    var daiguillage_chambre_uploader_options = {
        url: "api/sousprojet/reseaudistribution/upload_aiguillage_chambre.php",
        multiple:false,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        showAbort:true,
        allowedTypes: "xlsx",
        /*maxFileCount: 1,*/
        onLoad:function(obj)
        {
            $.ajax({
                cache: false,
                url: "api/sousprojet/reseaudistribution/load.php",
                method:"POST",
                data: {id_sous_projet:get('idsousprojet'),type_objet:'distribution_aiguillage_chambre'},
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
        daiguillage_chambre_uploader_options = merge_options(defaultUploaderStrLocalisation,daiguillage_chambre_uploader_options);
        daiguillage_chambre_uploader_options.abortStr = 'Injection en cours ...';
        daiguillage_chambre_uploader = $("#da_fileuploader_chambre").uploadFile(daiguillage_chambre_uploader_options);
    });
    $(document).ready(function() {
        $('#dist_aiguillage_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            daiguillage_formdata[$( this ).attr('name')] = $( this).val();
        });
        if(checkLinears('.lineareInput3')) {
            $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-danger");
            $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-success");
        } else {
            $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-success");
            $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-danger");
        }

        $("#id_sous_projet_distribution_aiguillage_btn").click(function () {

            $("#message_distribution_aiguillage").fadeOut();
            $("#rdistribution_block").toggleClass('block-opt-refresh');

            for (var key in daiguillage_formdata) {
                daiguillage_formdata[key] = $('#'+key).val();
            }
            daiguillage_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseaudistribution/aiguillage_save.php",
                data: daiguillage_formdata
            }).done(function (msg) {
                $("#rdistribution_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_distribution_aiguillage');
            });
        });

        $("#id_lineaire_distribution_aiguillage_btn").click(function () {

            if ( $( "#da_lineare_groupe" ).is( ":hidden" ) ) {
                $("#hdfd0454ff").removeClass("fa-plus");
                $("#hdfd0454ff").addClass("fa-minus");
                $( "#da_lineare_groupe" ).show( "fast" );
            } else {
                $( "#da_lineare_groupe" ).slideUp();
                $("#hdfd0454ff").removeClass("fa-minus");
                $("#hdfd0454ff").addClass("fa-plus");
            }
        });
        $('.lineareInput3').on('input', function() {
            if(checkLinears('.lineareInput3')) {
                $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-danger");
                $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-success");
            } else {
                $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-success");
                $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-danger");
            }
        });

        $("#id_sous_projet_distribution_aiguillage_ot_btn").click(function () {
            $.ajax({
                method: "POST",
                url: "api/ot/ot/check_ot.php",
                data: {
                    ids : get('idsousprojet'),
                    tentree : 'distributionaiguillage'
                }
            }).done(function (msg) {
                App.showMessage(msg, '#message_distribution_aiguillage');
                var obj = JSON.parse(msg);
                console.log(msg);
                if(obj.error == 0) {
                    document.location.href = '?page=ot&idsousprojet='+get('idsousprojet')+'&tentree=distributionaiguillage';
                }
            });
        });
    } );
</script>