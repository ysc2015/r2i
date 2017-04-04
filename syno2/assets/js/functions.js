function valById(id) {
    return $('#' + id).val();
}

function show_hide(index) {
    var th = document.querySelectorAll('th[id$="_' + index + '"]');
    var td = document.querySelectorAll('td[id$="_' + index + '"]');
    var hide = true;
    if (th.length == 0)
        return;

    var style = th[0].getAttribute('style');
    if (style == null) {
        style = '';
        hiddenColumns[index] = true;
    } else if (style.indexOf('display: none;') > -1) {
        hide = false;
        hiddenColumns[index] = false;
        style = style.replace('display: none;', '');
    }

    if (th != null) {
        for (var i = 0; i < th.length; i++) {
            if (hide === false) {
                th[i].setAttribute('style', style);
            } else {
                th[i].setAttribute('style', 'display: none;');
            }
        }
    }

    if (td != null) {
        for (var i = 0; i < td.length; i++) {
            if (hide === false) {
                td[i].setAttribute('style', style);
            } else {
                td[i].setAttribute('style', 'display: none;');
            }
        }
    }

    //$('th[id$="_' + index + '"]').toggle();
    //$('td[id$="_' + index + '"]').toggle();
}

function setValById(id, value) {
    $('#' + id).val(value);
}

function elementById(id) {
    return document.getElementById(id);
}

function isChecked(id) {
    return elementById(id).checked;
}
function isCheckedInt(id) {
    return elementById(id).checked == true ? 1 : 0;
}
function nullToStr(value) {
    if(value == null) {
        return '';
    }
    return value;
}

function iCheckToggleByClass(className, status) {
    if (status == undefined) {
        status = 'toggle';
    }
    $(document.getElementsByClassName(className)).iCheck(status);
}

function getTopUnreadedMessage() {
    $.ajax({
        url: 'api/index.php?api=mail&action=getMails',
        method: 'POST',
        data: {
            readed: false,
            limit: '0, 5'
        },
        success: function (response) {
            if (response.err == 0) {

                $('#unreadedMessageQuickList').html('');
                var html = '';
                for (var i = 0; i < response.data.length; i++) {
                    html += '<li>' +
                            '<div class="dropdown-messages-box">' +
                            //'<a href="profile.html" class="pull-left">' +
                            //'</a>' +
                            '<div class="media-body">' +
                            '<strong>' + response.data[i].contact_name + '</strong> ' + response.data[i].contact_message.substring(0, 100) + '<br>' +
                            '<small class="text-muted">' + response.data[i].contact_date + '</small>' +
                            '</div>' +
                            '</div>' +
                            '</li>' +
                            '<li class="divider"></li>';
                }
                html += '<li id="lastUnreadedMessageQuickList">' +
                        '<div class="text-center link-block">' +
                        '<a href="index.php?view=mail">' +
                        '<i class="fa fa-envelope"></i> <strong>Read All Messages</strong>' +
                        '</a>' +
                        '</div>' +
                        '</li>';

                $('#unreadedMessageQuickList').append(html);
                var e = document.getElementById('unreadedMessageQuickList');
                applyClasses(e);
                //$('#lastUnreadedMessageQuickList').insertBefore(html);
            }
        },
        error: function (response) {}
        ,
        complete: function () {}
        ,
        beforeSend: function () {}
    }
    );
}
function applyClasses(element) {
    var i;
    var clas = element.getAttribute('class');
    if (clas != '') {
        element.setAttribute('class', clas);
    }
    for (i = 0; i < element.children.length; i++) {
        applyClasses(element.children[i]);
    }
}

function showNotification(title, msg, type) {
    toastr.options.closeButton = true;
    //toastr.options.closeMethod = 'fadeOut';
    //toastr.options.closeDuration = 300;
    var message = [];
    if(typeof msg === 'string') {
        message.push(msg);
    } else {
        message = msg;
    }

    var msg = '<ul>';
    if (message.length > 0) {
        for (var i = 0; i < message.length; i++) {
            msg += '<li>' + message[i] + '</li>';
        }
        msg += '</ul>';
    } else {
        msg = message;
    }

    if (!type || type == undefined || type == null || type == 'success') {
        toastr.success(msg, title, {timeOut: 5000});
    } else if (type == 'error') {
        toastr.error(msg, title, {timeOut: 5000});
    } else if (type == 'warning') {
        toastr.warning(msg, title, {timeOut: 5000});
    }

}

function makeOptionsFromAPI(api, select_id) {
    $.ajax({
        url: 'api/index.php?api=' + api + '&action=listForSelect',
        success: function (data) {
            var content = '';
            for (var i = 0; i < data.data.length; i++) {
                content += '<option value="' + data.data[i].id + '">' + data.data[i].lib + "</option>";
            }
            if(typeof select_id === 'object') {
                for(var i = 0 ; i < select_id.length ; i++) {
                    $('#' + select_id[i]).html(content);
                    $('#' + select_id[i]).selectpicker('refresh');
                }
            } else {
                $('#' + select_id).html(content);
                $('#' + select_id).selectpicker('refresh');
            }
        },
        beforeSend: function (data) {},
        error: function (data) {}
    });
}
