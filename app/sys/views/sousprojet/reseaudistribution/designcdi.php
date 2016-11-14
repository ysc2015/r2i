<div class="tab-pane <?= ($value[0]=="designcdi"?"active":"")?>" id="designcdi_content">
    <form class="form-horizontal push-10-t push-10" id="dist_designcdi_form" name="dist_designcdi_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dd_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dd_intervenant_be" name="dd_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributiondesign!==NULL && $sousProjet->distributiondesign->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dd_intervenant_bex">Intervenant BEX <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dd_intervenant_bex" name="dd_intervenant_bex">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->distributiondesign!==NULL && $sousProjet->distributiondesign->intervenant_bex==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dd_date_debut">Date de Début <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="dd_date_debut" name="dd_date_debut" value="<?=($sousProjet->distributiondesign !== NULL ? $sousProjet->distributiondesign->date_debut : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dd_date_fin">Date de Fin <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="dd_date_fin" name="dd_date_fin" value="<?=($sousProjet->distributiondesign !== NULL ? $sousProjet->distributiondesign->date_fin : "")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dd_duree">Durée(jours) <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="dd_duree" name="dd_duree" value="<?=($sousProjet->distributiondesign !== NULL?$sousProjet->distributiondesign->duree:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="dd_lineaire_distribution">Linéaire Distribution <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="number" id="dd_lineaire_distribution" name="dd_lineaire_distribution" value="<?=($sousProjet->distributiondesign !== NULL ? $sousProjet->distributiondesign->lineaire_distribution : "")?>">
                </div>
                <div class="col-md-3">
                    <label for="dd_etat">Etat <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dd_etat" name="dd_etat">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatDesign::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_design\" ". ($sousProjet->distributiondesign!==NULL && $sousProjet->distributiondesign->etat==$result->id_etat_design ?"selected": "")." >$result->lib_etat_design</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dd_date_envoi">Date envoi <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="dd_date_envoi" name="dd_date_envoi" value="<?=($sousProjet->distributiondesign !== NULL ? $sousProjet->distributiondesign->date_envoi : "")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="dd_ok">OK <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="dd_ok" name="dd_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->distributiondesign!==NULL && $sousProjet->distributiondesign->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_distribution_design" role="alert" style="display: none;"></div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-8">
                    <button id="id_sous_projet_distribution_design_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <button id="id_sous_projet_distribution_design_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_distribution_design_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var ddesign_formdata = {};
    $(document).ready(function() {
        var typeetape = "sous_projet_distribution_design";
        var variable_etape = "distributiondesign";

        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"designcdi_href","Design CDI/CAD: ");

        $("#id_sous_projet_distribution_design_btn_osa").click(function () {
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape);//1 = ide
        });
        $("#id_sous_projet_distribution_design_list_tache").click(function () {
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);//1 = ide
        });

        $('#dist_designcdi_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            ddesign_formdata[$( this ).attr('name')] = $( this).val();
        });
        $("#id_sous_projet_distribution_design_btn").click(function () {

            $("#message_distribution_design").fadeOut();
            $("#rdistribution_block").toggleClass('block-opt-refresh');

            for (var key in ddesign_formdata) {
                ddesign_formdata[key] = $('#'+key).val();
            }
            ddesign_formdata['ids'] = get('idsousprojet');
            ddesign_formdata['dd_duree'] = $("#dd_duree").val();

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseaudistribution/design_save.php",
                data: ddesign_formdata
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                if(obj.error == 0) {
                    $("#dd_duree").val(obj.duree);
                }
                $("#rdistribution_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_distribution_design');
            });
        });
    } );
</script>