<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.transportswitch_edit.js.php
 *  Author     : RR
 *  Description: Custom JS code : edit transport switch informations
 */

var TransportSwitchFormValidation = function() {
    var API_URL = 'public/api/r2iApi.php';
    var $form = jQuery('.js-validation-bootstrap');
    var $form_ot = jQuery('.form-ot');
    //loader
    var showLoader = function(txt) {
        jQuery('#progressbar').html(txt);
        $('#loader').modal({backdrop: 'static', keyboard: false});
    };
    var hideLoader = function() {
        $('#loader').modal('hide');
    };
    var openDialog = function(txt,reloadwindow) {
        $( "#alertbox p").html(txt);
        $( "#alertbox" ).dialog({
            dialogClass: "alert-box",
            resizable: false,
            /*height:140,*/
            modal: true,
            buttons: {
                "Fermer": function() {
                    $( this ).dialog( "close" );
                    if(reloadwindow) {
                        window.location.reload();
                    }
                }
            }
        });
    };

    var updateTransportSwitchEntry = function() {
        jQuery('.update-transport-switch').on('click', function() {
            console.log('updateTransportSwitchEntry');

            if($form.valid()) {
                console.log('form submited');

                showLoader('MAJ entrée transport/aiguillage ...');

                var formData = new FormData();
                var Params = {};

                $form.find("input,textarea,select").each(function (index, node) {
                    Params[node.name] = node.value;
                });

                formData.append('parameters', JSON.stringify(Params));
                formData.append('method', 'update_transportswitch_entry');

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log('update_transportswitch_entry:success');
                        console.log(response);
                        hideLoader();
                        openDialog(response.msg,false);

                    },
                    error: function (e) {
                        console.log('update_transportswitch_entry:error');
                        console.log(e.responseText);
                        hideLoader();
                        openDialog('erreur',false);

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }

            return false;
        });
    };

    var addJobOrder = function() {
        jQuery('.add-ot').on('click', function() {
            console.log('add OT');
            $('#modal-normal').modal('hide');
            if($form_ot.valid()) {
                console.log('form submited');

                showLoader('Ajout ordre de travail ...');

                var formData = new FormData();
                var Params = {};

                $form_ot.find("input,textarea,select").each(function (index, node) {
                    Params[node.name] = node.value;
                });

                console.log(JSON.stringify(Params));

                formData.append('parameters', JSON.stringify(Params));
                formData.append('method', 'insert_job_order');

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log('insert_job_order:success');
                        console.log(response);
                        hideLoader();
                        if(response.done) {
                            setOT(response.id);
                        } else {
                            openDialog(response.msg,false);
                        }

                    },
                    error: function (e) {
                        console.log('insert_job_order:error');
                        console.log(e.responseText);
                        hideLoader();
                        openDialog('erreur',false);

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }

            return false;
        });
    };

    var setOT = function(jobid) {
        console.log('setOT');

        var formData = new FormData();
        var Params = {};

        Params['jobid'] = jobid;
        Params['objid'] = $('#transportswitch_id').val();

        console.log(JSON.stringify(Params));

        formData.append('parameters', JSON.stringify(Params));
        formData.append('method', 'set_transportswitch_job_order');

        $.ajax({
            url: API_URL,
            type: 'POST',
            data: formData,
            success: function (response) {
                console.log('set_transportswitch_job_order:success');
                console.log(response);
                hideLoader();
                openDialog(response.msg,true);

            },
            error: function (e) {
                console.log('set_transportswitch_job_order:error');
                console.log(e.responseText);
                hideLoader();
                openDialog('erreur',false);
            },
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    };

    // Init page helpers
    var initPlugins = function() {
        App.initHelpers(['easy-pie-chart','datepicker']);
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

        jQuery('.form-ot').validate({
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
            updateTransportSwitchEntry();
            addJobOrder();
            //init page helpers
            initPlugins();
            // Init Bootstrap Forms Validation
            initValidationBootstrap();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ TransportSwitchFormValidation.init(); });