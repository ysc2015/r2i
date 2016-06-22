<?php
extract($_GET);
$aiguillage = SousProjetDistributionAiguillage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));
build_user_form("distribution_aiguillage",$aiguillage);
?>
<script>
    var da_ot_id_entree = undefined;
    var da_ot_type_entree = 'distribution_aiguillage';
    $(document).ready(function() {
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

        /*$("#id_sous_projet_distribution_aiguillage_create_ot_show").click(function() {
            console.log('showcreate ot');
        });*/

        $('body').on('click', '#id_sous_projet_distribution_aiguillage_create_ot_show', function() {
            // do something
            console.log('show ot body source tag');
            $("#add_ot_form")[0].reset();
            data_ot.id_entree = da_ot_id_entree;
            data_ot.type_entree = da_ot_type_entree;
            show_btn = $("#id_sous_projet_distribution_aiguillage_create_ot_show");
            create_btn = $("#id_sous_projet_distribution_aiguillage_btn");
        });
    } );
</script>