<div class="tab-pane <?= ($value[0]=="draccordements"?"active":"")?>" id="draccordements_content">
    <form class="form-horizontal push-10-t push-10"  id="dist_raccord_form" name="dist_raccord_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dr_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dr_intervenant_be" name="dr_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dr_preparation_pds">Préparation PDS <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dr_preparation_pds" name="dr_preparation_pds">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->preparation_pds==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dr_controle_plans">Contrôle des plans <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dr_controle_plans" name="dr_controle_plans">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectControlePlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_plan\" ". ($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dr_date_transmission_pds">Date Transmission PDS <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="dr_date_transmission_pds" name="dr_date_transmission_pds" value="<?=($sousProjet->distributionraccordement !== NULL ? $sousProjet->distributionraccordement->date_transmission_pds : "")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dr_id_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dr_id_entreprise" name="dr_id_entreprise">
                        <option value="" selected="">Sélectionnez une entreprise</option>
                        <?php
                        $results = EntrepriseSTT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dr_date_racco">Date Racco <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="dr_date_racco" name="dr_date_racco"  value="<?=($sousProjet->distributionraccordement !== NULL ? $sousProjet->distributionraccordement->date_racco : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dr_duree">Durée <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="number" id="dr_duree" name="dr_duree" value="<?=($sousProjet->distributionraccordement !== NULL ? $sousProjet->distributionraccordement->duree : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dr_controle_demarrage_effectif">Contrôle démarrage effectif <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dr_controle_demarrage_effectif" name="dr_controle_demarrage_effectif">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectControleDemarrageEffectif::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_demarrage_effectif\" ". ($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->controle_demarrage_effectif==$result->id_controle_demarrage_effectif ?"selected": "")." >$result->lib_controle_demarrage_effectif</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dr_date_retour">Date Retour <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="dr_date_retour" name="dr_date_retour" value="<?=($sousProjet->distributionraccordement !== NULL ? $sousProjet->distributionraccordement->date_retour : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dr_etat_retour">Etat Retour <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dr_etat_retour" name="dr_etat_retour">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatRetour::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_retour\" ". ($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dr_ok">OK <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dr_ok" name="dr_ok">
                        <option value="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
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
                        <label for="dr_fileuploader_chambre">Fichier(s) chambres</label>
                        <div id="dr_fileuploader_chambre"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row" style="padding-left: 10px;">
                        <label for="dr_fileuploader_pboite">Fichier(s) plans de boites</label>
                        <div id="dr_fileuploader_pboite"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_distribution_raccordements" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_distribution_raccordements_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <button id="id_sous_projet_distribution_raccord_ot_btn" class="btn btn-info btn-sm" type="button"><i class="fa fa-calendar-o push-5-r"></i> Ordre de travail</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var draccord_formdata = {};
    var draccord_chambre_uploader_options = {
        url: "api/sousprojet/reseaudistribution/upload_raccord_chambre.php",
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
                data: {id_sous_projet:get('idsousprojet'),type_objet:'distribution_raccord_chambre'},
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
    var draccord_pboite_uploader_options = {
        url: "api/sousprojet/reseaudistribution/upload_pboite_file.php",
        multiple:true,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "xlsx,xls",
        onLoad:function(obj)
        {
            $.ajax({
                cache: false,
                url: "api/sousprojet/reseaudistribution/load.php",
                method:"POST",
                data: {id_sous_projet:get('idsousprojet'),type_objet:'distribution_racoord_pboite'},
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

            location.href="api/file/parserfile.php?id="+id;

            /*$('#draccord_pboite_table tbody').html('');
            $('#draccord-pboite-modal').modal('show');
            $("#draccord-pboite-block").toggleClass('block-opt-refresh');

            $.ajax({
                cache: false,
                url: "api/fileboiteparser/get_plan_boite_infos.php",
                method:"POST",
                data: {id:id},
                dataType: "json",
                success: function(data)
                {
                    $('#draccord_pboite_table tbody').append('');
                    for(var i = 0 ; i < data.length ; i++) {
                        html = '<tr><td>' +
                            data[i].name + '</td><td>' +
                            data[i].occurence_e + '</td><td>' +
                            data[i].cable_en_passage + '</td>';
                        $('#draccord_pboite_table tbody').append(html);
                    }
                }
            }).done(function (msg) {
                $("#draccord-pboite-block").removeClass('block-opt-refresh');
            });*/
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
        draccord_chambre_uploader_options = merge_options(defaultUploaderStrLocalisation,draccord_chambre_uploader_options);
        draccord_chambre_uploader_options.abortStr = 'Injection en cours ...';
        draccord_chambre_uploader = $("#dr_fileuploader_chambre").uploadFile(draccord_chambre_uploader_options);

        draccord_pboite_uploader_options = merge_options(defaultUploaderStrLocalisation,draccord_pboite_uploader_options);
        draccord_pboite_uploader_options.downloadStr = 'Téléchargez devis';
        draccord_pboite_uploader = $("#dr_fileuploader_pboite").uploadFile(draccord_pboite_uploader_options);
    });
    $(document).ready(function() {
        $('#dist_raccord_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            draccord_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_distribution_raccordements_btn").click(function () {

            $("#message_distribution_raccordements").fadeOut();
            $("#rdistribution_block").toggleClass('block-opt-refresh');

            for (var key in draccord_formdata) {
                draccord_formdata[key] = $('#'+key).val();
            }
            draccord_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseaudistribution/raccord_save.php",
                data: draccord_formdata
            }).done(function (msg) {
                $("#rdistribution_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_distribution_raccordements');
            });
        });
        $("#id_sous_projet_distribution_raccord_ot_btn").click(function () {
            $.ajax({
                method: "POST",
                url: "api/ot/ot/check_ot.php",
                data: {
                    ids : get('idsousprojet'),
                    tentree : 'distributiontirage'
                }
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                console.log(msg);
                if(obj.error == 0) {
                    document.location.href = '?page=ot&idsousprojet='+get('idsousprojet')+'&tentree=distributiontirage';
                } else {
                    App.showMessage(msg, '#message_distribution_raccordements');
                }
            });
        });
    } );
</script>
<!-- plans boite Modal -->
<div class="modal fade" id="draccord-pboite-modal"  role="dialog" aria-hidden="true"><!--tabindex="-1"-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b" id="draccord-pboite-block">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Infos plans boite</h3>
                </div>
                <div class="block-content table-responsive">
                    <table id="draccord_pboite_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Occurences (E)</th>
                            <th>Cable en passage</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Occurences (E)</th>
                            <th>Cable en passage</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END plans boite Modal -->