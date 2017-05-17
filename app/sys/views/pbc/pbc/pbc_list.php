<style>
    .question_pbc .ajax-upload-dragdrop {
        display: none;
    }
</style>
<ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">
    <li class="active">
        <a href="#btabs-alt-static-justified-q1"><i class="fa fa-question-circle"></i> Infos complémentaires</a>
    </li>
    <li class="">
        <a href="#btabs-alt-static-justified-q2"><i class="fa fa-pencil"></i> Corrections</a>
    </li>
</ul>
<div class="block-content tab-content">
    <div class="tab-pane active" id="btabs-alt-static-justified-q1">
        <table id="blq_pbc_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>id</th>
                <th>idot</th>
                <th>type</th>
                <th>OT</th>
                <th>snake</th>
                <th>planche a3</th>
                <th>chambre amont</th>
                <th>chambre aval</th>
                <th>question / reponse</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>id</th>
                <th>idot</th>
                <th>type</th>
                <th>OT</th>
                <th>snake</th>
                <th>planche a3</th>
                <th>chambre amont</th>
                <th>chambre aval</th>
                <th>question / reponse</th>
            </tr>
            </tfoot>
        </table>
        <button id="details_pbc_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#rep-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-eye-open'>&nbsp;</span> Afficher détails</button>
        <div id="sp_question_pbc_upload" class="row">
            <div class="col-md-6 question_pbc">
                <label for="question_pbc_uploader" style="margin-top: 20px;">Attachments Question</label>
                <div id="question_pbc_uploader"></div>
            </div>
            <div class="col-md-6">
                <label for="reponse_pbc_uploader" style="margin-top: 20px;">Attachments Réponse</label>
                <div id="reponse_pbc_uploader"></div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="btabs-alt-static-justified-q2">
        <table id="blq_pbc_table2" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>id</th>
                <th>idot</th>
                <th>type</th>
                <th>OT</th>
                <th>snake</th>
                <th>planche a3</th>
                <th>chambre amont</th>
                <th>chambre aval</th>
                <th>information / ajustement</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>id</th>
                <th>idot</th>
                <th>type</th>
                <th>OT</th>
                <th>snake</th>
                <th>planche a3</th>
                <th>chambre amont</th>
                <th>chambre aval</th>
                <th>information / ajustement</th>
            </tr>
            </tfoot>
        </table>
        <button id="details_pbc_show2" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#view-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-eye-open'>&nbsp;</span> Afficher détails</button>
    </div>
</div>

<script>
    var blq_pbc_dt;
    var blq_pbc_dt2;
    var blq_pbc_btns = ["#details_pbc_show"];
    var blq_pbc_btns2 = ["#details_pbc_show2"];

    var reponse_pbc_uploader_options = {
        url: "api/ot/ot/reponse_pbc_upload_retour.php",
        multiple:false,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "pdf,xls,xlsx,jpeg",
        onLoad:function(obj)
        {
            if(blq_pbc_dt != undefined && blq_pbc_dt.row('.selected').data() !== undefined) {
                $.ajax({
                    cache: false,
                    url: "api/ot/ot/load_reponse_pbc.php",
                    method:"POST",
                    data: {idpbc: blq_pbc_dt.row('.selected').data().id_blq_pbc},
                    dataType: "json",
                    success: function(data)
                    {
                        for(var i=0;i<data.length;i++)
                        {
                            obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"],data[i]["id"]);
                        }
                    }
                });
            }
        },
        dynamicFormData: function()
        {
            var data ={
                idpbc: blq_pbc_dt.row('.selected').data().id_blq_pbc
            };
            return data;
        },
        afterUploadAll:function(obj) {
        },
        downloadCallback:function(data,pd)
        {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            location.href="api/file/download.php?id="+id;
        },
        deleteCallback: function (data, pd) {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            $.ajax({
                method: "POST",
                url: "api/file/delete.php",
                data: {
                    id: id
                }
            }).done(function (message) {
                console.log(message);
            });

        }
    };
    var question_pbc_uploader_options = {
        multiple:false,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: false,
        showDelete:false,
        showDownload:true,
        onLoad:function(obj)
        {
            if(blq_pbc_dt != undefined && blq_pbc_dt.row('.selected').data() !== undefined) {
                $.ajax({
                    cache: false,
                    url: "api/ot/ot/load_question_pbc.php",
                    method:"POST",
                    data: {idpbc: blq_pbc_dt.row('.selected').data().id_blq_pbc},
                    dataType: "json",
                    success: function(data)
                    {
                        for(var i=0;i<data.length;i++)
                        {
                            obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"],data[i]["id"]);
                        }
                    }
                });
            }
        },
        downloadCallback:function(data,pd)
        {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            location.href="api/file/download.php?id="+id;
        }
    };
    $(function () {
        // Init page plugins & helpers
        question_pbc_uploader_options = merge_options(defaultUploaderStrLocalisation,question_pbc_uploader_options);
        question_pbc_uploader = $("#question_pbc_uploader").uploadFile(question_pbc_uploader_options);

        reponse_pbc_uploader_options = merge_options(defaultUploaderStrLocalisation,reponse_pbc_uploader_options);
        reponse_pbc_uploader = $("#reponse_pbc_uploader").uploadFile(reponse_pbc_uploader_options);
    });

    $(document).ready(function() {

        $(blq_pbc_btns.join(',')).addClass('disabled');
        $(blq_pbc_btns2.join(',')).addClass('disabled');

        blq_pbc_dt = $('#blq_pbc_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/ot/ot/pbc_liste.php?type=1&req='+get('type')
            },
            "columns": [
                { "data": "id_blq_pbc" },
                { "data": "id_ordre_de_travail" },
                { "data": "type" },
                { "data": "type_ot" },
                { "data": "snake" },
                { "data": "planche_a3" },
                { "data": "chambre_amont" },
                { "data": "chambre_aval" },
                { "data": "question_information" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2 ], "visible": false, "searchable": false },
                {
                    "targets": 7,
                    "render": function ( data, type, full, meta ) {
                        return  '<button class="btn btn-info btn-sm view-question disabled">voir question / réponse</button>';
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
                $(blq_pbc_btns.join(',')).addClass('disabled');
                update_info = false;
            }
        } );
        blq_pbc_dt2 = $('#blq_pbc_table2').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/ot/ot/pbc_liste.php?type=2&req='+get('type')
            },
            "columns": [
                { "data": "id_blq_pbc" },
                { "data": "id_ordre_de_travail" },
                { "data": "type" },
                { "data": "type_ot" },
                { "data": "snake" },
                { "data": "planche_a3" },
                { "data": "chambre_amont" },
                { "data": "chambre_aval" },
                { "data": "question_information" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2 ], "visible": false, "searchable": false },
                {
                    "targets": 7,
                    "render": function ( data, type, full, meta ) {
                        return  '<button class="btn btn-info btn-sm view-correction disabled">voir information / ajustement</button>';
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
                $(blq_pbc_btns2.join(',')).addClass('disabled');
                update_info2 = false;
            }
        } );

        $('#sp_question_pbc_upload').hide();

        $('body').on('click',"#blq_pbc_table tbody tr",function (){
            if(true) { //TODO check if dt is not empty
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');

                    $(blq_pbc_btns.join(',')).addClass('disabled');
                    //$('.view-question').addClass('disabled');
                    $(this).find('.view-question').addClass('disabled');

                    $('#sp_question_pbc_upload').hide();
                }
                else {
                    blq_pbc_dt.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $('.view-question').addClass('disabled');

                    $(blq_pbc_btns.join(',')).removeClass('disabled');
                    //$('.view-question').removeClass('disabled');
                    $(this).find('.view-question').removeClass('disabled');

                    question_pbc_uploader.reset();
                    question_pbc_uploader = $("#question_pbc_uploader").uploadFile(question_pbc_uploader_options);

                    reponse_pbc_uploader.reset();
                    reponse_pbc_uploader = $("#reponse_pbc_uploader").uploadFile(reponse_pbc_uploader_options);

                    $('#sp_question_pbc_upload').show();
                }
            }
        });

        $('body').on('click',"#blq_pbc_table2 tbody tr",function (){
            console.log($(this));
            if(true) { //TODO check if dt is not empty
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');

                    $(blq_pbc_btns2.join(',')).addClass('disabled');
                    $(this).find('.view-correction').addClass('disabled');
                    //$('.view-correction').addClass('disabled');
                }
                else {
                    blq_pbc_dt2.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $('.view-correction').addClass('disabled');

                    $(blq_pbc_btns2.join(',')).removeClass('disabled');
                    //$('.view-correction').removeClass('disabled');
                    $(this).find('.view-correction').removeClass('disabled');
                }
            }
        });

        $('body').on('click', '.view-question', function(e) {
            e.stopPropagation();
            console.log("view-question Clicked " + blq_pbc_dt.row('.selected').data().reponse_ajustement);
            $('#text2').removeAttr('readonly');
            $('#save_rep').show();
            $('#question-correction-title').html('Question / Réponse');
            $('#label1').html('Question');
            $('#label2').html('Réponse');
            $('#text1').val(blq_pbc_dt.row('.selected').data().question_information);
            $('#text2').val(blq_pbc_dt.row('.selected').data().reponse_ajustement);
            $('#question-correction').modal({backdrop: 'static', keyboard: false});
            $('#question-correction').modal('show');
        });

        $('body').on('click', '.view-correction', function(e) {
            e.stopPropagation();
            console.log("view-correction Clicked");
            $('#text2').attr('readonly','');
            $('#save_rep').hide();
            $('#question-correction-title').html('Information / Ajustement');
            $('#label1').html('Information');
            $('#label2').html('Ajustement');
            $('#text1').val(blq_pbc_dt2.row('.selected').data().question_information);
            $('#text2').val(blq_pbc_dt2.row('.selected').data().reponse_ajustement);
            $('#question-correction').modal({backdrop: 'static', keyboard: false});
            $('#question-correction').modal('show');
        });

    } );
</script>

<?php

include_once __DIR__."/modals/quest_correction.php";

?>