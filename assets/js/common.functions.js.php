<?php
header("Content-type: application/javascript");
?>
/**
 * file: common.functions.js.php
 * User: rabii
 */

function setDuree(selector1,selector2,d1,d2) {
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

function get(name){
    if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
        return decodeURIComponent(name[1]);
}

function checkLinears(sel){
    var flag = true;
    $(sel).filter(function() {
        if (this.value == '') {
            flag = false;
            return false;
        }
    });
    return flag;
}

function getObjectTypeForEntry(entree) {
    var str = '';
    switch (entree) {
        case 'transportaiguillage' : str='transport_aiguillage_chambre';break;
        case 'transporttirage' : str='transport_tirage_chambre,transport_raccord_chambre';break;
        case 'transportraccordement' : str='transport_raccord_chambre,transport_tirage_chambre';break;
        case 'transportrecette' : str='transport_recette_chambre_file';break;
        case 'distributionaiguillage' : str='distribution_aiguillage_chambre';break;
        case 'distributiontirage' : str='distribution_tirage_chambre,distribution_raccord_chambre';break;
        case 'distributionraccordement' : str='distribution_raccord_chambre,distribution_tirage_chambre';break;
        case 'distributionrecette' : str='distribution_recette_chambre_file';break;
        default : str='';break;
    }

    return str;
}

function getObjectTypeForEntryPB(entree) { /*utilisee pour recuperer plans boites, a creer une entite global c'est temporaire*/
    var str = '';
    switch (entree) {
        case 'transportaiguillage' : str='transport_racoord_pboite';break;
        case 'transporttirage' : str='transport_racoord_pboite';break;
        case 'transportraccordement' : str='transport_racoord_pboite';break;
        case 'distributionaiguillage' : str='distribution_racoord_pboite';break;
        case 'distributiontirage' : str='distribution_racoord_pboite';break;
        case 'distributionraccordement' : str='distribution_racoord_pboite';break;
        default : str='';break;
    }

    return str;
}

function getObjectNameForEntry(entree) {
    var str = '';
    switch (entree) {
        case 'transportaiguillage' : str='Transport Aiguillage';break;
        case 'transporttirage' : str='Transport Tirage';break;
        case 'transportraccordement' : str='Transport Raccordement';break;
        case 'transportrecette' : str='Transport Recette';break;
        case 'distributionaiguillage' : str='Distribution Aiguillage';break;
        case 'distributiontirage' : str='Distribution Tirage';break;
        case 'distributionraccordement' : str='Distribution Raccordement';break;
        case 'distributionrecette' : str='Distribution Recette';break;
        default : str='';break;
    }

    return str;
}

/**
 * Overwrites obj1's values with obj2's and adds obj2's if non existent in obj1
 * @param obj1
 * @param obj2
 * @returns obj3 a new object based on obj1 and obj2
 */
function merge_options(obj1,obj2){
    var obj3 = {};
    for (var attrname in obj1) { obj3[attrname] = obj1[attrname]; }
    for (var attrname in obj2) { obj3[attrname] = obj2[attrname]; }
    return obj3;
}

//shared obj

var defaultUploaderStrLocalisation = {
    dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
    deletelStr: "Supprimer",
    downloadStr: "Téléchargez",
    uploadStr: "Téléchargez",
    abortStr: "Abandonner",
    cancelStr: "Annuler",
    doneStr: "Términé",
    multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers sont autorisés.",
    extErrorStr: "non autorisé. extensions autorisées :",
    duplicateErrorStr: "fichier éxiste déjà",
    sizeErrorStr: "non autorisé. taille max autorisée :",
    uploadErrorStr: "envoi de fichier non autorisé",
    maxFileCountErrorStr: "non autorisé. max fichiers autorisés :"
}

//set ot status

function setOtStatus(idot,status,selector,dt) {
    $.ajax({
        url: "api/ot/ot/set_ot_status.php",
        dataType: "json",
        method: "POST",
        data: {
            idot : idot,
            status : status
        }
    }).done(function (msg) {
        if(msg.error == 0) {
            dt.ajax.reload();
        }
        App.showMessage(msg,selector);
    });
}

function setRetourTerrain(idsp,idtot,selector,val) {
    console.log('tip script ' + idtot);
    $.ajax({
        url: "api/myot/traitement/update_retour_terrain.php",
        dataType: "json",
        method: "POST",
        data: {
            idsp : idsp,
            idtot : idtot,
            val : val
        }
    }).done(function (msg) {
        console.log(msg.message);
        App.showMessage(msg,selector);
    });
}

function getRetourTerrain(idsp,idtot,selector) {
    $.ajax({
        url: "api/myot/traitement/get_retour_stt.php",
        dataType: "json",
        method: "POST",
        data: {
            idsp : idsp,
            idtot : idtot
        }
    }).done(function (msg) {
        console.log('getRetourTerrain');
        console.log(msg);
        $(selector).val(msg.retour);
        for(var i = 0 ; i < msg.liens.length ; i++) {
            //console.log();
            $('#'+msg.liens[i].wrapper).show();
            $('#'+msg.liens[i].labelid).html(msg.liens[i].label);
            $('#'+msg.liens[i].selector).html(msg.liens[i].value);
        }

        if(ot_dt.row('.selected').data().id_type_ordre_travail == 9 || ot_dt.row('.selected').data().id_type_ordre_travail == 10) {
            $("#ret_etat_retour2").val(msg.etatretour);
        } else {
            $("#ret_etat_retour").val(msg.etatretour);
        }
    });
}