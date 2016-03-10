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
    //send mail
    var sendMail = function() {
        $.ajax({
            url: 'public/api/mailApi.php',
            type: 'POST',
            dataType: 'json',
            data: {method : 'send_mail'},
            success: function (response) {
                console.log('send_mail:success');
                console.log(response);
                alert('Projet enregistré !');
                window.location.replace('?page=projects');
            },
            error: function (e) {
                console.log('send_mail:error');
                console.log(e.responseText);
            }
        });
    }
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
                if($methodname == 'insert_project') uploadObj.startUpload();
                if($methodname == 'insert_file') selectedFilesCounter--;
                if(selectedFilesCounter == 0 && $methodname == 'insert_file') {
                    console.log('did finish adding files TO DB');
                    //TODO temp code before form valildation enable
                    //send email here
                    console.log('send mail here !');
                    sendMail();
                    //window.location.replace('?page=projects');
                    //location.reload();

                }
            },
            error: function (e) {
                console.log($methodname+':error');
                console.log(e.responseText);
            }
        });
    };
    //Init JQuery Upload plugin
    var initUpload = function() {
        uploadObj = $("#fileuploader").uploadFile({
            url:"public/api/upload.php",
            fileName:"myfile",
            returnType:"json",
            autoSubmit:false,
            uploadStr:"Ajouter fichier(s)",
            cancelStr:"Annuler",
            dragDropStr:"<span><b>Glissez vos fichiers ici Fichiers</b></span>",
            afterUploadAll:function(obj)
            {
                console.log('afterUploadAll');
                var $_GET = get_$GET_Array();
                $.each(obj.existingFileNames, function( index, value ) {
                    console.log( index + ": " + value );
                    var $row ={project_id:$_GET['idp'],folder_id:1,filename:value};
                    executeMethod('insert_file',JSON.stringify($row));
                });


            },
//            formData: {"idp":"Ravi","idf":31},
            onSuccess:function(files,data,xhr,pd)
            {
                /*var $_GET = get_$GET_Array();
                 //call ajax
                 var $row ={project_id:$_GET['idp'],folder_id:1,filename:data.data[0],file_ext:'exx'};
                 executeMethod('insert_file',JSON.stringify($row));*/

            }
        });
    };
    // Add a project
    var addProject = function() {
        var $form = jQuery('.js-validation-bootstrap');
        var $row = {}; // default row value;
        // When the add project form is submitted
        jQuery('.add-project').on('click', function(){
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
                    executeMethod('insert_project',JSON.stringify($row));
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