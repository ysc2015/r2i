<?php
extract($_GET);
$taiguillage = SousProjetTransportAiguillage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("transport_aiguillage",$taiguillage);
?>
<script>
    var ta_ot_id_entree = undefined;
    var ta_ot_type_entree = 'transport_aiguillage';
    $(document).ready(function() {
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

        /*$("#id_sous_projet_transport_aiguillage_create_ot_show").click(function () {
            console.log('show ot');
        });*/

        $('body').on('click', '#id_sous_projet_transport_aiguillage_create_ot_show', function() {
            // do something
            console.log('show ot body source tag');
            $("#add_ot_form")[0].reset();
            data_ot.id_entree = ta_ot_id_entree;
            data_ot.type_entree = ta_ot_type_entree;
            show_btn = $("#id_sous_projet_transport_aiguillage_create_ot_show");
            create_btn = $("#id_sous_projet_transport_aiguillage_btn");
        });
    } );
</script>