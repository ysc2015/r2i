<?php
/**
 * Created by PhpStorm.
 * User: ilham
 * Date: 18/04/16
 * Time: 04:24 م
 */
header("Content-type: application/javascript");
?>
var DistribRaccoFormValidation = function() {
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
    var openDialog = function(cl,txt) {
        $( "#alertbox p").html(txt);
        $( "#alertbox" ).dialog({
            dialogClass: "alert-box",
            resizable: false,
            /*height:140,*/
            modal: true,
            buttons: {
                "Fermer": function() {
                    $( this ).dialog( "close" );
                    window.location.href = "?page=projects&action=list";
                }
            }
        });
    };
    // Add sub project
    var addDistribRacco= function() {
        // When the add project form is submitted
        jQuery('.add-distrib-racco').on('click', function(){
            if($form.valid()) {
                console.log('form submited');
                showLoader('Enregistrement en cours ...');

                var formData = new FormData();
                var Params = {};

                $form.find("input,textarea,select").each(function (index, node) {
                    Params[node.name] = node.value;
                });

                formData.append('parameters', JSON.stringify(Params));
                formData.append('method', 'insert_distrib_racco');

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log('insertion :success');
                        console.log(response);
                        hideLoader();
                        openDialog('dd', response.msg);

                    },
                    error: function (e) {
                        console.log('insertion :error');
                        console.log(e.responseText);
                        hideLoader();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
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
            // Add Events functionality
            addDistribRacco();
            //init page helpers
            initPlugins();
            // Init Bootstrap Forms Validation
            initValidationBootstrap();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ DistribRaccoFormValidation.init(); });