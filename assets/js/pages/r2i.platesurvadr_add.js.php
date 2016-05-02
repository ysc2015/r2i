<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.platesurvadr_add.js.php
 *  Author     : RR
 *  Description: Custom JS code : add plate surv adr entry
 */

var PlateSurvAdrFormValidation = function() {
    var API_URL = 'public/api/r2iApi.php';
    var $form = jQuery('.js-validation-bootstrap');
    //loader
    var showLoader = function(txt) {
        jQuery('#progressbar').html(txt);
        $('#loader').modal({backdrop: 'static', keyboard: false});
    };
    var hideLoader = function() {
        $('#loader').modal('hide');
    };
    var openDialog = function(id,txt,done) {
        $( "#alertbox p").html(txt);
        $( "#alertbox" ).dialog({
            dialogClass: "alert-box",
            resizable: false,
            /*height:140,*/
            modal: true,
            buttons: {
                "Fermer": function() {
                    $( this ).dialog( "close" );
                    if(done) {
                        window.location.href = '?page=platesurvadr&action=edit&platesurvadrid='+id;
                    }
                }
            }
        });
    };

    var addPlateSurvAdrEntry = function() {
        jQuery('.add-platesurvadr').on('click', function() {
            console.log('addPlateSurvAdrEntry');

            if($form.valid()) {
                console.log('form submited');

                showLoader('Ajout entrée préparation plaque/survey adresses terrain ...');

                var formData = new FormData();
                var Params = {};

                $form.find("input,textarea,select").each(function (index, node) {
                    Params[node.name] = node.value;
                });

                formData.append('parameters', JSON.stringify(Params));
                formData.append('method', 'insert_platesurvadr_entry');

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log('insert_platesurvadr_entry:success');
                        console.log(response);
                        hideLoader();
                        openDialog(response.id, response.msg, response.done);

                    },
                    error: function (e) {
                        console.log('insert_platesurvadr_entry:error');
                        console.log(e.responseText);
                        hideLoader();
                        openDialog(0, 'erreur', false);

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }

            return false;
        });
    };

    // Init page helpers
    var initPlugins = function() {
        App.initHelpers(['datepicker']);
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
            addPlateSurvAdrEntry();
            //init page helpers
            initPlugins();
            // Init Bootstrap Forms Validation
            initValidationBootstrap();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ PlateSurvAdrFormValidation.init(); });