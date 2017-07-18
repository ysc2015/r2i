<div class="tab-pane <?= ($value[0]=="tirage"?"active":"")?>" id="tirage_content">
    <form class="form-horizontal push-10-t push-10" id="transport_tirage_form" name="transport_tirage_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="tt_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="tt_intervenant_be" name="tt_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transporttirage!==NULL && $sousProjet->transporttirage->intervenant_be==$result->id_utilisateur ?"selected": "")." >".$result->prenom_utilisateur." ".$result->nom_utilisateur."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tt_plans">Plans <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="tt_plans" name="tt_plans">
                        <option value="" selected="">Sélectionnez état plans</option>
                        <?php
                        $results = SelectEtatPlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_plan\" ". ($sousProjet->transporttirage!==NULL && $sousProjet->transporttirage->plans==$result->id_etat_plan ?"selected": "")." >$result->lib_etat_plan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tt_controle_plans">Contrôle des plans <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="tt_controle_plans" name="tt_controle_plans">
                        <option value="" selected="">Sélectionnez type controle</option>
                        <?php
                        $results = SelectControlePlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_plan\" ". ($sousProjet->transporttirage!==NULL && $sousProjet->transporttirage->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tt_date_transmission_plans">Date Transmission Plans <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="tt_date_transmission_plans" name="tt_date_transmission_plans" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->date_transmission_plans:"")?>" placeholder="plans non transmis">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <button id="id_lineaire_transport_tirage_btn" class="btn btn-danger" type="button"><i id="hdf04l54ff" class="fa fa-plus push-5-r"></i> Linéaire de réseau</button>
            <div id="tt_lineare_groupe" style="border-left: dashed 1px #000;border-right: dashed 1px #000;border-bottom: dashed 1px #000;margin-top: 5px;padding: 5px;display: none">
                <label><span class="label label-info">Câbles </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="tt_lineaire1">câble 720FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire1" name="tt_lineaire1" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire1:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="tt_lineaire_reseau">câble 432FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire2" name="tt_lineaire2" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire2:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                        <label for="tt_lineaire_reseau">câble 288FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire3" name="tt_lineaire3" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire3:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                        <label for="tt_lineaire_reseau">câble 144FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire4" name="tt_lineaire4" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire4:"")?>">
                    </div>
                </div>
                <label><span class="label label-success">Tubage </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="tt_lineaire_reseau">21/25 <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire9" name="tt_lineaire9" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire9:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="tt_lineaire_reseau">16/20 <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire10" name="tt_lineaire10" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire10:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                        <label for="tt_lineaire_reseau">15/18 <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire11" name="tt_lineaire11" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire11:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                        <label for="tt_lineaire_reseau">Trançons à tuber <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire12" name="tt_lineaire12" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire12:"")?>">
                    </div>
                </div>
                <label><span class="label label-warning">Boites </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="tt_lineaire_reseau">BPE 720FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire5" name="tt_lineaire5" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire5:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="tt_lineaire_reseau">BPE 432FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire6" name="tt_lineaire6" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire6:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                        <label for="tt_lineaire_reseau">BPE 288FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire7" name="tt_lineaire7" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire7:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                        <label for="tt_lineaire_reseau">BPE 144FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire8" name="tt_lineaire8" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire8:"")?>">
                    </div>
                </div>
                <label><span class="label label-primary">NRO </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="tt_lineaire_reseau">CTR <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire13" name="tt_lineaire13" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire13:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="tt_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="tt_lineaire_reseau">TOR <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput2" type="number" id="tt_lineaire14" name="tt_lineaire14" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lineaire14:"")?>">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="tt_date_tirage">Date de début tirage <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="tt_date_tirage" name="tt_date_tirage" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->date_tirage:"")?>" placeholder="Tirage non plannifié">
                </div>
                <div class="col-md-4">
                    <label for="tt_date_ret_prevue">Date prévisionnelle de fin tirage <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="tt_date_ret_prevue" name="tt_date_ret_prevue" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->date_ret_prevue:"")?>" placeholder="Tirage non plannifié">
                </div>
                <div class="col-md-4">
                    <label for="tt_duree">Durée(jours) <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="tt_duree" name="tt_duree" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->duree:"")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="tt_id_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="tt_id_entreprise" name="tt_id_entreprise">
                        <option value="" selected="">Non Attribué</option>
                        <?php
                        $results = EntrepriseSTT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->transporttirage!==NULL && $sousProjet->transporttirage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tt_controle_demarrage_effectif">Avancement Travaux <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="tt_controle_demarrage_effectif" name="tt_controle_demarrage_effectif">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = EtatOT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_ot\" ". ($sousProjet->transporttirage!==NULL && $sousProjet->transporttirage->controle_demarrage_effectif==$result->id_etat_ot ?"selected": "")." >$result->lib_etat_ot</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tt_date_retour">Date Retour <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="date" id="tt_date_retour" name="tt_date_retour" value="<?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->date_retour:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="tt_etat_retour">Etat Retour <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="tt_etat_retour" name="tt_etat_retour">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatRetour::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_retour\" ". ($sousProjet->transporttirage!==NULL && $sousProjet->transporttirage->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="tt_lien_plans">Lien vers les plans <!--<span class="text-danger">*</span>--></label>
                    <textarea class="form-control" id="tt_lien_plans" name="tt_lien_plans" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->lien_plans:"")?></textarea>
                </div>
                <?php if($sousProjet->transporttirage!==NULL && $sousProjet->transporttirage->etat_retour==2) {?>
                    <div class="col-md-4">
                        <label for="tt_retour_presta">Retour presta <!--<span class="text-danger">*</span>--></label>
                        <textarea readonly class="form-control" id="tt_retour_presta" name="tt_retour_presta" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->transporttirage !== NULL?$sousProjet->transporttirage->retour_presta:"")?></textarea>
                    </div>
                <?php } ?>
                <div class="col-md-4">
                    <label for="tt_ok">Retours Prestataire Validés <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="tt_ok" name="tt_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->transporttirage!==NULL && $sousProjet->transporttirage->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
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
                        <label for="tt_fileuploader_chambre">Fichier(s) chambres</label>
                        <div id="tt_fileuploader_chambre"></div>
                    </div>
                </div>
                <?php if($sousProjet->transporttirage!==NULL && $sousProjet->transporttirage->etat_retour==2) {?>
                    <div class="col-md-6">
                        <div class="row retourpresta" style="padding-left: 10px;">
                            <label for="tt_fileuploader_retour">Fichier(s) retour presta</label>
                            <div id="tt_fileuploader_retour"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="alert alert-success" id="message_transport_tirage" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-xs-12">
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
                        <button id="id_sous_projet_transport_tirage_btn" class="btn btn-primary btn-sm" type="button"><i class="fa fa-check push-5-r"></i> Enregistrer</button>
                        <?php
                        }
                    } else if($sousProjet_master->id_sous_projet == $sousProjet->id_sous_projet) {
                        if($connectedProfil->profil->profil->shortlib != "vpi" ) {
                        ?>
                        <button id="id_sous_projet_transport_tirage_btn" class="btn btn-primary btn-sm" type="button"><i class="fa fa-check push-5-r"></i> Enregistrer</button>
                        <?php
                        }
                    } else {?>
                        <a href="?page=sousprojet&idsousprojet=<?=$sousProjet_master->id_sous_projet?>" class="btn btn-primary btn-sm" type="button">Maitre CTR</a>
                    <?php }?>

                    <button id="id_sous_projet_transport_tirage_ot_btn" class="btn btn-info btn-sm" type="button"><i class="fa fa-calendar-o push-5-r"></i> Ordre de travail</button>
                    <button id="id_sous_projet_transport_tirage_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_transport_tirage_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>
                    <button id="id_sous_projet_transport_tirage_blq" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#blq-modal' data-backdrop="static" data-keyboard="false" type="button"><i class="fa fa-question push-5-r"></i> BLQ / PBC</button>
                    <label class="css-input switch switch-sm switch-success">
                        <input id="id_sous_projet_transport_tirage_charge_be" class="a2tcheckbox" type="checkbox" value="FALSE" <?= ($sousProjet->transporttirage!==NULL && $sousProjet->transporttirage->date_charge_be !=NULL ?"checked" : "")?> ><span></span>
                        Prise en charge BE : <span id="charge_be_message_transport_tirage"><?= ($sousProjet->transporttirage!==NULL && $sousProjet->transporttirage->date_charge_be !=NULL ?" Le ".$sousProjet->transporttirage->date_charge_be."" : "")?></span>
                    </label>
                </div>
            </div>
        </div>
    </form>

</div>
<div id="charge-be-confirm_transport_tirage" title="Confirmer cette affectation ?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer cette affectation ?</p>
</div>
<script>
    var tirage_formdata = {};
    var ttirage_chambre_uploader_options = {
        url: "api/sousprojet/reseautransport/upload_tirage_chambre.php",
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
                data: {id_sous_projet:get('idsousprojet'),type_objet:'transport_tirage_chambre'},
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
    var tt_fileuploader_retour_options = {
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
                data: {idsp:get('idsousprojet'),etapes:'2,4'},//Tirage CTR - Tirage et Raccordement CTR
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
        ttirage_chambre_uploader_options = merge_options(defaultUploaderStrLocalisation,ttirage_chambre_uploader_options);
        ttirage_chambre_uploader_options.abortStr = 'Injection en cours ...';
        ttirage_chambre_uploader = $("#tt_fileuploader_chambre").uploadFile(ttirage_chambre_uploader_options);

        tt_fileuploader_retour_options = merge_options(defaultUploaderStrLocalisation,tt_fileuploader_retour_options);
        tt_fileuploader_retour = $("#tt_fileuploader_retour").uploadFile(tt_fileuploader_retour_options);
    });
    $(document).ready(function() {
        var typeetape = "sous_projet_transport_tirage";
        var variable_etape = "transporttirage";
        var actif = null;
        $( "#charge-be-confirm_transport_tirage" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {

                            if($("#id_sous_projet_transport_tirage_charge_be").is(':checked')){
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
                                    tentree : "transporttirage",
                                    actif : actif
                                }
                            }).done(function (msg) {
                                var obj = JSON.parse(msg);
                                if(obj.error == 0) {
                                    if(obj.date_charge_be == null){
                                        $("#id_sous_projet_transport_tirage_charge_be").prop('checked',false);
                                        $( "#charge-be-confirm_transport_tirage" ).dialog( "close" );
                                        $("#charge_be_message_transport_tirage").html("" );
                                        App.showMessage(msg, '#message_transport_tirage');

                                    }else{
                                        $("#id_sous_projet_transport_tirage_charge_be").prop('checked',true);
                                        $( "#charge-be-confirm_transport_tirage" ).dialog( "close" );
                                        $("#charge_be_message_transport_tirage").html("Le " + obj.date_charge_be );
                                        App.showMessage(msg, '#message_transport_tirage');

                                    }
                                } else {
                                    $( "#charge-be-confirm_transport_tirage" ).dialog( "close" );
                                    App.showMessage(msg, '#message_transport_tirage');

                                }
                            });

                },
                Non: function() {
                    $( "#charge-be-confirm_transport_tirage" ).dialog( "close" );
                }
            }
        });
        $('#id_sous_projet_transport_tirage_charge_be').click(function(e){
            e.preventDefault();
            $("#charge-be-confirm_transport_tirage").dialog("open");

        });

        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"tirage_href","Tirage: ");

        var liste_intervenant = [];
        $("#id_sous_projet_transport_tirage_btn_osa").click(function () {
            if($( "#tt_intervenant_be" ).val()!="") liste_intervenant.push( $( "#tt_intervenant_be" ).val());
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape,liste_intervenant);//1 = ide
        });
        $("#id_sous_projet_transport_tirage_list_tache").click(function () {
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);//1 = ide
        });

        $('#transport_tirage_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            tirage_formdata[$( this ).attr('name')] = $( this).val();
        });
        if(checkLinears('.lineareInput2')) {
            $("#id_lineaire_transport_tirage_btn").removeClass("btn-danger");
            $("#id_lineaire_transport_tirage_btn").addClass("btn-success");
        } else {
            $("#id_lineaire_transport_tirage_btn").removeClass("btn-success");
            $("#id_lineaire_transport_tirage_btn").addClass("btn-danger");
        }
        $("#id_sous_projet_transport_tirage_btn").click(function () {

            $("#message_transport_tirage").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');

            for (var key in tirage_formdata) {
                tirage_formdata[key] = $('#'+key).val();
            }
            tirage_formdata['ids'] = get('idsousprojet');

            if($("#tt_ok").val() == 1) {
                $("#tt_etat_retour").val(2);
                tirage_formdata['tt_etat_retour'] = $("#tt_etat_retour").val();
            }

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseautransport/tirage_save.php",
                data: tirage_formdata
            }).done(function (msg) {
                /*var obj = JSON.parse(msg);
                if(obj.error == 0) {
                    $("#tt_duree").val(obj.duree);
                }*/
                $("#rtransport_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_transport_tirage');
            });
        });

        $("#id_sous_projet_transport_tirage_blq").click(function () {
            if(!$('#blq_block').hasClass('block-opt-hidden')) {
                $('#blq_block').addClass('block-opt-hidden');
            }
            if(!$('#blq2_block').hasClass('block-opt-hidden')) {
                $('#blq2_block').addClass('block-opt-hidden');
            }

            blq_ot_dt.ajax.url( 'api/ot/ot/ot_liste.php?idsp='+get('idsousprojet')+'&tentree=transporttirage' ).load();
        });

        $("#id_lineaire_transport_tirage_btn").click(function () {

            if ( $( "#tt_lineare_groupe" ).is( ":hidden" ) ) {
                $("#hdf04l54ff").removeClass("fa-plus");
                $("#hdf04l54ff").addClass("fa-minus");
                $( "#tt_lineare_groupe" ).show( "fast" );
            } else {
                $( "#tt_lineare_groupe" ).slideUp();
                $("#hdf04l54ff").removeClass("fa-minus");
                $("#hdf04l54ff").addClass("fa-plus");
            }
        });

        $('.lineareInput2').on('input', function() {
            if(checkLinears('.lineareInput2')) {
                $("#id_lineaire_transport_tirage_btn").removeClass("btn-danger");
                $("#id_lineaire_transport_tirage_btn").addClass("btn-success");
            } else {
                $("#id_lineaire_transport_tirage_btn").removeClass("btn-success");
                $("#id_lineaire_transport_tirage_btn").addClass("btn-danger");
            }
        });

        $("#id_sous_projet_transport_tirage_ot_btn").click(function () {
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
                    document.location.href = '?page=ot&idsousprojet='+get('idsousprojet')+'&tentree=transporttirage';
                } else {
                    App.showMessage(msg, '#message_transport_tirage');
                }
            });
        });
    } );
</script>