<?php
extract($_GET);
$tirage = SousProjetDistributionTirage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("distribution_tirage",$tirage);
?>
<!--<script>
    var dt_ot_id_entree = undefined;
    var dt_ot_type_entree = 'distribution_tirage';
    $(document).ready(function() {
        dt_ot_id_entree = <?/*= ($tirage!==NULL ? $tirage->id_sous_projet_distribution_tirage : 0) */?> ;
        var dtirage_isnew = ($("#id_sous_projet_distribution_tirage").val()?false:true);

        $("#message_distribution_tirage").hide();
        $("#id_sous_projet_distribution_tirage_btn").click(function () {

            $("#message_distribution_tirage").fadeOut();
            $("#rdistribution_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (dtirage_isnew?"api/sousprojet/dtirage_add.php":"api/sousprojet/dtirage_update.php"),
                data: {
                    ids: <?/*= $_GET['idsousprojet'] */?>,
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
    } );
</script>-->