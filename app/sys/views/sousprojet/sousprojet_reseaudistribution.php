<div class="block block-themed" id="rdistribution_block">
    <div class="block-header bg-info">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title"><?=$lang["RESEAUDISTRIBUTION"]?></h3>
    </div>
    <div class="block-content">
        <div class="block" id="rdistribution_block_content">
        </div>
    </div>
</div>

<script>
    var da_ot_id_entree = undefined;
    var da_ot_type_entree = 'distribution_aiguillage';
    var dt_ot_id_entree = undefined;
    var dt_ot_type_entree = 'distribution_tirage';
    $(document).ready(function() {
        console.log('rdistribution_block');
        $("#rdistribution_block").toggleClass('block-opt-refresh');
        $.ajax({
            method: "POST",
            data: {
                idsousprojet : <?= $_GET['idsousprojet']?>
            },
            url: "api/sousprojet/blocks/reseaudistribution_block.php"
        }).done(function (msg) {
            $("#rdistribution_block_content").html(msg);
            $("#rdistribution_block").removeClass('block-opt-refresh');

            //TODO create js proto for this
            //designcdi
            var ddesign_isnew = ($("#id_sous_projet_distribution_design").val()?false:true);

            $("#message_distribution_design").hide();
            $("#id_sous_projet_distribution_design_btn").click(function () {

                $("#message_distribution_design").fadeOut();
                $("#rdistribution_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (ddesign_isnew?"api/sousprojet/ddesign_add.php":"api/sousprojet/ddesign_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        dd_intervenant_be: $('#dd_intervenant_be').val(),
                        dd_intervenant_bex: $('#dd_intervenant_bex').val(),
                        dd_date_debut: $('#dd_date_debut').val(),
                        dd_date_fin: $('#dd_date_fin').val(),
                        dd_duree: $('#dd_duree').val(),
                        dd_lineaire_distribution: $('#dd_lineaire_distribution').val(),
                        dd_etat: $('#dd_etat').val(),
                        dd_date_envoi: $('#dd_date_envoi').val()

                    }
                }).done(function (msg) {
                    $("#rdistribution_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_distribution_design')) {
                        $("#id_sous_projet_distribution_design_alert").hide();
                        ddesign_isnew = false;
                    }
                });
            });
            //aiguillage
            <?php
            $aiguillage = SousProjetDistributionAiguillage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            ?>
            da_ot_id_entree = <?= ($aiguillage!==NULL ? $aiguillage->id_sous_projet_distribution_aiguillage : 0) ?> ;
            var daiguillage_isnew = ($("#id_sous_projet_distribution_aiguillage").val()?false:true);

            $("#message_distribution_aiguillage").hide();
            $("#id_sous_projet_distribution_aiguillage_btn").click(function () {

                $("#message_distribution_aiguillage").fadeOut();
                $("#rdistribution_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (daiguillage_isnew?"api/sousprojet/daiguillage_add.php":"api/sousprojet/daiguillage_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        da_intervenant_be: $('#da_intervenant_be').val(),
                        da_plans: $('#da_plans').val(),
                        da_lineaire_reseau: $('#da_lineaire_reseau').val(),
                        da_controle_plans: $('#da_controle_plans').val(),
                        da_date_transmission_plans: $('#da_date_transmission_plans').val(),
                        da_entreprise: $('#da_entreprise').val(),
                        da_date_aiguillage: $('#da_date_aiguillage').val(),
                        da_duree: $('#da_duree').val(),
                        da_controle_demarrage_effectif: $('#da_controle_demarrage_effectif').val(),
                        da_date_retour: $('#da_date_retour').val(),
                        da_etat_retour: $('#da_etat_retour').val()

                    }
                }).done(function (msg) {
                    var obj = $.parseJSON(msg);
                    console.log(obj);
                    $("#rdistribution_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_distribution_aiguillage')) {
                        $("#id_sous_projet_distribution_aiguillage_alert").hide();
                        if(daiguillage_isnew) {
                            da_ot_id_entree = obj.id;
                            daiguillage_isnew = false;
                            $("#id_sous_projet_distribution_aiguillage_btn").after('  <button id="id_sous_projet_distribution_aiguillage_create_ot_show" class="btn btn-success" type="button" data-toggle="modal" data-target="#add-ot" data-backdrop="static" data-keyboard="false">créer ordre de travail</button>');
                            console.log(data_ot);
                        }
                    }
                });
            });

            $('body').on('click', '#id_sous_projet_distribution_aiguillage_create_ot_show', function() {
                // do something
                console.log('show ot body source tag');
                $("#add_ot_form")[0].reset();
                data_ot.id_entree = da_ot_id_entree;
                data_ot.type_entree = da_ot_type_entree;
                show_btn = $("#id_sous_projet_distribution_aiguillage_create_ot_show");
                create_btn = $("#id_sous_projet_distribution_aiguillage_btn");
            });
            //commandecdi
            var dcmdcdi_isnew = ($("#id_sous_projet_distribution_commande_cdi").val()?false:true);

            $("#message_distribution_commande_cdi").hide();
            $("#id_sous_projet_distribution_commande_cdi_btn").click(function () {

                $("#message_distribution_commande_cdi").fadeOut();
                $("#rdistribution_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (dcmdcdi_isnew?"api/sousprojet/dcmdcdi_add.php":"api/sousprojet/dcmdcdi_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        dcc_intervenant_be: $('#dcc_intervenant_be').val(),
                        dcc_date_butoir: $('#dcc_date_butoir').val(),
                        dcc_traitement_retour_terrain: $('#dcc_traitement_retour_terrain').val(),
                        dcc_modification_carto: $('#dcc_modification_carto').val(),
                        dcc_commandes_acces: $('#dcc_commandes_acces').val(),
                        dcc_date_transmission_ca: $('#dcc_date_transmission_ca').val(),
                        dcc_ref_commande_acces: $('#dcc_ref_commande_acces').val(),
                        dcc_go_ft: $('#dcc_go_ft').val()

                    }
                }).done(function (msg) {
                    $("#rdistribution_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_distribution_commande_cdi')) {
                        $("#id_sous_projet_distribution_commande_cdi_alert").hide();
                        dcmdcdi_isnew = false;
                    }
                });
            });
            //tirage
            <?php
            $tirage = SousProjetDistributionTirage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
            ?>
            dt_ot_id_entree = <?= ($tirage!==NULL ? $tirage->id_sous_projet_distribution_tirage : 0) ?> ;
            var dtirage_isnew = ($("#id_sous_projet_distribution_tirage").val()?false:true);

            $("#message_distribution_tirage").hide();
            $("#id_sous_projet_distribution_tirage_btn").click(function () {

                $("#message_distribution_tirage").fadeOut();
                $("#rdistribution_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (dtirage_isnew?"api/sousprojet/dtirage_add.php":"api/sousprojet/dtirage_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        dt_intervenant_be: $('#dt_intervenant_be').val(),
                        dt_date_previsionnelle: $('#dt_date_previsionnelle').val(),
                        dt_prep_plans: $('#dt_prep_plans').val(),
                        dt_controle_plans: $('#dt_controle_plans').val(),
                        dt_date_transmission_plans: $('#dt_date_transmission_plans').val(),
                        dt_entreprise: $('#dt_entreprise').val(),
                        dt_date_tirage: $('#dt_date_tirage').val(),
                        dt_duree: $('#dt_duree').val(),
                        dt_controle_demarrage_effectif: $('#dt_controle_demarrage_effectif').val(),
                        dt_date_retour: $('#dt_date_retour').val(),
                        dt_etat_retour: $('#dt_etat_retour').val()

                    }
                }).done(function (msg) {
                    var obj = $.parseJSON(msg);
                    console.log(obj);
                    $("#rdistribution_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_distribution_tirage')) {
                        $("#id_sous_projet_distribution_tirage_alert").hide();
                        if(dtirage_isnew) {
                            dt_ot_id_entree = obj.id;
                            dtirage_isnew = false;
                            $("#id_sous_projet_distribution_tirage_btn").after('  <button id="id_sous_projet_distribution_tirage_create_ot_show" class="btn btn-success" type="button" data-toggle="modal" data-target="#add-ot" data-backdrop="static" data-keyboard="false">créer ordre de travail</button>');
                            console.log(data_ot);
                        }
                    }
                });
            });

            $('body').on('click', '#id_sous_projet_distribution_tirage_create_ot_show', function() {
                // do something
                console.log('show ot body source tag');
                $("#add_ot_form")[0].reset();
                data_ot.id_entree = dt_ot_id_entree;
                data_ot.type_entree = dt_ot_type_entree;
                show_btn = $("#id_sous_projet_distribution_tirage_create_ot_show");
                create_btn = $("#id_sous_projet_distribution_tirage_btn");
            });
            //raccordements
            var draccord_isnew = ($("#id_sous_projet_distribution_raccordements").val()?false:true);

            $("#message_distribution_raccordements").hide();
            $("#id_sous_projet_distribution_raccordements_btn").click(function () {

                $("#message_distribution_raccordements").fadeOut();
                $("#rdistribution_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (draccord_isnew?"api/sousprojet/draccord_add.php":"api/sousprojet/draccord_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        dr_intervenant_be: $('#dr_intervenant_be').val(),
                        dr_preparation_pds: $('#dr_preparation_pds').val(),
                        dr_controle_plans: $('#dr_controle_plans').val(),
                        dr_date_transmission_pds: $('#dr_date_transmission_pds').val(),
                        dr_entreprise: $('#dr_entreprise').val(),
                        dr_date_racco: $('#dr_date_racco').val(),
                        dr_duree: $('#dr_duree').val(),
                        dr_controle_demarrage_effectif: $('#dr_controle_demarrage_effectif').val(),
                        dr_date_retour: $('#dr_date_retour').val(),
                        dr_etat_retour: $('#dr_etat_retour').val()

                    }
                }).done(function (msg) {
                    $("#rdistribution_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_distribution_raccordements')) {
                        $("#id_sous_projet_distribution_raccordements_alert").hide();
                        draccord_isnew = false;
                    }
                });
            });
            //recette
            var drecette_isnew = ($("#id_sous_projet_distribution_recette").val()?false:true);

            $("#message_distribution_recette").hide();
            $("#id_sous_projet_distribution_recette_btn").click(function () {

                $("#message_distribution_recette").fadeOut();
                $("#rdistribution_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (drecette_isnew?"api/sousprojet/drecette_add.php":"api/sousprojet/drecette_update.php"),
                    data: {
                        ids: <?= $_GET['idsousprojet'] ?>,
                        drec_intervenant_be: $('#drec_intervenant_be').val(),
                        drec_doe: $('#drec_doe').val(),
                        drec_netgeo: $('#drec_netgeo').val(),
                        drec_intervenant_free: $('#drec_intervenant_free').val(),
                        drec_entreprise: $('#drec_entreprise').val(),
                        drec_date_recette: $('#drec_date_recette').val(),
                        drec_etat_recette: $('#drec_etat_recette').val()

                    }
                }).done(function (msg) {
                    $("#rdistribution_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_distribution_recette')) {
                        $("#id_sous_projet_distribution_recette_alert").hide();
                        drecette_isnew = false;
                    }
                });
            });
        });
    } );
</script>