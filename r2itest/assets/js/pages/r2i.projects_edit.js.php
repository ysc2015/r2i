<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.projects_add.js.php
 *  Author     : RR
 *  Description: Custom JS code used in Admin Page Projects ADD
 */

var API_URL = 'public/api/r2iApi.php';

function deleteFileDialog (id,name) {
    $( "#alertbox p").html('Suppprimer le fichier ' +name+ '?');
    $( "#alertbox" ).dialog({
        dialogClass: "alert-box",
        resizable: false,
        /*height:140,*/
        modal: true,
        buttons: {
            "Suppprimer": function() {
                $( this ).dialog( "close" );
                console.log('i delete '+id);
                var formData = new FormData();
                var Params = {};

                ProjectFormValidation.showLoader('suppression fichier contour');

                Params['project_sd_file_id'] = id;
                Params['filename'] = name;

                formData.append('parameters', JSON.stringify(Params));
                formData.append('method', 'delete_sd_file');

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log('delete_sd_file:success');
                        console.log(response);
                        ProjectFormValidation.hideLoader();
                        ProjectFormValidation.buildFilesList();
                        ProjectFormValidation.openDialog(response.msg);
                    },
                    error: function (e) {
                        console.log('delete_sd_file:error');
                        console.log(e);
                        ProjectFormValidation.hideLoader();
                        ProjectFormValidation.buildFilesList();
                        ProjectFormValidation.openDialog(response.msg);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            },
            "Annuler": function() {
                $( this ).dialog( "close" );
            }
        }
    });
};

var ProjectFormValidation = function() {
    var $form = jQuery('.js-validation-bootstrap');
    var $fileselect = $('#myfile');
    //get $_GET array
    var _$GET = function(val) {
        var $_GET = {};
        if(document.location.toString().indexOf('?') !== -1) {
            var query = document.location
                .toString()
                // get the query string
                .replace(/^.*?\?/, '')
                // and remove any existing hash string (thanks, @vrijdenker)
                .replace(/#.*$/, '')
                .split('&');

            for(var i=0, l=query.length; i<l; i++) {
                var aux = decodeURIComponent(query[i]).split('=');
                $_GET[aux[0]] = aux[1];
            }
        }
        return $_GET[val];
    };
    var buildFilesList = function() {
        console.log('buildFilesList');
        console.log(_$GET('projectid'));

        $('#filescontainer').html('');

        var formData = new FormData();
        var Params = {};

        Params['project_id'] = _$GET('projectid');

        formData.append('parameters', JSON.stringify(Params));
        formData.append('method', 'get_project_files');

        var html = '';

        $.ajax({
            url: API_URL,
            type: 'POST',
            data: formData,
            success: function (response) {
                console.log('get_project_files:success');
                console.log(response);
                if(response.data.length > 0) {
                    console.log('building ...');
                    $.each(response.data, function(index, item) {
                        console.log(item.uploaded_filename);
                        html +='<div class="alert alert-info">';
                        html +='<button type="button" class="close" aria-hidden="true" onclick="deleteFileDialog(\''+item.project_sd_file_id+'\',\''+item.uploaded_filename+'\')">&times;</button>';
                        html +='<i class="fa fa-check"></i><a class="alert-link" href="javascript:void(0)"> '+item.uploaded_filename+'</a>';
                        html +='</div>';
                    });

                } else {
                    html +='<div class="alert alert-warning">';
                    html +='<p>Aucun fichier contour uploadé !</p>';
                    html +='</div>';
                }
                $("#filescontainer").html(html);
                hideLoader();

            },
            error: function (e) {
                console.log('get_project_files:error');
                console.log(e);
                hideLoader();
            },
            cache: false,
            contentType: false,
            processData: false
        });
    };
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
                "Fermer": function() {
                    $( this ).dialog( "close" );
                    //$form[0].reset();
                }
            }
        });
    };
    // update a project
    var updateProject = function() {
        jQuery('.mod-project').on('click', function(){

            if($form.valid()) {
                console.log('form submited');

                showLoader('Enregistrement de projet en cours ...');

                var formData = new FormData();
                var Params = {};

                $form.find("input,textarea,select").each(function (index, node) {
                    Params[node.name] = node.value;
                });

                formData.append('parameters', JSON.stringify(Params));
                formData.append('method', 'update_project');

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
                        console.log('update_project:success');
                        console.log(response);
                        hideLoader();
                        buildFilesList();
                        openDialog(response.msg);

                    },
                    error: function (e) {
                        console.log('update_project:error');
                        console.log(e);
                        hideLoader();
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
                }
            },
            messages: {
                'city': {
                    required: 'Veuillez saisir une ville !'
                }
            }
        });
    };

    return {
        openDialog:openDialog,
        buildFilesList:buildFilesList,
        showLoader:showLoader,
        hideLoader:hideLoader,
        init: function () {
            //events
            updateProject();
            //init sd files list
            buildFilesList();
            //init page helpers
            initPlugins();
            // Init Bootstrap Forms Validation
            initValidationBootstrap();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ ProjectFormValidation.init(); });