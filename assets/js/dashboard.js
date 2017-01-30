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