<?php
header("Content-type: application/javascript");
?>
var API_URL = 'public/api/r2iApi.php';

$(function () {
    function Update(){
        var obj = new Object();
        obj.project_id= project_id;
        console.log(obj.project_id);
        obj.info = new Object();
        obj.info.ceation_date = $('#ceation_date').val();
        console.log(obj.info.ceation_date);
        obj.info.attribution_date = $('#attribution_date').val();
        obj.info.project_name = $('#project_name').val();
        obj.info.city = $('#city').val();
        console.log(obj.info.city);
        obj.info.plate_dept_code = $('#plate_dept_code').val();
        obj.info.type_site_id = $('#type_site_id').val();
        obj.info.size = $('#size').val();
        obj.info.orig_site_state_id = $('#orig_site_state_id').val();
        obj.info.orig_site_provision_date = $('#orig_site_provision_date').val();
        console.log(obj);
        $.ajax({

            url: API_URL,
            type: 'POST',
            dataType: 'json',
            data: {
                parameters: obj,
                method: 'update_project',
            },
            success: function (response) {
                if(response.status == 'success') {
                    console.log("upadte effectué");
                }
            },
            error: function (e) {
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
