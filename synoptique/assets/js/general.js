function showNotification(message, type = 'info', title = '') {
    $.notify({
        // options
        message: message,
        title: title,
        //url: 'https://github.com/mouse0270/bootstrap-notify',
        //target: '_blank'
    }, {
        // settings
        type: type,
        placement: {
            from: "bottom",
            align: "right"
        },
        animate: {
            enter: 'animated fadeInUp',
            exit: 'animated fadeOutUp'
        },
        //offset: 20,
        offset: {
            y: 100,
            x: 20
        },
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 1000,
        //url_target: '_blank',
        //mouse_over: null,
        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<p data-notify="title">{1}</p> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>'
    });
}

function makeOptionsList(list, selected, id, lib) {
    var options = '';
    for (var i = 0; i < list.length; i++) {
        options += '<option value="' + list[i][id] + '" ' + (list[i][id] == selected ? 'selected' : '') + '>' + list[i][lib] + '</option>';
    }
    return options;
}

function sendToApi(api, action, data,onSuccessCallBack) {
    $.ajax({
        url: 'api/?api=' + api + '&action=' + action,
        method: 'POST',
        data: data,
        success: function (data) {
            var date = new Date();
            if (data.err == 0) {
                showNotification(data.msg, 'info', date.getFullYear() + '/' + date.getMonth() + '/' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds());
            } else {
                showNotification(data.msg, 'danger', date.getFullYear() + '/' + date.getMonth() + '/' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds());
            }
            if(onSuccessCallBack) {
                onSuccessCallBack();
            }

        },
        error: function (data) {
            showNotification('ERROR ' + data, 'danger');
        }
    });
}

function updateChambreOnChange(chambreId, obj, select) {
    var value = '';
    if (obj.type === 'checkbox') {
        if (obj.checked === true) {
            value = 1;
        } else {
            value = 0;
        }
    } else {
        value = obj.value;
    }
    sendToApi('chambre', 'update_on_change', {f: select, v: value, id: chambreId});
}

function updateTronconOnChange(tronconID, obj, select) {
    var value = '';
    if (obj.type === 'checkbox') {
        if (obj.checked === true) {
            value = 1;
        } else {
            value = 0;
        }
    } else {
        value = obj.value;
    }
    sendToApi('troncon', 'update_on_change', {f: select, v: value, id: tronconID});
}

function deleteImage(imageID) {
    sendToApi('photo', 'delete', { id: imageID },imageUploader);

}

function imageUploader(chambreID) {
    if(!chambreID) {
        chambreID = $('#chambre_id_for_image_upload').val();
    }
    console.log('Click Click');
    // photos_area
    $.ajax({
        url: 'api/?api=photos&action=list&id=' + chambreID,
        success: function (data) {
            $('#photos_area').html('');
            var image = '<table class="table table-bordered table-responsive">';
            //image += '<tr><th>#</th><th>Preview</th><th>Date Chargement</th><th>Action</th></tr>';
            var line1 = '';
            var line2 = '';
            var j = 0;
            for(var i = 0 ; i < data.photos.length ; i++) {
                /*image += '<tr><td>' + data.photos[i]['id'] + '</td><td>';
                image += '<img onclick="showImage(\'assets/photos/' + data.photos[i]['new_name'] + '\')" width="128px" height="128px" src="assets/photos/' + data.photos[i]['new_name'] + '" alt="..." class="img-responsive img-thumbnail" />';
                image += '</td>';
                image += '<td>' + data.photos[i]['date_upload'] + '</td>';
                image += '<td><button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove">&nbsp;</span></button></td>';
                $('<img onclick="showImage(\'assets/photos/' + data.photos[i]['new_name'] + '\')" width="128px" height="128px" src="assets/photos/' + data.photos[i]['new_name'] + '" alt="..." class="img-responsive img-thumbnail" /><span class="badge"><button class="btn btn-xs btn-danger">x</button> </span>').appendTo('#photos_area');
            */
                if(j == 0) {
                    line1 += '<tr>';
                    line2 += '<tr>';
                }
                line1 += '<td><img onclick="showImage(\'assets/photos/' + data.photos[i]['new_name'] + '\')" width="128px" height="128px" src="assets/photos/' + data.photos[i]['new_name'] + '" alt="..." class="img-responsive img-thumbnail" /></td>';
                line2 += '<td><button onclick="deleteImage(' + data.photos[i]['id'] + ')" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></button></td>';
                if(j == 2) {
                    line1 += '</tr>';
                    line2 += '</tr>';
                    image += line1 + line2;
                    line1 = '';
                    line2 = '';
                    j = 0;
                }
                j++;
            }
            if(j < 3 && j > 1) {
                for(; j < 3 ; j++) {
                    line1 += '<td></td>';
                    line2 += '<td></td>';
                }
                line1 += '</tr>';
                line2 += '</tr>';
                image += line1 + line2;
            }
            image += '</table>';
            $(image).appendTo('#photos_area');
        },
        beforeSend : function () {
            $('#photos_area').html('<img src="img/gear.gif" id="loading_gif" width="32px" height="32px" />');
        },
        error: function (data) {
        }
    });
    $('#chambre_id_for_image_upload').val(chambreID);
    $('#imageUploadModal').modal('show');
}