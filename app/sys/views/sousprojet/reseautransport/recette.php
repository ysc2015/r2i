<div class="tab-pane <?= ($value[0]=="recette"?"active":"")?>" id="recette_content">
    <form class="form-horizontal push-10-t push-10" id="transport_recette_form" name="transport_recette_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="trec_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="trec_intervenant_be" name="trec_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="trec_doe">DOE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="trec_doe" name="trec_doe">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->doe==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="trec_netgeo">Netgeo <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="trec_netgeo" name="trec_netgeo">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->netgeo==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="trec_intervenant_free">Intervenant FREE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="trec_intervenant_free" name="trec_intervenant_free">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->intervenant_free==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="trec_date_recette">Date de début recette <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control" type="text" id="trec_date_recette" name="trec_date_recette" value="<?=($sousProjet->transportrecette !== NULL ? $sousProjet->transportrecette->date_recette : "")?>" placeholder="Recette non plannifiée">
                </div>
                <div class="col-md-4">
                    <label for="trec_date_recette">Date prévisionnelle de fin recette <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control" type="text" id="trec_date_recette" name="trec_date_recette" value="<?=($sousProjet->transportrecette !== NULL ? $sousProjet->transportrecette->date_ret_prevue : "")?>" placeholder="Recette non plannifiée">
                </div>
                <div class="col-md-4">
                    <label for="trec_duree">Durée(jours) <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="trec_duree" name="trec_duree" value="<?=($sousProjet->transportrecette !== NULL?$sousProjet->transportrecette->duree:"")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="trec_id_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control" id="trec_id_entreprise" name="trec_id_entreprise">
                        <option value="" selected="">Non Attribué</option>
                        <?php
                        $results = EntrepriseSTT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="trec_controle_demarrage_effectif">Avancement Travaux <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="trec_controle_demarrage_effectif" name="trec_controle_demarrage_effectif">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = EtatOT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_ot\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->controle_demarrage_effectif==$result->id_etat_ot ?"selected": "")." >$result->lib_etat_ot</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="trec_date_retour">Date Retour <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="date" id="trec_date_retour" name="trec_date_retour" value="<?=($sousProjet->transportrecette !== NULL ? $sousProjet->transportrecette->date_retour : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="trec_etat_recette">Etat Recette <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control" id="trec_etat_recette" name="trec_etat_recette">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatRecette::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_recette\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->etat_recette==$result->id_etat_recette ?"selected": "")." >$result->lib_etat_recette</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="trec_date_transmission_plans">Date Transmission Plans <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="trec_date_transmission_plans" name="trec_date_transmission_plans" value="<?=($sousProjet->transportrecette !== NULL ? $sousProjet->transportrecette->date_transmission_plans : "")?>" placeholder="Plans non transmis">
                </div>
                <div class="col-md-3">
                    <label for="trec_controle_plans">Contrôle des plans <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="trec_controle_plans" name="trec_controle_plans">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectControlePlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_plan\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="trec_ok">Retours Prestataires Validés <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="trec_ok" name="trec_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="trec_lien_plans">Lien vers les plans <!--<span class="text-danger">*</span>--></label>
                    <textarea class="form-control" id="trec_lien_plans" name="trec_lien_plans" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->transportrecette !== NULL?$sousProjet->transportrecette->lien_plans:"")?></textarea>
                </div>
                <?php if($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->etat_recette==3) {?>
                    <div class="col-md-4">
                        <label for="trec_retour_presta">Retour presta <!--<span class="text-danger">*</span>--></label>
                        <textarea readonly class="form-control" id="trec_retour_presta" name="trec_retour_presta" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->transportrecette !== NULL?$sousProjet->transportrecette->retour_presta:"")?></textarea>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-6">
                    <div class="row" style="padding-left: 10px;">
                        <label for="fileuploader_recette">Fichier(s) recette</label>
                        <div id="fileuploader_recette"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row" style="padding-left: 10px;">
                        <label for="fileuploader_recette_chambre">Fichier(s) chambres</label>
                        <div id="fileuploader_recette_chambre"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <?php if($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->etat_recette==3) {?>
                    <div class="col-md-6">
                        <div class="row retourpresta" style="padding-left: 10px;">
                            <label for="trec_fileuploader_retour">Fichier(s) retour presta</label>
                            <div id="trec_fileuploader_retour"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="alert alert-success" id="message_transport_recette" role="alert" style="display: none;"></div>
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
                    <?php if($sousProjet_master == NULL) {?>
                        <button id="id_sous_projet_transport_recette_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <?php } else if($sousProjet_master->id_sous_projet == $sousProjet->id_sous_projet) {?>
                        <button id="id_sous_projet_transport_recette_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <?php } else {?>
                        <a href="?page=sousprojet&idsousprojet=<?=$sousProjet_master->id_sous_projet?>" class="btn btn-primary btn-sm" type="button">Maitre CTR</a>
                    <?php }?>

                    <button id="id_sous_projet_transport_recette_ot_btn" class="btn btn-info btn-sm" type="button"><i class="fa fa-calendar-o push-5-r"></i> Ordre de travail</button>
                    <button id="id_sous_projet_transport_recette_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_transport_recette_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>
                    <button id="id_sous_projet_transport_recette_blq" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#blq-modal' data-backdrop="static" data-keyboard="false" type="button"><i class="fa fa-question push-5-r"></i> BLQ / PBC</button>
                </div>
            </div>
        </div>
    </form>

</div>
<script>
    var recette_formdata = {};
    var recette_uploader_options = {
        url: "api/sousprojet/reseautransport/upload_recette_file.php",
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
                url: "api/sousprojet/reseautransport/load.php",
                method:"POST",
                data: {id_sous_projet:get('idsousprojet'),type_objet:'transport_recette_file'},
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
    var recette_chambre_uploader_options = {
        url: "api/sousprojet/reseautransport/upload_recette_chambre_file.php",
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
                url: "api/sousprojet/reseautransport/load.php",
                method:"POST",
                data: {id_sous_projet:get('idsousprojet'),type_objet:'transport_recette_chambre_file'},
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
    var trec_fileuploader_retour_options = {
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
                data: {idsp:get('idsousprojet'),etapes:'9'},//Recette Optique CTR
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
        recette_uploader_options = merge_options(defaultUploaderStrLocalisation,recette_uploader_options);
        recette_uploader = $("#fileuploader_recette").uploadFile(recette_uploader_options);

        recette_chambre_uploader_options = merge_options(defaultUploaderStrLocalisation,recette_chambre_uploader_options);
        recette_chambre_uploader = $("#fileuploader_recette_chambre").uploadFile(recette_chambre_uploader_options);

        trec_fileuploader_retour_options = merge_options(defaultUploaderStrLocalisation,trec_fileuploader_retour_options);
        trec_fileuploader_retour = $("#trec_fileuploader_retour").uploadFile(trec_fileuploader_retour_options);
    });
    $(document).ready(function() {
        var typeetape = "sous_projet_transport_recette";

        var variable_etape = "transportrecette";

        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"recette_href","Recette: ");


        $("#id_sous_projet_transport_recette_list_tache").click(function () {
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);//1 = ide
        });
        var liste_intervenant = [];
        $("#id_sous_projet_transport_recette_btn_osa").click(function () {
            if($( "#trec_intervenant_be" ).val()!="") liste_intervenant.push($( "#trec_intervenant_be" ).val());
            if($( "#trec_doe" ).val()!="") liste_intervenant.push($( "#trec_doe" ).val());
            if($( "#trec_netgeo" ).val()!="") liste_intervenant.push($( "#trec_netgeo" ).val());
            if($( "#trec_intervenant_free" ).val()!="") liste_intervenant.push($( "#trec_intervenant_free" ).val());
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape,liste_intervenant);//1 = ide
        });

        $('#transport_recette_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            recette_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_transport_recette_btn").click(function () {

            $("#message_transport_recette").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');

            for (var key in recette_formdata) {
                recette_formdata[key] = $('#'+key).val();
            }
            recette_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseautransport/recette_save.php",
                data: recette_formdata
            }).done(function (msg) {
                $("#rtransport_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_transport_recette');
            });
        });

        $("#id_sous_projet_transport_recette_blq").click(function () {
            if(!$('#blq_block').hasClass('block-opt-hidden')) {
                $('#blq_block').addClass('block-opt-hidden');
            }
            if(!$('#blq2_block').hasClass('block-opt-hidden')) {
                $('#blq2_block').addClass('block-opt-hidden');
            }

            blq_ot_dt.ajax.url( 'api/ot/ot/ot_liste.php?idsp='+get('idsousprojet')+'&tentree=transportrecette' ).load();
        });

        $("#id_sous_projet_transport_recette_ot_btn").click(function () {
            $.ajax({
                method: "POST",
                url: "api/ot/ot/check_ot.php",
                data: {
                    ids : get('idsousprojet'),
                    tentree : 'transportrecette'
                }
            }).done(function (msg) {
                console.log(msg);
                var obj = JSON.parse(msg);
                console.log(msg);
                if(obj.error == 0) {
                    document.location.href = '?page=ot&idsousprojet='+get('idsousprojet')+'&tentree=transportrecette';
                } else {
                    App.showMessage(msg, '#message_transport_recette');
                }
            });
        });
    } );
</script>