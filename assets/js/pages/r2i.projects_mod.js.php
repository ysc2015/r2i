<?php
header("Content-type: application/javascript");
?>
var API_URL = 'public/api/r2iApi.php';

$(function () {
    function Update(){
        var object = new Object();
        object.project_id= project_id;
        console.log(object.project_id);
        object.info = new Object();
        object.info.ceation_date = $('#ceation_date').val();
        console.log(object.info.ceation_date);
        object.info.attribution_date = $('#attribution_date').val();
        object.info.project_name = $('#project_name').val();
        object.info.city = $('#city').val();
        console.log(object.info.city);
        object.info.plate_dept_code = $('#plate_dept_code').val();
        object.info.site_code = $('#site_code').val();
        object.info.type_site_id = $('#type_site_id').val();
        object.info.size = $('#size').val();
        object.info.orig_site_state_id = $('#orig_site_state_id').val();
        object.info.orig_site_provision_date = $('#orig_site_provision_date').val();
        console.log(object);
        $.ajax({

            url: API_URL,
            type: 'POST',
            dataType: 'json',
            data: {
                parameters: object,
                method: 'update_project',
            },
            success: function (response) {
                if(response.status == 'success') {
                    console.log("upadte effectué");
                }
            },
            error: function (e) {
                console.log("testEroor");
                console.log(e.responseText);
            }
        });
    }
    $('#update-project').click(Update);
    $.ajax({
        url: API_URL,
        type: 'POST',
        dataType: 'json',
        data: {
            parameters: '{"project_id":' + project_id + '}',
            method : 'get_projects_by_id'
        },
        success: function (response) {
            if(response.status == 'success') {
                var project = $.parseJSON(response.project);
                $('#ceation_date').val(project.ceation_date);
                $('#attribution_date').val(project.attribution_date);
                $('#project_name').val(project.project_name);
                $('#city').val(project.city);
                $('#plate_dept_code').val(project.plate_dept_code);
                $('#site_code').val(project.site_code);
                $('#type_site_id').val(project.type_site_id);
                $('#size').val(project.size);
                $('#orig_site_state_id').val(project.orig_site_state_id);
                $('#orig_site_provision_date').val(project.orig_site_provision_date);
            }
        },
        error: function (e) {
            console.log(e.responseText);
        }
    });



});
