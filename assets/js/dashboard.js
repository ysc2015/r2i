/**
 * file:
 * User: rabii
 */

"use strict";

function getPlansOk() {

    $('#gestplansot_block').addClass('block-opt-refresh');

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "api/dashboard/activitevpi/get_plans_ok_count.php"
    }).done(function (msg) {
        //console.log(msg.rows);

        $.each(msg.rows, function(k, v) {
            $('#'+k+'_plan_count').html(v);
            if(v > 0) $('#'+k+'_plan_count').addClass('clickable');
            else $('#'+k+'_plan_count').removeClass('clickable');
        });

        $('#gestplansot_block').removeClass('block-opt-refresh');
    });
}

function getPlannifOT() {

    gestion_travaux_ctr_dt.ajax.url( 'api/dashboard/activitevpi/gestion_travaux_ctr_liste.php' ).load();
    gestion_travaux_cdi_dt.ajax.url( 'api/dashboard/activitevpi/gestion_travaux_cdi_liste.php' ).load();
    gestion_travaux_ch1.ajax.url( 'api/dashboard/activitevpi/gestion_travaux_ch1.php' ).load();
    gestion_travaux_ch2.ajax.url( 'api/dashboard/activitevpi/gestion_travaux_ch2.php' ).load();
    //gestion_travaux_ch3.ajax.url( 'api/dashboard/activitevpi/gestion_travaux_ch3.php' ).load();

}

function getPBC_PBT() {

    gestion_travaux_pbc.ajax.url( 'api/dashboard/activitevpi/gestion_travaux_pbc.php' ).load();
}

function getEtatOT() {
    etat_ot_dt.ajax.url( 'api/ot/ot/ot_liste_w_state.php' ).load();
}