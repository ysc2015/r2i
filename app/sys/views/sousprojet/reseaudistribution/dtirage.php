<div class="tab-pane <?= ($value[0]=="dtirage"?"active":"")?>" id="dtirage_content">
    <form class="form-horizontal push-10-t push-10" id="dist_tirage_form" name="dist_tirage_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dt_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dt_intervenant_be" name="dt_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributiontirage!==NULL && $sousProjet->distributiontirage->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dt_date_previsionnelle">Date Previsionnelle <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="dt_date_previsionnelle" name="dt_date_previsionnelle" value="<?=($sousProjet->distributiontirage !== NULL ? $sousProjet->distributiontirage->date_previsionnelle : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dt_prep_plans">Préparation des plans <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dt_prep_plans" name="dt_prep_plans">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributiontirage!==NULL && $sousProjet->distributiontirage->prep_plans==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dt_controle_plans">Contrôle des plans <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dt_controle_plans" name="dt_controle_plans">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectControlePlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_plan\" ". ($sousProjet->distributiontirage!==NULL && $sousProjet->distributiontirage->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <button id="id_lineaire_distribution_tirage_btn" class="btn btn-danger" type="button"><i id="hdfh04l54ff" class="fa fa-plus push-5-r"></i> Linéaire de réseau</button>
            <div id="dt_lineare_groupe" style="border-left: dashed 1px #000;border-right: dashed 1px #000;border-bottom: dashed 1px #000;margin-top: 5px;padding: 5px;display: none">
                <label><span class="label label-info">Câbles </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="dt_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="dt_lineaire1">câble 288FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput4" type="number" id="dt_lineaire1" name="dt_lineaire1" value="<?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lineaire1:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="dt_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="dt_lineaire_reseau">câble 144FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput4" type="number" id="dt_lineaire2" name="dt_lineaire2" value="<?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lineaire2:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="dt_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                        <label for="dt_lineaire_reseau">câble 72FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput4" type="number" id="dt_lineaire3" name="dt_lineaire3" value="<?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lineaire3:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="dt_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                        <label for="dt_lineaire_reseau">câble 48FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput4" type="number" id="dt_lineaire4" name="dt_lineaire4" value="<?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lineaire4:"")?>">
                    </div>
                </div>
                <label><span class="label label-success">Tubage </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="dt_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="dt_lineaire_reseau">18/21 <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput4" type="number" id="dt_lineaire9" name="dt_lineaire9" value="<?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lineaire9:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="dt_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="dt_lineaire_reseau">15/18 <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput4" type="number" id="dt_lineaire10" name="dt_lineaire10" value="<?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lineaire10:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="dt_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                        <label for="dt_lineaire_reseau">11/14 <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput4" type="number" id="dt_lineaire11" name="dt_lineaire11" value="<?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lineaire11:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="dt_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                        <label for="dt_lineaire_reseau">Trançons à tuber <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput4" type="number" id="dt_lineaire12" name="dt_lineaire12" value="<?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lineaire12:"")?>">
                    </div>
                </div>
                <label><span class="label label-warning">Boites </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="dt_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="dt_lineaire_reseau">BPE 288FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput4" type="number" id="dt_lineaire5" name="dt_lineaire5" value="<?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lineaire5:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="dt_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="dt_lineaire_reseau">BPE 144FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput4" type="number" id="dt_lineaire6" name="dt_lineaire6" value="<?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lineaire6:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="dt_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                        <label for="dt_lineaire_reseau">BPE 72FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput4" type="number" id="dt_lineaire7" name="dt_lineaire7" value="<?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lineaire7:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="dt_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                        <label for="dt_lineaire_reseau">BPE 48FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput4" type="number" id="dt_lineaire8" name="dt_lineaire8" value="<?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lineaire8:"")?>">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="dt_date_tirage">Date de début tirage <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="dt_date_tirage" name="dt_date_tirage" value="<?=($sousProjet->distributiontirage !== NULL ? $sousProjet->distributiontirage->date_tirage : "")?>" placeholder="Tirage non plannifié">
                </div>
                <div class="col-md-4">
                    <label for="dt_date_ret_prevue">Date prévisionnelle de fin tirage <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="dt_date_ret_prevue" name="dt_date_ret_prevue" value="<?=($sousProjet->distributiontirage !== NULL ? $sousProjet->distributiontirage->date_ret_prevue : "")?>" placeholder="Tirage non plannifié">
                </div>
                <div class="col-md-4">
                    <label for="dt_duree">Durée(jours) <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="dt_duree" name="dt_duree" value="<?=($sousProjet->distributiontirage !== NULL ? $sousProjet->distributiontirage->duree : "")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dt_id_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="dt_id_entreprise" name="dt_id_entreprise">
                        <option value="" selected="">Non Attribué</option>
                        <?php
                        $results = EntrepriseSTT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->distributiontirage!==NULL && $sousProjet->distributiontirage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dt_controle_demarrage_effectif">Avancement Travaux <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="dt_controle_demarrage_effectif" name="dt_controle_demarrage_effectif">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = EtatOT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_ot\" ". ($sousProjet->distributiontirage!==NULL && $sousProjet->distributiontirage->controle_demarrage_effectif==$result->id_etat_ot ?"selected": "")." >$result->lib_etat_ot</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dt_date_retour">Date Retour <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="date" id="dt_date_retour" name="dt_date_retour" value="<?=($sousProjet->distributiontirage !== NULL ? $sousProjet->distributiontirage->date_retour : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dt_etat_retour">Etat Retour <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="dt_etat_retour" name="dt_etat_retour">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatRetour::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_retour\" ". ($sousProjet->distributiontirage!==NULL && $sousProjet->distributiontirage->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dt_date_transmission_plans">Date Transmission Plans <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="dt_date_transmission_plans" name="dt_date_transmission_plans" value="<?=($sousProjet->distributiontirage !== NULL ? $sousProjet->distributiontirage->date_transmission_plans : "")?>" placeholder="plans non transmis">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="dt_lien_plans">Lien vers les plans <!--<span class="text-danger">*</span>--></label>
                    <textarea class="form-control" id="dt_lien_plans" name="dt_lien_plans" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->lien_plans:"")?></textarea>
                </div>
                <?php if($sousProjet->distributiontirage!==NULL && $sousProjet->distributiontirage->etat_retour==2) {?>
                    <div class="col-md-4">
                        <label for="dt_retour_presta">Retour presta <!--<span class="text-danger">*</span>--></label>
                        <textarea readonly class="form-control" id="dt_retour_presta" name="dt_retour_presta" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->distributiontirage !== NULL?$sousProjet->distributiontirage->retour_presta:"")?></textarea>
                    </div>
                <?php } ?>
                <div class="col-md-4">
                    <label for="dt_ok">Retours Prestataire Validés <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dt_ok" name="dt_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->distributiontirage!==NULL && $sousProjet->distributiontirage->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
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
                        <label for="dt_fileuploader_chambre">Fichier(s) chambres</label>
                        <div id="dt_fileuploader_chambre"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if($sousProjet->distributiontirage!==NULL && $sousProjet->distributiontirage->etat_retour==2) {?>
                        <div class="row retourpresta" style="padding-left: 10px;">
                            <label for="dt_fileuploader_retour">Fichier(s) retour presta</label>
                            <div id="dt_fileuploader_retour"></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_distribution_tirage" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-xs-12">
                    <?php if($connectedProfil->profil->profil->shortlib != "vpi" ) {?>
                    <button id="id_sous_projet_distribution_tirage_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <?php } ?>
                    <button id="id_sous_projet_distribution_tirage_ot_btn" class="btn btn-info btn-sm" type="button"><i class="fa fa-calendar-o push-5-r"></i> Ordre de travail</button>
                    <button id="id_sous_projet_distribution_tirage_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_distribution_tirage_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>
                    <button id="id_sous_projet_distribution_tirage_blq" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#blq-modal' data-backdrop="static" data-keyboard="false" type="button"><i class="fa fa-question push-5-r"></i> BLQ / PBC</button>
                    <label class="css-input switch switch-sm switch-success">
                        <input id="id_sous_projet_distribution_tirage_charge_be" class="a2tcheckbox" type="checkbox" value="FALSE" <?= ($sousProjet->distributiontirage!==NULL && $sousProjet->distributiontirage->date_charge_be !=NULL ?"checked" : "")?> ><span></span>
                        Prise en charge BE : <span id="charge_be_message_distribution_tirage"><?= ($sousProjet->distributiontirage!==NULL && $sousProjet->distributiontirage->date_charge_be !=NULL ?" Le ".$sousProjet->distributiontirage->date_charge_be."" : "")?></span>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="charge-be-confirm_distribution_tirage" title="Confirmer cette affectation ?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer cette affectation ?</p>
</div>
<script>
    var dtirage_formdata = {};
    var dtirage_chambre_uploader_options = {
        url: "api/sousprojet/reseaudistribution/upload_tirage_chambre.php",
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
                data: {id_sous_projet:get('idsousprojet'),type_objet:'distribution_tirage_chambre'},
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
    var dt_fileuploader_retour_options = {
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
                data: {idsp:get('idsousprojet'),etapes:'6,8'},//Tirage CDI - Tirage et Raccordement CDI
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
        dtirage_chambre_uploader_options = merge_options(defaultUploaderStrLocalisation,dtirage_chambre_uploader_options);
        dtirage_chambre_uploader_options.abortStr = 'Injection en cours ...';
        dtirage_chambre_uploader = $("#dt_fileuploader_chambre").uploadFile(dtirage_chambre_uploader_options);

        dt_fileuploader_retour_options = merge_options(defaultUploaderStrLocalisation,dt_fileuploader_retour_options);
        dt_fileuploader_retour = $("#dt_fileuploader_retour").uploadFile(dt_fileuploader_retour_options);
    });
    $(document).ready(function() {
        var typeetape = "sous_projet_distribution_tirage";
        var variable_etape = "distributiontirage";
        var actif = null;
        $( "#charge-be-confirm_distribution_tirage" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                            if($("#id_sous_projet_distribution_tirage_charge_be").is(':checked')){
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
                                    tentree : "distributiontirage",
                                    actif : actif
                                }
                            }).done(function (msg) {
                                var obj = JSON.parse(msg);
                                if(obj.error == 0) {
                                    if(obj.date_charge_be == null){
                                        $("#id_sous_projet_distribution_tirage_charge_be").prop('checked',false);
                                        $( "#charge-be-confirm_distribution_tirage" ).dialog( "close" );
                                        $("#charge_be_message_distribution_tirage").html("" );
                                        App.showMessage(msg, '#message_distribution_tirage');

                                    }else{
                                        $("#id_sous_projet_distribution_tirage_charge_be").prop('checked',true);
                                        $( "#charge-be-confirm_distribution_tirage" ).dialog( "close" );
                                        $("#charge_be_message_distribution_tirage").html("Le " + obj.date_charge_be );
                                        App.showMessage(msg, '#message_distribution_tirage');

                                    }
                                } else {
                                    $( "#charge-be-confirm_distribution_tirage" ).dialog( "close" );
                                    App.showMessage(msg, '#message_distribution_tirage');

                                }
                            });

                },
                Non: function() {
                    $( "#charge-be-confirm_distribution_tirage" ).dialog( "close" );
                }
            }
        });
        $('#id_sous_projet_distribution_tirage_charge_be').click(function(e){
            e.preventDefault();
            $("#charge-be-confirm_distribution_tirage").dialog("open");

        });
        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"dtirage_href","Tirage: ");
        var liste_intervenant = [];
        $("#id_sous_projet_distribution_tirage_btn_osa").click(function () {
            if($( "#dt_intervenant_be" ).val()!="") liste_intervenant.push( $( "#dt_intervenant_be" ).val());
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape,liste_intervenant);
        });
        $("#id_sous_projet_distribution_tirage_list_tache").click(function () {
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);//1 = ide
        });

        $('#dist_tirage_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            dtirage_formdata[$( this ).attr('name')] = $( this).val();
        });
        if(checkLinears('.lineareInput4')) {
            $("#id_lineaire_distribution_tirage_btn").removeClass("btn-danger");
            $("#id_lineaire_distribution_tirage_btn").addClass("btn-success");
        } else {
            $("#id_lineaire_distribution_tirage_btn").removeClass("btn-success");
            $("#id_lineaire_distribution_tirage_btn").addClass("btn-danger");
        }

        $("#id_sous_projet_distribution_tirage_btn").click(function () {

            $("#message_distribution_tirage").fadeOut();
            $("#rdistribution_block").toggleClass('block-opt-refresh');

            for (var key in dtirage_formdata) {
                dtirage_formdata[key] = $('#'+key).val();
            }
            dtirage_formdata['ids'] = get('idsousprojet');

            if($("#dt_ok").val() == 1) {
                $("#dt_etat_retour").val(2);
                dtirage_formdata['dt_etat_retour'] = $("#dt_etat_retour").val();
            }

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseaudistribution/tirage_save.php",
                data: dtirage_formdata
            }).done(function (msg) {
                /*var obj = JSON.parse(msg);
                if(obj.error == 0) {
                    $("#dt_duree").val(obj.duree);
                }*/
                $("#rdistribution_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_distribution_tirage');
            });
        });

        $("#id_sous_projet_distribution_tirage_blq").click(function () {
            if(!$('#blq_block').hasClass('block-opt-hidden')) {
                $('#blq_block').addClass('block-opt-hidden');
            }
            if(!$('#blq2_block').hasClass('block-opt-hidden')) {
                $('#blq2_block').addClass('block-opt-hidden');
            }

            blq_ot_dt.ajax.url( 'api/ot/ot/ot_liste.php?idsp='+get('idsousprojet')+'&tentree=distributiontirage' ).load();
        });

        $("#id_lineaire_distribution_tirage_btn").click(function () {

            if ( $( "#dt_lineare_groupe" ).is( ":hidden" ) ) {
                $("#hdfh04l54ff").removeClass("fa-plus");
                $("#hdfh04l54ff").addClass("fa-minus");
                $( "#dt_lineare_groupe" ).show( "fast" );
            } else {
                $( "#dt_lineare_groupe" ).slideUp();
                $("#hdfh04l54ff").removeClass("fa-minus");
                $("#hdfh04l54ff").addClass("fa-plus");
            }
        });
        $('.lineareInput4').on('input', function() {
            if(checkLinears('.lineareInput4')) {
                $("#id_lineaire_distribution_tirage_btn").removeClass("btn-danger");
                $("#id_lineaire_distribution_tirage_btn").addClass("btn-success");
            } else {
                $("#id_lineaire_distribution_tirage_btn").removeClass("btn-success");
                $("#id_lineaire_distribution_tirage_btn").addClass("btn-danger");
            }
        });

        $("#id_sous_projet_distribution_tirage_ot_btn").click(function () {
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
                    App.showMessage(msg, '#message_distribution_tirage');
                }
            });
        });
    } );
</script>