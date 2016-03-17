<?php
header("Content-type: application/javascript");
?>
var API_URL = 'public/api/r2iApi.php';

$(function () {

    function creerSousProjet(){
        var object = new Object();
        object.project_id= project_id;
        console.log(object.project_id);
        object.info = new Object();
        object.info.res_type = $('#res_type').val();
        console.log(object.info.res_type);
        object.info.intervenantBE = $('#intervenantBE').val();
        object.info.lineaireReseau = $('#lineaireReseau').val();
        object.info.controleDesPlans = $('#controleDesPlans').val();
        console.log(object.info.controleDesPlans);
        object.info.date_trans_plans = $('#date_trans_plans').val();
        object.info.entreprise = $('#entreprise').val();
        object.info.fichier = $('#fichier').val();
        object.info.date_aiguillage = $('#date_aiguillage').val();
        object.info.Date_ret_Prev = $('#Date_ret_Prev').val();
        object.info.duree = $('#duree').val();
        object.info.controle_demarrage = $('#controle_demarrage').val();
        object.info.avancement = $('#avancement').val();
        object.info.controleParallele = $('#controleParallele').val();
        object.info.DateRetour = $('#DateRetour').val();
        object.info.EtatRetour = $('#EtatRetour').val();
        object.info.ControleApreTrv = $('#ControleApreTrv').val();

        console.log(object);
        $.ajax({

            url: API_URL,
            type: 'POST',
            dataType: 'json',
            data: {
                parameters: object,
                method: 'insert_sous_project',
            },
            success: function (response) {
                if(response.status == 'success') {
                    console.log("bien inserer");
                }
            },
            error: function (e) {
                console.log(e.responseText);
            }
        });
    }
    $('#add-sous-project').click(creerSousProjet);

});
