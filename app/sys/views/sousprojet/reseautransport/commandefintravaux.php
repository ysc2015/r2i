<div class="tab-pane <?= ($value[0]=="commandefintravaux"?"active":"")?>" id="commandefintravaux_content">
    <form class="form-horizontal push-10-t push-10" id="transport_cmdfintrvx_form" name="transport_cmdfintrvx_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="cftrvx_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cftrvx_intervenant_be" name="cftrvx_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportcmdfintravaux!==NULL && $sousProjet->transportcmdfintravaux->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cftrvx_date_butoir">Date butoire traitement retour Tir <!--<span class="text-danger">*</span>--></label>
                    <input disabled class="form-control " type="date" id="cftrvx_date_butoir" name="cftrvx_date_butoir" value="<?=($sousProjet->transportcmdfintravaux !== NULL ? $sousProjet->transportcmdfintravaux->date_butoir : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cftrvx_traitement_retour_terrain">Traitement Retours terrain <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cftrvx_traitement_retour_terrain" name="cftrvx_traitement_retour_terrain" value="<?=($sousProjet->transportcmdfintravaux !== NULL ? $sousProjet->transportcmdfintravaux->traitement_retour_terrain : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cftrvx_modification_carto">Modification Carto <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cftrvx_modification_carto" name="cftrvx_modification_carto">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectModificationCarto::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_modification_carto\" ". ($sousProjet->transportcmdfintravaux!==NULL && $sousProjet->transportcmdfintravaux->modification_carto==$result->id_modification_carto ?"selected": "")." >$result->lib_modification_carto</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="cftrvx_commandes_fin_travaux">Commandes Fin Travaux <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cftrvx_commandes_fin_travaux" name="cftrvx_commandes_fin_travaux">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectCommandeAcces::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_commande_acces\" ". ($sousProjet->transportcmdfintravaux!==NULL && $sousProjet->transportcmdfintravaux->commandes_fin_travaux==$result->id_commande_acces ?"selected": "")." >$result->lib_commande_acces</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cftrvx_date_transmission_tfx">Date Transmission TFX <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cftrvx_date_transmission_tfx" name="cftrvx_date_transmission_tfx" value="<?=($sousProjet->transportcmdfintravaux !== NULL ? $sousProjet->transportcmdfintravaux->date_transmission_tfx : "")?>">
                </div>
                <div class="col-md-6">
                    <label for="cftrvx_ref_commande_fin_travaux">Référence Commande Fin Travaux <!--<span class="text-danger">*</span>--></label>
                    <br>
                    <input class="js-tags-input form-control " type="text" id="cftrvx_ref_commande_fin_travaux" name="cftrvx_ref_commande_fin_travaux" value="<?=($sousProjet->transportcmdfintravaux !== NULL ? $sousProjet->transportcmdfintravaux->ref_commande_fin_travaux : "")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="cftrvx_date_debut_travaux_ft">Date Début Travaux FT <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cftrvx_date_debut_travaux_ft" name="cftrvx_date_debut_travaux_ft" value="<?=($sousProjet->transportcmdfintravaux !== NULL ? $sousProjet->transportcmdfintravaux->date_debut_travaux_ft : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cftrvx_date_fin_travaux_ft">Date Fin Travaux FT <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cftrvx_date_fin_travaux_ft" name="cftrvx_date_fin_travaux_ft" value="<?=($sousProjet->transportcmdfintravaux !== NULL ? $sousProjet->transportcmdfintravaux->date_fin_travaux_ft : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cftrvx_go_ft">OK FT <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cftrvx_go_ft" name="cftrvx_go_ft">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectGoFt::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_go_ft\" ". ($sousProjet->transportcmdfintravaux!==NULL && $sousProjet->transportcmdfintravaux->go_ft==$result->id_go_ft ?"selected": "")." >$result->lib_go_ft</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="cftrvx_ok">Réalisation de l'ensemble des commandes travaux <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cftrvx_ok" name="cftrvx_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->transportcmdfintravaux!==NULL && $sousProjet->transportcmdfintravaux->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 fcomp-annexe">
                    <label for="fcomp_uploader_wrapper2">Documents livrables complementaires </label>
                    <div id="fcomp_uploader_wrapper2">
                        <div id="fcomp_uploader2"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_transport_commande_fin_travaux" role="alert" style="display: none;"></div>
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
                        <button id="id_sous_projet_transport_commande_fin_trvx_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                        <?php
                        }
                    } else if($sousProjet_master->id_sous_projet == $sousProjet->id_sous_projet) {
                        if($connectedProfil->profil->profil->shortlib != "vpi" ) {
                        ?>
                        <button id="id_sous_projet_transport_commande_fin_trvx_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                        <?php
                        }
                    } else {?>
                        <a href="?page=sousprojet&idsousprojet=<?=$sousProjet_master->id_sous_projet?>" class="btn btn-primary btn-sm" type="button">Maitre CTR</a>
                    <?php }?>

                    <button id="id_sous_projet_transport_cmdfintravaux_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_transport_cmdfintravaux_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>
                    <label class="css-input switch switch-sm switch-success">
                        <input id="id_sous_projet_transport_cmdfintravaux_charge_be" class="a2tcheckbox" type="checkbox" value="FALSE" <?= ($sousProjet->transportcmdfintravaux!==NULL && $sousProjet->transportcmdfintravaux->date_charge_be !=NULL ?"checked" : "")?> ><span></span>
                        Prise en charge BE : <span id="charge_be_message_transport_cmdfintravaux"><?= ($sousProjet->transportcmdfintravaux!==NULL && $sousProjet->transportcmdfintravaux->date_charge_be !=NULL ?" Le ".$sousProjet->transportcmdfintravaux->date_charge_be."" : "")?></span>
                    </label>
                </div>
            </div>
        </div>
    </form>

</div>
<div id="charge-be-confirm_transport_commande_fin_travaux" title="Confirmer cette affectation ?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer cette affectation ?</p>
</div>
<script>
    var cmd_fin_trvx_formdata = {};
    var fcomp_uploader_options2 = {
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
                data: {idsp:get('idsousprojet'), types : '2,3,4'},
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

        fcomp_uploader_options2 = merge_options(defaultUploaderStrLocalisation,fcomp_uploader_options2);
        fcomp_uploader_options2.showDelete = false;
        fcomp_uploader2 = $("#fcomp_uploader2").uploadFile(fcomp_uploader_options2);
    });
    $(document).ready(function() {
        var typeetape = "sous_projet_transport_commande_fin_travaux";
        var variable_etape = "transportcmdfintravaux";
        var actif = null;
        $( "#charge-be-confirm_transport_commande_fin_travaux" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {

                            if($("#id_sous_projet_transport_cmdfintravaux_charge_be").is(':checked')){
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
                                    tentree : "transportcmdfintravaux",
                                    actif : actif
                                }
                            }).done(function (msg) {
                                var obj = JSON.parse(msg);
                                if(obj.error == 0) {
                                    if(obj.date_charge_be == null){
                                        $("#id_sous_projet_transport_cmdfintravaux_charge_be").prop('checked',false);
                                        $( "#charge-be-confirm_transport_commande_fin_travaux" ).dialog( "close" );
                                        $("#charge_be_message_transport_cmdfintravaux").html("" );
                                        App.showMessage(msg, '#message_transport_commande_fin_travaux');

                                    }else{
                                        $("#id_sous_projet_transport_cmdfintravaux_charge_be").prop('checked',true);
                                        $( "#charge-be-confirm_transport_commande_fin_travaux" ).dialog( "close" );
                                        $("#charge_be_message_transport_cmdfintravaux").html("Le " + obj.date_charge_be );
                                        App.showMessage(msg, '#message_transport_commande_fin_travaux');

                                    }
                                } else {
                                    $( "#charge-be-confirm_transport_commande_fin_travaux" ).dialog( "close" );
                                    App.showMessage(msg, '#message_transport_commande_fin_travaux');

                                }
                            });

                },
                Non: function() {
                    $( "#charge-be-confirm_transport_commande_fin_travaux" ).dialog( "close" );
                }
            }
        });
        $('#id_sous_projet_transport_cmdfintravaux_charge_be').click(function(e){
            e.preventDefault();
            $("#charge-be-confirm_transport_commande_fin_travaux").dialog("open");

        });

        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"commandefintravaux_href","Commandes Fin Travaux: ");

        var liste_intervenant = [];
        $("#id_sous_projet_transport_cmdfintravaux_btn_osa").click(function () {
            if($( "#cftrvx_intervenant_be" ).val()!="") liste_intervenant.push($( "#cftrvx_intervenant_be" ).val());
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape,liste_intervenant);//1 = ide //
        });
        $("#id_sous_projet_transport_cmdfintravaux_list_tache").click(function () {

            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);//1 = ide
        });

        jQuery('#cftrvx_ref_commande_fin_travaux').tagsinput({});
        $('#transport_cmdfintrvx_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            cmd_fin_trvx_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_transport_commande_fin_trvx_btn").click(function () {
            $("#message_transport_commande_fin_travaux").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');

            for (var key in cmd_fin_trvx_formdata) {
                cmd_fin_trvx_formdata[key] = $('#'+key).val();
            }
            cmd_fin_trvx_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseautransport/commandefintravaux_save.php",
                data: cmd_fin_trvx_formdata
            }).done(function (msg) {
                $("#rtransport_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_transport_commande_fin_travaux');
            });
        });
    } );
</script>