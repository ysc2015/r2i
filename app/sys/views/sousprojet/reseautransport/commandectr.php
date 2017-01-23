<div class="tab-pane <?= ($value[0]=="commandectr"?"active":"")?>" id="commandectr_content">
    <form class="form-horizontal push-10-t push-10" id="transport_cmdctr_form" name="transport_cmdctr_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="cctr_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cctr_intervenant_be" name="cctr_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportcmcctr!==NULL && $sousProjet->transportcmcctr->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cctr_date_butoir">Date butoire traitement retour Aig <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cctr_date_butoir" name="cctr_date_butoir" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->date_butoir : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cctr_traitement_retour_terrain">Traitement Retours terrain <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cctr_traitement_retour_terrain" name="cctr_traitement_retour_terrain" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->traitement_retour_terrain : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cctr_modification_carto">Modification Carto <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cctr_modification_carto" name="cctr_modification_carto">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectModificationCarto::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_modification_carto\" ". ($sousProjet->transportcmcctr!==NULL && $sousProjet->transportcmcctr->modification_carto==$result->id_modification_carto ?"selected": "")." >$result->lib_modification_carto</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="cctr_commandes_acces">Commande Accès <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cctr_commandes_acces" name="cctr_commandes_acces">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectCommandeAcces::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_commande_acces\" ". ($sousProjet->transportcmcctr!==NULL && $sousProjet->transportcmcctr->commandes_acces==$result->id_commande_acces ?"selected": "")." >$result->lib_commande_acces</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cctr_date_transmission_ca">Date Transmission CA <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cctr_date_transmission_ca" name="cctr_date_transmission_ca" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->date_transmission_ca : "")?>">
                </div>
                <div class="col-md-6">
                    <label for="cctr_ref_commande_acces">Référence Commande Accès <!--<span class="text-danger">*</span>--></label>
                    <br>
                    <input class="js-tags-input form-control " type="text" id="cctr_ref_commande_acces" name="cctr_ref_commande_acces" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->ref_commande_acces : "")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="cctr_date_depot_cmd">Date de dépôt de la commande <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cctr_date_depot_cmd" name="cctr_date_depot_cmd" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->date_depot_cmd : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cctr_date_debut_travaux_ft">Date Début Travaux FT <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cctr_date_debut_travaux_ft" name="cctr_date_debut_travaux_ft" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->date_debut_travaux_ft : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cctr_date_fin_travaux_ft">Date Fin Travaux FT <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="cctr_date_fin_travaux_ft" name="cctr_date_fin_travaux_ft" value="<?=($sousProjet->transportcmcctr !== NULL ? $sousProjet->transportcmcctr->date_fin_travaux_ft : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="cctr_go_ft">GO FT <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="cctr_go_ft" name="cctr_go_ft">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectGoFt::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_go_ft\" ". ($sousProjet->transportcmcctr!==NULL && $sousProjet->transportcmcctr->go_ft==$result->id_go_ft ?"selected": "")." >$result->lib_go_ft</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="cctr_ok">Réalisation de l'ensemble des commandes Structurantes <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control" id="cctr_ok" name="cctr_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->transportcmcctr!==NULL && $sousProjet->transportcmcctr->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_transport_commande_ctr" role="alert" style="display: none;"></div>
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
                        <button id="id_sous_projet_transport_commande_ctr_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <?php } else if($sousProjet_master->id_sous_projet == $sousProjet->id_sous_projet) {?>
                        <button id="id_sous_projet_transport_commande_ctr_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <?php } else {?>
                        <a href="?page=sousprojet&idsousprojet=<?=$sousProjet_master->id_sous_projet?>" class="btn btn-primary btn-sm" type="button">Maitre CTR</a>
                    <?php }?>

                    <button id="id_sous_projet_transport_commande_ctr_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_transport_commande_ctr_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>
                </div>
            </div>
        </div>
    </form>

</div>
<script>
    var cmd_formdata = {};
    $(function () {
        // Init page plugins & helpers
        jQuery('#cctr_ref_commande_acces').tagsinput({});
    });
    $(document).ready(function() {
        var typeetape = "sous_projet_transport_commande_ctr";

        var variable_etape = "transportcmcctr";
        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"commandectr_href","CMD Structurante CTR: ");

        $("#id_sous_projet_transport_commande_ctr_btn_osa").click(function () {
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape);//1 = ide
        });
        $("#id_sous_projet_transport_commande_ctr_list_tache").click(function(){
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);
        })

        $('#transport_cmdctr_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            cmd_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_transport_commande_ctr_btn").click(function () {
            $("#message_transport_commande_ctr").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');

            for (var key in cmd_formdata) {
                cmd_formdata[key] = $('#'+key).val();
            }
            cmd_formdata['ids'] = get('idsousprojet');

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseautransport/cmdctr_save.php",
                data: cmd_formdata
            }).done(function (msg) {
                $("#rtransport_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_transport_commande_ctr');
            });
        });

        $("#cctr_ref_commande_acces").change(function(e) {
            e.preventDefault();
            console.log('cctr_ref_commande_acces chg');
            console.log($( this).val());

        });
    } );
</script>