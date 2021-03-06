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
                    <input readonly class="form-control " type="text" id="dr_date_transmission_pds" name="dr_date_transmission_pds" value="<?=($sousProjet->distributionraccordement !== NULL ? $sousProjet->distributionraccordement->date_transmission_plans : "")?>" placeholder="Plans non transmis">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="dr_date_racco">Date de début du raccordement <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="dr_date_racco" name="dr_date_racco"  value="<?=($sousProjet->distributionraccordement !== NULL ? $sousProjet->distributionraccordement->date_racco : "")?>" placeholder="Raccordement non plannifié">
                </div>
                <div class="col-md-4">
                    <label for="dr_date_ret_prevue">Date prévisionnelle de fin du raccordement <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="dr_date_ret_prevue" name="dr_date_ret_prevue"  value="<?=($sousProjet->distributionraccordement !== NULL ? $sousProjet->distributionraccordement->date_ret_prevue : "")?>" placeholder="Raccordement non plannifié">
                </div>
                <div class="col-md-4">
                    <label for="dr_duree">Durée <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="dr_duree" name="dr_duree" value="<?=($sousProjet->distributionraccordement !== NULL ? $sousProjet->distributionraccordement->duree : "")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dr_id_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="dr_id_entreprise" name="dr_id_entreprise">
                        <option value="" selected="">Non Attribué</option>
                        <?php
                        $results = EntrepriseSTT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dr_controle_demarrage_effectif">Avancement Travaux <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="dr_controle_demarrage_effectif" name="dr_controle_demarrage_effectif">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = EtatOT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_ot\" ". ($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->controle_demarrage_effectif==$result->id_etat_ot ?"selected": "")." >$result->lib_etat_ot</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dr_date_retour">Date Retour <!--<span class="text-danger">*</span>--></label>
                    <input disabled class="form-control " type="date" id="dr_date_retour" name="dr_date_retour" value="<?=($sousProjet->distributionraccordement !== NULL ? $sousProjet->distributionraccordement->date_retour : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dr_etat_retour">Etat Retour <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="dr_etat_retour" name="dr_etat_retour">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatRetour::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_retour\" ". ($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="dr_lien_plans">Lien vers les plans <!--<span class="text-danger">*</span>--></label>
                    <textarea class="form-control" id="dr_lien_plans" name="dr_lien_plans" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->distributionraccordement !== NULL?$sousProjet->distributionraccordement->lien_plans:"")?></textarea>
                </div>
                <?php if($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->etat_retour==2) {?>
                    <div class="col-md-4">
                        <label for="dr_retour_presta">Retour presta <!--<span class="text-danger">*</span>--></label>
                        <textarea readonly class="form-control" id="dr_retour_presta" name="dr_retour_presta" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->distributionraccordement !== NULL?$sousProjet->distributionraccordement->retour_presta:"")?></textarea>
                    </div>
                <?php } ?>
                <div class="col-md-4">
                    <label for="dr_ok">Retours Prestataire Validés <!--<span class="text-danger">*</span>--></label>
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
        <div class="row items-push">
            <div class="form-group">
                <?php if($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->etat_retour==2) {?>
                    <div class="col-md-6">
                        <div class="row retourpresta" style="padding-left: 10px;">
                            <label for="dr_fileuploader_retour">Fichier(s) retour presta</label>
                            <div id="dr_fileuploader_retour"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="alert alert-success" id="message_distribution_raccordements" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <?php if($connectedProfil->profil->profil->shortlib != "vpi" ) {?>
                    <button id="id_sous_projet_distribution_raccordements_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <?php } ?>
                    <button id="id_sous_projet_distribution_raccord_ot_btn" class="btn btn-info btn-sm" type="button"><i class="fa fa-calendar-o push-5-r"></i> Ordre de travail</button>
                    <button id="id_sous_projet_distribution_raccordements_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_distribution_raccordements_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>
                    <button id="id_sous_projet_distribution_raccordements_blq" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#blq-modal' data-backdrop="static" data-keyboard="false" type="button"><i class="fa fa-question push-5-r"></i> BLQ / PBC</button>

                    <label class="css-input switch switch-sm switch-success">
                        <input id="id_sous_projet_distribution_raccordements_charge_be" class="a2tcheckbox" type="checkbox" value="FALSE" <?= ($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->date_charge_be !=NULL ?"checked" : "")?> ><span></span>
                        Prise en charge BE : <span id="charge_be_message_distribution_raccordements"><?= ($sousProjet->distributionraccordement!==NULL && $sousProjet->distributionraccordement->date_charge_be !=NULL ?" Le ".$sousProjet->distributionraccordement->date_charge_be."" : "")?></span>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="charge-be-confirm_distribution_raccordements" title="Confirmer cette affectation ?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer cette affectation ?</p>
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
        allowedTypes: "xls,xlsx",
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

            location.href="api/file/download.php?id="+id;//parserfile
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
    var dr_fileuploader_retour_options = {
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
                data: {idsp:get('idsousprojet'),etapes:'7,8'},//Raccordement CDI - Tirage et Raccordement CDI
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
        draccord_chambre_uploader_options = merge_options(defaultUploaderStrLocalisation,draccord_chambre_uploader_options);
        draccord_chambre_uploader_options.abortStr = 'Injection en cours ...';
        draccord_chambre_uploader = $("#dr_fileuploader_chambre").uploadFile(draccord_chambre_uploader_options);

        draccord_pboite_uploader_options = merge_options(defaultUploaderStrLocalisation,draccord_pboite_uploader_options);
        draccord_pboite_uploader_options.downloadStr = 'Téléchargez';
        draccord_pboite_uploader = $("#dr_fileuploader_pboite").uploadFile(draccord_pboite_uploader_options);

        dr_fileuploader_retour_options = merge_options(defaultUploaderStrLocalisation,dr_fileuploader_retour_options);
        dr_fileuploader_retour = $("#dr_fileuploader_retour").uploadFile(dr_fileuploader_retour_options);
    });
    $(document).ready(function() {
        var typeetape = "sous_projet_distribution_raccordements";
        var variable_etape = "distributionraccordement";
        var actif = null;
        $( "#charge-be-confirm_distribution_raccordements" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                            if($("#id_sous_projet_distribution_raccordements_charge_be").is(':checked')){
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
                                    tentree : "distributionraccordement",
                                    actif : actif
                                }
                            }).done(function (msg) {
                                var obj = JSON.parse(msg);
                                if(obj.error == 0) {
                                    if(obj.date_charge_be == null){
                                        $("#id_sous_projet_distribution_raccordements_charge_be").prop('checked',false);
                                        $( "#charge-be-confirm_distribution_raccordements" ).dialog( "close" );
                                        $("#charge_be_message_distribution_raccordements").html("" );
                                        App.showMessage(msg, '#message_distribution_raccordements');

                                    }else{
                                        $("#id_sous_projet_distribution_raccordements_charge_be").prop('checked',true);
                                        $( "#charge-be-confirm_distribution_raccordements" ).dialog( "close" );
                                        $("#charge_be_message_distribution_raccordements").html("Le " + obj.date_charge_be );
                                        App.showMessage(msg, '#message_distribution_raccordements');

                                    }
                                } else {
                                    $( "#charge-be-confirm_distribution_raccordements" ).dialog( "close" );
                                    App.showMessage(msg, '#message_distribution_raccordements');

                                }
                            });

                },
                Non: function() {
                    $( "#charge-be-confirm_distribution_raccordements" ).dialog( "close" );
                }
            }
        });
        $('#id_sous_projet_distribution_raccordements_charge_be').click(function(e){
            e.preventDefault();
            $("#charge-be-confirm_distribution_raccordements").dialog("open");

        });
        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"draccordements_href","Raccordements: ");
        var liste_intervenant = [];
        $("#id_sous_projet_distribution_raccordements_btn_osa").click(function () {
            if($( "#dr_intervenant_be" ).val()!="") liste_intervenant.push( $( "#dr_intervenant_be" ).val());
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape,liste_intervenant);
        });
        $("#id_sous_projet_distribution_raccordements_list_tache").click(function () {
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);
        });

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

            if($("#dr_ok").val() == 1) {
                $("#dr_etat_retour").val(2);
                draccord_formdata['dr_etat_retour'] = $("#dr_etat_retour").val();
            }

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseaudistribution/raccord_save.php",
                data: draccord_formdata
            }).done(function (msg) {
                /*var obj = JSON.parse(msg);
                if(obj.error == 0) {
                    $("#dr_duree").val(obj.duree);
                }*/
                $("#rdistribution_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_distribution_raccordements');
            });
        });

        $("#id_sous_projet_distribution_raccordements_blq").click(function () {
            if(!$('#blq_block').hasClass('block-opt-hidden')) {
                $('#blq_block').addClass('block-opt-hidden');
            }
            if(!$('#blq2_block').hasClass('block-opt-hidden')) {
                $('#blq2_block').addClass('block-opt-hidden');
            }

            blq_ot_dt.ajax.url( 'api/ot/ot/ot_liste.php?idsp='+get('idsousprojet')+'&tentree=distributionraccordement' ).load();
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
                    document.location.href = '?page=ot&idsousprojet='+get('idsousprojet')+'&tentree=distributionraccordement';
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