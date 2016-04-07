<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.zones_add.js.php
 *  Author     : RR
 *  Description: Custom JS code : Add new sub project (zone)
 */

var SubProjectFormValidation = function() {
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
                }
            }
        });
    };
    // Add sub project
    var addSubProject = function() {
        // When the add project form is submitted
        jQuery('.add-sub-project').on('click', function(){
            console.log('add sub project');
            if($form.valid()) {
                console.log('form submited');
                showLoader('Enregistrement de sous projet en cours ...');

                var formData = new FormData();
                var Params = {};

                $form.find("input,textarea,select").each(function (index, node) {
                    Params[node.name] = node.value;
                });

                formData.append('parameters', JSON.stringify(Params));
                formData.append('method', 'insert_sub_project');

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log('insert_sub_project:success');
                        console.log(response);
                        hideLoader();
                        openDialog('dd', response.msg);

                    },
                    error: function (e) {
                        console.log('insert_sub_project:error');
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
    // back to projects list
    var backToProjectsList = function() {
        // When the back to project clicked
        jQuery('.back-to-projects').on('click', function(){
            console.log('backToProjectsList');
            window.location.href = "?page=projects&action=list";
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
            addSubProject();
            backToProjectsList();
            //init page helpers
            initPlugins();
            // Init Bootstrap Forms Validation
            initValidationBootstrap();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ SubProjectFormValidation.init(); });