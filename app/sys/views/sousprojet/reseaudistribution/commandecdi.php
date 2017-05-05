<div class="tab-pane <?= ($value[0]=="commandecdi"?"active":"")?>" id="commandecdi_content">
    <form class="form-horizontal push-10-t push-10" id="dist_cmdcdi_form" name="dist_cmdcdi_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dcc_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="dcc_intervenant_be" name="dcc_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributioncmdcdi!==NULL && $sousProjet->distributioncmdcdi->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dcc_date_butoir">Date butoire traitement retour Aig <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="date" id="dcc_date_butoir" name="dcc_date_butoir" value="<?=($sousProjet->distributioncmdcdi !==NULL ? $sousProjet->distributioncmdcdi->date_butoir : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dcc_traitement_retour_terrain">Traitement Retours terrain <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="date" id="dcc_traitement_retour_terrain" name="dcc_traitement_retour_terrain" value="<?=($sousProjet->distributioncmdcdi !== NULL ? $sousProjet->distributioncmdcdi->traitement_retour_terrain : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dcc_modification_carto">Modification Carto <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="dcc_modification_carto" name="dcc_modification_carto">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectModificationCarto::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_modification_carto\" ". ($sousProjet->distributioncmdcdi!==NULL && $sousProjet->distributioncmdcdi->modification_carto==$result->id_modification_carto ?"selected": "")." >$result->lib_modification_carto</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dcc_commandes_acces">Commande Accès <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="dcc_commandes_acces" name="dcc_commandes_acces">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectCommandeAcces::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_commande_acces\" ". ($sousProjet->distributioncmdcdi!==NULL && $sousProjet->distributioncmdcdi->commandes_acces==$result->id_commande_acces ?"selected": "")." >$result->lib_commande_acces</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dcc_date_transmission_ca">Date Transmission CA <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="date" id="dcc_date_transmission_ca" name="dcc_date_transmission_ca" value="<?=($sousProjet->distributioncmdcdi !== NULL ? $sousProjet->distributioncmdcdi->date_transmission_ca : "")?>">
                </div>
                <div class="col-md-6">
                    <label for="dcc_ref_commande_acces">Référence Commande Accès <!--<span class="text-danger">*</span>--></label>
                    <br>
                    <input class="js-tags-input form-control" type="text" id="dcc_ref_commande_acces" name="dcc_ref_commande_acces" value="<?=($sousProjet->distributioncmdcdi !== NULL ? $sousProjet->distributioncmdcdi->ref_commande_acces : "")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dcc_date_depot_cmd">Date de dépôt de la commande <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="date" id="dcc_date_depot_cmd" name="dcc_date_depot_cmd" value="<?=($sousProjet->distributioncmdcdi !==NULL ? $sousProjet->distributioncmdcdi->date_depot_cmd : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dcc_date_debut_travaux_ft">Date Début Travaux FT <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="date" id="dcc_date_debut_travaux_ft" name="dcc_date_debut_travaux_ft" value="<?=($sousProjet->distributioncmdcdi !==NULL ? $sousProjet->distributioncmdcdi->date_debut_travaux_ft : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dcc_date_fin_travaux_ft">Date Fin Travaux FT <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control" type="date" id="dcc_date_fin_travaux_ft" name="dcc_date_fin_travaux_ft" value="<?=($sousProjet->distributioncmdcdi !==NULL ? $sousProjet->distributioncmdcdi->date_fin_travaux_ft : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dcc_go_ft">GO FT <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="dcc_go_ft" name="dcc_go_ft">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectGoFt::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_go_ft\" ". ($sousProjet->distributioncmdcdi!==NULL && $sousProjet->distributioncmdcdi->go_ft==$result->id_go_ft ?"selected": "")." >$result->lib_go_ft</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="dcc_ok">Réalisation de l'ensemble des commandes Structurantes <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="dcc_ok" name="dcc_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->distributioncmdcdi!==NULL && $sousProjet->distributioncmdcdi->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 fcomp-annexe">
                    <label for="fcomp_uploader_wrapper3">Documents livrables complementaires </label>
                    <div id="fcomp_uploader_wrapper3">
                        <div id="fcomp_uploader3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_distribution_commande_cdi" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_distribution_commande_cdi_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <button id="id_sous_projet_distribution_commandecdi_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_distribution_commandecdi_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>

                    <label class="css-input switch switch-sm switch-success">
                        <input id="id_sous_projet_distribution_commandecdi_charge_be" class="a2tcheckbox" type="checkbox" value="FALSE" <?= ($sousProjet->distributioncmdcdi!==NULL && $sousProjet->distributioncmdcdi->date_charge_be !=NULL ?"checked" : "")?> ><span></span>
                        Charge BE prise en charge : <span id="charge_be_message_distribution_commandecdi"><?= ($sousProjet->distributioncmdcdi!==NULL && $sousProjet->distributioncmdcdi->date_charge_be !=NULL ?" Le ".$sousProjet->distributioncmdcdi->date_charge_be."" : "")?></span>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="charge-be-confirm_distribution_commande_cdi" title="Confirmer cette affectation ?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer cette affectation ?</p>
</div>
<script>
    var dcmd_formdata = {};
    var fcomp_uploader_options3 = {
        url: "#",
        multiple:false,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "pdf,zip,rar",
        onLoad:function(obj)
        {
            $.ajax({
                cache: false,
                url: "api/ot/ot/load_fcomp.php",
                method:"POST",
                data: {idsp:get('idsousprojet'), types : '5'},
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
                idot: ot_dt.row('.selected').data().id_ordre_de_travail
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
        //

        fcomp_uploader_options3 = merge_options(defaultUploaderStrLocalisation,fcomp_uploader_options3);
        fcomp_uploader_options3.showDelete = false;
        fcomp_uploader3 = $("#fcomp_uploader3").uploadFile(fcomp_uploader_options3);
    });
    $(document).ready(function() {
        var typeetape = "sous_projet_distribution_commande_cdi";
        var variable_etape = "distributioncmdcdi";
        var actif = null;
        $( "#charge-be-confirm_distribution_commande_cdi" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {

                            if($("#id_sous_projet_distribution_commandecdi_charge_be").is(':checked')){
                                actif = 1;
                            }else{
                                actif = 0;
                            }
                            $.ajax({
                                method: "POST",
                                url: "api/projet/sousprojet/update_charge_be_prise_en_charge.php",
                                data: {
                                    ids : get('idsousprojet'),
                                    id_etape : get('idsousprojet'),
                                    tentree : "distributioncmdcdi",
                                    actif : actif
                                }
                            }).done(function (msg) {
                                var obj = JSON.parse(msg);
                                if(obj.error == 0) {
                                    if(obj.date_charge_be == null){
                                        $("#id_sous_projet_distribution_commandecdi_charge_be").prop('checked',false);
                                        $( "#charge-be-confirm_distribution_commande_cdi" ).dialog( "close" );
                                        $("#charge_be_message_distribution_commandecdi").html("" );
                                        App.showMessage(msg, '#message_distribution_commandecdi');

                                    }else{
                                        $("#id_sous_projet_distribution_commandecdi_charge_be").prop('checked',true);
                                        $( "#charge-be-confirm_distribution_commande_cdi" ).dialog( "close" );
                                        $("#charge_be_message_distribution_commandecdi").html("Le " + obj.date_charge_be );
                                        App.showMessage(msg, '#message_distribution_commandecdi');

                                    }
                                } else {
                                    $( "#charge-be-confirm_distribution_commande_cdi" ).dialog( "close" );
                                    App.showMessage(msg, '#message_distribution_commande_cdi');
                                }
                            });

                },
                Non: function() {
                    $( "#charge-be-confirm_distribution_commande_cdi" ).dialog( "close" );
                }
            }
        });
        $('#id_sous_projet_distribution_commandecdi_charge_be').click(function(e){
            e.preventDefault();
            $("#charge-be-confirm_distribution_commande_cdi").dialog("open");

        });
        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"commandecdi_href","CMD Structurante CDI: ");
        var liste_intervenant = [];
        $("#id_sous_projet_distribution_commandecdi_btn_osa").click(function () {
            if($( "#dcc_intervenant_be" ).val()!="") liste_intervenant.push( $( "#dcc_intervenant_be" ).val());
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape,liste_intervenant);
        });
        $("#id_sous_projet_distribution_commandecdi_list_tache").click(function () {
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);
        });
        jQuery('#dcc_ref_commande_acces').tagsinput({});
        $('#dist_cmdcdi_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            dcmd_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_distribution_commande_cdi_btn").click(function () {

            $("#message_distribution_commande_cdi").fadeOut();
            $("#rdistribution_block").toggleClass('block-opt-refresh');

            for (var key in dcmd_formdata) {
                dcmd_formdata[key] = $('#'+key).val();
            }
            dcmd_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseaudistribution/cmdcdi_save.php",
                data: dcmd_formdata
            }).done(function (msg) {
                $("#rdistribution_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_distribution_commande_cdi');
            });
        });
    } );
</script>