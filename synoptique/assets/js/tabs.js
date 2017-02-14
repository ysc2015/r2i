var openedTab = [];

function addTabContent(elementID, content) {
    var contentElement = '<div role="tabpanel" class="tab-pane"  id="' + elementID + '">';
    contentElement += content;
    contentElement += '</div>';
    $(contentElement).appendTo('#myTabContent');
}

function removeTab(tabId) {
    tabId = tabId.replace('tab_id_','');

    var indexOf = openedTab.indexOf(tabId);
    if (indexOf != -1) {
        openedTab.splice(indexOf, 1);
        $('#tab_id_' + tabId).remove();
        $('#tab_title_tab_id_' + tabId).remove();
    }
}

function addTabsTitleElement(elementID, title) {
    var navElement = '<li role="presentation" id="tab_title_' + elementID + '">';
    navElement += '<a href="#' + elementID + '" aria-controls="' + elementID + '" id="' + elementID + '-tab" role="tab" data-toggle="tab">' + title + '</a>';
    navElement += '<button onclick="removeTab(\'' + elementID + '\')" class="close" style="left: -5px;top: -43px;position: relative;"><span aria-hidden="true">×</span></button>';
    navElement += '</li>';
    $(navElement).appendTo('#myTabs');
}

function activaTab(tab) {
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
}

function tronconClick(obj) {
    var troncon_id = obj.getAttribute('data-id');
    if (openedTab.indexOf(troncon_id) != -1) {
        return;
    }
    openedTab.push(troncon_id);

    var x = obj.getAttribute('stroke');
    if (x == 'red') {
        obj.setAttribute('stroke', 'green');
    } else {
        obj.setAttribute('stroke', 'red');
    }

    $.ajax({
        url: 'api/?api=troncon',
        method: 'POST',
        data: {
            id: obj.getAttribute('data-id')
        },
        success: function (data) {

            var type_infra = '';

            var options = makeOptionsList(type_infra_options, data.type_infra_src, 'id_type_infra', 'lib_type_infra');

            var chambre_source = '<tr><td>Ref Chambre</td><td>' + data.ref_chambre_src + '</td></tr>';
            chambre_source += '<tr><td>Type Infra</td> <td>';
            chambre_source += '<select class="form-control" onchange="updateChambreOnChange(' + data.chambre_src + ',this,\'type_infra\')">' + options + '</select>';

            options = makeOptionsList(type_chambre_options, data.type_chambre_src, 'id_type_chambre', 'lib_type_chambre');
            chambre_source += '</td></tr><tr><td>Type Chambre :</td><td>';
            chambre_source += '<select class="form-control" onchange="updateChambreOnChange(' + data.chambre_src + ',this,\'type_chambre\')">' + options + '</select>';
            chambre_source += '</td></tr>';
            chambre_source += '<tr><td colspan="2"><input type="checkbox" onclick="updateChambreOnChange(' + data.chambre_src + ',this,\'manchon_prevu\')" /> Manchon Prévu <a href="#" onclick="imageUploader(' + data.chambre_src + ')">Upload Photos</a> </td></tr>';

            options = makeOptionsList(type_infra_options, data.type_infra_dst, 'id_type_infra', 'lib_type_infra');

            var chambre_destination = '<tr><td>Ref Chambre</td><td>' + data.ref_chambre_dst + '</td></tr>';
            chambre_destination += '<tr><td>Type Infra</td> <td>';
            chambre_destination += '<select class="form-control" onchange="updateChambreOnChange(' + data.chambre_dst + ',this,\'type_infra\')">' + options + '</select>';

            options = makeOptionsList(type_chambre_options, data.type_chambre_dst, 'id_type_chambre', 'lib_type_chambre');
            chambre_destination += '</td></tr><tr><td>Type Chambre :</td><td>';
            chambre_destination += '<select class="form-control" onchange="updateChambreOnChange(' + data.chambre_dst + ',this,\'type_chambre\')">' + options + '</select>';
            chambre_destination += '</td></tr>';
            chambre_destination += '<tr><td colspan="2"><input type="checkbox" onclick="updateChambreOnChange(' + data.chambre_dst + ',this,\'manchon_prevu\')" /> Manchon Prévu <a href="#" onclick="imageUploader(' + data.chambre_dst + ')">Upload Photos</a> </td></tr>';

            var html = '<table class="table"> \
            <tr class="topBorder leftBorder rightBorder bottomBorder"> \
            <td colspan="4" class=""> \
            <table class="table table-bordered"> ' + chambre_source + '</table></td></tr>\
            <tr><td rowspan="3">\
                <svg width="100" height="100" style="background: white">\
                <circle r="50" cx="50" cy="50" fill="rgb(255,255,255)" stroke="rgb(0,0,0)" />\
                <text x="20" y="25">Masque</text>\
                <line x1="0" y1="45" x2="100" y2="45" stroke-width="4" stroke="rgb(0,0,0)" />\
                <text x="20" y="65">Alvéole de </text>\
                <text x="20" y="80">départ :</text>\
                </svg> \
               </td><td>';

            options = makeOptionsList(masque_options, data.masque_src, 'id_masque', 'val_masque');
            html += '<select class="" onchange="updateTronconOnChange(' + data.id_troncon + ',this,\'masque_src\')">' + options + '</select> \
            </td><td class="leftBorder"></td><td></td></tr>\
            <tr><td style="height: 8px; padding: 0px;"><img width="174px" height="10px" src="img/Biochem_reaction_arrow_forward_NNNN_horiz_med.svg.png" />\
            </td><td class="leftBorder"></td><td></td></tr>\
            <tr><td><input class="" type="number" min="0" name="" value="' + data.alveole_src + '" onchange="updateTronconOnChange(' + data.id_troncon + ',this,\'alveole_src\')"></td><td class="leftBorder"></td><td></td></tr> \
            <tr><td>Conduite :</td><td>\
                <input type="radio" name="conduite_libre_src" ' + (data.conduite_libre == 0 ? 'checked' : '' ) + ' value="0" onclick="updateTronconOnChange(' + data.id_troncon + ',this,\'conduite_libre\')"> Occupée &nbsp;' +
                '<input name="conduite_libre_src" type="radio" ' + (data.conduite_libre == 1 ? 'checked' : '' ) + ' value="1"  onclick="updateTronconOnChange(' + data.id_troncon + ',this,\'conduite_libre\')"> Libre</td>\
            <td colspan="2" class="leftBorder">Présence d’alvéole diamètre</td></tr>\
            <tr><td>Type de Réseau:</td><td>';

            options = makeOptionsList(type_reseau_options, data.type_reseau, 'id_type_reseau', 'lib_type_reseau');
            html += '<select onchange="updateTronconOnChange(' + data.id_troncon + ',this,\'type_reseau\')">' + options + '</select> </td> \
            <td colspan="2" class="leftBorder">';

            options = makeOptionsList(alveole_diametre_options, data.alveole_diametre, 'id_alveole_diametre', 'val_alveole_diametre');
            html += '<select class="" onchange="updateTronconOnChange(' + data.id_troncon + ',this,\'alveole_diametre\')">' + options + '</select> \
            </td></tr><tr><td>Autre :</td><td><input type="text" value="" name="autre" onchange="updateTronconOnChange(' + data.id_troncon + ',this,\'autre\')" ></td><td class="leftBorder">Alvéole 100% FREE</td>\
            <td><input type="checkbox" ' + (data.alveole_100_free == 1 ? 'checked' : '') + ' onclick="updateTronconOnChange(' + data.id_troncon + ',this,\'alveole_100_free\')" /> OUI/NON</td></tr>';

            options = makeOptionsList(diametre_options, data.diametre, 'id_diametre', 'valeur_diametre');
            html += '<tr><td>Diamètre</td><td>\
            <select onchange="updateTronconOnChange(' + data.id_troncon + ',this,\'diametre\')" >' + options + '</select>  \
            </td><td class="leftBorder"></td><td></td></tr>\
            <tr><td>Etat Alvéole choisie</td><td>\
            <input type="radio"  value="0" ' + (data.etat_aveole == 0 ? 'checked' : '' ) + ' name="etat_aveole_radio" onclick="updateTronconOnChange(' + data.id_troncon + ',this,\'etat_aveole\')" > Occupée &nbsp; ' +
                '<input value="1" type="radio"' + (data.etat_aveole == 1 ? 'checked' : '' ) + '  name="etat_aveole_radio" onclick="updateTronconOnChange(' + data.id_troncon + ',this,\'etat_aveole\')" > Libre</td>\
            <td class="leftBorder"></td><td></td></tr><tr><td>+4 alvéoles Libres</td><td><input type="checkbox" ' + (data.alveole_libre_4 == 1 ? 'checked' : '') + ' onclick="updateTronconOnChange(' + data.id_troncon + ',this,\'alveole_libre_4\')"> OUI/NON</td>\
            <td class="leftBorder"></td><td></td></tr>';

            options = makeOptionsList(passage_options, data.passage, 'id_passage', 'lib_passage');
            html += '<tr><td>Passage</td><td><select onchange="updateTronconOnChange(' + data.id_troncon + ',this,\'passage\')">' + options + '</select>\
            </td><td class="leftBorder"></td><td></td></tr><tr><td rowspan="3">\
            <svg width="100" height="100" style="background: white">\
            <circle r="50" cx="50" cy="50" fill="rgb(255,255,255)" stroke="rgb(0,0,0)" />\
            <text x="20" y="25">Masque</text>\
            <line x1="0" y1="45" x2="100" y2="45" stroke-width="4" stroke="rgb(0,0,0)" />\
            <text x="20" y="65">Alvéole de </text>\
            <text x="20" y="80">départ :</text>\
            </svg>\
            </td><td>';

            options = makeOptionsList(masque_options, data.masque_dst, 'id_masque', 'val_masque');
            html += '<select class="" onchange="updateTronconOnChange(' + data.id_troncon + ',this,\'masque_dst\')">' + options + '</select>\
            </td><td class="leftBorder"></td><td></td></tr><tr><td style="height: 8px; padding: 0px;">\
            <img width="174px" height="10px" src="img/Biochem_reaction_arrow_forward_NNNN_horiz_med.svg.png" /></td>\
            <td class="leftBorder"></td><td></td></tr><tr>\
            <td><input onchange="updateTronconOnChange(' + data.id_troncon + ',this,\'alveole_dst\')" class="" type="number" min="0" name="" value="' + data.alveole_dst + '" ></td><td class="leftBorder"></td><td></td></tr>\
            <tr class="topBorder leftBorder rightBorder bottomBorder">\
            <td colspan="4" class="">\
            <table class="table table-bordered">' + chambre_destination + '</table></td></tr></table>';


            addTabsTitleElement('tab_id_' + troncon_id, 'Troncon ' + troncon_id);
            addTabContent('tab_id_' + troncon_id, html);
            activaTab('tab_id_' + troncon_id);
            //$('#home').html(html);
        }
    });
}