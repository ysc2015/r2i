<?php
header("Content-type: application/javascript");
?>
/**
 * file: common.functions.js.php
 * User: rabii
 */
//console.log('common functions included');

function setDuree(selector1,selector2,d1,d2) {
    //console.log(selector1);
    //console.log(selector2);
    //console.log($(selector2));
    //console.log(d1);
    //console.log(d2);
    $.ajax({
        method: "POST",
        data: {
            dd : d1,
            df : d2
        },
        url: "api/utils/get_duree.php"
    }).done(function (msg) {

        var obj = JSON.parse(msg);
        //console.log(obj);
        if(obj.duree == "erreur") {
            //var msg = {error : 1, message : 'la date de retour prévue doit étre superieure à la date de début !'};
            //App.showMessage(msg,selector2);
            selector1.val('');

        } else {
            selector1.val(obj.duree);
        }
    });
}