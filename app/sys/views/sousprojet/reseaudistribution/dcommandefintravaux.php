<div class="tab-pane <?= ($value[0]=="dcommandefintravaux"?"active":"")?>" id="dcommandefintravaux_content">
    <form class="form-horizontal push-10-t push-10" id="distribution_cmdfintrvx_form" name="distribution_cmdfintrvx_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dcftrvx_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dcftrvx_intervenant_be" name="dcftrvx_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributioncmdfintravaux!==NULL && $sousProjet->distributioncmdfintravaux->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dcftrvx_date_butoir">Date butoire traitement retour Tir <!--<span class="text-danger">*</span>--></label>
                    <input disabled class="form-control " type="date" id="dcftrvx_date_butoir" name="dcftrvx_date_butoir" value="<?=($sousProjet->distributioncmdfintravaux !== NULL ? $sousProjet->distributioncmdfintravaux->date_butoir : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dcftrvx_traitement_retour_terrain">Traitement Retours terrain <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="dcftrvx_traitement_retour_terrain" name="dcftrvx_traitement_retour_terrain" value="<?=($sousProjet->distributioncmdfintravaux !== NULL ? $sousProjet->distributioncmdfintravaux->traitement_retour_terrain : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dcftrvx_modification_carto">Modification Carto <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dcftrvx_modification_carto" name="dcftrvx_modification_carto">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectModificationCarto::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_modification_carto\" ". ($sousProjet->distributioncmdfintravaux!==NULL && $sousProjet->distributioncmdfintravaux->modification_carto==$result->id_modification_carto ?"selected": "")." >$result->lib_modification_carto</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dcftrvx_commandes_fin_travaux">Commandes Fin Travaux <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dcftrvx_commandes_fin_travaux" name="dcftrvx_commandes_fin_travaux">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectCommandeAcces::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_commande_acces\" ". ($sousProjet->distributioncmdfintravaux!==NULL && $sousProjet->distributioncmdfintravaux->commandes_fin_travaux==$result->id_commande_acces ?"selected": "")." >$result->lib_commande_acces</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dcftrvx_date_transmission_tfx">Date Transmission TFX <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="dcftrvx_date_transmission_tfx" name="dcftrvx_date_transmission_tfx" value="<?=($sousProjet->distributioncmdfintravaux !== NULL ? $sousProjet->distributioncmdfintravaux->date_transmission_tfx : "")?>">
                </div>
                <div class="col-md-6">
                    <label for="dcftrvx_ref_commande_fin_travaux">Référence Commande Fin Travaux <!--<span class="text-danger">*</span>--></label>
                    <br>
                    <input class="js-tags-input form-control " type="text" id="dcftrvx_ref_commande_fin_travaux" name="dcftrvx_ref_commande_fin_travaux" value="<?=($sousProjet->distributioncmdfintravaux !== NULL ? $sousProjet->distributioncmdfintravaux->ref_commande_fin_travaux : "")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dcftrvx_date_debut_travaux_ft">Date Début Travaux FT <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="dcftrvx_date_debut_travaux_ft" name="dcftrvx_date_debut_travaux_ft" value="<?=($sousProjet->distributioncmdfintravaux !== NULL ? $sousProjet->distributioncmdfintravaux->date_debut_travaux_ft : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dcftrvx_date_fin_travaux_ft">Date Fin Travaux FT <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="dcftrvx_date_fin_travaux_ft" name="dcftrvx_date_fin_travaux_ft" value="<?=($sousProjet->distributioncmdfintravaux !== NULL ? $sousProjet->distributioncmdfintravaux->date_fin_travaux_ft : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dcftrvx_go_ft">OK FT <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dcftrvx_go_ft" name="dcftrvx_go_ft">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectGoFt::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_go_ft\" ". ($sousProjet->distributioncmdfintravaux!==NULL && $sousProjet->distributioncmdfintravaux->go_ft==$result->id_go_ft ?"selected": "")." >$result->lib_go_ft</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="dcftrvx_ok">Réalisation de l'ensemble des commandes travaux <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dcftrvx_ok" name="dcftrvx_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->distributioncmdfintravaux!==NULL && $sousProjet->distributioncmdfintravaux->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_distribution_commande_fin_travaux" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_distribution_commande_fin_trvx_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <button id="id_sous_projet_distribution_cmdfintravaux_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_distribution_cmdfintravaux_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>
                    <label class="css-input switch switch-sm switch-success">
                        <input id="id_sous_projet_distribution_cmdfintravaux_charge_be" class="a2tcheckbox" type="checkbox" value="FALSE" <?= ($sousProjet->distributioncmdfintravaux!==NULL && $sousProjet->distributioncmdfintravaux->date_charge_be !=NULL ?"checked" : "")?> ><span></span>
                        Charge BE prise en charge : <span id="charge_be_message_distribution_cmdfintravaux"><?= ($sousProjet->distributioncmdfintravaux!==NULL && $sousProjet->distributioncmdfintravaux->date_charge_be !=NULL ?" Le ".$sousProjet->distributioncmdfintravaux->date_charge_be."" : "")?></span>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="charge-be-confirm_distribution_commande_fin_travaux" title="Confirmer cette affectation ?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer cette affectation ?</p>
</div>
<script>
    var dcmd_fin_trvx_formdata = {};
    $(document).ready(function() {
        var typeetape = "sous_projet_distribution_commande_fin_travaux";
        var variable_etape = "distributioncmdfintravaux";
        var actif = null;
        $( "#charge-be-confirm_distribution_commande_fin_travaux" ).dialog({
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
                            tentree : "distributioncmdfintravaux"
                        }
                    }).done(function (msg) {
                        var obj = JSON.parse(msg);
                        console.log(msg);
                        if(obj.error == 0) {
                            if($("#id_sous_projet_distribution_cmdfintravaux_charge_be").is(':checked')){
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
                                    tentree : "distributioncmdfintravaux",
                                    actif : actif
                                }
                            }).done(function (msg) {
                                var obj = JSON.parse(msg);
                                if(obj.error == 0) {
                                    if(obj.date_charge_be == null){
                                        $("#id_sous_projet_distribution_cmdfintravaux_charge_be").prop('checked',false);
                                        $( "#charge-be-confirm_distribution_commande_fin_travaux" ).dialog( "close" );
                                        $("#charge_be_message_distribution_cmdfintravaux").html("" );
                                        App.showMessage(msg, '#message_distribution_commande_fin_travaux');

                                    }else{
                                        $("#id_sous_projet_distribution_cmdfintravaux_charge_be").prop('checked',true);
                                        $( "#charge-be-confirm_distribution_commande_fin_travaux" ).dialog( "close" );
                                        $("#charge_be_message_distribution_cmdfintravaux").html("Le " + obj.date_charge_be );
                                        App.showMessage(msg, '#message_distribution_commande_fin_travaux');

                                    }
                                } else {

                                }
                            });
                        } else {
                            $( "#charge-be-confirm_distribution_commande_fin_travaux" ).dialog( "close" );
                            App.showMessage(msg, '#message_distribution_commande_fin_travaux');

                        }
                    });
                },
                Non: function() {
                    $( "#charge-be-confirm_distribution_commande_fin_travaux" ).dialog( "close" );
                }
            }
        });
        $('#id_sous_projet_distribution_cmdfintravaux_charge_be').click(function(e){
            e.preventDefault();
            $("#charge-be-confirm_distribution_commande_fin_travaux").dialog("open");

        });
        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"dcommandefintravaux_href","Commandes Fin Travaux: ");

        var liste_intervenant = [];
        $("#id_sous_projet_distribution_cmdfintravaux_btn_osa").click(function () {
            if($( "#dcftrvx_intervenant_be" ).val()!="") liste_intervenant.push( $( "#dcftrvx_intervenant_be" ).val());
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape,liste_intervenant);//1 = ide
        });
        $("#id_sous_projet_distribution_cmdfintravaux_list_tache").click(function () {
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);//1 = ide
        });
        jQuery('#dcftrvx_ref_commande_fin_travaux').tagsinput({});
        $('#distribution_cmdfintrvx_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            dcmd_fin_trvx_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_distribution_commande_fin_trvx_btn").click(function () {
            $("#message_distribution_commande_fin_travaux").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');

            for (var key in dcmd_fin_trvx_formdata) {
                dcmd_fin_trvx_formdata[key] = $('#'+key).val();
            }
            dcmd_fin_trvx_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseaudistribution/commandefintravaux_save.php",
                data: dcmd_fin_trvx_formdata
            }).done(function (msg) {
                $("#rtransport_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_distribution_commande_fin_travaux');
            });
        });
    } );
</script>