<div class="tab-pane <?= ($value[0]=="aiguillage"?"active":"")?>" id="aiguillage_content">
    <form class="form-horizontal push-10-t push-10" id="transport_aiguillage_form" name="transport_aiguillage_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="ta_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="ta_intervenant_be" name="ta_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportaiguillage!==NULL && $sousProjet->transportaiguillage->intervenant_be==$result->id_utilisateur ?"selected": "")." >".$result->prenom_utilisateur." ".$result->nom_utilisateur."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="ta_plans">Plans <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="ta_plans" name="ta_plans">
                        <option value="" selected="">Sélectionnez état plans</option>
                        <?php
                        $results = SelectEtatPlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_plan\" ". ($sousProjet->transportaiguillage!==NULL && $sousProjet->transportaiguillage->plans==$result->id_etat_plan ?"selected": "")." >$result->lib_etat_plan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="ta_controle_plans">Contrôle des plans <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="ta_controle_plans" name="ta_controle_plans">
                        <option value="" selected="">Sélectionnez type controle</option>
                        <?php
                        $results = SelectControlePlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_plan\" ". ($sousProjet->transportaiguillage!==NULL && $sousProjet->transportaiguillage->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="ta_date_transmission_plans">Date Transmission Plans <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="ta_date_transmission_plans" name="ta_date_transmission_plans" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->date_transmission_plans:"")?>" placeholder="plans non transmis">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <button id="id_lineaire_transport_aiguillage_btn" class="btn btn-danger" type="button"><i id="hdf0454ff" class="fa fa-plus push-5-r"></i> Linéaire de réseau</button>
            <div id="lineare_groupe" style="border-left: dashed 1px #000;border-right: dashed 1px #000;border-bottom: dashed 1px #000;margin-top: 5px;padding: 5px;display: none">
                <label><span class="label label-info">Câbles </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="ta_lineaire1">câble 720FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput" type="number" id="ta_lineaire1" name="ta_lineaire1" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire1:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="ta_lineaire_reseau">câble 432FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput" type="number" id="ta_lineaire2" name="ta_lineaire2" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire2:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                        <label for="ta_lineaire_reseau">câble 288FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput" type="number" id="ta_lineaire3" name="ta_lineaire3" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire3:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                        <label for="ta_lineaire_reseau">câble 144FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput" type="number" id="ta_lineaire4" name="ta_lineaire4" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire4:"")?>">
                    </div>
                </div>
                <label><span class="label label-warning">Boites </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="ta_lineaire_reseau">BPE 720FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput" type="number" id="ta_lineaire5" name="ta_lineaire5" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire5:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="ta_lineaire_reseau">BPE 432FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput" type="number" id="ta_lineaire6" name="ta_lineaire6" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire6:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                        <label for="ta_lineaire_reseau">BPE 288FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput" type="number" id="ta_lineaire7" name="ta_lineaire7" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire7:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                        <label for="ta_lineaire_reseau">BPE 144FO <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput" type="number" id="ta_lineaire8" name="ta_lineaire8" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire8:"")?>">
                    </div>
                </div>
                <label><span class="label label-primary">NRO </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="ta_lineaire_reseau">CTR <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput" type="number" id="ta_lineaire9" name="ta_lineaire9" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire9:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="ta_lineaire_reseau">TOR <!--<span class="text-danger">*</span>--></label>
                        <input class="form-control  lineareInput" type="number" id="ta_lineaire10" name="ta_lineaire10" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire10:"")?>">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="ta_date_aiguillage">Date de début d’aiguillage <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="ta_date_aiguillage" name="ta_date_aiguillage" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->date_aiguillage:"")?>" placeholder="Aiguillage non plannifié">
                </div>
                <div class="col-md-4">
                    <label for="ta_date_ret_prevue">Date prévisionnelle de fin d’aiguillage <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="ta_date_ret_prevue" name="ta_date_ret_prevue" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->date_ret_prevue:"")?>" placeholder="Aiguillage non plannifié">
                </div>
                <div class="col-md-4">
                    <label for="ta_duree">Durée(jours) <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="ta_duree" name="ta_duree" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->duree:"")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="ta_id_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="ta_id_entreprise" name="ta_id_entreprise">
                        <option value="" selected="">Non Attribué</option>
                        <?php
                        $results = EntrepriseSTT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->transportaiguillage!==NULL && $sousProjet->transportaiguillage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="ta_controle_demarrage_effectif">Avancement Travaux <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="ta_controle_demarrage_effectif" name="ta_controle_demarrage_effectif">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = EtatOT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_ot\" ". ($sousProjet->transportaiguillage!==NULL && $sousProjet->transportaiguillage->controle_demarrage_effectif==$result->id_etat_ot ?"selected": "")." >$result->lib_etat_ot</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="ta_date_retour">Date Retour <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="date" id="ta_date_retour" name="ta_date_retour" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->date_retour:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="ta_etat_retour">Etat Retour <!--<span class="text-danger">*</span>--></label>
                    <select disabled class="form-control " id="ta_etat_retour" name="ta_etat_retour">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatRetour::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_retour\" ". ($sousProjet->transportaiguillage!==NULL && $sousProjet->transportaiguillage->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="ta_lien_plans">Lien vers les plans <!--<span class="text-danger">*</span>--></label>
                    <textarea class="form-control" id="ta_lien_plans" name="ta_lien_plans" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lien_plans:"")?></textarea>
                </div>
                <?php if($sousProjet->transportaiguillage!==NULL && $sousProjet->transportaiguillage->etat_retour==2) {?>
                    <div class="col-md-4">
                        <label for="ta_retour_presta">Retour presta <!--<span class="text-danger">*</span>--></label>
                        <textarea readonly class="form-control" id="ta_retour_presta" name="ta_retour_presta" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->retour_presta:"")?></textarea>
                    </div>
                <?php } ?>
                <div class="col-md-4">
                    <label for="ta_ok">Retours Prestataires Validés <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="ta_ok" name="ta_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->transportaiguillage!==NULL && $sousProjet->transportaiguillage->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
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
                        <label for="ta_fileuploader_chambre">Fichier(s) chambres</label>
                        <div id="ta_fileuploader_chambre"></div>
                    </div>
                </div>
                <?php if($sousProjet->transportaiguillage!==NULL && $sousProjet->transportaiguillage->etat_retour==2) {?>
                    <div class="col-md-6">
                        <div class="row retourpresta" style="padding-left: 10px;">
                            <label for="ta_fileuploader_retour">Fichier(s) retour presta</label>
                            <div id="ta_fileuploader_retour"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="alert alert-success" id="message_transport_aiguillage" role="alert" style="display: none;"></div>
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
                    <?php if($sousProjet_master == NULL) {?>
                        <button id="id_sous_projet_transport_aiguillage_btn" class="btn btn-primary btn-sm" type="button"><i class="fa fa-check push-5-r"></i> Enregistrer</button>
                    <?php } else if($sousProjet_master->id_sous_projet == $sousProjet->id_sous_projet) {?>
                        <button id="id_sous_projet_transport_aiguillage_btn" class="btn btn-primary btn-sm" type="button"><i class="fa fa-check push-5-r"></i> Enregistrer</button>
                    <?php } else {?>
                        <a href="?page=sousprojet&idsousprojet=<?=$sousProjet_master->id_sous_projet?>" class="btn btn-primary btn-sm" type="button">Maitre CTR</a>
                    <?php }?>

                    <button id="id_sous_projet_transport_aiguillage_ot_btn" class="btn btn-info btn-sm" type="button"><i class="fa fa-calendar-o push-5-r"></i> Ordre de travail</button>
                    <button id="id_sous_projet_transport_aiguillage_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_transport_aiguillage_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>
                    <button id="id_sous_projet_transport_aiguillage_blq" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#blq-modal' data-backdrop="static" data-keyboard="false" type="button"><i class="fa fa-question push-5-r"></i> BLQ / PBC</button>
                </div>

            </div>
        </div>
    </form>
</div>
<script>
    var aiguillage_formdata = {};
    var taiguillage_chambre_uploader_options = {
        url: "api/sousprojet/reseautransport/upload_aiguillage_chambre.php",
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
                data: {id_sous_projet:get('idsousprojet'),type_objet:'transport_aiguillage_chambre'},
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
    var ta_fileuploader_retour_options = {
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
                data: {idsp:get('idsousprojet'),etapes:'1'},//Aiguillage CTR
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
        taiguillage_chambre_uploader_options = merge_options(defaultUploaderStrLocalisation,taiguillage_chambre_uploader_options);
        taiguillage_chambre_uploader_options.abortStr = 'Injection en cours ...';
        taiguillage_chambre_uploader = $("#ta_fileuploader_chambre").uploadFile(taiguillage_chambre_uploader_options);

        ta_fileuploader_retour_options = merge_options(defaultUploaderStrLocalisation,ta_fileuploader_retour_options);
        ta_fileuploader_retour = $("#ta_fileuploader_retour").uploadFile(ta_fileuploader_retour_options);
    });
    $(document).ready(function() {
        var typeetape = "sous_projet_transport_aiguillage";

        var variable_etape = "transportaiguillage";
        var liste_intervenant = [];
        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"aiguillage_href","Aiguillage : ");

        $("#id_sous_projet_transport_aiguillage_btn_osa").click(function () {
            liste_intervenant[0] = $( "#ta_intervenant_be" ).val();
             appelscriptosa(typeetape,get("idsousprojet"),variable_etape,liste_intervenant);//1 = ide
        });
        $('#id_sous_projet_transport_aiguillage_list_tache').click(function (){
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);
        });
        $('#transport_aiguillage_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            aiguillage_formdata[$( this ).attr('name')] = $( this).val();
        });
        if(checkLinears('.lineareInput')) {
            $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-danger");
            $("#id_lineaire_transport_aiguillage_btn").addClass("btn-success");
        } else {
            $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-success");
            $("#id_lineaire_transport_aiguillage_btn").addClass("btn-danger");
        }

        $("#id_sous_projet_transport_aiguillage_btn").click(function () {

            $("#message_transport_aiguillage").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');

            for (var key in aiguillage_formdata) {
                aiguillage_formdata[key] = $('#'+key).val();
            }
            aiguillage_formdata['ids'] = get('idsousprojet');
            //aiguillage_formdata['ta_duree'] = $("#ta_duree").val();

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseautransport/aiguillage_save.php",
                data: aiguillage_formdata
            }).done(function (msg) {
                /*var obj = JSON.parse(msg);
                if(obj.error == 0) {
                    $("#ta_duree").val(obj.duree);
                }*/
                $("#rtransport_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_transport_aiguillage');
            });
        });

        $("#id_sous_projet_transport_aiguillage_blq").click(function () {
            if(!$('#blq_block').hasClass('block-opt-hidden')) {
                $('#blq_block').addClass('block-opt-hidden');
            }
            if(!$('#blq2_block').hasClass('block-opt-hidden')) {
                $('#blq2_block').addClass('block-opt-hidden');
            }

            blq_ot_dt.ajax.url( 'api/ot/ot/ot_liste.php?idsp='+get('idsousprojet')+'&tentree=transportaiguillage' ).load();
        });

        $("#id_lineaire_transport_aiguillage_btn").click(function () {

            if ( $( "#lineare_groupe" ).is( ":hidden" ) ) {
                $("#hdf0454ff").removeClass("fa-plus");
                $("#hdf0454ff").addClass("fa-minus");
                $( "#lineare_groupe" ).show( "fast" );
            } else {
                $( "#lineare_groupe" ).slideUp();
                $("#hdf0454ff").removeClass("fa-minus");
                $("#hdf0454ff").addClass("fa-plus");
            }
        });
        $('.lineareInput').on('input', function() {
            if(checkLinears('.lineareInput')) {
                $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-danger");
                $("#id_lineaire_transport_aiguillage_btn").addClass("btn-success");
            } else {
                $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-success");
                $("#id_lineaire_transport_aiguillage_btn").addClass("btn-danger");
            }
        });

        $("#id_sous_projet_transport_aiguillage_ot_btn").click(function () {
            $.ajax({
                method: "POST",
                url: "api/ot/ot/check_ot.php",
                data: {
                    ids : get('idsousprojet'),
                    tentree : 'transportaiguillage'
                }
            }).done(function (msg) {
                console.log(msg);
                var obj = JSON.parse(msg);
                if(obj.error == 0) {
                    document.location.href = '?page=ot&idsousprojet='+get('idsousprojet')+'&tentree=transportaiguillage';
                } else {
                    App.showMessage(msg, '#message_transport_aiguillage');
                }
            });
        });
    } );
</script>