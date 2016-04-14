<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.projects_add.js.php
 *  Author     : RR
 *  Description: Custom JS code used in Admin Page Projects ADD
 */

var ProjectFormValidation = function() {
    var API_URL = 'public/api/r2iApi.php';
    var $form = jQuery('.js-validation-bootstrap');
    var $fileselect = $('#myfile');
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
                        window.location.href = '?page=projects&action=edit&projectid='+id;
                    }
                }
            }
        });
    };
    // Add a project
    var addProject = function() {
        // When the add project form is submitted
        jQuery('.add-project').on('click', function(){

            //$('#loader').modal({backdrop: 'static', keyboard: false});

            if($form.valid()) {
                console.log('form submited');

                showLoader('Enregistrement de projet ...');

                var formData = new FormData();
                var Params = {};

                $form.find("input,textarea,select").each(function (index, node) {
                    Params[node.name] = node.value;
                });

                formData.append('parameters', JSON.stringify(Params));
                formData.append('method', 'insert_project');

                // Get the selected files from the input.
                var files = $fileselect[0].files;

                console.log(files);

                console.log(JSON.stringify(Params));

                // Loop through each of the selected files.
                for (var i = 0; i < files.length; i++) {

                    /*// Check the file type.
                    if (!file.type.match('image.*')) {
                        continue;
                    }*/

                    // Add the file to the request.
                    formData.append('myfile'+i, files[i]);
                }

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log('insert_project:success');
                        console.log(response);
                        hideLoader();
                        openDialog(response.id, response.msg, response.done);

                    },
                    error: function (e) {
                        console.log('insert_project:error');
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

                'city': {
                    required: true
                },
                'plate_dept_code': {
                    required: true
                },
                'site_code': {
                    required: true
                },
                'type_site_id': {
                    required: true
                },
                'size': {
                    required: true,
                    number : true
                },
                'orig_site_state_id': {
                    required: true
                },
                'orig_site_provision_date': {
                    required: true
                },
                'myfile': {
                    required: true
                }
            },
            messages: {
                'city': {
                    required: 'Ce champs est obligatoire'
                },
                'plate_dept_code': {
                    required: 'Ce champs est obligatoire'
                },
                'site_code': {
                    required: 'Ce champs est obligatoire'
                },
                'type_site_id': {
                    required: 'Ce champs est obligatoire'
                },
                'size': {
                    required: 'Ce champs est obligatoire',
                    number : 'Tapez un nombre valide'
                },
                'orig_site_state_id': {
                    required: 'Ce champs est obligatoire'
                },
                'orig_site_provision_date': {
                    required: 'Ce champs est obligatoire'
                },
                'myfile': {
                    required: 'Ce champs est obligatoire'
                }
            }
        });
    };

    return {
        init: function () {
            // add events
            addProject();
            //init page helpers
            initPlugins();
            // Init Bootstrap Forms Validation
            initValidationBootstrap();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ ProjectFormValidation.init(); });