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
                    <label for="cftrvx_date_butoir">Date butoire traitement retour Aig <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cftrvx_date_butoir" name="cftrvx_date_butoir" value="<?=($sousProjet->transportcmdfintravaux !== NULL ? $sousProjet->transportcmdfintravaux->date_butoir : "")?>">
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
                    <label for="cftrvx_ok_ft">OK FT <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cftrvx_ok_ft" name="cftrvx_ok_ft">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectGoFt::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_go_ft\" ". ($sousProjet->transportcmdfintravaux!==NULL && $sousProjet->transportcmdfintravaux->ok_ft==$result->id_go_ft ?"selected": "")." >$result->lib_go_ft</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cftrvx_ok">OK <!--<span class="text-danger">*</span>--></label>
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
            </div>
        </div>
        <div class="alert alert-success" id="message_transport_commande_fin_travaux" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_transport_commande_fin_trvx_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                <button id="id_sous_projet_transport_cmdfintravaux_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                </div>
            </div>
        </div>
    </form>

</div>
<script>
    var cmd_fin_trvx_formdata = {};
    $(document).ready(function() {
        $.ajax({
            method : "GET",
            url :"app/sys/api/osa/osa_api.php",
            data:{
                idetape: 2,
                typeetape: "sous_projet_transport_commande_fin_travaux",
                idprojet:26
            },
            success : function(reponse){
                $('#commandefintravaux_href').html("Commandes Fin Travaux: "+reponse);
            }
        });
        $("#id_sous_projet_transport_cmdfintravaux_btn_osa").click(function () {
            var typeetape = "sous_projet_transport_commande_fin_travaux";

            var variable_etape = "transportcmdfintravaux";
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape);//1 = ide
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