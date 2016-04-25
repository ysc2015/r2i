<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.synops_edit.js.php
 *  Author     : RR
 *  Description: Custom JS code : edit synops
 */

var SynopsFormValidation = function() {
    var API_URL = 'public/api/qjisApi.php';
    var $form = jQuery('.js-validation-bootstrap');
    //loader
    var showLoader = function(txt) {
        jQuery('#progressbar').html(txt);
        $('#loader').modal({backdrop: 'static', keyboard: false});
    };
    var hideLoader = function() {
        $('#loader').modal('hide');
    };
    var openDialog = function(txt) {
        $( "#alertbox p").html(txt);
        $( "#alertbox" ).dialog({
            dialogClass: "alert-box",
            resizable: false,
            /*height:140,*/
            modal: true,
            buttons: {
                "Ouvrir": function() {
                    $( this ).dialog( "close" );
                },
                Annuler: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    };

    //events
    var addSynoptic = function() {
        // When the add project form is submitted
        jQuery('.open-upload-syn').on('click', function(){

            //$('#loader').modal({backdrop: 'static', keyboard: false});

            var formData = new FormData();

            formData.append('action', 'login');
            formData.append('user', 'ayoub');
            formData.append('mdp', 'dsdsq');

            $.ajax({
                url: API_URL,
                type: 'POST',
                data: formData,
                success: function (response) {
                    console.log('get_login:success');
                    console.log(response);
                },
                error: function (e) {
                    console.log('get_login:error');
                    console.log(e.responseText);
                },
                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        });
    };

    // Init page helpers
    var initPlugins = function() {
        //App.initHelpers(['easy-pie-chart','datepicker']);
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
            },
            messages: {
            }
        });
    };

    return {
        init: function () {
            //events
            addSynoptic();
            //init page helpers
            initPlugins();
            // Init Bootstrap Forms Validation
            initValidationBootstrap();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ SynopsFormValidation.init(); });