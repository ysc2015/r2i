<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.projects_sdfiles.js.php
 *  Author     : RR
 *  Description: Custom JS code used in Admin Page Projects Upload SD Files
 */

var SDFilesUpload = function() {
    var API_URL = 'api/r2iApi.php';
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
    //Init JQuery Upload plugin
    var initUpload = function() {
        $("#fileuploader").uploadFile({
            url:"api/upload.php",
            fileName:"myfile",
            autoSubmit:false,
            uploadStr:"Ajouter fichier(s)",
            dragDropStr:"<span><b>Glissez vos fichiers ici Fichiers</b></span>",
            afterUploadAll:function(obj)
            {
                console.log('afterUploadAll');
                $.each(obj.existingFileNames, function( index, value ) {
                    alert( index + ": " + value );
                });


            },
//            formData: {"idp":"Ravi","idf":31},
            onSuccess:function(files,data,xhr,pd)
            {
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
                //call ajax
                var $row ={project_id:$_GET['idp'],folder_id:1,filename:data.data[0],file_ext:'exx'};
                executeMethod('insert_file',JSON.stringify($row));

            }
        });
    };
    return {
        init: function () {
            //Add upload plugin functionality
            initUpload();
        }
    };
}();
// Initialize when page loads
jQuery(function(){ SDFilesUpload.init(); });