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
                    <input class="form-control " type="date" id="tr_date_transmission_pds" name="tr_date_transmission_pds" value="<?=($sousProjet->transportraccordement !== NULL ? $sousProjet->transportraccordement->date_transmission_pds : "")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="tr_id_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="tr_id_entreprise" name="tr_id_entreprise">
                        <option value="" selected="">Sélectionnez une entreprise</option>
                        <?php
                        $results = EntrepriseSTT::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tr_date_racco">Date Racco <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="tr_date_racco" name="tr_date_racco" value="<?=($sousProjet->transportraccordement !== NULL ? $sousProjet->transportraccordement->date_racco : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="tr_duree">Durée <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="number" id="tr_duree" name="tr_duree" value="<?=($sousProjet->transportraccordement !== NULL ? $sousProjet->transportraccordement->duree : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="tr_controle_demarrage_effectif">Contrôle démarrage effectif <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="tr_controle_demarrage_effectif" name="tr_controle_demarrage_effectif">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectControleDemarrageEffectif::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_demarrage_effectif\" ". ($sousProjet->transportraccordement!==NULL && $sousProjet->transportraccordement->controle_demarrage_effectif==$result->id_controle_demarrage_effectif ?"selected": "")." >$result->lib_controle_demarrage_effectif</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="tr_date_retour">Date Retour <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="tr_date_retour" name="tr_date_retour" value="<?=($sousProjet->transportraccordement !== NULL ? $sousProjet->transportraccordement->date_retour : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="tr_etat_retour">Etat Retour <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="tr_etat_retour" name="tr_etat_retour">
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
                <div class="col-md-4">
                    <label for="tr_retour_presta">Retour presta <!--<span class="text-danger">*</span>--></label>
                    <textarea class="form-control" id="tr_retour_presta" name="tr_retour_presta" rows="6" placeholder="Collez lien ici.."><?=($sousProjet->transportraccordement !== NULL?$sousProjet->transportraccordement->retour_presta:"")?></textarea>
                </div>
                <div class="col-md-4">
                    <label for="tr_ok">OK <!--<span class="text-danger">*</span>--></label>
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
        <div class="alert alert-success" id="message_transport_raccordements" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_transport_raccordements_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <button id="id_sous_projet_transport_raccord_ot_btn" class="btn btn-info btn-sm" type="button"><i class="fa fa-calendar-o push-5-r"></i> Ordre de travail</button>
                    <button id="id_sous_projet_transport_raccordemants_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                </div>
            </div>
        </div>
    </form>

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
        allowedTypes: "xlsx",
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

            /*traccord_chambre_idres = id;
            $('#traccord-chambre-modal').modal({backdrop: 'static', keyboard: false});
            traccord_chambre_table.draw(false);*/

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
        allowedTypes: "xlsx",
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
            $('#traccord-pboite-modal').modal({backdrop: 'static', keyboard: false});
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
    var traccord_chambre_idres = 0;
    var traccord_chambre_table;
    $(function () {
        traccord_chambre_uploader_options = merge_options(defaultUploaderStrLocalisation,traccord_chambre_uploader_options);
        traccord_chambre_uploader_options.abortStr = 'Injection en cours ...';
        traccord_chambre_uploader = $("#tr_fileuploader_chambre").uploadFile(traccord_chambre_uploader_options);

        traccord_pboite_uploader_options = merge_options(defaultUploaderStrLocalisation,traccord_pboite_uploader_options);
        traccord_pboite_uploader_options.downloadStr = 'Téléchargez/Voir infos';
        traccord_pboite_uploader = $("#tr_fileuploader_pboite").uploadFile(traccord_pboite_uploader_options);
    });
    $(document).ready(function() {
        var typeetape = "sous_projet_transport_raccordements";
        var variable_etape = "transportraccordement";

        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"raccordements_href","Raccordement: ");

        $("#id_sous_projet_transport_raccordemants_btn_osa").click(function () {
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape);//1 = ide
        });
        $('#transport_raccord_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            raccord_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_transport_raccordements_btn").click(function () {

            $("#message_transport_raccordements").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');

            for (var key in raccord_formdata) {
                raccord_formdata[key] = $('#'+key).val();
            }
            raccord_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseautransport/raccord_save.php",
                data: raccord_formdata
            }).done(function (msg) {
                $("#rtransport_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_transport_raccordements');
            });
        });

        traccord_chambre_table = $('#traccord_chambre_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "bJQueryUI": true,
            "bStateSave": true,
            "ajax": {
                "url": 'api/ot/chambreot/chambre_liste.php',
                "type": 'POST',
                "data": function ( d ) {
                    return {idres : traccord_chambre_idres}
                }
            },
            "columns": [
                { "data": "id_chambre" },
                { "data": "id_ressource" },
                { "data": "id_sous_projet" },
                { "data": "type_entree" },
                { "data": "ref_chambre" },
                { "data": "villet" },
                { "data": "sous_projet" },
                { "data": "ref_note" },
                { "data": "code_ch1" },
                { "data": "code_ch2" },
                { "data": "gps" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2,3 ], "visible": false, "searchable": false }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {

            }
        } );
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
                    document.location.href = '?page=ot&idsousprojet='+get('idsousprojet')+'&tentree=transporttirage';
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
<!-- plans boite Modal -->
<div class="modal fade" id="traccord-pboite-modal"  role="dialog" aria-hidden="true"><!--tabindex="-1"-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b" id="traccord-pboite-block">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Infos plans boite</h3>
                </div>
                <div class="block-content table-responsive">
                    <table id="traccord_pboite_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
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

<!-- chambre Modal -->
<div class="modal fade" id="traccord-chambre-modal"  role="dialog" aria-hidden="true"><!--tabindex="-1"-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b" id="traccord-chambre-block">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Chambres injectées</h3>
                </div>
                <div class="block-content table-responsive">
                    <table id="traccord_chambre_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>id_res</th>
                            <th>ids</th>
                            <th>tentree</th>
                            <th>ref chambre</th>
                            <th>villet</th>
                            <th>sous projet</th>
                            <th>ref note</th>
                            <th>code ch1</th>
                            <th>code ch2</th>
                            <th>gps</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>id_res</th>
                            <th>ids</th>
                            <th>tentree</th>
                            <th>ref chambre</th>
                            <th>villet</th>
                            <th>sous projet</th>
                            <th>ref note</th>
                            <th>code ch1</th>
                            <th>code ch2</th>
                            <th>gps</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END chambre Modal -->