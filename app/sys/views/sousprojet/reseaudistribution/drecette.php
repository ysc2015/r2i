<div class="tab-pane <?= ($value[0]=="drecette"?"active":"")?>" id="drecette_content">
    <form class="form-horizontal push-10-t push-10" id="dist_recette_form" name="dist_recette_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="drec_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="drec_intervenant_be" name="drec_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="drec_doe">DOE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="drec_doe" name="drec_doe">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->doe==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="drec_netgeo">Netgeo <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="drec_netgeo" name="drec_netgeo">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->netgeo==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="drec_injection_netgeo">Injection netgeo <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="drec_injection_netgeo" name="drec_injection_netgeo">
                        <!--<option value="" selected="">Sélectionnez une valeur</option>-->
                        <?php
                        $results = SelectInjectionNetgeo::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_injection_netgeo\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->injection_netgeo==$result->id_injection_netgeo ?"selected": "")." >$result->lib_injection_netgeo</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="drec_date_recette">Date de début recette <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control" type="text" id="drec_date_recette" name="drec_date_recette" value="<?=($sousProjet->distributionrecette !== NULL ? $sousProjet->distributionrecette->date_recette : "")?>" placeholder="Recette non plannifiée">
                </div>
                <div class="col-md-4">
                    <label for="drec_date_recette">Date prévisionnelle de fin recette <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control" type="text" id="drec_date_recette" name="drec_date_recette" value="<?=($sousProjet->distributionrecette !== NULL ? $sousProjet->distributionrecette->date_ret_prevue : "")?>" placeholder="Recette non plannifiée">
                </div>
                <div class="col-md-4">
                    <label for="tt_duree">Durée(jours) <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="drec_duree" name="tt_duree" value="<?=($sousProjet->distributionrecette !== NULL?$sousProjet->distributionrecette->duree:"")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="drec_id_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="drec_id_entreprise" name="drec_id_entreprise">
                        <option value="" selected="">Non Attribué</option>
                        <?php
                        $results = EntrepriseSTT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="drec_controle_demarrage_effectif">Avancement Travaux <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="drec_controle_demarrage_effectif" name="drec_controle_demarrage_effectif">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = EtatOT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_ot\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->controle_demarrage_effectif==$result->id_etat_ot ?"selected": "")." >$result->lib_etat_ot</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="drec_date_retour">Date Retour <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="date" id="drec_date_retour" name="drec_date_retour" value="<?=($sousProjet->distributionrecette !== NULL ? $sousProjet->distributionrecette->date_retour : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="drec_etat_recette">Etat Recette <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="drec_etat_recette" name="drec_etat_recette">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatRecette::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_recette\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->etat_recette==$result->id_etat_recette ?"selected": "")." >$result->lib_etat_recette</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="drec_date_transmission_plans">Date Transmission Plans <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="drec_date_transmission_plans" name="drec_date_transmission_plans" value="<?=($sousProjet->distributionrecette !== NULL ? $sousProjet->distributionrecette->date_transmission_plans : "")?>" placeholder="Plans non transmis">
                </div>
                <div class="col-md-3">
                    <label for="drec_controle_plans">Contrôle des plans <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="drec_controle_plans" name="drec_controle_plans">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectControlePlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_plan\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="drec_ok">Retours Prestataires Validés <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="drec_ok" name="drec_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="drec_lien_plans">Lien vers les plans <!--<span class="text-danger">*</span>--></label>
                    <textarea class="form-control" id="drec_lien_plans" name="drec_lien_plans" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->distributionrecette !== NULL?$sousProjet->distributionrecette->lien_plans:"")?></textarea>
                </div>
                <?php if($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->etat_recette==3) {?>
                    <div class="col-md-4">
                        <label for="drec_retour_presta">Retour presta <!--<span class="text-danger">*</span>--></label>
                        <textarea readonly class="form-control" id="drec_retour_presta" name="drec_retour_presta" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->distributionrecette !== NULL?$sousProjet->distributionrecette->retour_presta:"")?></textarea>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-6">
                    <div class="row" style="padding-left: 10px;">
                        <label for="fileuploader_recette2">Fichier(s) recette</label>
                        <div id="fileuploader_recette2"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row" style="padding-left: 10px;">
                        <label for="fileuploader_recette2_chambre">Fichier(s) chambres</label>
                        <div id="fileuploader_recette2_chambre"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <?php if($sousProjet->distributionrecette!==NULL && $sousProjet->distributionrecette->etat_recette==3) {?>
                    <div class="col-md-6">
                        <div class="row retourpresta" style="padding-left: 10px;">
                            <label for="drec_fileuploader_retour">Fichier(s) retour presta</label>
                            <div id="drec_fileuploader_retour"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="alert alert-success" id="message_distribution_recette" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_distribution_recette_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <button id="id_sous_projet_distribution_recette_ot_btn" class="btn btn-info btn-sm" type="button"><i class="fa fa-calendar-o push-5-r"></i> Ordre de travail</button>
                    <button id="id_sous_projet_distribution_recette_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_distribution_recette_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>
                    <button id="id_sous_projet_distribution_recette_blq" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#blq-modal' data-backdrop="static" data-keyboard="false" type="button"><i class="fa fa-question push-5-r"></i> BLQ / PBC</button>
                    <button id="id_sous_projet_distribution_recette_charge_be" class='btn btn-warning btn-sm' type="button">Charge BE prise en charge</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="charge-be-confirm_distribution_recette" title="Confirmer cette affectation ?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer cette affectation ?</p>
</div>
<script>
    var drecette_formdata = {};
    var recette_uploader2_options2 = {
        url: "api/sousprojet/reseaudistribution/upload_recette_file.php",
        multiple:true,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "xlsx,xls,pdf",
        onLoad:function(obj)
        {
            $.ajax({
                cache: false,
                url: "api/sousprojet/reseaudistribution/load.php",
                method:"POST",
                data: {id_sous_projet:get('idsousprojet'),type_objet:'distribution_recette_file'},
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
    var recette_chambre_uploader2_options2 = {
        url: "api/sousprojet/reseaudistribution/upload_recette_chambre_file.php",
        multiple:true,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "xls,xlsx",
        onLoad:function(obj)
        {
            $.ajax({
                cache: false,
                url: "api/sousprojet/reseaudistribution/load.php",
                method:"POST",
                data: {id_sous_projet:get('idsousprojet'),type_objet:'distribution_recette_chambre_file'},
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
    var drec_fileuploader_retour_options = {
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
            $.ajax({
                cache: false,
                url: "api/myot/traitement/load_retour_stt_etape.php",
                method:"POST",
                data: {idsp:get('idsousprojet'),etapes:'10'},//Recette Optique CDI
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
        recette_uploader2_options2 = merge_options(defaultUploaderStrLocalisation,recette_uploader2_options2);
        recette_uploader2 = $("#fileuploader_recette2").uploadFile(recette_uploader2_options2);

        recette_chambre_uploader2_options2 = merge_options(defaultUploaderStrLocalisation,recette_chambre_uploader2_options2);
        recette_chambre_uploader2 = $("#fileuploader_recette2_chambre").uploadFile(recette_chambre_uploader2_options2);

        drec_fileuploader_retour_options = merge_options(defaultUploaderStrLocalisation,drec_fileuploader_retour_options);
        drec_fileuploader_retour = $("#drec_fileuploader_retour").uploadFile(drec_fileuploader_retour_options);

    });
    $(document).ready(function() {
        var typeetape = "sous_projet_distribution_recette";
        var variable_etape = "distributionrecette";
        $( "#charge-be-confirm_distribution_recette" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/ot/ot/check_ot.php",
                        data: {
                            ids : get('idsousprojet'),
                            tentree : "distributionrecette"
                        }
                    }).done(function (msg) {
                        var obj = JSON.parse(msg);
                        console.log(msg);
                        if(obj.error == 0) {
                            $.ajax({
                                method: "POST",
                                url: "api/projet/sousprojet/update_charge_be_prise_en_charge.php",
                                data: {
                                    ids : get('idsousprojet'),
                                    id_etape : get('idsousprojet'),
                                    tentree : "distributionrecette"
                                }
                            }).done(function (msg) {
                                var obj = JSON.parse(msg);
                                if(obj.error == 0) {
                                    $( "#charge-be-confirm_distribution_recette" ).dialog( "close" );
                                    App.showMessage(msg, '#message_distribution_recette');
                                } else {

                                }
                            });
                        } else {
                            $( "#charge-be-confirm_distribution_recette" ).dialog( "close" );
                            App.showMessage(msg, '#message_distribution_recette');

                        }
                    });
                },
                Non: function() {
                    $( "#charge-be-confirm_distribution_recette" ).dialog( "close" );
                }
            }
        });
        $('#id_sous_projet_distribution_recette_charge_be').click(function(e){
            e.preventDefault();
            $("#charge-be-confirm_distribution_recette").dialog("open");

        });
        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"drecette_href","Recette: ");
        var liste_intervenant = [];
        $("#id_sous_projet_distribution_recette_btn_osa").click(function () {
            if($( "#drec_intervenant_be" ).val()!="") liste_intervenant.push( $( "#drec_intervenant_be" ).val());
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape,liste_intervenant);
        });
        $("#id_sous_projet_distribution_recette_list_tache").click(function () {
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);//1 = ide
        });
        $('#dist_recette_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            drecette_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_distribution_recette_btn").click(function () {

            $("#message_distribution_recette").fadeOut();
            $("#rdistribution_block").toggleClass('block-opt-refresh');

            for (var key in drecette_formdata) {
                drecette_formdata[key] = $('#'+key).val();
            }
            drecette_formdata['ids'] = get('idsousprojet');

            if($("#drec_ok").val() == 1) {
                $("#drec_etat_recette").val(3);
                drecette_formdata['drec_etat_recette'] = $("#drec_etat_recette").val();
            }

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseaudistribution/recette_save.php",
                data: drecette_formdata
            }).done(function (msg) {
                $("#rdistribution_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_distribution_recette');
            });
        });

        $("#id_sous_projet_distribution_recette_blq").click(function () {
            if(!$('#blq_block').hasClass('block-opt-hidden')) {
                $('#blq_block').addClass('block-opt-hidden');
            }
            if(!$('#blq2_block').hasClass('block-opt-hidden')) {
                $('#blq2_block').addClass('block-opt-hidden');
            }

            blq_ot_dt.ajax.url( 'api/ot/ot/ot_liste.php?idsp='+get('idsousprojet')+'&tentree=distributionrecette' ).load();
        });

        $("#id_sous_projet_distribution_recette_ot_btn").click(function () {
            $.ajax({
                method: "POST",
                url: "api/ot/ot/check_ot.php",
                data: {
                    ids : get('idsousprojet'),
                    tentree : 'distributionrecette'
                }
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                console.log(msg);
                if(obj.error == 0) {
                    document.location.href = '?page=ot&idsousprojet='+get('idsousprojet')+'&tentree=distributionrecette';
                } else {
                    App.showMessage(msg, '#message_distribution_recette');
                }
            });
        });
    } );
</script>