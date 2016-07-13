<?php
extract($_GET);
$ttirage = SousProjetTransportTirage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("transport_tirage",$ttirage);
?>
<!--<script>
    var tt_ot_id_entree = undefined;
    var tt_ot_type_entree = 'transport_tirage';
    $(document).ready(function() {
        tt_ot_id_entree = <?/*= ($ttirage!==NULL ? $ttirage->id_sous_projet_transport_tirage : 0) */?> ;
        var ttirage_isnew = ($("#id_sous_projet_transport_tirage").val()?false:true);

        $("#message_transport_tirage").hide();
        $("#id_sous_projet_transport_tirage_btn").click(function () {

            $("#message_transport_tirage").fadeOut();
            $("#rtransport_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                url: (ttirage_isnew?"api/sousprojet/ttirage_add.php":"api/sousprojet/ttirage_update.php"),
                data: {
                    ids: <?/*= $_GET['idsousprojet'] */?>,
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

        /*$("#id_sous_projet_transport_tirage_create_ot_show").click(function () {
            console.log('show ot');
        });*/

        $('body').on('click', '#id_sous_projet_transport_tirage_create_ot_show', function() {
            // do something
            console.log('show ot body source tag');
            $("#add_ot_form")[0].reset();
            data_ot.id_entree = tt_ot_id_entree;
            data_ot.type_entree = tt_ot_type_entree;
            show_btn = $("#id_sous_projet_transport_tirage_create_ot_show");
            create_btn = $("#id_sous_projet_transport_tirage_btn");
        });
    } );
</script>-->