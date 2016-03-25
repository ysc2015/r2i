<?php
header("Content-type: application/javascript");
?>

var UserUpdateFormValidation = function() {

    var API_URL = 'public/api/r2iApiUser.php';
    var $form = jQuery('.js-validation-bootstrap');
    var $row = {}; // default row value;

    var updateUser = function() {
        // When the update form is submitted
        jQuery('#update-user').on('click', function(){
            console.log('mod user');

            if($form.valid()) {
                $form.find('input,textarea,select').each(function () {
                    $row[$(this).attr('name')] = $(this).val();
                });
                console.log(JSON.stringify($row));
                //call ajax
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

            // Update Event functionality
            updateUser();
            //init page helpers
            initPlugins();
            // Init Bootstrap Forms Validation
            initValidationBootstrap();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ UserUpdateFormValidation.init(); });
