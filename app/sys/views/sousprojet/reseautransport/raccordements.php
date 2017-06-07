<div class="tab-pane <?= ($value[0]=="raccordements"?"active":"")?>" id="raccordements_content">
    <form class="form-horizontal push-10-t push-10" id="transport_raccord_form" name="transport_raccord_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="tr_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="tr_intervenant_be" name="tr_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tr_preparation_pds">Préparation PDS <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="tr_preparation_pds" name="tr_preparation_pds">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->preparation_pds==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tr_controle_plans">Contrôle des plans <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="tr_controle_plans" name="tr_controle_plans">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectControlePlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_plan\" ". ($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tr_date_transmission_pds">Date Transmission PDS <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="tr_date_transmission_pds" name="tr_date_transmission_pds" value="<?=($sousProjet->transportraccordement !== NULL ? $sousProjet->transportraccordement->date_transmission_plans : "")?>" placeholder="Plans non transmis">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="tr_date_racco">Date de début du raccordement <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="tr_date_racco" name="tr_date_racco" value="<?=($sousProjet->transportraccordement !== NULL ? $sousProjet->transportraccordement->date_racco : "")?>" placeholder="Raccordement non plannifié">
                </div>
                <div class="col-md-4">
                    <label for="tr_date_ret_prevue">Date prévisionnelle de fin  du raccordement <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="tr_date_ret_prevue" name="tr_date_ret_prevue" value="<?=($sousProjet->transportraccordement !== NULL ? $sousProjet->transportraccordement->date_ret_prevue : "")?>" placeholder="Raccordement non plannifié">
                </div>
                <div class="col-md-4">
                    <label for="tr_duree">Durée(jours) <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="tr_duree" name="tr_duree" value="<?=($sousProjet->transportraccordement !== NULL ? $sousProjet->transportraccordement->duree : "")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="tr_id_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="tr_id_entreprise" name="tr_id_entreprise">
                        <option value="" selected="">Non Attribué</option>
                        <?php
                        $results = EntrepriseSTT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tr_date_retour">Date Retour <!--<span class="text-danger">*</span>--></label>
                    <input disabled class="form-control " type="date" id="tr_date_retour" name="tr_date_retour" value="<?=($sousProjet->transportraccordement !== NULL ? $sousProjet->transportraccordement->date_retour : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="tr_controle_demarrage_effectif">Avancement Travaux <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="tr_controle_demarrage_effectif" name="tr_controle_demarrage_effectif">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = EtatOT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_ot\" ". ($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->controle_demarrage_effectif==$result->id_etat_ot ?"selected": "")." >$result->lib_etat_ot</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tr_etat_retour">Etat Retour <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="tr_etat_retour" name="tr_etat_retour">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatRetour::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_retour\" ". ($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="tr_lien_plans">Lien vers les plans <!--<span class="text-danger">*</span>--></label>
                    <textarea class="form-control" id="tr_lien_plans" name="tr_lien_plans" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->transportraccordement !== NULL?$sousProjet->transportraccordement->lien_plans:"")?></textarea>
                </div>
                <?php if($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->etat_retour==2) {?>
                    <div class="col-md-4">
                        <label for="tr_retour_presta">Retour presta <!--<span class="text-danger">*</span>--></label>
                        <textarea readonly class="form-control" id="tr_retour_presta" name="tr_retour_presta" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->transportraccordement !== NULL?$sousProjet->transportraccordement->retour_presta:"")?></textarea>
                    </div>
                <?php } ?>
                <div class="col-md-4">
                    <label for="tr_ok">Retours Prestataire Validés <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="tr_ok" name="tr_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
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
                        <label for="tr_fileuploader_chambre">Fichier(s) chambres</label>
                        <div id="tr_fileuploader_chambre"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row" style="padding-left: 10px;">
                        <label for="tr_fileuploader_pboite">Fichier(s) plans de boites</label>
                        <div id="tr_fileuploader_pboite"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <?php if($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->etat_retour==2) {?>
                    <div class="col-md-6">
                        <div class="row retourpresta" style="padding-left: 10px;">
                            <label for="tr_fileuploader_retour">Fichier(s) retour presta</label>
                            <div id="tr_fileuploader_retour"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="alert alert-success" id="message_transport_raccordements" role="alert" style="display: none;"></div>
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
                        <button id="id_sous_projet_transport_raccordements_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                        <?php
                        }
                    } else if($sousProjet_master->id_sous_projet == $sousProjet->id_sous_projet) {
                        if($connectedProfil->profil->profil->shortlib != "vpi" ) {
                        ?>
                        <button id="id_sous_projet_transport_raccordements_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                        <?php
                        }
                    } else {?>
                        <a href="?page=sousprojet&idsousprojet=<?=$sousProjet_master->id_sous_projet?>" class="btn btn-primary btn-sm" type="button">Maitre CTR</a>
                    <?php }?>

                    <button id="id_sous_projet_transport_raccord_ot_btn" class="btn btn-info btn-sm" type="button"><i class="fa fa-calendar-o push-5-r"></i> Ordre de travail</button>
                    <button id="id_sous_projet_transport_raccordemants_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button type="button" id="id_sous_projet_transport_raccordements_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false">Traiter Une tache OSA</button>
                    <button id="id_sous_projet_transport_raccordements_blq" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#blq-modal' data-backdrop="static" data-keyboard="false" type="button"><i class="fa fa-question push-5-r"></i> BLQ / PBC</button>
                    <label class="css-input switch switch-sm switch-success">
                        <input id="id_sous_projet_transport_raccordements_charge_be" class="a2tcheckbox" type="checkbox" value="FALSE" <?= ($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->date_charge_be !=NULL ?"checked" : "")?> ><span></span>
                        Charge BE prise en charge : <span id="charge_be_message_transport_raccordements"><?= ($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->date_charge_be !=NULL ?" Le ".$sousProjet->transportraccordement->date_charge_be."" : "")?></span>
                    </label>
                </div>
            </div>
        </div>
    </form>

</div>
<div id="charge-be-confirm_transport_raccordements" title="Confirmer cette affectation ?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer cette affectation ?</p>
</div>
<script>
    var raccord_formdata = {};
    var traccord_chambre_uploader_options = {
        url: "api/sousprojet/reseautransport/upload_raccord_chambre.php",
        multiple:false,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        showAbort:true,
        allowedTypes: "xls,xlsx",
        /*maxFileCount: 1,*/
        onLoad:function(obj)
        {
            $.ajax({
                cache: false,
                url: "api/sousprojet/reseautransport/load.php",
                method:"POST",
                data: {id_sous_projet:get('idsousprojet'),type_objet:'transport_raccord_chambre'},
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
    var traccord_pboite_uploader_options = {
        url: "api/sousprojet/reseautransport/upload_pboite_file.php",
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
                url: "api/sousprojet/reseautransport/load.php",
                method:"POST",
                data: {id_sous_projet:get('idsousprojet'),type_objet:'transport_racoord_pboite'},
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

            $('#traccord_pboite_table tbody').html('');
            //$('#traccord-pboite-modal').modal({backdrop: 'static', keyboard: false});
            $("#traccord-pboite-block").toggleClass('block-opt-refresh');

            $.ajax({
                cache: false,
                url: "api/fileboiteparser/get_plan_boite_infos.php",
                method:"POST",
                data: {id:id},
                dataType: "json",
                success: function(data)
                {
                    $('#traccord_pboite_table tbody').append('');
                    for(var i = 0 ; i < data.length ; i++) {
                        html = '<tr><td>' +
                            data[i].name + '</td><td>' +
                            data[i].occurence_e + '</td><td>' +
                            data[i].cable_en_passage + '</td>';
                        $('#traccord_pboite_table tbody').append(html);
                    }
                }
            }).done(function (msg) {
                $("#traccord-pboite-block").removeClass('block-opt-refresh');
            });
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
    var tr_fileuploader_retour_options = {
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
                data: {idsp:get('idsousprojet'),etapes:'3,4'},//Raccordement CTR - Tirage et Raccordement CTR
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
        traccord_chambre_uploader_options = merge_options(defaultUploaderStrLocalisation,traccord_chambre_uploader_options);
        traccord_chambre_uploader_options.abortStr = 'Injection en cours ...';
        traccord_chambre_uploader = $("#tr_fileuploader_chambre").uploadFile(traccord_chambre_uploader_options);

        traccord_pboite_uploader_options = merge_options(defaultUploaderStrLocalisation,traccord_pboite_uploader_options);
        traccord_pboite_uploader_options.downloadStr = 'Téléchargez/Voir infos';
        traccord_pboite_uploader = $("#tr_fileuploader_pboite").uploadFile(traccord_pboite_uploader_options);

        tr_fileuploader_retour_options = merge_options(defaultUploaderStrLocalisation,tr_fileuploader_retour_options);
        tr_fileuploader_retour = $("#tr_fileuploader_retour").uploadFile(tr_fileuploader_retour_options);
    });
    $(document).ready(function() {

        var typeetape = "sous_projet_transport_raccordements";
        var variable_etape = "transportraccordement";
        var actif = null;
        $( "#charge-be-confirm_transport_raccordements" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {

                            if($("#id_sous_projet_transport_raccordements_charge_be").is(':checked')){
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
                                    tentree : "transportraccordement",
                                    actif : actif
                                }
                            }).done(function (msg) {
                                var obj = JSON.parse(msg);
                                if(obj.error == 0) {
                                    if(obj.date_charge_be == null){
                                        $("#id_sous_projet_transport_raccordements_charge_be").prop('checked',false);
                                        $( "#charge-be-confirm_transport_raccordements" ).dialog( "close" );
                                        $("#charge_be_message_transport_raccordements").html("" );
                                        App.showMessage(msg, '#message_transport_raccordements');

                                    }else{
                                        $("#id_sous_projet_transport_raccordements_charge_be").prop('checked',true);
                                        $( "#charge-be-confirm_transport_raccordements" ).dialog( "close" );
                                        $("#charge_be_message_transport_raccordements").html("Le " + obj.date_charge_be );
                                        App.showMessage(msg, '#message_transport_raccordements');

                                    }
                                } else {
                                    $( "#charge-be-confirm_transport_raccordements" ).dialog( "close" );
                                    App.showMessage(msg, '#message_transport_raccordements');

                                }
                            });

                },
                Non: function() {
                    $( "#charge-be-confirm_transport_raccordements" ).dialog( "close" );
                }
            }
        });
        $('#id_sous_projet_transport_raccordements_charge_be').click(function(e){
            e.preventDefault();
            $("#charge-be-confirm_transport_raccordements").dialog("open");

        });

        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"raccordements_href","Raccordement: ");

        var liste_intervenant = [];
        $("#id_sous_projet_transport_raccordemants_btn_osa").click(function () {
            if($( "#tr_intervenant_be" ).val()!="") liste_intervenant.push($( "#tr_intervenant_be" ).val());
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape,liste_intervenant);
        });
        $('#transport_raccord_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            raccord_formdata[$( this ).attr('name')] = $( this).val();
        });
        $('#id_sous_projet_transport_raccordements_list_tache').click(function(){
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);
        });
        $("#id_sous_projet_transport_raccordements_btn").click(function () {

            $("#message_transport_raccordements").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');

            for (var key in raccord_formdata) {
                raccord_formdata[key] = $('#'+key).val();
            }
            raccord_formdata['ids'] = get('idsousprojet');

            if($("#tr_ok").val() == 1) {
                $("#tr_etat_retour").val(2);
                raccord_formdata['tr_etat_retour'] = $("#tr_etat_retour").val();
            }

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseautransport/raccord_save.php",
                data: raccord_formdata
            }).done(function (msg) {
                /*var obj = JSON.parse(msg);
                if(obj.error == 0) {
                    $("#tr_duree").val(obj.duree);
                }*/
                $("#rtransport_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_transport_raccordements');
            });
        });

        $("#id_sous_projet_transport_raccordements_blq").click(function () {
            if(!$('#blq_block').hasClass('block-opt-hidden')) {
                $('#blq_block').addClass('block-opt-hidden');
            }
            if(!$('#blq2_block').hasClass('block-opt-hidden')) {
                $('#blq2_block').addClass('block-opt-hidden');
            }

            blq_ot_dt.ajax.url( 'api/ot/ot/ot_liste.php?idsp='+get('idsousprojet')+'&tentree=transportraccordement' ).load();
        });

        $("#id_sous_projet_transport_raccord_ot_btn").click(function () {
            $.ajax({
                method: "POST",
                url: "api/ot/ot/check_ot.php",
                data: {
                    ids : get('idsousprojet'),
                    tentree : 'transporttirage'
                }
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                console.log(msg);
                if(obj.error == 0) {
                    document.location.href = '?page=ot&idsousprojet='+get('idsousprojet')+'&tentree=transportraccordement';
                } else {
                    App.showMessage(msg, '#message_transport_raccordements');
                }
            });
        });
        /*$.smoothScroll({
            scrollTarget: '#rtransport_block'
        });
        $("#recette_href").trigger('click');*/
    } );
</script>