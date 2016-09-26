/**
 * file:
 * User: rabii
 */

"use strict";

$(document).ready(function() {
    console.log('infozone_nom_ready');
    $("#message_infozone_nom").hide();
    $("#id_sous_projet_btn").click(function() {
        console.log('dsdsq');
        $("#message_infozone_nom").fadeOut();
        $.ajax({
                method: "POST",
                url: "api/sousprojet/sous_projet_update.php",
                data: {
                    ids : 6,
                    zone : $("#zone").val()
                }
        }).done(function (msg) {
    console.log(msg);
    App.showMessage(msg, '#message_infozone_nom');
});
});
} );
