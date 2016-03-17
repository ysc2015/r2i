<?php
header("Content-type: application/javascript");
?>
var API_URL = 'public/api/r2iApi.php';

$(function () {

    function creerSousProjet(){
        var ob = new Object();
        ob.project_id= project_id;
        console.log(ob.project_id);
        ob.info = new Object();
        ob.info.res_type = $('#res_type').val();
        console.log(ob.info.res_type);
        ob.info.intervenantBE = $('#intervenantBE').val();
        ob.info.plans = $('#plans').val();
        ob.info.lineaireReseau = $('#lineaireReseau').val();
        ob.info.controleDesPlans = $('#controleDesPlans').val();
        console.log(ob.info.controleDesPlans);
        ob.info.date_trans_plans = $('#date_trans_plans').val();
        ob.info.entreprise = $('#entreprise').val();
        ob.info.date_aiguillage = $('#date_aiguillage').val();
        ob.info.Date_ret_Prev = $('#Date_ret_Prev').val();
        ob.info.duree = $('#duree').val();
        ob.info.controle_demarrage = $('#controle_demarrage').val();
        ob.info.avancement = $('#avancement').val();
        ob.info.controleParallele = $('#controleParallele').val();
        ob.info.DateRetour = $('#DateRetour').val();
        ob.info.EtatRetour = $('#EtatRetour').val();
        ob.info.ControleApreTrv = $('#ControleApreTrv').val();
        console.log(ob);
        $.ajax({

            url: API_URL,
            type: 'POST',
            dataType: 'json',
            data: {
                parameters: ob,
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
