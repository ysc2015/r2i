<div class="block block-themed" id="rtransport_block">
    <div class="block-header bg-info">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title"><?=$lang["RESEAUTRANSPORT"]?></h3>
    </div>
    <div class="block-content">
        <div class="block" id="rtransport_block_content">
        </div>
    </div>
</div>

<script>
    var ta_ot_id_entree = undefined;
    var ta_ot_type_entree = 'transport_aiguillage';
    var tt_ot_id_entree = undefined;
    var tt_ot_type_entree = 'transport_tirage';
    $(document).ready(function() {
        console.log('rtransport_block');
        $("#rtransport_block").toggleClass('block-opt-refresh');
        $.ajax({
            method: "POST",
            data: {
                idsousprojet : <?= $_GET['idsousprojet']?>
            },
            url: "api/sousprojet/blocks/reseautransport_block.php"
        }).done(function (msg) {
            $("#rtransport_block_content").html(msg);
            $("#rtransport_block").removeClass('block-opt-refresh');

            //TODO create js proto for this
            //design
            var tdesign_isnew = ($("#id_sous_projet_transport_design").val()?false:true);

            $("#message_transport_design").hide();
            $("#id_sous_projet_transport_design_btn").click(function () {

                $("#message_transport_design").fadeOut();
                $("#rtransport_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (tdesign_isnew?"api/sousprojet/tdesign_add.php":"api/sousprojet/tdesign_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        td_intervenant_be: $('#td_intervenant_be').val(),
                        td_date_debut: $('#td_date_debut').val(),
                        td_date_ret_prevue: $('#td_date_ret_prevue').val(),
                        td_duree: $('#td_duree').val(),
                        td_lineaire_transport: $('#td_lineaire_transport').val(),
                        td_nb_zones: $('#td_nb_zones').val()

                    }
                }).done(function (msg) {
                    $("#rtransport_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_transport_design')) {
                        $("#id_sous_projet_transport_design_alert").hide();
                        tdesign_isnew = false;
                    }
                });
            });
            //aiguillage
            <?php
            $taiguillage = SousProjetTransportAiguillage::first(array('conditions' => array("id_sous_projet = ?", $_GET['idsousprojet'])));
            ?>
            ta_ot_id_entree = <?= ($taiguillage!==NULL ? $taiguillage->id_sous_projet_transport_aiguillage : 0) ?> ;
            var taiguillage_isnew = ($("#id_sous_projet_transport_aiguillage").val()?false:true);

            $("#message_transport_aiguillage").hide();
            $("#id_sous_projet_transport_aiguillage_btn").click(function () {

                $("#message_transport_aiguillage").fadeOut();
                $("#rtransport_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (taiguillage_isnew?"api/sousprojet/taguillage_add.php":"api/sousprojet/taguillage_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        ta_intervenant_be: $('#ta_intervenant_be').val(),
                        ta_plans: $('#ta_plans').val(),
                        ta_lineaire_reseau: $('#ta_lineaire_reseau').val(),
                        ta_controle_plans: $('#ta_controle_plans').val(),
                        ta_date_transmission_plans: $('#ta_date_transmission_plans').val(),
                        ta_entreprise: $('#ta_entreprise').val(),
                        phase: $('#phase').val(),
                        ta_date_aiguillage: $('#ta_date_aiguillage').val(),
                        ta_date_ret_prevue: $('#ta_date_ret_prevue').val(),
                        ta_duree: $('#ta_duree').val(),
                        ta_controle_demarrage_effectif: $('#ta_controle_demarrage_effectif').val(),
                        ta_date_retour: $('#ta_date_retour').val(),
                        ta_etat_retour: $('#ta_etat_retour').val()

                    }
                }).done(function (msg) {
                    var obj = $.parseJSON(msg);
                    console.log(obj);
                    $("#rtransport_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_transport_aiguillage')) {
                        $("#id_sous_projet_transport_aiguillage_alert").hide();
                        if(taiguillage_isnew) {
                            ta_ot_id_entree = obj.id;
                            taiguillage_isnew = false;
                            $("#id_sous_projet_transport_aiguillage_btn").after('  <button id="id_sous_projet_transport_aiguillage_create_ot_show" class="btn btn-success" type="button" data-toggle="modal" data-target="#add-ot" data-backdrop="static" data-keyboard="false">créer ordre de travail</button>');
                            console.log(data_ot);
                        }
                    }
                });
            });

            $('body').on('click', '#id_sous_projet_transport_aiguillage_create_ot_show', function() {
                // do something
                console.log('show ot body source tag');
                $("#add_ot_form")[0].reset();
                data_ot.id_entree = ta_ot_id_entree;
                data_ot.type_entree = ta_ot_type_entree;
                show_btn = $("#id_sous_projet_transport_aiguillage_create_ot_show");
                create_btn = $("#id_sous_projet_transport_aiguillage_btn");
            });
            //commandectr
            var tcmdctr_isnew = ($("#id_sous_projet_transport_commande_ctr").val()?false:true);

            $("#message_transport_commande_ctr").hide();
            $("#id_sous_projet_transport_commande_ctr_btn").click(function () {

                $("#message_transport_commande_ctr").fadeOut();
                $("#rtransport_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (tcmdctr_isnew?"api/sousprojet/tcmdctr_add.php":"api/sousprojet/tcmdctr_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        cctr_intervenant_be: $('#cctr_intervenant_be').val(),
                        cctr_date_butoir: $('#cctr_date_butoir').val(),
                        cctr_traitement_retour_terrain: $('#cctr_traitement_retour_terrain').val(),
                        cctr_modification_carto: $('#cctr_modification_carto').val(),
                        cctr_commandes_acces: $('#cctr_commandes_acces').val(),
                        cctr_date_transmission_ca: $('#cctr_date_transmission_ca').val(),
                        cctr_ref_commande_acces: $('#cctr_ref_commande_acces').val(),
                        cctr_go_ft: $('#cctr_go_ft').val()

                    }
                }).done(function (msg) {
                    $("#rtransport_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_transport_commande_ctr')) {
                        $("#id_sous_projet_transport_commande_ctr_alert").hide();
                        tcmdctr_isnew = false;
                    }
                });
            });
            //tirage
            <?php
            $ttirage = SousProjetTransportTirage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            ?>
            tt_ot_id_entree = <?= ($ttirage!==NULL ? $ttirage->id_sous_projet_transport_tirage : 0) ?> ;
            var ttirage_isnew = ($("#id_sous_projet_transport_tirage").val()?false:true);

            $("#message_transport_tirage").hide();
            $("#id_sous_projet_transport_tirage_btn").click(function () {

                $("#message_transport_tirage").fadeOut();
                $("#rtransport_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (ttirage_isnew?"api/sousprojet/ttirage_add.php":"api/sousprojet/ttirage_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        tt_intervenant_be: $('#tt_intervenant_be').val(),
                        tt_date_previsionnelle: $('#tt_date_previsionnelle').val(),
                        tt_prep_plans: $('#tt_prep_plans').val(),
                        tt_controle_plans: $('#tt_controle_plans').val(),
                        tt_date_transmission_plans: $('#tt_date_transmission_plans').val(),
                        tt_entreprise: $('#tt_entreprise').val(),
                        tt_date_tirage: $('#tt_date_tirage').val(),
                        tt_date_ret_prevue: $('#tt_date_ret_prevue').val(),
                        tt_duree: $('#tt_duree').val(),
                        tt_controle_demarrage_effectif: $('#tt_controle_demarrage_effectif').val(),
                        tt_date_retour: $('#tt_date_retour').val(),
                        tt_etat_retour: $('#tt_etat_retour').val()

                    }
                }).done(function (msg) {
                    var obj = $.parseJSON(msg);
                    console.log(obj);
                    $("#rtransport_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_transport_tirage')) {
                        $("#id_sous_projet_transport_tirage_alert").hide();
                        if(ttirage_isnew) {
                            tt_ot_id_entree = obj.id;
                            ttirage_isnew = false;
                            $("#id_sous_projet_transport_tirage_btn").after('  <button id="id_sous_projet_transport_tirage_create_ot_show" class="btn btn-success" type="button" data-toggle="modal" data-target="#add-ot" data-backdrop="static" data-keyboard="false">créer ordre de travail</button>');
                            console.log(data_ot);
                        }
                    }
                });
            });

            $('body').on('click', '#id_sous_projet_transport_tirage_create_ot_show', function() {
                // do something
                console.log('show ot body source tag');
                $("#add_ot_form")[0].reset();
                data_ot.id_entree = tt_ot_id_entree;
                data_ot.type_entree = tt_ot_type_entree;
                show_btn = $("#id_sous_projet_transport_tirage_create_ot_show");
                create_btn = $("#id_sous_projet_transport_tirage_btn");
            });
            //raccordements
            var traccord_isnew = ($("#id_sous_projet_transport_raccordements").val()?false:true);

            $("#message_transport_raccordements").hide();
            $("#id_sous_projet_transport_raccordements_btn").click(function () {

                $("#message_transport_raccordements").fadeOut();
                $("#rtransport_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (traccord_isnew?"api/sousprojet/traccord_add.php":"api/sousprojet/traccord_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        tr_intervenant_be: $('#tr_intervenant_be').val(),
                        tr_preparation_pds: $('#tr_preparation_pds').val(),
                        tr_controle_plans: $('#tr_controle_plans').val(),
                        tr_date_transmission_pds: $('#tr_date_transmission_pds').val(),
                        tr_entreprise: $('#tr_entreprise').val(),
                        tr_date_racco: $('#tr_date_racco').val(),
                        tr_duree: $('#tr_duree').val(),
                        tr_controle_demarrage_effectif: $('#tr_controle_demarrage_effectif').val(),
                        tr_date_retour: $('#tr_date_retour').val(),
                        tr_etat_retour: $('#tr_etat_retour').val()

                    }
                }).done(function (msg) {console.log(msg);
                    $("#rtransport_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_transport_raccordements')) {
                        $("#id_sous_projet_transport_raccordements_alert").hide();
                        traccord_isnew = false;
                    }
                });
            });
            //recette
            var trecette_isnew = ($("#id_sous_projet_transport_recette").val()?false:true);

            $("#message_transport_recette").hide();
            $("#id_sous_projet_transport_recette_btn").click(function () {

                $("#message_transport_recette").fadeOut();
                $("#rtransport_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (trecette_isnew?"api/sousprojet/trecette_add.php":"api/sousprojet/trecette_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        trec_intervenant_be: $('#trec_intervenant_be').val(),
                        trec_doe: $('#trec_doe').val(),
                        trec_netgeo: $('#trec_netgeo').val(),
                        trec_intervenant_free: $('#trec_intervenant_free').val(),
                        trec_entreprise: $('#trec_entreprise').val(),
                        trec_date_recette: $('#trec_date_recette').val(),
                        trec_etat_recette: $('#trec_etat_recette').val()

                    }
                }).done(function (msg) {
                    $("#rtransport_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_transport_recette')) {
                        $("#id_sous_projet_transport_recette_alert").hide();
                        trecette_isnew = false;
                    }
                });
            });

        });
    } );
</script>