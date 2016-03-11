<?php
header("Content-type: application/javascript");
?>
var API_URL = 'public/api/r2iApiUser.php';

$(function () {

    function Update(){
        var obj = new Object();
        obj.user_id = user_id;
        obj.info = new Object();
        obj.info.profil_id = $('#profil_id').val();
        obj.info.user_firstname = $('#user_firstname').val();
        obj.info.user_lastname = $('#user_lastname').val();
        obj.info.email = $('#email').val();
        obj.info.password = $('#password').val();
        obj.info.salt = $('#salt').val();

        $.ajax({
            url: API_URL,
            type: 'POST',
            dataType: 'json',
            data: {
                parameters: obj,
                method: 'update_user',

            },
            success: function (response) {
                if(response.status == 'success') {
                 console.log("upadte effectué");
                }
            },
            error: function (e) {
                console.log(e.responseText);
            }
        });
    }
    $('#update-user').click(Update);

    $.ajax({
        url: API_URL,
        type: 'POST',
        dataType: 'json',
        data: {
            parameters: '{"user_id":' + user_id + '}',
            method : 'get_user_by_id'
        },
        success: function (response) {
            if(response.status == 'success') {
                var user = $.parseJSON(response.user);
                $('#profil_id').val(user.profil_id);
                $('#user_firstname').val(user.user_firstname);
                $('#user_lastname').val(user.user_lastname);
                $('#email').val(user.email);
                $('#password').val(user.password);
                $('#salt').val(user.salt);
            }
        },
        error: function (e) {
            console.log(e.responseText);
        }
    });
});
