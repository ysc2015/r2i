<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.projects_add.js.php
 *  Author     : RR
 *  Description: Custom JS code used in Admin Page Projects ADD
 */

var ProjectFormValidation = function() {
    var API_URL = 'public/api/r2iApiUser.php';
    var uploadObj = null;
    var selectedFilesCounter = 0;
    //get $_GET array
    var get_$GET_Array = function() {
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
        return $_GET;
    };

    //call ajax -> api method
    var executeMethod = function($methodname, $params) {
        $.ajax({
            url: API_URL,
            type: 'POST',
            dataType: 'json',
            data: ($params!=0?{parameters: $params,method : $methodname}:{method : $methodname}),
            success: function (response) {
                console.log($methodname+':success');
                console.log(response);

            },
            error: function (e) {
                console.log($methodname+':error');
                console.log(e.responseText);
            }
        });
    };

    // Add a project
    var addProject = function() {
        var $form = jQuery('.js-validation-bootstrap');
        var $row = {}; // default row value;
        // When the add project form is submitted
        jQuery('.add_utilisateur').on('click', function(){
            console.log('Enregistrement projet');
            console.log(uploadObj);
            if($form.valid()) {
                if(uploadObj.selectedFiles > 0) {
                    selectedFilesCounter = uploadObj.selectedFiles;
                    $form.find('input,textarea,select').each(function () {
                        $row[$(this).attr('name')] = $(this).val();
                    });
                    console.log(JSON.stringify($row));
                    //call ajax
                    executeMethod('insert_user',JSON.stringify($row));
                } else {
                    alert('Ajouter des fichiers au projet !');
                }
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
            //Add upload plugin functionality
            initUpload();
            // Update Event functionality
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