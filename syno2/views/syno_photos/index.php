<?php
$nbrPerPage = 10;
if (isset($_POST['nbrPerPage'])) {
    $nbrPerPage = $_POST['nbrPerPage'];
}
$nbr = DBHelper::count('syno_photos');
$nbrPages = ceil($nbr / $nbrPerPage);
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <form class="pull-right mail-search">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" id="search_value" placeholder="Search for">

                        <div class="input-group-btn">
                            <button id="btn_search" class="btn btn-sm btn-primary">
                                Search
                            </button>
                        </div>

                        <select id="search_by" class="form-control input-sm">
                            <option value="id"><?php echo $lang["id_label"]; ?></option>
                            <option value="org_name"><?php echo $lang["org_name_label"]; ?></option>
                            <option value="new_name"><?php echo $lang["new_name_label"]; ?></option>
                            <option value="id_chambre"><?php echo $lang["id_chambre_label"]; ?></option>
                            <option value="date_upload"><?php echo $lang["date_upload_label"]; ?></option>
                            <option value="id_user"><?php echo $lang["id_user_label"]; ?></option>
                        </select>
                    </div>
                </form>

                <h2>
                    <?php echo $lang['syno_photos_TITLE']; ?> 
                    <sup><span class="label label-info" id="nbrOf_syno_photos"><?php echo $nbr; ?></span>
                        <span class="label label-primary" id="nPage"></span></sup> 
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm" id="btn_prev"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm" id="btn_next"><i class="fa fa-arrow-right"></i></button>
                    </div>

                    <button id="btn_new" data-toggle="modal" href="#modal-form" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New syno_photos</button>
                    <button id="btn_refresh" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</button>
                    <button id="btn_checkAll" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left"><i class="fa fa-check"></i> Select All</button>
                    <button id="btn_remove" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>
                </div>
            </div>

            <div class="mail-box-header">
                <button class="btn btn-xs btn-primary" onclick="show_hide(0)">id</button> <button class="btn btn-xs btn-primary" onclick="show_hide(1)">org_name</button> <button class="btn btn-xs btn-primary" onclick="show_hide(2)">new_name</button> <button class="btn btn-xs btn-primary" onclick="show_hide(3)">id_chambre</button> <button class="btn btn-xs btn-primary" onclick="show_hide(4)">date_upload</button> <button class="btn btn-xs btn-primary" onclick="show_hide(5)">id_user</button> 
            </div>

            <div class="mail-box">
                <table class="table table-bordered table-hover table-mail">
                    <thead>
                        <tr><th></th><th id="cell_0_0">id</th><th id="cell_0_1">org_name</th><th id="cell_0_2">new_name</th><th id="cell_0_3">id_chambre</th><th id="cell_0_4">date_upload</th><th id="cell_0_5">id_user</th><th>Action</th></tr>
                    </thead>
                    <tbody id="syno_photos_body_id">
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 b-r">
                        <h3 class="m-t-none m-b"><?php echo $lang["syno_photos_modal_title"]; ?></h3>

                        <p><?php echo $lang["syno_photos_modal_description"]; ?></p>

                        <div class="form-group">
                            <label for="<?php echo $lang["id_id"]; ?>"><?php echo $lang["id_label"]; ?></label> 
                            <input id="<?php echo $lang["id_id"]; ?>" placeholder="<?php echo $lang["id_placeholder"]; ?>" class="form-control " type="text" readonly>
                        </div>

                        <div class="form-group">
                            <label for="<?php echo $lang["org_name_id"]; ?>"><?php echo $lang["org_name_label"]; ?></label> 
                            <input id="<?php echo $lang["org_name_id"]; ?>" placeholder="<?php echo $lang["org_name_placeholder"]; ?>" class="form-control " type="text" >
                        </div>

                        <div class="form-group">
                            <label for="<?php echo $lang["new_name_id"]; ?>"><?php echo $lang["new_name_label"]; ?></label> 
                            <div id="<?php echo $lang["new_name_id"]; ?>">Sélectionner</div>
                        </div>

                        <div class="form-group">
                            <label for="<?php echo $lang["id_chambre_id"]; ?>">
                                <?php echo $lang["id_chambre_label"]; ?>
                            </label> 
                            <select id="<?php echo $lang["id_chambre_id"]; ?>" class="form-control select2">
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="<?php echo $lang["date_upload_id"]; ?>"><?php echo $lang["date_upload_label"]; ?></label> 
                            <input readonly id="<?php echo $lang["date_upload_id"]; ?>" placeholder="<?php echo $lang["date_upload_placeholder"]; ?>" class="form-control " type="text" >
                        </div>

                        <div class="form-group">
                            <label for="<?php echo $lang["id_user_id"]; ?>"><?php echo $lang["id_user_label"]; ?></label> 
                            <input id="<?php echo $lang["id_user_id"]; ?>" placeholder="<?php echo $lang["id_user_placeholder"]; ?>" class="form-control " type="text" >
                        </div>

                        <div>
                            <button id="btn_save" data-api="add" class="btn btn-sm btn-primary pull-right m-t-n-xs"><strong>Save</strong></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var page = 1;
    var maxPage = <?php echo $nbrPages; ?>;
    var apiName = 'syno_photos';
    var lastResponseData = null;
    var hiddenColumns = [false, false, false, false, false, false];

    function getData() {
        var obj = {
            <?php echo $lang["id_id"]; ?>: valById("<?php echo $lang["id_id"]; ?>"),
            <?php echo $lang["org_name_id"]; ?>: valById("<?php echo $lang["org_name_id"]; ?>"),
            <?php echo $lang["new_name_id"]; ?>: valById("<?php echo $lang["new_name_id"]; ?>"),
            <?php echo $lang["id_chambre_id"]; ?>: valById("<?php echo $lang["id_chambre_id"]; ?>"),
            <?php echo $lang["date_upload_id"]; ?>: valById("<?php echo $lang["date_upload_id"]; ?>"),
            <?php echo $lang["id_user_id"]; ?>: valById("<?php echo $lang["id_user_id"]; ?>"),
        };
        return obj;
    }

    function checkData(data) {
        return true;
    }

    function updateAPI() {
        uploader.startUpload();
    }

    var uploader;
    function addAPI() {
        uploader.startUpload();
    }

    function deleteAPI() {
        var elements = document.getElementsByClassName('i-checks');
        var ids = '';
        var elementToRemove = 0;
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].checked) {
                ids += elements[i].value + ',';
                elementToRemove++;
            }
        }
        if (ids.length > 0) {
            ids = ids.substring(0, ids.length - 1);
            $.ajax({
                url: API_BASE_URL + apiName + '&action=delete',
                method: 'POST',
                data: {
                    ids: ids
                },
                success: function (response) {
                    if (response.err == 0) {
                        showNotification('DONE', response.msg);
                        if (page == maxPage) {
                            prevPage();
                        }
                        listAPI(page);
                        var nbr = $('#nbrOf_syno_photos').text();
                        nbr -= elementToRemove;
                        $('#nbrOf_syno_photos').text(nbr);
                    }
                },
                error: function (response) {},
                complete: function () {},
                beforeSend: function () {}
            });
        }
    }

    function listAPI(page) {
        var objData = {};
        objData.page = page;
        var search_value = $('#search_value').val().trim();
        var search_by = $('#search_by').val();

        if (search_value != '') {
            objData.search_value = search_value;
            objData.search_by = search_by;
        }
        $.ajax({
            url: API_BASE_URL + apiName + '&action=list',
            method: 'POST',
            data: objData,
            success: function (response) {
                if (response.err == 0) {
                    lastResponseData = response.data;
                    $('#syno_photos_body_id').html('');
                    var html = '';
                    var addedHtml = ["<span class='label label-", "primary", "'><i class='fa fa-", 'check', "'></i></span>"];
                    for (var i = 0; i < response.data.length; i++) {
                        html = '<tr id="id_' + i + '" class="">';
                        html += '<td class="check-mail">';
                        html += '<input value="' + response.data[i].id + '" type="checkbox" class="i-checks">';
                        html += '</td>';
                        html += "<td id=\"cell_" + i + "_0\" class=\"mail-contact\">" + response.data[i].id + "</td>";
                        html += "<td id=\"cell_" + i + "_1\" class=\"mail-contact\">" + nullToStr(response.data[i].org_name) + "</td>";
                        html += "<td id=\"cell_" + i + "_2\" class=\"mail-contact\">" + nullToStr(response.data[i].new_name) + "</td>";
                        html += "<td id=\"cell_" + i + "_3\" class=\"mail-contact\">" + nullToStr(response.data[i].id_chambre) + "</td>";
                        html += "<td id=\"cell_" + i + "_4\" class=\"mail-contact\">" + nullToStr(response.data[i].date_upload) + "</td>";
                        html += "<td id=\"cell_" + i + "_5\" class=\"mail-contact\">" + nullToStr(response.data[i].id_user) + "</td>";

                        html += '<td class="">' +
                                '<button onclick="btn_edit_click(' + i + ');" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>' +
                                '</td>';
                        //html += '<td class="text-right mail-date"></td>';
                        html += '</tr>';
                        $('#syno_photos_body_id').append(html);

                        var tr = document.getElementById('id_' + i);
                        applyClasses(tr);
                        $(tr.children[0].children[0]).iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });
                    }

                    for (var i = 0; i < hiddenColumns.length; i++) {
                        show_hide(hiddenColumns[i]);
                    }
                    $('#nPage').text('Page : ' + page + ' - ' + response.extra.Pages);
                    $('#nbrOf_syno_photos').text('Number : ' + response.extra.NbrQ + ' Total : ' + response.extra.NbrT);
                }
            },
            error: function (response) {},
            complete: function () {},
            beforeSend: function () {}
        });
    }

    function nextPage() {
        if (page < maxPage)
        {
            page++;
            return true;
        }
        return false;
    }

    function prevPage() {
        if (page > 1) {
            page--;
            return true;
        }
        return false;
    }

    function btn_edit_click(index) {
        var data = lastResponseData[index];
        $('#btn_save').attr('data-api', 'update');
        $("#<?php echo $lang["id_id"]; ?>").val(data.id);
        $("#<?php echo $lang["org_name_id"]; ?>").val(data.org_name);
        $("#<?php echo $lang["new_name_id"]; ?>").val(data.new_name);
        $("#<?php echo $lang["id_chambre_id"]; ?>").val(data.id_chambre);
        $("#<?php echo $lang["date_upload_id"]; ?>").val(data.date_upload);
        $("#<?php echo $lang["id_user_id"]; ?>").val(data.id_user);

        $('#modal-form').modal('show');
    }


    $(function () {
        uploader = $("#<?php echo $lang["new_name_id"]; ?>").uploadFile({
            url: "api/?api=upload",
            autoSubmit: false,
            sequential: true,
            showProgress: true,
            multiple: true,
            dragDrop: true,
            dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
            fileName: "pictures",
            dynamicFormData: function () {
                var data = {
                    "id": $("#<?php echo $lang["id_id"]; ?>").val(),
                    "chambre_id": $('#<?php echo $lang["id_chambre_id"]; ?>').val()
                };
                return data;
            },
            cancelStr: '<button class="btn btn-xs btn-danger">Cancel</button>',
            multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers ne sont pas autorisés.",
            uploadStr: "<button class='btn btn-primary'>Téléchargez</button>",
            allowedTypes: "jpg,png,gif,jpeg,tiff",
            onSubmit: function (files) {
                $('#loading_gif').show();
            },
            onSuccess: function (files, data, xhr, pd) {
                $('#loading_gif').hide();
                showNotification(data.msg, (data.err == 0 ? 'success' : 'danger'));
                listAPI(page);
                var nbr = $('#nbrOf_syno_photos').text();
                nbr++;
                $('#nbrOf_syno_photos').text(nbr);
            }
        });

        makeOptionsFromAPI('syno_chambre', '<?php echo $lang["id_chambre_id"]; ?>');

        listAPI(page);

        $('#btn_search').click(function () {
            event.preventDefault();
            event.stopPropagation();
            var search_value = $('#search_value').val().trim();

            if (search_value != '') {
                page = 1;
                listAPI(page);
            } else {
                page = 1;
                listAPI(page);
            }
        });

        var selectBtnValues = ['Select All', 'Deselect All'];
        var selectBtnSelectedIndex = 0;
        $('#btn_checkAll').click(function () {
            if (selectBtnSelectedIndex == 0) {
                iCheckToggleByClass('i-checks', 'check');
                $(this).html('<i class="fa fa-check"></i> ' + selectBtnValues[1]);
                selectBtnSelectedIndex = 1;
            } else {
                selectBtnSelectedIndex = 0;
                iCheckToggleByClass('i-checks', 'uncheck');
                $(this).html('<i class="fa fa-check"></i> ' + selectBtnValues[0]);
            }


        });

        $('#btn_prev').click(function () {
            if (prevPage()) {
                listAPI(page);
            }
        });

        $('#btn_remove').click(deleteAPI);

        $('#btn_refresh').click(function () {
            listAPI(page);
        });

        $('#btn_save').click(function () {
            var data_api = $('#btn_save').attr('data-api');            
            if (data_api == 'add') {
                console.log('ADD');
                addAPI();
            } else {
                updateAPI();
            }

        });

        $('#btn_new').click(function () {
            $('#btn_save').attr('data-api', 'add');
        });

        $('#btn_next').click(function (event) {
            if (nextPage()) {
                listAPI(page);
            }
        });
    });
</script>