<div class="tab-pane <?= ($value[0]=="commandectr"?"active":"")?>" id="commandectr_content">
    <form class="form-horizontal push-10-t push-10" id="transport_cmdctr_form" name="transport_cmdctr_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="cctr_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cctr_intervenant_be" name="cctr_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportcmcctr!==NULL && $sousProjet->transportcmcctr->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cctr_date_butoir">Date butoire traitement retour Aig <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cctr_date_butoir" name="cctr_date_butoir" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->date_butoir : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cctr_traitement_retour_terrain">Traitement Retours terrain <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cctr_traitement_retour_terrain" name="cctr_traitement_retour_terrain" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->traitement_retour_terrain : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cctr_modification_carto">Modification Carto <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cctr_modification_carto" name="cctr_modification_carto">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectModificationCarto::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_modification_carto\" ". ($sousProjet->transportcmcctr!==NULL && $sousProjet->transportcmcctr->modification_carto==$result->id_modification_carto ?"selected": "")." >$result->lib_modification_carto</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="cctr_commandes_acces">Commande Accès <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cctr_commandes_acces" name="cctr_commandes_acces">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectCommandeAcces::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_commande_acces\" ". ($sousProjet->transportcmcctr!==NULL && $sousProjet->transportcmcctr->commandes_acces==$result->id_commande_acces ?"selected": "")." >$result->lib_commande_acces</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cctr_date_transmission_ca">Date Transmission CA <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cctr_date_transmission_ca" name="cctr_date_transmission_ca" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->date_transmission_ca : "")?>">
                </div>
                <div class="col-md-6">
                    <label for="cctr_ref_commande_acces">Référence Commande Accès <!--<span class="text-danger">*</span>--></label>
                    <br>
                    <input class="js-tags-input form-control " type="text" id="cctr_ref_commande_acces" name="cctr_ref_commande_acces" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->ref_commande_acces : "")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="cctr_date_depot_cmd">Date de dépôt de la commande <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cctr_date_depot_cmd" name="cctr_date_depot_cmd" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->date_depot_cmd : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cctr_date_debut_travaux_ft">Date Début Travaux FT <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cctr_date_debut_travaux_ft" name="cctr_date_debut_travaux_ft" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->date_debut_travaux_ft : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cctr_date_fin_travaux_ft">Date Fin Travaux FT <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cctr_date_fin_travaux_ft" name="cctr_date_fin_travaux_ft" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->date_fin_travaux_ft : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cctr_go_ft">GO FT <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cctr_go_ft" name="cctr_go_ft">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectGoFt::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_go_ft\" ". ($sousProjet->transportcmcctr!==NULL && $sousProjet->transportcmcctr->go_ft==$result->id_go_ft ?"selected": "")." >$result->lib_go_ft</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="cctr_ok">Réalisation de l'ensemble des commandes Structurantes <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="cctr_ok" name="cctr_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->transportcmcctr!==NULL && $sousProjet->transportcmcctr->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 fcomp-annexe">
                    <label for="fcomp_uploader_wrapper1">Documents livrables complementaires </label>
                    <div id="fcomp_uploader_wrapper1">
                        <div id="fcomp_uploader1"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_transport_commande_ctr" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <?php
                    $sousProjet_master = SousProjet::first(
                        array('conditions' =>
                            array("id_projet = ? AND is_master = 1", $sousProjet->id_projet)
                        )
                    );
                    ?>
                    <?php if($sousProjet_master == NULL) {
                        if($connectedProfil->profil->profil->shortlib != "vpi" ) {
                        ?>
                        <button id="id_sous_projet_transport_commande_ctr_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                        <?php
                        }
                    } else if($sousProjet_master->id_sous_projet == $sousProjet->id_sous_projet) {
                        if($connectedProfil->profil->profil->shortlib != "vpi" ) {
                        ?>
                        <button id="id_sous_projet_transport_commande_ctr_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                        <?php
                        }
                    } else {?>
                        <a href="?page=sousprojet&idsousprojet=<?=$sousProjet_master->id_sous_projet?>" class="btn btn-primary btn-sm" type="button">Maitre CTR</a>
                    <?php }?>

                    <button id="id_sous_projet_transport_commande_ctr_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_transport_commande_ctr_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>
                    <label class="css-input switch switch-sm switch-success">
                        <input id="id_sous_projet_transport_commandectr_charge_be" class="a2tcheckbox" type="checkbox" value="FALSE" <?= ($sousProjet->transportcmcctr!==NULL && $sousProjet->transportcmcctr->date_charge_be !=NULL ?"checked" : "")?> ><span></span>
                        Prise en charge BE : <span id="charge_be_message_transport_commandectr"><?= ($sousProjet->transportcmcctr!==NULL && $sousProjet->transportcmcctr->date_charge_be !=NULL ?" Le ".$sousProjet->transportcmcctr->date_charge_be."" : "")?></span>
                    </label>
                </div>
            </div>
        </div>
    </form>

</div>
<div id="charge-be-confirm_transport_commande_ctr" title="Confirmer cette affectation ?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer cette affectation ?</p>
</div>
<script>
    var cmd_formdata = {};

    var fcomp_uploader_options1 = {
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
                data: {idsp:get('idsousprojet'), types : '1'},
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
        // Init page plugins & helpers //
        jQuery('#cctr_ref_commande_acces').tagsinput({});

        fcomp_uploader_options1 = merge_options(defaultUploaderStrLocalisation,fcomp_uploader_options1);
        fcomp_uploader_options1.showDelete = false;
        fcomp_uploader1 = $("#fcomp_uploader1").uploadFile(fcomp_uploader_options1);
    });


    $(document).ready(function() {
        var typeetape = "sous_projet_transport_commande_ctr";
        var variable_etape = "transportcmcctr";
        var actif = null;
        $( "#charge-be-confirm_transport_commande_ctr" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {

                            if($("#id_sous_projet_transport_commandectr_charge_be").is(':checked')){
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
                                    tentree : "transportcmcctr",
                                    actif : actif
                                }
                            }).done(function (msg) {
                                var obj = JSON.parse(msg);
                                if(obj.error == 0) {
                                    if(obj.date_charge_be == null){
                                        $("#id_sous_projet_transport_commandectr_charge_be").prop('checked',false);
                                        $( "#charge-be-confirm_transport_commande_ctr" ).dialog( "close" );
                                        $("#charge_be_message_transport_commandectr").html("" );
                                        App.showMessage(msg, '#message_transport_commandectr');

                                    }else{
                                        $("#id_sous_projet_transport_commandectr_charge_be").prop('checked',true);
                                        $( "#charge-be-confirm_transport_commande_ctr" ).dialog( "close" );
                                        $("#charge_be_message_transport_commandectr").html("Le " + obj.date_charge_be );
                                        App.showMessage(msg, '#message_transport_commandectr');

                                    }
                                } else {
                                    $( "#charge-be-confirm_transport_commande_ctr" ).dialog( "close" );
                                    App.showMessage(msg, '#message_transport_commande_ctr');

                                }
                            });

                },
                Non: function() {
                    $( "#charge-be-confirm_transport_commande_ctr" ).dialog( "close" );
                }
            }
        });
        $('#id_sous_projet_transport_commandectr_charge_be').click(function(e){
            e.preventDefault();
            $("#charge-be-confirm_transport_commande_ctr").dialog("open");

        });
        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"commandectr_href","CMD Structurante CTR: ");

        var liste_intervenant = [];
        $("#id_sous_projet_transport_commande_ctr_btn_osa").click(function () {
            if($( "#cctr_intervenant_be" ).val()!="") liste_intervenant.push($( "#cctr_intervenant_be" ).val());
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape,liste_intervenant);
        });
        $("#id_sous_projet_transport_commande_ctr_list_tache").click(function(){
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);
        })

        $('#transport_cmdctr_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            cmd_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_transport_commande_ctr_btn").click(function () {
            $("#message_transport_commande_ctr").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');

            for (var key in cmd_formdata) {
                cmd_formdata[key] = $('#'+key).val();
            }
            cmd_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseautransport/cmdctr_save.php",
                data: cmd_formdata
            }).done(function (msg) {
                $("#rtransport_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_transport_commande_ctr');
            });
        });

        /*$("#cctr_ref_commande_acces").change(function(e) {
            e.preventDefault();
        });*/


    } );
</script>