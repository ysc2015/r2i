<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.users_add.js.php
 *  Author     : RR
 *  Description: Custom JS code : Add new user
 */
var ProjectFormValidation = function() {
    var API_URL = 'public/api/r2iApi.php';
    var $form = jQuery('.js-validation-bootstrap');
    var showAlert = function(type,msg) {
        console.log('showAlert');
        switch (type) {
            case "1" : $("#successmsg").html(msg);$('#successalert').modal({backdrop: 'static', keyboard: false});break;
            case "2" : $("#errormsg").html(msg);$('#erroralert').modal({backdrop: 'static', keyboard: false});break;
            default : break;
        }
    };
    var addUser = function() {
        // When the add project form is submitted
        jQuery('#add-user').on('click', function(){
            console.log('add user');

            if($form.valid()) {
                //call ajax
                // Create a new element input, this will be our hashed password field.
                var p = document.createElement("input");

                // Add the new element to our form.
                $form.append(p);
                p.name = "p";
                p.type = "hidden";
                p.value = hex_sha512($("#password1").val());

                // Make sure the plaintext password doesn't get sent.
                $("#password1").val("");
                $("#password2").val("");
                // Finally submit the form.
                //form.submit();
                var formData = {};
                $form.find("input,textarea,select").each(function (index, node) {
                    formData[node.name] = node.value;
                });
                console.log(JSON.stringify(formData));

                //send login ajax request
                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    dataType: 'json',
                    data: {parameters : JSON.stringify(formData), method : 'insert_user'},
                    success: function (response) {
                        console.log('insert_user success');
                        console.log(response);
                        showAlert((response.done == true ? '1':'2'),response.msg);
                        $form[0].reset();
                        setTimeout(function () {
                            //or
                            window.location.href = "?page=users&action=list";
                        }, 2500);
                    },
                    error: function (response) {
                        console.log('insert_user error');
                        console.log(response);
                    }
                });
            }
            return false;
        });
    };
    // Init page helpers
    var initPlugins = function() {
        //App.initHelpers(['datepicker']);
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
            rules: {
                'profil_id': {
                    required: true
                },
                'user_firstname': {
                    required: true
                },
                'user_lastname': {
                    required: true
                },
                'email': {
                    required: true,
                    email:true,
                    remote: {
                        url: "public/api/check-email.php",
                        type: "post"
                    }
                },
                'password1': {
                    required: true
                },
                'password2': {
                    equalTo: "#password1"
                }
            },
            messages: {
                'profil_id': {
                    required: 'Veuillez séléctionner un profil !'
                },
                'user_firstname': {
                    required: 'Veuillez saisir un prénom !'
                },
                'user_lastname': {
                    required: 'Veuillez saisir un nom !'
                },
                'email': {
                    required: 'Veuillez saisir un email !',
                    email: 'email non valide !',
                    remote: "Email déjà utilisé !"
                },
                'password1': {
                    required: 'Veuillez saisir un mot de passe !'
                },
                'password2': {
                    equalTo: 'Le mot de passe ne corresponds pas !'
                }
            }
        });
    };

    return {
        init: function () {
            // Update Event functionality
            addUser();
            //init page helpers
            initPlugins();
            // Init Bootstrap Forms Validation
            initValidationBootstrap();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ ProjectFormValidation.init(); });