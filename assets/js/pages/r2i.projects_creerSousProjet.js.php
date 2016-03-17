<?php
header("Content-type: application/javascript");
?>


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

    var addUser = function() {
        var $form = jQuery('.js-validation-bootstrap');
        var $row = {}; // default row value;
        // When the add project form is submitted
        jQuery('#add-sous-project').on('click', function(){
            console.log('Enregistrement sous projet');

                $form.find('input,textarea,select').each(function () {
                    $row[$(this).attr('name')] = $(this).val();
                });
                console.log(JSON.stringify($row));
                //call ajax
                executeMethod('insert_sous_project',JSON.stringify($row));

        });
    };
    // Init page helpers



    return {
        init: function () {

            // Update Event functionality
            addUser();

        }
    };
}();

// Initialize when page loads
jQuery(function(){ ProjectFormValidation.init(); });