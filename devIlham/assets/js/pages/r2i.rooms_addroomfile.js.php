<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.rooms_add.js.php
 *  Author     : RR
 *  Description: Custom JS code used in Admin Page RoomsFiles ADD
 */
var RoomsFileFormValidation = function() {
    var API_URL = 'public/api/r2iApi.php';
    //
    var showAlert = function(type,msg) {
        console.log('showAlert');
        switch (type) {
            case "1" : $("#successmsg").html(msg);$('#successalert').modal({backdrop: 'static', keyboard: false});break;
            case "2" : $("#errormsg").html(msg);$('#erroralert').modal({backdrop: 'static', keyboard: false});break;
            default : break;
        }
    };
    //Add(inject) a file
    var addRoomsFile = function() {
        var $form = jQuery('.js-validation-bootstrap');
        // When the add file form is submitted
        $form.submit(function(){

            $('#loader').modal({backdrop: 'static', keyboard: false});

            var formData = new FormData($(this)[0]);
            console.log(formData);
            formData.append('method', 'inject_rooms_file');

            $.ajax({
                url: API_URL,
                type: 'POST',
                data: formData,
                success: function (response) {
                    console.log('inject_rooms_file:success');
                    console.log(response);
                    $('#loader').modal('hide');
                    $( "#dialog-message" ).dialog({
                        modal: true,
                        buttons: {
                            Ok: function() {
                                $( this ).dialog( "close" );
                            }
                        }
                    });
                    $form[0].reset();
                },
                error: function (e) {
                    console.log('inject_rooms_file:error');
                    console.log(e.responseText);
                    $('#loader').modal('hide');
                    $form[0].reset();
                },
                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        });
    };
    // Init Bootstrap Forms Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
    var initValidationBootstrap = function(){
        jQuery('.js-validation-bootstrap').validate({
            errorClass: 'help-block animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents('.form-group > div').append(error);
            },
            highlight: function(e) {
                jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                jQuery(e).closest('.help-block').remove();
            },
            success: function(e) {
                jQuery(e).closest('.form-group').removeClass('has-error');
                jQuery(e).closest('.help-block').remove();
            },
            //TODO add rules later
            rules: {
                'file-input': {
                    required: true
                }
            },
            messages: {
                'file-input': {
                    required: 'Séléctionnez un fichier'
                }
            }
        });
    };

    return {
        init: function () {
            //Add submit functionality
            addRoomsFile();
            // Init Bootstrap Forms Validation
            initValidationBootstrap();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ RoomsFileFormValidation.init(); });