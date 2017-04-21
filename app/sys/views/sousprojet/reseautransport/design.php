<div class="tab-pane <?= ($value[0]=="design"?"active":"")?>" id="design_content">
    <form class="form-horizontal push-10-t push-10" id="transport_design_form" name="transport_design_form">
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="td_intervenant_be">Intervenant BE <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="td_intervenant_be" name="td_intervenant_be">
                        <option value="" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportdesign!==NULL && $sousProjet->transportdesign->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="td_valideur_bei">Valideur BEI <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="td_valideur_bei" name="td_valideur_bei">
                        <option value="0" selected="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportdesign!==NULL && $sousProjet->transportdesign->valideur_bei==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="td_date_debut">Date de Début <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="td_date_debut" name="td_date_debut" value="<?=($sousProjet->transportdesign !== NULL?$sousProjet->transportdesign->date_debut:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="td_date_ret_prevue">Date ret Prev <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="date" id="td_date_ret_prevue" name="td_date_ret_prevue" value="<?=($sousProjet->transportdesign !== NULL?$sousProjet->transportdesign->date_ret_prevue:"")?>">
                </div>
            </div>
        </div>
        <div class="row items-push">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="td_duree">Durée(jours) <!--<span class="text-danger">*</span>--></label>
                    <input readonly class="form-control " type="text" id="td_duree" name="td_duree" value="<?=($sousProjet->transportdesign !== NULL?$sousProjet->transportdesign->duree:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="td_lineaire_transport">Linéaire Transport <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="number" id="td_lineaire_transport" name="td_lineaire_transport" value="<?=($sousProjet->transportdesign !== NULL?$sousProjet->transportdesign->lineaire_transport:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="td_nb_zones">Nbe Zones <!--<span class="text-danger">*</span>--></label>
                    <input class="form-control " type="number" id="td_nb_zones" name="td_nb_zones" value="<?=($sousProjet->transportdesign !== NULL?$sousProjet->transportdesign->nb_zones:"")?>">
                </div>
                <div class="col-md-3">
                    <label for="td_ok">Etape design Terminé <!--<span class="text-danger">*</span>--></label>
                    <select class="form-control " id="td_ok" name="td_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousProjet->transportdesign!==NULL && $sousProjet->transportdesign->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="message_transport_design" role="alert" style="display: none;"></div>
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
                        <button id="id_sous_projet_transport_design_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <?php } else if($sousProjet_master->id_sous_projet == $sousProjet->id_sous_projet) {?>
                        <button id="id_sous_projet_transport_design_btn" class="btn btn-primary btn-sm" type="button">Enregistrer</button>
                    <?php } else {?>
                        <a href="?page=sousprojet&idsousprojet=<?=$sousProjet_master->id_sous_projet?>" class="btn btn-primary btn-sm" type="button">Maitre CTR</a>
                    <?php }?>

                    <button id="id_sous_projet_transport_design_btn_osa" class="btn btn-primary btn-sm" type="button">Créer Une tache OSA</button>
                    <button id="id_sous_projet_transport_design_list_tache" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#liste_tache_osa' data-backdrop="static" data-keyboard="false" type="button">Traiter Une tache OSA</button>
                    <label class="css-input switch switch-sm switch-success">
                        <input id="id_sous_projet_transport_design_charge_be" class="a2tcheckbox" type="checkbox" value="FALSE" <?= ($sousProjet->transportdesign!==NULL && $sousProjet->transportdesign->date_charge_be !=NULL ?"checked" : "")?> ><span></span>
                        Charge BE prise en charge : <span id="charge_be_message_transport_design"><?= ($sousProjet->transportdesign!==NULL && $sousProjet->transportdesign->date_charge_be !=NULL ?" Le ".$sousProjet->transportdesign->date_charge_be."" : "")?></span>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="charge-be-confirm_transport_design" title="Confirmer cette affectation ?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer cette affectation ?</p>
</div>
<script>
    var design_formdata = {};
    $(document).ready(function() {
        var typeetape = "sous_projet_transport_design";
        var variable_etape = "transportdesign";
        var actif = null;
        $( "#charge-be-confirm_transport_design" ).dialog({
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
                            tentree : "transportdesign"
                        }
                    }).done(function (msg) {
                        var obj = JSON.parse(msg);
                        console.log(msg);
                        if(obj.error == 0) {
                            if($("#id_sous_projet_transport_design_charge_be").is(':checked')){
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
                                    tentree : "transportdesign",
                                    actif : actif
                                }
                            }).done(function (msg) {
                                var obj = JSON.parse(msg);
                                if(obj.error == 0) {
                                    if(obj.date_charge_be == null){
                                        $("#id_sous_projet_transport_design_charge_be").prop('checked',false);
                                        $( "#charge-be-confirm_transport_design" ).dialog( "close" );
                                        $("#charge_be_message_transport_design").html("" );
                                        App.showMessage(msg, '#message_transport_design');

                                    }else{
                                        $("#id_sous_projet_transport_design_charge_be").prop('checked',true);
                                        $( "#charge-be-confirm_transport_design" ).dialog( "close" );
                                        $("#charge_be_message_transport_design").html("Le " + obj.date_charge_be );
                                        App.showMessage(msg, '#message_transport_design');

                                    }
                                } else {

                                }
                            });
                        } else {
                            $( "#charge-be-confirm_transport_design" ).dialog( "close" );
                            App.showMessage(msg, '#message_transport_design');

                        }
                    });
                },
                Non: function() {
                    $( "#charge-be-confirm_transport_design" ).dialog( "close" );
                }
            }
        });
        $('#id_sous_projet_transport_design_charge_be').click(function(e){
            e.preventDefault();
            $("#charge-be-confirm_transport_design").dialog("open");

        });

        calculetache_osa(typeetape,get("idsousprojet"),variable_etape,"design_href","Design: ");

        $('#transport_design_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            design_formdata[$( this ).attr('name')] = $( this).val();
        });
        var liste_intervenant = [];
        $("#id_sous_projet_transport_design_btn_osa").click(function () {
            if($( "#td_intervenant_be" ).val()!="") liste_intervenant.push($( "#td_intervenant_be" ).val());
            if($( "#td_valideur_bei" ).val()!="") liste_intervenant.push($( "#td_valideur_bei" ).val());
            appelscriptosa(typeetape,get("idsousprojet"),variable_etape,liste_intervenant);
        });
        $('#id_sous_projet_transport_design_list_tache').click(function(){
            liste_tache_osa(typeetape,get("idsousprojet"),variable_etape);
        });
        $("#id_sous_projet_transport_design_btn").click(function () {

            $("#message_transport_design").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');

            for (var key in design_formdata) {
                design_formdata[key] = $('#'+key).val();
            }
            design_formdata['ids'] = get('idsousprojet');
            design_formdata['td_duree'] = $("#td_duree").val();

            $.ajax({
                method: "POST",
                url: "api/sousprojet/reseautransport/design_save.php",
                data: design_formdata
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                if(obj.error == 0) {
                    $("#td_duree").val(obj.duree);
                }
                $("#rtransport_block").removeClass('block-opt-refresh');
                App.showMessage(msg, '#message_transport_design');
            });
        });
    } );
</script>